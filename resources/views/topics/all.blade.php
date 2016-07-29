@extends('layouts/app')
<?php
namespace App;
use Auth;
?>
@section('content')

<style type="text/css">

.galleryItem {
	/*color: #797478;*/
	font: 10px/1.5 Verdana, Helvetica, sans-serif;
	/*width: 16%;*/
	color: white;
	height: 20%%;
	/*width:150px;*/
	border-radius: 10px;
	margin:  2% 2% 50px 2%;
	padding: 1% 2% 1% 2%;
	float: left;
	-webkit-transition: color 0.5s ease;
}
	@media only screen and (max-width : 940px),
only screen and (max-device-width : 940px){
	.galleryItem {height: 21%;}
}

@media only screen and (max-width : 720px),
only screen and (max-device-width : 720px){
	.galleryItem {height: 29.33333%;}
	.header h1 {font-size: 40px;}
}

@media only screen and (max-width : 530px),
only screen and (max-device-width : 530px){
	.galleryItem {height: 46%;}
	.header h1 {font-size: 28px;}
}

@media only screen and (max-width : 320px),
only screen and (max-device-width : 320px){
	.galleryItem {height: 96%;}
	.galleryItem img {height: 96%;}
	.galleryItem h3 {font-size: 18px;}
	.galleryItem p, .header p {font-size: 18px;}
	.header h1 {font-size: 70px;}
}

</style>
	<div class="container">
		   			
	<?php

	   foreach ($topics_list as  $topic_ob) {
	   	
	    $href="/topics/".$topic_ob->topic;

	   $src="/images/icons/".$topic_ob->topic.'_'.$topic_ob->username;
       
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

	   	// do it

	   $str="<a href='".$href."'> <div style='background:#F83333;text-align:center;' class=\"galleryItem\">
			 <img overflow='hidden' width='80' height='80' style='border-radius:15px' src='".$src."' alt=\"image here\" />
			 <h3>".$topic_ob->topic."</h3>
			
			 </div></a>";

			 echo($str);
	   }
	?>
	</div>
	</div>
@endsection


 <!-- <p>Category : ".$topic_ob->category."</p> -->