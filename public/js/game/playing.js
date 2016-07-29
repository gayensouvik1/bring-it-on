
	// y=0;
	question_change_speed=10000;
	question_num=1;
	max_questions=7;
	stop_score_upadte=0;
	click="disabled";
	result_shown=false;
	selectd_ans="";
	time_remaining=10;
	opponent_previous=0;

	function display_question()
	{
		// y++;
		started_playing=true;
		if(question_num>1)
		document.getElementById(question_num-1).style.display='none';
		// document.getElementById(question_num-1).style.display='none';
		if(question_num<=max_questions)
		document.getElementById(question_num).style.display='block';
		click="enabled";
		set_time_for_question=setTimeout('display_question()',question_change_speed);

		if(question_num>max_questions)
		{
			show_results_page();
			clearTimeout(set_time_for_question);
			clearTimeout(set_display_scores);
			document.getElementById('time').innerHTML="";
			// stop_score_upadte=1;
	
		}
		
		else
			{
				change_time_remaining();
			}

			question_num++;

	}

	function change_time_remaining()
	{
		
		document.getElementById('time_remaining').innerText=time_remaining;
		set_time_for_changing_remaining_time=setTimeout('change_time_remaining()',1000);
		time_remaining--;
		if(time_remaining==0)
		{
			time_remaining=10;
			clearTimeout(set_time_for_changing_remaining_time);
		}
	}


	function validate_ans(question_id,selected_option)
		{
			//alert("a");
			// alert(time_remaining);
			// console.log(selected_option+" "+selected_option.id+' '+selected_option.background+ " "+selected_option.id.background);
			if(click=="enabled")
			{
				click="disabled";
				// alert(selected_option);
				selectd_ans=selected_option.id;
				document.getElementById(selectd_ans).style.background="red";
				// console.log("hey"+selected_option.innerText+"bye ");
			// console.log(selected_option.innerText);
				var xmlhttpobject=new XMLHttpRequest();

			// xmlhttpobject.onreadystatechange=function(){
			// 	// if(xmlhttpobject.readyState==4 && xmlhttpobject.status==200)
			// 	// {
			// 	// 	// document.getElementById('return1').innerHTML=xmlhttpobject.responseText;
			// 	// };
			// }

			xmlhttpobject.open('GET','/game/validate_ans/'+question_id+'/'+selected_option.innerText+'/'+time_remaining);
			xmlhttpobject.send();
			}

		}

	function display_scores()
		{
			var xmlhttpobject=new XMLHttpRequest();
			xmlhttpobject.onreadystatechange=function()
			{
				if(xmlhttpobject.readyState==4 && xmlhttpobject.status==200)
				{
					// console.log(xmlhttpobject.responseText + "  "+parseInt(document.getElementById('scores').innerText))
					response=xmlhttpobject.responseText;
					// alert(response);
					// console.log(response+"res  ");
					var my_score="";
					var next_index=0;
					for(var i=0;i<response.length;i++)
					{
						if(response[i]=='-')
						{
							next_index=i+1;
							break;
						}
						my_score+=response[i];
					}


					//checking if opponent left
					// opponent_left=false;
					// for(var i=0;i<response.length;i++)
					// {
					// 	if(response[i]=='_')
					// 	{
					// 		opponent_left=true;
					// 		break;
					// 	}
						
					// }

					var opponent_score="";

					for(var i=next_index;i<response.length;i++)
					{
						opponent_score+=response[i];
					}

					//if()

					// console.log(xmlhttpobject.responseText + "  "+parseInt(document.getElementById('scores').innerText))
					// console.log(parseInt(my_score));
					if(parseInt(my_score)>parseInt( document.getElementById('self').innerText))
					{
						// console.log(selectd_ans+ "  "+selected_ans.innerText);
						document.getElementById(selectd_ans).style.background="green";
					}
					document.getElementById('self').innerHTML=my_score;
					document.getElementById('opponent').innerHTML=opponent_score;
				};

			}

			xmlhttpobject.open('GET','/game/display_scores');
			xmlhttpobject.send();

			set_display_scores=setTimeout(display_scores,600);

			// if2(stop_score_update==1)
			// {
			// 	clearTimeout(set_display_scores);
			// }

		}


	function show_results_page()  //hidden_questions is in searching.blade.php
	{

		var xmlhttpobject=new XMLHttpRequest();
		xmlhttpobject.onreadystatechange=function()
		{
			if(xmlhttpobject.readyState==4 && xmlhttpobject.status==200)
			{
				result_shown=true;
				document.getElementById('hidden_questions').innerHTML=xmlhttpobject.responseText;
			}
		}

		xmlhttpobject.open('GET','/game/result');
		xmlhttpobject.send();

	}

	function warning()
		{
			if(!result_shown)
			{

				show_results_page();
				// var xmlhttpobject=new XMLHttpRequest();
				// xmlhttpobject.onreadystatechange=function()
				// {
				// 	// if(xmlhttpobject.readyState==4 && xmlhttpobject.status==200)
				// 	// {

				// 	// }
				// }

				// xmlhttpobject.open('GET','/game/result');
				// xmlhttpobject.send();
			}
			

			// return "You will loose the game if you refresh or close the window";
			   // var x;
			   //  if (confirm("Press a button!") == true) {
			   //      x = "You pressed OK!";
			   //  } else {
			   //      x = "You pressed Cancel!";
			   //  }
			   //  alert(x);
			// 


		}
		window.addEventListener('load',display_scores,false);
		// window.addEventListener('unload',show_results_page);


