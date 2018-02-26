<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
}
