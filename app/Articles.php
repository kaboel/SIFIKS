<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function admin() {
        return $this->belongsTo('App\Admin', 'writer_id');
    }

    public function doctor() {
        return $this->belongsTo('App\Doctor', 'writer_id');
    }

    public function cutStr($str){
        if (strlen($str) > 200){
            return substr($str,0,200) . "...";
        }
        return $str;
    }

    public function trimStr($str) {
        if(strlen($str) > 20) {
            return substr($str, 0, 20) . "...";
        }
        return $str;
    }
}
