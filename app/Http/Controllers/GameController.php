<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Info;

use App\Http\Controllers\Controller;

use Auth;
use App\Topic;
use App\Question;
use App\Http\Requests;

class GameController extends Controller
{
	// for authentication 

	public function __construct()
    {
        $this->middleware('auth');
    }



   public function searching($topic)
   { 

   
       // echo($topic);
   	   $user=Auth::user();
   	   // status of all opponents to check if someone is playing with user
       $self_status=Info::where('username',$user->username)->select('status')->first();
       $opponents=Info::where('topic',$topic)->where('status','waiting')->get();

       // needs to change
        if(sizeof($self_status)>0 )
       {

         if($self_status->status!="waiting")
           {
           $opponent_arr=explode(" ", $self_status->status);
           $opponent=Info::where('username',$opponent_arr[2])->first();

           // echo("found");
           $questions=Question::get_questions_to_play($opponent->username,$topic);   // get questions to play

           return view('/game/playing',compact('opponent','questions')); 
            }

        }
 
       
       if(sizeof($opponents)>1)
       {
       		// echo("found");
       		foreach ($opponents as $player) 
       		{
         		if($player->username!=$user->username)
         		{
         			$opponent=$player;
         			Info::where('username',$user->username)->update(['status'=>'playing with '.$opponent->username]);
         			Info::where('username',$opponent->username)->update(['status'=>'playing with '.$user->username]);
              $questions=Question::get_questions_to_play($opponent->username,$topic);   // get questions to play
         			return view('/game/playing',compact('opponent','questions')); 
         			break;
         		}
         		
         	}
       }


   }


    public function play($topic)
   {
        // $this->set_topic("done");

        $user=Auth::user();

    		Info::where('username',$user->username)->update(['topic'=>$topic,'status'=>"waiting",'current_score'=>0]);
        // $opponents=Info::where('topic',$topic)->where('status','waiting')->get();

		    return view('/game/searching',compact('topic'));

   }








	public function validate_ans($question_id,$selected_option,$time_remaining)
	{
		
		$user=Auth::user();
    $ans=Question::select('option1')->where('id',$question_id)->first();
    $points=0;
    $fixed_point=10;
    // $time_remaining=10;
   // echo($ans->option1." ".$selected_option);
    $selected_option=rtrim($selected_option);
    $selected_option=ltrim($selected_option);
    $ans=rtrim($ans->option1);
    $ans=ltrim($ans);
    if($ans==$selected_option)
    {
      $points=$time_remaining+$fixed_point;
    }
    // echo("sop".$selected_option."sop".$ans->option1."result".($ans->option1==$selected_option));
		Info::where('username',$user->username)->increment('current_score', $points);
		// echo ("true");
	}


  // returns score of the opponent who left the match in between
  public function get_left_opponent($user)
  {
        $status_arr=explode(' ',$user->status);
        // echo($user->username);
        // echo($status_arr[2]);
        // $status_arr[1]="hey";
        $opponent=Info::where('username',$status_arr[2])->first();
        
        $opponent_opponents_arr=explode(',',$opponent->opponents);
        $opponent_my_scores=explode(',',$opponent->my_scores);
        $opponent_opponent_score=explode(',',$opponent->opponent_scores);

        $size=count($opponent_opponents_arr);
        $index=-1;
        for($i=$size-1;$i>=0;$i--)
        {
          if($opponent_opponents_arr[$i]==$user->username)
          {
            $index=$i;
            break;
          }
        }

        // echo($index." iu ".$user->username);
               // echo($opponent->opponent_score[$index]." ".$user->current_score);

      $opponent_opponent_score[$index]=$user->current_score;
      $opponent->opponent_score=implode(',', $opponent_opponent_score);
      Info::where('username',$opponent->username)->update(['opponent_scores'=>$opponent->opponent_score]);
      return $opponent_my_scores[$index];
  }


   public function display_scores()
   {
   		$user=Auth::user();
   		$user_score=Info::where('username',$user->username)->first();
   		echo($user_score->current_score."-");
      $status="playing with ".$user->username;
      $opponent_score=Info::where('status',$status)->select('current_score')->first();
      if(sizeof($opponent_score)>0)
      {
        echo($opponent_score->current_score);
      }

      else
      {

   		$opponent_score=$this->get_left_opponent($user_score);

      echo($opponent_score);

      }


   }





// funciton not used yet

