@extends('layouts.app')



@section('content')

<link rel="stylesheet" type="text/css" href="/css/layout/profile_pic.css">


<script type="text/javascript">
  function like_topic(topic)
  {
     var xmlhttp=new XMLHttpRequest();
     xmlhttp.onreadystatechange=function()
     {
       if(xmlhttp.readyState==4 && xmlhttp.status)
       {
          if(xmlhttp.responseText=='liked')
          {
            document.getElementById('like_btn').innerText='UNLIKE TOPIC';
            document.getElementById('likes').innerText=parseInt(document.getElementById('likes').innerText)+1;
          }

          else
          {
            document.getElementById('like_btn').innerText='LIKE TOPIC';
            console.log(parseInt(document.getElementById('likes').innerText)-1);
            document.getElementById('likes').innerText=parseInt(document.getElementById('likes').innerText)-1;     
           }
       }
     }

     xmlhttp.open('GET','/topics/'+topic+'/like');
     xmlhttp.send();

  }

</script>
<style type="text/css">
      
  .table-hover tbody tr:hover td {
    background: #428bca;
}

  .table-hover tbody tr:hover th {
    background: black;
}

</style>

<div class="container">
  <div class="row">
    <div class="col-md-4" >
      <?php

        // $src="images/profile/".$user->username;
        // if(file_exists($src.".png"))
        // {
        //   $src.=".png";
        // }

        // else if(file_exists($src.".jpg"))
        // {
        //   $src.=".jpg";
        // }

        // else if(file_exists($src."jpeg"))
        // {
        //   $src.=".jpeg";
        // }

        // else
        // {
        //   $src="images/profile/admin.jpg";
        // }
      ?>

	<?php
		
       $liked_by=$topic->liked_by;
       $liked_by=explode(',',$liked_by);
       $likes=count($liked_by)-1;
       $like_unlike="LIKE TOPIC";
       foreach ($liked_by as $user) 
       {
          if($user==Auth::user()->username)
          {
            $like_unlike="UNLIKE TOPIC";
          }
       }
       

		 	$url='/topics/'.$topic->topic.'/play';
	     
       $src="/images/icons/".$topic->topic.'_'.$topic->username;
       
        if(file_exists(public_path().$src.".png"))
        {
          $src.=".png";
        }

        else if(file_exists(public_path().$src.".jpg"))
        {
          $src.=".jpg";
        }

        else if(file_exists(public_path().$src.".jpeg"))
        {
          $src.=".jpeg";
        }
       
        else
        {
          $src="/images/icons/default topic pic.jpg";
        }

		  
	?>
      <figure class="snip1336">
      <img src=<?php echo("'".$src."'");?> alt="sample87" />
      <figcaption>
        
        
        <a id="like_btn" style="cursor: pointer;" onclick="like_topic(<?php echo("'".$topic->topic."'");?>)" class="info">  
            <?php
              echo($like_unlike);
                  $button="<a class=\"info\" href ='".url($url)."'>  Play  </a>";
        echo($button."<br>");
            ?>
        </a>
        <!-- Likes :  -->
     
        <div >
           Likes:
      
        <span id="likes"> <?php
         echo($likes);
        ?></span>

            <span style="float:right;margin-right: 20px">
      Uploader : <?php
         echo($topic->username);
        ?></span>
        </div>

   
    
      <br><br>
      </figcaption>
      </figure>
      <br><br>
    </div>


    <!--  col 8 starts -->
    <div class="col-md-8">

  <table class="table table-hover" style="font-size: 18px">
      <tr><th>Rank</th>
      <th>Username</th>
      <th>Rating</th>
      </tr>
    <?php
      $i=0;
      foreach ($rank_list as $username => $rating) {
        $i++;
        $row="<tr><td>".$i."</td><td><a href='/profile/".$username."'>$username</a></td><td>".$rating."</td></tr>";
        echo($row);
      }
    ?>  
    </table>
    </div>
</div>
</div>

@endsection


