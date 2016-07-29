<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Info;

use Auth;

use App\User;

use App\Question;

use App\Http\Requests;

class ProfileController extends Controller
{
    //


	public function __construct()
	{
        $this->middleware('auth');
	}

    public function display($profile_name)
    {
    	$profile_user=Info::where('username',$profile_name)->first();

        if(sizeof($profile_user)==0)
        {
            return view("/errors/no_user");
        }


        else if($profile_user->username==Auth::user()->username)
        {
            return view("/profile/self",compact('profile_user'));
        }


    	return view('/profile/display',compact('profile_user'));
    }


    public function update()
    {

        // code here
    }

    public function update_online_info()
    {
        $user=Auth::user();
        Info::where('username',$user->username)->update(['updated_at'=>time()]);

        return "user_logged_in updated";
       
    }

    public function get_online_info($profile_name)
    {
        $time_lag_in_update=30+5;
        $profile_user=Info::select('updated_at')->where('username',$profile_name)->first();
        $last_updated=$profile_user->updated_at;
        $current_time=time();
        $last_online=$current_time-(strtotime($last_updated));
         // echo($current_time." ".strtotime($last_updated)." ".$last_online." ");
        // echo($last_online);
        if($last_online>$time_lag_in_update)
        {
            return round($last_online/60,2)." min ago";
        }

        else
        {
            return "now";
        }
    }

    // returns all topics of the user that are accepted  
    public function my_topics()
    {
        $topics=Question::where('username',Auth::user()->username)->select('topic','category','id')->groupBy('topic','category')->get();
        return view('/profile/topics',compact('topics'));
    }

    // gives combined rank_list of the players
    public function rank_list()
    {
        $rank_list=Info::get_rank_list();
        $i=0;
        $table='
        <figure class="snip1336" style="background: #242121">
        <figcaption style="background: #242121">     
        <a onclick="rank_list()" style="cursor: pointer;background: black" class="info">Rank list</a>
        <a onclick="my_topics()" style="cursor: pointer;background: black" class="info">My Topics</a>
        </figcaption>
        </figure>
        <table class="table table-hover" style="font-size:18px">
             <tr> <th>Rank</th>
              <th>Username</th>
              <th>Rating</th>
              </tr>';
    
          foreach ($rank_list as $username => $rating) {
                $i++;
                  $row="<tr>
                    <td>".$i."</td>
                    <td><a href='/profile/".$username."'>".$username."</a></td>
                    <td>".$rating."</td>
                  </tr>";

                  $table.=$row;
              }
                $table.="</table>";
        return $table;
    }

    // function for deleting topic uploaded by user 
    public function delete($id)
    {
        Question::where('id',$id)->delete();
        return $this->my_topics();
    }

    //function for uploading profile pic of user
    public function upload_profile($username)
    {
        $target_location=public_path()."/images/profile/".$username.".";
        $file=$_FILES['profile_pic'];
        $this->remove_duplicate($target_location);
        $filetype=pathinfo(basename($file['name']),PATHINFO_EXTENSION);
        $target_location.=$filetype;
        if(move_uploaded_file($file['tmp_name'], $target_location))
        {
            echo("done");
        }

        else
        {
            echo("problem in uploading profile image");
        }
    }

    /// checks if profile/cover pic already exists

    public function remove_duplicate($target_location)
    {

        if(file_exists($target_location.".png"))
        {
          $target_location.=".png";
          unlink($target_location);
        }

        else if(file_exists($target_location.".jpg"))
        {
          $target_location.=".jpg";
          unlink($target_location);
        }

        else if(file_exists($target_location.".jpeg"))
        {
          $target_location.=".jpeg";
          unlink($target_location);
        }

    }

     public function upload_cover($username)
        {
            $target_location=public_path()."/images/cover_pic/".$username.".";
            $this->remove_duplicate($target_location);
            // echo("hello");
            $file=$_FILES['cover_pic'];
            $filetype=pathinfo(basename($file['name']),PATHINFO_EXTENSION);
            $target_location.=$filetype;
            // echo($file['tmp_name']);
            if(move_uploaded_file($file['tmp_name'], $target_location))
            {
                echo("done");
            }

            else
            {
                echo("problem in uploading cover image");
            }
        }

}
