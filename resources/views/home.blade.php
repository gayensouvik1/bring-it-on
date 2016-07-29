@extends('layouts.app')


@section('content')
<head>
<link rel="stylesheet" type="text/css" href="/css/layout/profile_pic.css">
<style type="text/css">
  
  .table-hover tbody tr:hover td {
    background: #428bca;
}

  .table-hover tbody tr:hover th {
    background: black;
}

</style>
<script type="text/javascript" src="/js/home.js"></script>
</head>
<div class="container">
  <div class="row">
    <div class="col-md-4" >
      <?php

        $profile_src="images/profile/".$user->username;

        if(file_exists($profile_src.".png"))
        {
          $profile_src.=".png";
        }

        else if(file_exists($profile_src.".jpg"))
        {
          $profile_src.=".jpg";
        }

        else if(file_exists($profile_src."jpeg"))
        {
          $profile_src.=".jpeg";
        }

        else
        {
          $profile_src="images/profile/admin.jpg";
        }


        $cover_pic="images/profile/".$user->username." cover";

        if(file_exists($cover_pic.".png"))
        {
          $cover_pic.=".png";
        }

        else if(file_exists($cover_pic.".jpg"))
        {
          $cover_pic.=".jpg";
        }

        else if(file_exists($cover_pic."jpeg"))
        {
          $cover_pic.=".jpeg";
        }

        else
        {
          $cover_pic="images/profile/admin.jpg";
        }




      ?>
      <figure class="snip1336">
      <!-- to be changed -->
      <img src=<?php echo($cover_pic);?> alt="sample87" />
      <figcaption>
        <img src=<?php echo ("/".$profile_src) ;?> class="profile" />
 
        
        <a href="/create/topic" class="info">Create Topic</a>
    
      <br><br>
      </figcaption>
      </figure>
      <br><br>
    </div>
    <div id="topics_rank" class="col-md-8">
        <figure class="snip1336" style="background: #242121">
        
        <figcaption style="background: #242121">
   
          
           <a onclick="rank_list()" style="cursor: pointer;background: black" class="info">Rank list</a>
           <a onclick="my_topics()" style="cursor: pointer;background: black" class="info">My Topics</a>

        </figcaption>
        </figure>
       
    <table  class="table table-hover" style="font-size:18px">
     <tr> <th>Rank</th>
      <th>Username</th>
      <th>Rating</th>
      </tr>
    <?php
      $i=0;
      foreach ($result_array as $username => $rating) {
        $i++;
          $row="<tr>
            <td>".$i."</td>
            <td><a href='/profile/".$username."'>".$username."</a></td>
            <td>".$rating."</td>
          </tr>";

          echo($row);
      }
        
    ?>  
    </table>
    </div>
</div>
</div>

@endsection

