
@extends('layouts/app')


@section('content')

<script type="text/javascript" src="/js/profile/display.js"></script>
<script type="text/javascript" src="/js/profile/profile.js"></script>
<script type="text/javascript" src="/js/profile/image_upload.js"></script>
<link rel="stylesheet" type="text/css" href="/css/layout/profile_pic.css">
<link rel="stylesheet" type="text/css" href="/css/layout/image_upload.css">
<link rel="stylesheet" type="text/css" href="/css/profile/self.css">

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


<span>
  
  <!-- <input type="checkbox" id="our-popup" class="smoosh" /> -->
  <label for="our-popup" class="overlay"></label>

  <div id="profile_pic_upload"  class="overlay-dialogue">
    <?php $strr = "'/profile/".$profile_user->username."/upload'"; ?>
    <form action=<?php echo $strr ; ?> method="post" enctype="multipart/form-data">
      Select profile pic to upload:
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <input type="file" name="profile_pic" id="fileToUpload" >
      <br>
      <input type="submit" value="Upload Image" name="submit">
      <input type="hidden" value="{{csrf_token()}}" name="_token">
      &nbsp &nbsp &nbsp<button type="button" onclick="cancel()">Cancel</button>
    </form>
    <!-- <label for="our-popup" ><a style="color:black" onclick="close()">Close</a></label> -->
    </div>


   <div id="cover_pic_upload"  class="overlay-dialogue">
    <?php $strr = "'/cover/".$profile_user->username."/upload'"; ?>
    <form action=<?php echo $strr ; ?> method="post" enctype="multipart/form-data">
      Select cover pic to upload:
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <input type="file" name="cover_pic" id="fileToUpload" value="">
      <br>
      <input type="submit" value="Upload Image" name="submit">
      <input type="hidden" value="{{csrf_token()}}" name="_token">
      &nbsp &nbsp &nbsp<button type="button" onclick="cancel()">Cancel</button>
     </form>
    <!-- <label for="our-popup" ><a style="color:black" onclick="close()">Close</a></label> -->
  </div>

</span>



<body onload="ring(<?php echo($win.",".$lost);?>)"> 
<div class="container">
<div class="row">
    <div class="col-md-4" >

      <?php

        $profile_src="/images/profile/".$profile_user->username;
        if(file_exists(public_path().$profile_src.".png"))
        {
          $profile_src.=".png";
        }

        else if(file_exists(public_path().$profile_src.".jpg"))
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
 
        
        <a onclick="show_upload_profile()" id="myBtn" class="info">Change Profile Picture</a>
        <a onclick="show_upload_cover()" class="info">Change Cover Picture</a>
      
    
      <br><br>

 
     
      <canvas id="myCanvas" class="user_performance">
          
      </canvas>
      </figcaption>
      </figure>

      
    </div>

    <div id="topics" class="col-md-8">

      
       <?php

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


@endsection