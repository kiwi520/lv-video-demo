<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ["_token","file"];

    /**
     *  与视频模型一对多关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos(){
        return $this->hasMany(Video::class);
    }
}
