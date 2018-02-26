<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LessonController extends CommonController
{
    /**
     * 获取所有课程
     * @return \Illuminate\Http\JsonResponse
     */
    public function lesson($tid){

            if($tid){
                $data = DB::table('lessons')
                    ->join('tag_lessons', 'lessons.id', '=', 'tag_lessons.lesson_id')
                    ->where('tag_id',$tid)
                    ->get();
            }else{
                $data = Lesson::get();
            }

            return $this->response($data);
    }


    public function comLesson($row,Request $request){
        if(is_numeric($row)){
            $data = Lesson::where('iscommend',1)->limit($row)->get();
            foreach ($data as $k=> $v){
                if($k == 'preview'){
                   $host = $request->server('HTTP_HOST');
                   $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                    $v['preview'] = $http_type.$host.'/'.$v['preview'];
                }
            }
            return $this->response($data);
        }

    }


    public function hotLesson($row,Request $request){
        if(is_numeric($row)){
            $data = Lesson::where('iscommend',1)->limit($row)->get();
            foreach ($data as $k=> $v){
                if($k == 'preview'){
                    $host = $request->server('HTTP_HOST');
                    $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                    $v['preview'] = $http_type.$host.'/'.$v['preview'];
                }
            }
            return $this->response($data);
        }

    }
}
