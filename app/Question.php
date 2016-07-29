<?php

namespace App;

use App\Info;
use Auth;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
      

    public static function insert_into_table($new_question)
    {
        // echo($new_question->username);
        // echo($new_question->topic);

          Question::insert(
        ['username'=>$new_question->username,
        'topic'=>$new_question->topic,
        'category'=>$new_question->category,
        'question'=>$new_question->question,
        'option1'=>$new_question->option1,
        'option2'=>$new_question->option2,
        'option3'=>$new_question->option3,
        'option4'=>$new_question->option4,
        ]);
    }
   

   //returns array of randomly collected questions and options arranged randomly 
   public static function set_questions_to_play($opponent_username,$topic)  
     {

     	$no_of_questions=7;
     	$questions_id ="";
        $temp_que=Question::orderByRaw('RAND()')->take($no_of_questions)->select('id')->where('topic',$topic)->get();
       
        $n=sizeof($temp_que);

       if(Info::check_questions_set()=="true")
       {
       		return;
       }

       else
       {

       	for($i=0;$i<$n;$i++)
       	{
       		
       		//array_push($questions_id,$temp_que[$i]->id);
       		$questions_id.=($temp_que[$i]->id.",");
       		Info::set_questions($opponent_username,$questions_id);
       
       	}

       }

       	// $selected_question_ids=array();

       	// for($i=0;$i<$no_of_questions;$i++)
       	// {
       	// 	 $random=rand()%$n;
       	// 	 array_push($selected_question_ids,$questions[$random]);
       	// 	 unset($questions[$random]);
       	// 	 $questions=array_values($questions);
       	// 	$options_arr[0]=$temp_que[$random]->option1;
       	// 	$options_arr[1]=$temp_que[$random]->option2;
       	// 	$options_arr[2]=$temp_que[$random]->option3;
       	// 	$options_arr[3]=$temp_que[$random]->option4;
       	// 	$no_options=4;
       	// 	for($j=0;$j<4;$j++)
       	// 	{
       	// 		$option_rand=rand()%$no_options;
       	// 		$option="option".$j;
       	// 		echo($questions[0]);
       	// 		$questions[$i]->$option=$options_arr[$option_rand];
       	// 		$no_options--;
       	// 		unset($options_arr[$option_rand]);
       	// 	}
       	// 	$n--;
       	// }

       	// print_r($selected_question_ids);
       	// print_r($questions);

       	// return $questions;
    

 	}


     public static function get_questions_to_play($opponent_username,$topic)
     {
     		$no_of_questions=7;
     		Question::set_questions_to_play($opponent_username,$topic);

     		$questions_id=Info::select('questions_to_play')->where('username',Auth::user()->username)->first();
     		// print_r($que->questions_to_play);
     		$questions_id_arr=explode(',',$questions_id->questions_to_play);
     		$questions=array();
     		$options_arr=array(  );
     		for($i=0;$i<$no_of_questions;$i++)
     		{
     			// echo($questions_id_arr[$i]);
     			$temp=Question::where('id',$questions_id_arr[$i])->first();
     			// echo($temp);
     			//array_push($questions, $temp);
     			$questions[]=$temp;

  	     		$options_arr[0]=$questions[$i]->option1;
	       		$options_arr[1]=$questions[$i]->option2;
	       		$options_arr[2]=$questions[$i]->option3;
	       		$options_arr[3]=$questions[$i]->option4;
       			$no_options=4;
	       		
	       		for($j=1;$j<=4;$j++)
	       		{
	       			$option_rand=rand()%$no_options;
	       			$option="option".$j;
	       			// echo($questions[0]);
	       			$questions[$i]->$option=$options_arr[$option_rand];
	       			$no_options--;
	       			unset($options_arr[$option_rand]);
	       			$options_arr=array_values($options_arr);
	       			// print_r($options_arr);
	       		}


     		}

     		return $questions;
     }

}
