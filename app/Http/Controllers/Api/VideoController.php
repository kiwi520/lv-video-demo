<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class VideoController extends Controller
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
    public function getLessons($lid){
        if(is_numeric($lid)){
            $data = DB::table('videos')->where(["lesson_id"=>$lid])->select('id','title','path')->get();
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
    }

    /**
     * 获取所有热门视频
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHost(){
            $hids = DB::table('lessons')->where(["ishot"=>1])->select('id')->get()->toArray();
            $new_hids = [];
            foreach ($hids as $k =>$v){
                $new_hids[] = $v->id;
            }
            if(count($new_hids)>0){
                $data = DB::table('videos')->whereIn("lesson_id",$new_hids)->get();
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
    }


    /**
     * 获取所有推荐视频
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommend(){
        $hids = DB::table('lessons')->where(["iscommend"=>1])->select('id')->get()->toArray();
        $new_hids = [];
        foreach ($hids as $k =>$v){
            $new_hids[] = $v->id;
        }
        if(count($new_hids)>0){
            $data = DB::table('videos')->whereIn("lesson_id",$new_hids)->get();
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
    }
}
