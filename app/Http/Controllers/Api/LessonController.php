<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    /**
     * 获取所有课程
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $data = DB::table('lessons')->select('id','title','introduce','preview','click')->get()->toArray();
        if(count($data)>0){
            return response()->json([
                'status_code' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        }else{
            return response()->json([
                'status_code' => 404,
                'message' => 'not found'
            ]);
        }
    }
}
