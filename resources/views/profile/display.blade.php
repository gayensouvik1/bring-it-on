
@extends('layouts/app')


@section('content')

<script type="text/javascript" src="/js/profile/profile.js"></script>
<script type="text/javascript">
  
  function get_online_info(profile_name)
  {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
      if(xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById('active').innerText=xmlhttp.responseText;
      }
    }

    xmlhttp.open('GET','/profile/'+profile_name+"/get_online_info");
    xmlhttp.send();
  }


  function call_to_get_info()
  {
    get_online_info(<?php echo("'".$profile_user->username."'")?>)

    setTimeout_for_online_info=setTimeout(call_to_get_info,30000);
  }

  window.addEventListener('load',call_to_get_info);
    
</script>
<link rel="stylesheet" type="text/css" href="/css/layout/profile_pic.css">


  <?php
      $opponent=explode(',',$profile_user->opponents);
      $my_score=explode(',', $profile_user->my_scores);
      $topic=explode(',',$profile_user->topics);
      $opponent_score=explode(',', $profile_user->opponent_scores);
      $length=count($opponent)-1;
      $result;
      $win= 0;
      $lost=0;
      for($i=0;$i<$length;$i++)
      {
         if(($my_score[$i]-$opponent_score[$i])>0)
         {
          $result[$i]='W';
          $win++;
         }

         else
         {
          $result[$i]='L';
          $lost++;
         }
      }
  ?>
<body onload="ring(<?php echo($win.",".$lost);?>)">
<div class="container">
<div class="row">
    <div class="col-md-4" >
      <?php

     $profile_src="/images/profile/".$profile_user->username;
        if(file_exists(public_path().public_path().public_path().$profile_src.".png"))
        {
          $profile_src.=".png";
        }

        else if(file_exists(public_path().public_path().$profile_src.".jpg"))
        {
          $profile_src.=".jpg";
        }

        else if(file_exists(public_path().$profile_src.".jpeg"))
        {
          $profile_src.=".jpeg";
        }

        else
        {
          $profile_src="/images/profile/default profile pic.jpg";
        }

        $cover_src="/images/cover_pic/".$profile_user->username;
        if(file_exists(public_path().$cover_src.".png"))
        {
          $cover_src.=".png";
        }

        else if(file_exists(public_path().$cover_src.".jpg"))
        {
          $cover_src.=".jpg";
        }

        else if(file_exists(public_path().$cover_src.".jpeg"))
        {
          $cover_src.=".jpeg";
        }

        else
        {
          $cover_src="/images/cover_pic/default cover pic.jpg";
        }

            
      ?>
      <figure class="snip1336">
      <img src=<?php echo("'".$cover_src."'");?> alt="sample87" />
      <figcaption>
        <img src=<?php echo "'".$profile_src."'" ; ?> class="profile" />
 
        
        <a  id="myBtn" class="info">Change Profile Picture</a>
        <a  class="info">Change Cover Picture</a>
      
    
      <br><br>
            
      <div >
         Acitve : <span id="active"></span>
      </div>
  <br><br>
      <canvas id="myCanvas" class="user_performance">
          
      </canvas>

      <br><br>
          </figcaption>

      </figure>   
      
    </div>
    <div class="col-md-8">
      
       <?php
          // print_r($opponent);
          // print_r($result);
          // print_r($topic);
          // // print_r($);

          for($i=$length-1;$i>=0;$i--)
          {
            $point_diff;
            $lost_win;
          if($result[$i]=='W')
          {
            $lost_win=" DEFEATED ";
            $point_diff=$my_score[$i]-$opponent_score[$i];
          }

          else
          {
            $lost_win=" LOST FROM ";
            $point_diff=$opponent_score[$i]-$my_score[$i];
          }

          $str="<div class='recent_achievements' style='padding:35px;margin:35px;background:rgba(255, 71, 0, 0.92);font-size:15px' >".

              $profile_user->username." ".$lost_win." ".$opponent[$i]." in the topic ".strtoupper($topic[$i])
          ." with the gap of ".$point_diff." points "."</div>";
          echo ($str);

        }
       ?>
       
    </div>
</div>
</div>
</body>


@endsection