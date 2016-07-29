<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    //
    public static function get_info($username)
    {
    	return Info::where('username',$username)->first();
    }


    // returns associative array of rank list in sorted order 
// not working



    // checks whether questions for this users already set or not
    public static function check_questions_set()
    {
       $no_of_questions=3;
      $questions_to_play=Info::select('questions_to_play')->where('username',Auth::user()->username)->first();
      $questions_ids=explode(',',$questions_to_play->questions_to_play);
      if(count($questions_ids)>=$no_of_questions-1)
      {
        return "true";
      }

      else
        return "false";
    }

    public static function set_questions($opponent_username,$questions_id)
    {
        Info::where('username',Auth::user()->username)->update(['questions_to_play'=>$questions_id]);
        Info::where('username',$opponent_username)->update(['questions_to_play'=>$questions_id]);

    }



    public static function get_rank_list()
    {

    	$all_users=Info::select('username','opponent_scores','my_scores')->get();
    	$length=sizeof($all_users);

    	for($i=0;$i<$length;$i++)
          {
            $my_score=explode(',',$all_users[$i]->my_scores);
            $opponent_score=explode(',',$all_users[$i]->opponent_scores);     

            $matches=count($my_score);     
            $win=0;
            $lost=0; 
            for($j=0;$j<$matches;$j++)
            { 
             if(($my_score[$j]-$opponent_score[$j])>0)
             {
              $win++;
             }

             else
             {
              $lost++;
             }

             
           }
           $result[$i]=round(($win*$win)/($lost+$win),2);
          }

          $result_array = array( );
          for($i=0;$i<$length;$i++)
          {

          	$result_array+=array($all_users[$i]->username=>$result[$i]);

          }

          arsort($result_array);

          return $result_array;
    }


}
