<?php
	$username=$user->username;
	$opponentname=$opponent->username;
	$user_score=$user->current_score;
	$opponent_score=$opponent->current_score;
	$user_profile_pic=get_profile_pic($username);
	$opponent_profile_pic=get_profile_pic($opponentname);
	$result=get_result($user_score,$opponent_score);

	 function get_result($user_score,$opponent_score)
	 {
	 	if($user_score>$opponent_score)
	 	{
	 		$result="Congratulations Winner !!!";
	 	}

	 	else if($user_score==$opponent_score)
	 	{
	 		$result="It's a draw";
	 	}

	 	else
	 	{
	 		$result="Sorry, Better luck next time";
	 	}
	 	return $result;
	 }

	 function get_profile_pic($username)
	{
		$user_profile_pic="/images/profile/".$username;
		if(file_exists(public_path().$user_profile_pic.'.jpg'))
		{
			$user_profile_pic.='.jpg';
		}

		else if(file_exists(public_path().$user_profile_pic.'.png'))
		{
			$user_profile_pic.='.png';
		}

		else if(file_exists(public_path().$user_profile_pic.'.jpeg'))
		{
			$user_profile_pic.='.jpeg';
		}

		else
		{
			$user_profile_pic="/images/profile/default profile pic.jpg";
		}

		return $user_profile_pic;
	}
?>
<link rel="stylesheet" type="text/css" href="/css/layout/profile_pic.css">

	<div id=container>
    <!-- <div class="row" >
        <div class="col-md-12 col-md-offset-1" > -->
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center; background: rgba(0, 0	, 0, 0.92);"><font size="5" color="#fff"><?php
                echo($result);
                ?></font></div>

                <div class="panel-body" style="background: #1500FF;">
                <div align="center">
          			<img src="/images/result/congratulation.png" height="200" width="300" >
          		</div>
                   <font size="4" color="#fff">

                  	<!-- <div class="row" > -->
                  		<!-- <div class="col-md-3"></div> -->
                  		
                  		<!-- <div class="col-md-4"> -->
                  		<div class="row">
                  		<div class="col-md-6">
                  			<img " src=<?php echo("'".$user_profile_pic."'");?> class="img-circle" height="120" width="120">
                  			<br>
                  		
	                  		<?php
	                  			echo ($username."<br>");
	                  			echo ($user->current_score);
	                  		?>
	                  		<br>
                  		</div>
                  		<div class="col-md-6">
                  			<img src=<?php echo("'".$opponent_profile_pic."'");?> class="img-circle" height="120" width="120">
                  			<br>
                  		<?php
                  			echo ($opponentname."<br>");
                  			echo ($opponent->current_score);
                  		?>        
                  		</div>  
                  		</div>        
                  			<!-- </div> -->
                  	</font>
                </div>
          <!--   </div>
        </div> -->
    </div>
   </div>


