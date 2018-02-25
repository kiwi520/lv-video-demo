<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lesson;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = video::get();
        return view("admin.video.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lessons = Lesson::get(["id","title"]);
        return view("admin.video.create",compact("lessons"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Video();
        if($model->create($request->all())){
            flash('视频添加成功！！！')->overlay();

            return redirect("/admin/video");
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_numeric($id)){
            $path = Video::where(["id"=>$id])->select(["path"])->get();

            $full = public_path($path->first()["path"]);
//            echo $path->first()["path"];
//            echo $path->first()["path"];
            if(is_file($full)){
                unlink($full);
                Video::destroy($id);

                return response()->json([
                    'status_code' => 200,
                    'message' => 'success'
                ]);
            }else{
                Video::destroy($id);
                return response()->json([
                    'status_code' => 404,
                    'message' => 'not fond'
                ]);
            }

        };
    }

    public function uploadVideo(){
        if($_FILES["file"]){
            $filepath=public_path("/videos/");
            $randname=$_POST["name"]. '-' . $_POST['index'];
            //将临时位置的文件移动到指定的目录上即可
            if(is_uploaded_file($_FILES["file"]["tmp_name"])){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath.$randname)){
                    echo "上传成功";
                }else{
                    echo "上传失败";
                }
            }else{
                echo "不是一个上传文件";
            }
        }
    }

    public function videoMerge(){
        $target = public_path("/videos/").$_POST["name"];
        $dst = fopen($target, 'wb');

        for($i = 0; $i < $_POST['index']; $i++) {
            $slice = $target . '-' . $i;
            $src = fopen($slice, 'rb');
            stream_copy_to_stream($src, $dst);
            fclose($src);
            unlink($slice);
        }

        fclose($dst);

        return response()->json([
            'status_code' => 200,
            'message' => 'success',
            'path' => '/videos/'.$_POST["name"]
        ]);
    }
}
