<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class New_question extends Model
{
    //

    public static function delete_topic($topic,$username)
    {
    	New_question::where('topic',$topic)->where('username',$username)->delete();
    }
}
