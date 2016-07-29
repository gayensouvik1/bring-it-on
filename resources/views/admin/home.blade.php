@extends('/layouts/app')

@section('content')
  
  
<head>
  <script type="text/javascript" src="/js/admin/home.js"></script>
  <script type="text/javascript" src="js/admin/view_questions.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/layout/profile_pic.css">
  <link rel="stylesheet" type="text/css" href="/css/admin/home.css">
</head> 
 
<div id="blur"></div>

<div class="container">
<div id="questions_page">

</div>
  <div class="row">
    <div class="col-md-4" >
      <?php
  
      // $profile_src="/images/profile/".Auth::user()->username;
      //   if(file_exists(public_path().$profile_src.".png"))
      //   {
      //     $profile_src.=".png";
      //   }

      //   else if(file_exists(public_path().$profile_src.".jpg"))
      //   {
      //     $profile_src.=".jpg";
      //   }

      //   else if(file_exists(public_path().$profile_src.".  jpeg"))
      //   {
      //     $profile_src.=".jpeg";
      //   }

      //   else
      //   {
      //     $profile_src="/images/profile/default profile pic.jpg";
      //   }

        $profile_src="/images/profile/".Auth::user()->username;
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
          $profile_src="/images/cover_pic/default cover pic.jpg";
        }




        $cover_src="/images/cover_pic/".Auth::user()->username;
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

        
        // $win=1;
        // $draw=2;
        // $lost=3;
        // $total=$win+$lost+$draw;
      ?>
      

    <figure class="snip1336">
      <img src=<?php echo("'".$cover_src."'");?> alt="sample87" />
      <figcaption>
        <img src=<?php echo "'".$profile_src."'" ; ?> class="profile" />
 
        <a href="/create/topic" class="info">Create Topic</a>

      
    
      <br><br>

 
     
      <canvas id="myCanvas" class="user_performance">
          
      </canvas>
      </figcaption>
      </figure>
      <br><br>


      
    </div>
    <div class="col-md-8">
      <div class="table-responsive">
      <table class="table table-hover" style="font-size: 18px">
      <tr><th>#</th>
      <th>Topic</th>
      <th>Category</th>
      <th>Uploader</th>
      <th>Action</th>
      </tr>
        <?php
        $i=0;
        foreach ($new_topics as $topic_ob) 
        {
          $i++;
          $row="
          <tr>
            <td>".$i."</td>
            <td>".$topic_ob->topic."</td>
            <td>".$topic_ob->category." </td>
            <td> ".$topic_ob->username."</td>

            <td>
            <a onclick=\"display_questions('".$topic_ob->topic."','".$topic_ob->category."','".$topic_ob->username."')\">View
            </a>
               |  
            <a onclick=\"add_topic('".$topic_ob->topic."','".$topic_ob->username."')\">
                Add
            </a>
            </td>
          </tr>";

          echo($row);
            
        }
      ?>
        </table>
      </div>
    </div>
</div>
</div>

  
@endsection