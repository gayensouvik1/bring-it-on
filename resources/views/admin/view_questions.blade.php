

<!-- why the hell is js not working in this file -->
<!-- <script type="text/javascript" src="js/admin/view_new_questions.js"></script> -->


<?php


$id=0;
// echo($new_questions[0]->topic);
foreach ($new_questions as $question)
	 {
	
	$id++;
	$image_location="/images/new_questions/".$question->id;

	$img="";
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
		{
			$img="<img src='".$image_location."' height='150px'>";
		}





	 $questions='<div class="container-fluid bg-info" style="display:block" id= '.$id.'>
    <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header" style="background:#f0ad4e ;text-align:center">
            <span style="float:left;font-size:25px">'.$id.')</span>
            <h id="qid" style="text-align:center;font-size:25px"> '.$question->question.'</h>
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
           <label  class="element-animation1 btn btn-lg btn-primary btn-block" id="option1"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right" style="float:left"></i></span> <input type="radio" name="q_answer" value="1"> '.$question->option1.' </label>
           <label  id="option2" class="element-animation2 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right" style="float:left"></i></span> <input  type="radio" name="q_answer" value="2">'.$question->option2.'</label>
           <label  id="option3" class="element-animation3 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right" style="float:left"></i></span> <input type="radio" name="q_answer" value="3">'.$question->option3.'</label>
           <label  id="option4" class="element-animation4 btn btn-lg btn-primary btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right" style="float:left"></i></span> <input  type="radio" name="q_answer" value="4">'.$question->option4.'</label>
       </div>
   </div>
   <div class="modal-footer text-muted">
    <span id="answer"></span>
</div>

</div>
</div>
</div>';
	 echo($questions);
	}

$buttons='<div style="text-align:center" id="buttons"><button class="btn btn-primary" onclick="add_topic(\''.$new_questions[0]->topic.'\',\''.$new_questions[0]->username.'\')">Add</button>
<button class="btn btn-danger" onclick="delete_topic(\''.$new_questions[0]->topic.'\',\''.$new_questions[0]->username.'\')">Delete</button>
<button class="btn btn-success" onclick="hide_questions()">Cancel</button></div>';

echo($buttons."<br><br><br>");



	?>