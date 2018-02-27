<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
class VideoController extends CommonController
{
    /**
     * 获取全部视频
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $data = DB::table('videos')->select('id','title','path')->get();
        if(count($data)>0){
            return response()->json([
                'status_code' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'not found',
            ]);
        }
    }


    /**
     * 根据所属视频课程类别获取视频
     * @param $lid lesson_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLessons($lid,Request $request){
        if(is_numeric($lid)){
            $data = DB::table('videos')->where(["lesson_id"=>$lid])->get()->toArray();
            if($data){
                $newData = [];
                foreach ($data as $k=> $v){
                    foreach ($v as $m=>$s){
                        if($m == "path"){
                            $host = $request->server('HTTP_HOST');
                            $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                            $newData[$k][$m]=$http_type.$host.'/'.$s;
                        }else{
                            $newData[$k][$m]=$s;
                        }
                    }
                }
                return $this->response($newData);
            }else{
                return $this->response($data,404);
            }
        }
    }

//    /**
//     * 获取所有热门视频
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function getHot(){
//            $hids = DB::table('lessons')->where(["ishot"=>1])->select('id')->get()->toArray();
//            $new_hids = [];
//            foreach ($hids as $k =>$v){
//                $new_hids[] = $v->id;
//            }
//            if(count($new_hids)>0){
//                $data = DB::table('videos')->whereIn("lesson_id",$new_hids)->get();
////                dd($data);
//                if(count($data)>0){
//                    return $this->response($data);
//                }else{
//                    return $this->response($data,404);
//                }
//            }
//    }
//
//
//    /**
//     * 获取所有推荐视频
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function getCommend(){
//        $hids = DB::table('lessons')->where(["iscommend"=>1])->select('id')->get()->toArray();
//        $new_hids = [];
//        foreach ($hids as $k =>$v){
//            $new_hids[] = $v->id;
//        }
//        if(count($new_hids)>0){
//            $data = DB::table('videos')->whereIn("lesson_id",$new_hids)->get();
//            if(count($data)>0){
//                return response()->json([
//                    'status_code' => 200,
//                    'message' => 'success',
//                    'data' => $data
//                ]);
//            }else{
//                return response()->json([
//                    'status_code' => 404,
//                    'message' => 'not found',
//                ]);
//            }
//        }
//    }


    public function range($offset = 30,$path ='',$maxlength = 10){
        $path = public_path()."/videos/1519188479040.mp4";
//        $ffmpeg_path       = Config::get("phpFFmpeg.ffmpeg"); //ffmpeg运行的路径
//        $ffprobe_path      = Config::get("phpFFmpeg.ffprobe"); //ffprobe运行路径
        $logger = public_path()."/public/ffpmeg.log";
//        dd($logger);
        $ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
        ));
        $video = $ffmpeg->open($path);


        $video->filters()->clip(TimeCode::fromSeconds($offset), TimeCode::fromSeconds($maxlength));
//        $video->resize(new Dimension(320, 240));
//        $video->synchronize();
//        $data = $video->save(new X264(),substr($path,0,-8).'.mp4');
        $format = new X264();
        $data = $video->save($format,public_path().'/export-x264.mp4');
        dd($data);
        return $this->response($data);
    }
}
