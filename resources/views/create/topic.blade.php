@extends('layouts/app')

@section('content')

	
	<script type="text/javascript" src="/js/create/create_topic.js">


	</script>

	<div id="container" style="color:black" >
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create Your Own Topics Here (Must have atleast 7 questions)</div>
        		  <form onsubmit='set_questions()' class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/submit/questions') }}">
             		 {!! csrf_field() !!}
	                <div class="panel-body">
	   
	                   <br>
	                   Name <br><input name='topic' type="text" id="name"  placeholder="name of topic">
	                   <br>
	                   Category <br><input name='category' type="text" id="category" placeholder="category of topic">
	                   	<br>
	                   	<input name="topic_picture" type="file"></input>
	                   	<br>
	                   <div id="questions"></div>

	                  	 <button type="button" class="btn btn-danger glyphicon glyphicon-circle-arrow-right" onclick="update_topic()">Add Question</button>
                 	    <input style="display: none" type="submit" class="btn btn-primary" id="submit_btn"  type="submit" value="Submit">

	                </div>
	                <input id="questions_to_send" type="hidden" name="questions"></input>
	                <input id="length_to_send" type="hidden" name="questions_len"></input>
	              </form>  
            </div>
        </div>
    </div>
<!-- <div id="newfile"></div>
 -->    </div>

@endsection







	