   public function update_user_info($current_opponent,$opponent_score)
   {
      $user=Auth::user();
      $user_info=Info::get_info($user->username);
      $opponents=$user_info->opponents.$current_opponent.",";
      $my_scores=$user_info->my_scores.$user_info->current_score.",";
      $topics=$user_info->topics.$user_info->topic.",";
      $opponent_scores=$user_info->opponent_scores.$opponent_score.","  ;



      Info::where('username',$user->username)->update(['status'=>'online','opponents'=>$opponents,'my_scores'=>$my_scores,'topics'=>$topics,'opponent_scores'=>$opponent_scores,'questions_to_play'=>"no questions"]);


      // $this->update_user_info()
   }



   public function update_topics_table($topic)
   {

     $user=Auth::user(); 
     $user_info=Info::get_info($user->username);
     $status_arr=explode(' ',$user_info->status);     
     $topic_row=Topic::where('topic',$topic)->first();

     $my_score=$user_info->current_score;
     $loosers=$topic_row->loosers;
     $winners=$topic_row->winners;



      $opponent=Info::where('username',$status_arr[2])->first();
      
      $opponent_opponents_arr=explode(',',$opponent->opponents);
      $opponent_my_scores=explode(',',$opponent->my_scores);
      $opponent_opponent_score=explode(',',$opponent->opponent_scores);

      $size=count($opponent_opponents_arr);
      $index=-1;
      for($i=$size-1;$i>=0;$i--)
      {
        if($opponent_opponents_arr[$i]==$user->username)
        {
          $index=$i;
          break;
        }
      }

      if($my_score>$opponent_my_scores[$index])
      {
        $winners.=($user->username.",");
        $loosers.=($opponent->username.",");
      }

      else if($my_score<$opponent_my_scores[$index])
      {
         $winners.=($opponent->username.",");
         $loosers.=($user->username.",");
      }

     // if($my_score>$opponent_score)
     // {
     //   $winners.=($user->username.",");
     // }

     // else
     // {
     //    $loosers.=($user->username.",");
     // }

     Topic::where('topic',$topic)->update(['winners'=>$winners,'loosers'=>$loosers]);
   

   }



   public function user_left_before_starting()
   {  
      $user=Auth::user();
      Info::where('username',$user->username)->update(['status'=>'online']);
   }


   public function result()
   {  

      $user=Info::where('username',Auth::user()->username)->first();
      $status_arr=explode(' ',$user->status);
      // print_r($status_arr);
      $current_opponent=$status_arr[2];
      $opponent=Info::where('username',$current_opponent)->first();
      if($opponent->status!='online' && $opponent->status!='waiting')
      {
      
        $topic=$user->topic;
        $opponent_score=$opponent->current_score;

      }

      else
      {
       $opponent_score=$this->get_left_opponent($user);
       $this->update_topics_table($user->topic);
       // $this->update_topics_table($user->topic,$opponent_score);
      }


      $this->update_user_info($current_opponent,$opponent_score);

      return view('/game/result',compact('user','opponent'));

   }


}




   // public function display_scores()
   // {
   //    $user=Auth::user();
   //    $user_score=Info::select('current_score')->where('username',$user->username)->first();
   //    echo($user_score->current_score."<br>");
   //    // if want to remove <br> than function calling this using ajax should be changed to get the scores of the players
   //    $status="playing with ".$user->username;
   //    $opponent_score=Info::where('status',$status)->select('current_score')->first();
   //    if(sizeof($opponent_score)==0)
   //    {
   //       return "-1";
   //    }

   //    echo($opponent_score->current_score);
   // }







    // for finding pair 

   //  public static $topic;

   // public function set_topic($topic)
   // {

   //    self::$topic=$topic;
      

   // }

   // private function get_topic()
   // {

   //  return self::$topic;
   // }
    //  tried other way didn't work out       
       //    // foreach ($self_status as $already_playing) 
       //    {         
       //     // if($already_playing->topic!=$topic)
       //      // {
           
       //    //   Info::where('status',$already_playing)->update(['status'=>'player_left']);
       //    // }

       //   //    if($self_status->status=='waiting')
       //   //    {

       //   //    }

       //   //  else
       //   //  {
       //   //    Info::where('username',$user->username)->update(['status'=>'playing with '.$already_playing->username]);

       //   //   $opponent_arr=explode(" ", $self_status->status);
       //     //  $opponent=Info::where('username',$opponent_arr[2])->first();

       //     //  // // echo("found");
       //   //   $questions=Question::get_questions_to_play($opponent->username,$topic);   // get questions to play

       //   //   return view('/game/playing',compact('opponent','questions')); 
       //   //  }
       //   }
       // }
