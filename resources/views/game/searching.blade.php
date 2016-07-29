@extends('layouts.app')

@section('content')





<!DOCTYPE html>

<?php

?>
<!-- 	<div id="return1"> not returned </div> -->

<body onbeforeunload="user_left_page()" onunload="show_results_page()">

	<div style="font-size: 25px;text-align:center">{{$topic}}</div>

 	<div style="font-size: 20px;text-align: center" id="time">Time Remaining For this Question : <span id="time_remaining">10</span></div>

 	<div id="hidden_questions"></div>

</body>

<head>

	<script type="text/javascript" src="/js/game/searching.js"></script>
	<script type="text/javascript" src="/js/game/playing.js"></script>
</head>
	<script type="text/javascript">

	function xml()
	{	
	
		if(counter<50){
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4 && xmlhttp.status==200)
			{

			document.getElementById('hidden_questions').innerHTML=xmlhttp.responseText;
			if(document.getElementById('qid'))
			{
				// get_questions();
				// show_questions();
				counter=50;
				clearTimeout(setTimeout);	
				display_question();		
			}
			
			if(document.getElementById('players'))
			{
				counter=50;
				clearTimeout(setTimeout);			
			}
			}
		}
		xmlhttp.open("GET","/topics/"+<?php echo("'".$topic."'");?>+"/searching");
		xmlhttp.send();
	}

	}


	

	</script>
</head>


<?php


use App\Info;
?>


@endsection