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
                    ->get()->toArray();
            }else{
                $data = Lesson::get();
            }

            return $this->response($data);
    }


    public function comLesson($row,Request $request){
        if(is_numeric($row)){
            $data = Lesson::where('iscommend',1)->limit($row)->get()->toArray();
            $newData = [];
            foreach ($data as $k => $v){
                foreach ($v as $m=>$s){
                    if($m == "preview"){
                        $host = $request->server('HTTP_HOST');
                        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                        $newData[$k][$m]=$http_type.$host.'/'.$s;
                    }else{
                        $newData[$k][$m]=$s;
                    }

                }
//                $host = $request->server('HTTP_HOST');
//                $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
//                $newData[$k]['id'] = $v['id'];
//                $newData[$k]['title'] = $v['title'];
//                $newData[$k]['introduce'] = $v['introduce'];
//                $newData[$k]['preview'] = $http_type.$host.'/'.$v['preview'];
//                $newData[$k]['iscommend'] = $v['iscommend'];
//                $newData[$k]['ishot'] = $v['ishot'];
//                $newData[$k]['click'] = $v['click'];
//                $newData[$k]['created_at'] = $v['created_at'];
//                $newData[$k]['updated_at'] = $v['updated_at'];
            }
            return $this->response($newData);
        }

    }


    public function hotLesson($row,Request $request){
        if(is_numeric($row)){
            $data = Lesson::where('iscommend',1)->limit($row)->get()->toArray();
            $newData = [];
            foreach ($data as $k=> $v){
                foreach ($v as $m=>$s){
                    if($m == "preview"){
                        $host = $request->server('HTTP_HOST');
                        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
                        $newData[$k][$m]=$http_type.$host.'/'.$s;
                    }else{
                        $newData[$k][$m]=$s;
                    }

                }
            }
            return $this->response($newData);
        }

    }
}
