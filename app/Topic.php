<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    public static function insert_into_table($new_question)
    {

    	$username=$new_question->username;
    	$topic=$new_question->topic;
    	// echo($username);
    		$check_duplicate =Topic::select('id')->where('username',$username)->where('topic',$topic)->first();
    		if(sizeof($check_duplicate)>0)
    		{
    			return "same topic with this username already exists";
    		}
    		
    		return Topic::insert(
    		['username'=>$new_question->username,
    		 'topic'=>$new_question->topic,
    		 'category'=>$new_question->category,
    		 'winners'=>"",
    		 'loosers'=>"",
    		 'correct_ans'=>0,
    		 'incorrect_ans'=>0
    		]);
    }



    public static function get_rank_list($topic)
    {

        $winners_loosers=Topic::select('winners','loosers')->where('topic',$topic)->first();
        // echo($topic." ");
        $winners=explode(',',$winners_loosers->winners);
        $loosers=explode(',',$winners_loosers->loosers);

        $length=count($winners);

        $winners_associative_arr=array();
        $loosers_associative_arr=array();
        for($i=0;$i<$length-1;$i++)
        {
            if(array_key_exists($winners[$i],$winners_associative_arr))
            {
                $winners_associative_arr[$winners[$i]]+=1;
            }

            else
            {
                $winners_associative_arr[$winners[$i]]= 1;
            }
        }


        for($i=0;$i<$length-1;$i++)
        {
            if(array_key_exists($loosers[$i],$loosers_associative_arr))
            {
                $loosers_associative_arr[$loosers[$i]]+=1;
            }

            else
            {
                $loosers_associative_arr[$loosers[$i]] =1 ;
            }
        }

        $rank_list=array();
        // print_r($winners_associative_arr);

        // echo($name);

        foreach ($winners_associative_arr as $username => $wins) {
            // echo("h");
            // print_r($username);//." ".$wins);
            $total_matches=$wins;
            if(array_key_exists($username,$loosers_associative_arr))
            {
               $total_matches+= $loosers_associative_arr[$username];
               unset($loosers_associative_arr[$username]);
            }
            // echo($total_matches);
            $rating=round(($wins*$wins)/$total_matches,2);
            $rank_list[$username]=$rating;

        }

        foreach ($loosers_associative_arr as $username => $losses) {
            $rank_list[$username]=0;
        }

   

        arsort($rank_list);
 
        return $rank_list;

    }
}
