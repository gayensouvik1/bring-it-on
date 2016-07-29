<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Http\Request;


use Auth;

use App\Question;

use App\Info;
use App\Topic;
use App\New_question;

use DB;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;

class TopicController extends Controller
{
   
   public function __construct()
    {
        $this->middleware('auth');
    }

   public function display_all()
   {
   		$topics_list = Topic::select('topic','category','username')->groupBy('topic')->orderBy('topic')->get();
   		// return "hello";
      // return Redirect::to('home');
   		return view('/topics/all',compact('topics_list'));
   } 

   public function display($topic_name)
   {

      $topic=Topic::where('topic',$topic_name)->first();
       if(sizeof($topic)<=0)
        return view('/errors/no_such_topic');

      $rank_list=Topic::get_rank_list($topic_name);
      return view('/topics/selected',compact('topic','rank_list'));

   }

   public function create()
   {
      $user=Auth::user();
      return view('/create/topic',compact('user'));
   }

   public function create_question()
   {
      return view('/create/question');
   }   


   public function upload_image_for_question($file,$target_name)
   {

     $filetype= pathinfo(basename($file['name']),PATHINFO_EXTENSION);
     $target_location=public_path()."/images/new_questions/".$target_name.".".$filetype;
     if(move_uploaded_file($file['tmp_name'],$target_location))
     {
       echo("done");
     }

     else
     {
      echo "problem in uploading questions images";
     }
   }

   public function upload_topics_icon($file,$target_name)
   {

     $filetype= pathinfo(basename($file['name']),PATHINFO_EXTENSION);
     $target_location=public_path()."/images/icons/".$target_name.".".$filetype;
     if(move_uploaded_file($file['tmp_name'],$target_location))
     {
       echo("done");
     }

     else
     {
      echo "problem in uploading questions images";
     }
   }

   public function submit_questions(Request $request)
   {
    $questions=$request->get('questions');

    $length=$request->get('questions_len');
      $str=explode(',', $questions);
      echo($questions."  ques ");
      echo($length." len  ");
      echo sizeof($str);
      $topic_picture="";
      if($_FILES['topic_picture']['name'])
      {
         $this->upload_topics_icon($_FILES['topic_picture'],$request->get('topic')."_".Auth::user()->username);
      }

      for($i=0;$i<$length;$i++)
      {

       $str[$i*5]= str_replace('`', ',', $str[$i*5]);
       $str[$i*5+1]= str_replace('`', ',', $str[$i*5+1]);
       $str[$i*5+2]= str_replace('`', ',', $str[$i*5+2]);
       $str[$i*5+3]= str_replace('`', ',', $str[$i*5+3]);
       $str[$i*5+4]= str_replace('`', ',', $str[$i*5+4]);

        // echo($questions);
      $update=New_question::insert(['username'=>Auth::user()->username,
            'topic'=>$request->get('topic'),
            'category'=>$request->get('category'),
            'question'=>$str[$i*5],
            'option1'=>$str[$i*5+1],
            'option2'=>$str[$i*5+2],
            'option3'=>$str[$i*5+3],
            'option4'=>$str[$i*5+4],
            ]);
        // $path=public_path().'/images/new_questions/';
        // mkdir($path);

        if($_FILES[$i+1]['name'])
          {

            $target_name=New_question::select('id')->orderBy('id','desc')->first()->id;

            $this->upload_image_for_question($_FILES[$i+1],$target_name);
          }

      }

      return redirect('/home');

   }



   // for empty string it return page not found because it 
   // checks for topics/search url which is not present
  public  function search($search_input)
  {
    $str_match = array();
    $all_topics=Question::select('topic')->distinct()->get();
    foreach ($all_topics as $topic)
    {
      $ans=0;
      $s2=strlen($search_input);

      $current_topic=strtolower($topic->topic);
      $size=strlen($current_topic);
      $search=strtolower($search_input);
      // echo("song ".$song." ".($size-$s2)."  <br>");
      for( $i=0;$i<=($size-$s2);$i++)
      {
        $ans2=0;
        // echo("i ".$i." <br>");
        for($j=0;$j<$s2;$j++)
        {
          // echo("j ".$j." <br>");
          $k=$j;        
          $ans3=0;
          while($k<$s2  && $current_topic[$i+$k]==$search[$k]  )
          {
          
            $ans3++;
            $k=$k+1;
            // echo("ans2 ".$ans2."<br> ");
          }

          if($ans3>$ans2)
          {
            $ans2=$ans3;
          }
        }

        if($ans2>$ans)
        {
          $ans=$ans2;
        }
      }

      
      $str_match+=array($current_topic=>$ans);
        // echo(" ans ".$ans." location ".$current_topic."<br>");
        // print_r($str_match);

    }
      arsort($str_match);

    $count=0;
    /// do it again doing almost good 
    foreach ($str_match as $key => $value) {
    
    if($count>=5 || $value<($s2)/2)
      break;
      
      // $sql="SELECT DISTINCT song_location,song_name,song_link FROM songs WHERE song_location ='$key'";
      // $result=$connect->query($sql);


      $search_result=Question::select('topic','category')->where('topic',$key)->distinct()->first();
      $str="<a style='' href='/topics/".$search_result->topic."'><li>".$search_result->topic."<br><span> Category : ".$search_result->category."<br></span></li></a>";
      echo($str);
    $count++;


  }


    // return $str_match;
    
  }







  // like unlike topic is controlled by this function only 
  public function like($topic)
  {      $user=Auth::user();
     $liked_by=Topic::select('liked_by')->where('topic',$topic)->first()->liked_by;

     $liked_by_arr=explode(',',$liked_by);

     $length=count($liked_by_arr)-1;

     for($i=0;$i<$length;$i++)
     {
        if($liked_by_arr[$i]==$user->username)
        {
          unset($liked_by_arr[$i]);
          $liked_by=implode(',',$liked_by_arr);
          Topic::where('topic',$topic)->update(['liked_by'=>$liked_by]);
          return "unliked";
        }
     }

     $liked_by.=($user->username.",");
     Topic::where('topic',$topic)->update(['liked_by'=>$liked_by]);
     return "liked";

  }


}

?>