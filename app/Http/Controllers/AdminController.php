<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\New_question;

use App\Topic;

use App\Question;

use Auth;

use App\Http\Requests;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
    	$user=User::select('admin','username')->where('username',Auth::user()->username)->first();
    	$new_topics=New_question::select('topic','category','username')->distinct()->get();
    	if($user->admin)
    	{
    		return view("/admin/home",compact('user','new_topics'));
    	}

    	else
    	{
        	return redirect("/home");
    	}
    }

    public function view_questions($topic,$category,$username)
    {
    	$new_questions=New_question::where('topic',$topic)->where('category',$category)->where('username',$username)->get();
    	return view('/admin/view_questions',compact('new_questions'));
    }

    public function delete_topic($topic,$username)
    {
        New_question::delete_topic($topic,$username);
    }

    public function add_topic($topic,$username)
    {

    	//move to questions table

    	//call delete_topic
    	$new_questions=New_question::where('topic',$topic)->where('username',$username)->get();
        Topic::insert_into_table($new_questions[0]);

        $topic_picture_type=$this->check_for_image($topic."_".$username);
        $topic_picture="";
        $topic_picture.=$topic_picture_type;
        
        if($topic_picture!="none")
        {
            $topic_picture=$topic."_".$username.$topic_picture_type;
            $old_location=public_path()."/images/new_questions/".$topic_picture;
            $new_location=public_path()."/images/questions/".$topic_picture;
            if(rename($old_location,$new_location))
            {
                echo("topic_pic uploaded");
            }
            else
            {
                echo "topic_pic not uploaded";
            }
        }

    	foreach ($new_questions as $new_question) 
    	{
    		
    	    Question::insert_into_table($new_question);

            $filetype=$this->check_for_image($new_question->id);

            if($filetype!="none")
            {
                $target_name=Question::select('id')->orderBy('id','desc')->first()->id;
                $target_location=public_path()."/images/questions/".$target_name.$filetype;
                $old_location=public_path()."/images/new_questions/".$new_question->id.$filetype;
                if(rename($old_location, $target_location))
                {
                    echo("changed");
                }

                else
                {
                    echo("error while adding moving pictures of the question");
                }
            }

    	}

        $this->delete_topic($topic,$username);

    	

    }

    public function check_for_image($name)
    {
        $target_location=public_path()."/images/new_questions/".$name;

        if(file_exists($target_location.".png"))
        {
            return ".png";
        }

        else if(file_exists($target_location.".jpg"))
        {
            return ".jpg";
        }

        else
        {
            return "none";
        }
    }

}
