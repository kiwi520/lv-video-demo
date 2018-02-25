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


    public function comLesson($row){
        if(is_numeric($row)){
            $data = Lesson::where('iscommend',1)->limit($row)->get();

            return $this->response($data);
        }

    }


    public function hotLesson($row){
        if(is_numeric($row)){
            $data = Lesson::where('iscommend',1)->limit($row)->get();

            return $this->response($data);
        }

    }
}
