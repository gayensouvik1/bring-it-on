
<?php
  $user=Auth::user();
?>
<head>
	<script type="text/javascript" src="/js/game/playing.js"></script>
  <link rel="stylesheet" type="text/css" href="/css/game/playing.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <!-- <script type="text/javascript" href="/bootstrap/js/bootstrap.min.js"></script> -->
</head>

<body onload='alert("hi")' bgcolor="white" onbeforeunload="return warning()">


<div id="players">
	
  <div id="self_player"><?php
  echo($user->username);
  ?></div>

  <div id="opponent_player"> <?php
	echo($opponent->username); 
	?>
  </div>

</div>


<div id="scores">
    <div id="self"></div>
    <div id="opponent"></div>
</div>

<br><br><br><br>
<div id="questions" >

	 <?php 
	 $id=0;
	 foreach ($questions as $question)
	 {
	 	$id++;
    $option1=$id."option1";
    $option2=$id."option2";
    $option3=$id."option3";
    $option4=$id."option4";
    $img="";
		$validate_ans="validate_ans(".$question->id.",this".")";
    $image_location="/images/questions/".$question->id;
    if(file_exists(public_path().$image_location.".png"))
    {
        $image_location.=".png";
    }

    else if(file_exists(public_path().$image_location.".jpg"))
    {
      $image_location.=".jpg";
    }

    else
    {
      $image_location='none';
    }

    if($image_location!='none')
    $img="<img src='".$image_location."' height='150px'>";


	 $str='<div class="container-fluid bg-info" style="display:none" id= '.$id.'>
    <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header" style="background:#f0ad4e ;text-align:center">
            <span style="font-size:25px">'.$id.')</span>
            <h id="qid" style="text-align:center;font-size:25px">'.$question->question.'</h>
             <div>
              '.$img.'
             </div>
        </div>
        <div class="modal-body">
            <div class="col-xs-3 col-xs-offset-5">
               <div id="loadbar" style="display: none;">
                  <div class="blockG" id="rotateG_01"></div>
                  <div class="blockG" id="rotateG_02"></div>
                  <div class="blockG" id="rotateG_03"></div>
                  <div class="blockG" id="rotateG_04"></div>
                  <div class="blockG" id="rotateG_05"></div>
                  <div class="blockG" id="rotateG_06"></div>
                  <div class="blockG" id="rotateG_07"></div>
                  <div class="blockG" id="rotateG_08"></div>
              </div>
          </div>

          <div class="quiz" id="quiz" data-toggle="buttons">
           <label onclick="'.$validate_ans.'" class="element-animation1 btn btn-lg btn-primary btn-block" id="'.$option1.'"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input type="radio" name="q_answer" value="1">'.$question->option1.'</label>
           <label onclick="'.$validate_ans.'" id="'.$option2.'" class="element-animation2 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input type="radio" name="q_answer" value="2">'.$question->option2.'</label>
           <label onclick="'.$validate_ans.'" id="'.$option3.'" class="element-animation3 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input type="radio" name="q_answer" value="3">'.$question->option3.'</label>
           <label onclick="'.$validate_ans.'" id="'.$option4.'" class="element-animation4 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span><input  type="radio" name="q_answer" value="4">'.$question->option4.'</label>
       </div>
   </div>
   <div class="modal-footer text-muted">
    <span id="answer"></span>
</div>
   
</div>
</div>
</div>';
	 echo($str);
	}
 ?>

</div>

</body>

<!--  this is que format -->

