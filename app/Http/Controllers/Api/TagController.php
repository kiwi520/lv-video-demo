<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class TagController extends Controller
{
    /**
     * 获取所有列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $data = DB::table('tags')->select('id', 'name')->get()->toArray();
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
