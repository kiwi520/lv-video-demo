<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lesson;
use App\Models\Tag;
use App\Models\TagLesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lesson::get();
        return view("admin.lesson.index",compact("data"));
//        return view("admin.tag.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get(["id","title"]);
        return view("admin.lesson.create",compact("tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $model = new Lesson();
        if($ids = $model->create($request->all())){
            if(is_numeric($ids->id)){
                $lesson_id = $ids->id;
                $tag_id = $request->input("tag_id");
                if($lesson_id && $tag_id){
                    $lt = new TagLesson();
                    $lt->tag_id = $tag_id;
                    $lt->lesson_id = $lesson_id;
                    $lt->save();

                    flash('标签添加成功！！！')->overlay();

                    return redirect("admin/lesson");
                }
            }

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
        //
    }


    public function uploadImage(Request $request){
        if (!$request->hasFile('file')) {
            return response()->json([], 500, '无法获取上传文件');
        }
        $file = $request->file('file');

//        var_dump($file);

        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
//            $ext = $file->getClientOriginalExtension();     // 扩展名
//            $realPath = $file->getRealPath();   //临时文件的绝对路径
//            $type = $file->getClientMimeType();     // image/jpeg

            // 上传文件
//            $filename = date('Ymd/His').$originalName;
            // 使用我们新建的uploads本地存储空间（目录）
            $path = $file->store('video-desc', 'lesson');
            $img = Image::make('lesson/'.$path)->resize(200, 250);
            $img->save('lesson/'.$path);
            return response()->json([
                'status_code' => 200,
                'message' => 'success',
                'photo' => asset('lesson/'.$path),
                'origin' => 'lesson/'.$path,
                'name' => $originalName,
            ]);

        } else {
            return response()->json([], 500, '文件未通过验证');
        }
    }



//        $input = $request->all();
//        $input['preview'] = time().'.jpg';
//        $request->image->move(public_path('images/admin'), $input['preview']);
//
//
//        echo 1;
        //生成路径，图片存储
//        $ext = $request->preview->getClientOriginalExtension();
//////        $cover_path = "images/" . time() . $ext;
////        $name = "preview".time();
////        $src = "images/preview". $name .$ext;
////        Image::make($request->preview)->save(public_path($src));
//
//        echo $ext;
//    }
}
