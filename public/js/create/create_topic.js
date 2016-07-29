		
		node_fixed_value=2;
		name="";
		category="";
		questions=[];
		// images=[];
		min_questions_required=7;
		question_num=0;


		function get_question()
		 {	
		 	question_num++;
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()			
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var question = document.createElement("div");
					question.id=question_num;
					question.innerHTML=xmlhttp.responseText;
					document.getElementById('questions').appendChild(question);
					document.getElementById('questions').childNodes[question_num-1].childNodes[22].name=question_num;					
					if(question_num>=min_questions_required)
					{
						document.getElementById('submit_btn').style.display='inline';
						console.log(document.getElementById('submit_btn'));
					}
				}
			}

			xmlhttp.open("GET","/create/question");
			xmlhttp.send();
		}
	

		function set_questions()
		{	


			
			var length=document.getElementById('questions').childNodes.length;
			// alert(length+" "+min_questions_required);
			if(length>=min_questions_required)
			{

				for(var i=1;i<=length;i++)
				{
					var que_temp=document.getElementById(i).childNodes[0+node_fixed_value].value;
					var n=que_temp.length;
					var que="";
					for(j=0;j<n;j++)
					{

						if(que_temp[j]==',')
						{
							que+='`';
						}

						else
						{
							que+=que_temp[j];
						}

						// console.log(que);

					}


					var option1_temp=document.getElementById(i).childNodes[4+node_fixed_value].value;
					var option1="";
					n=option1_temp.length;
					for(j=0;j<n;j++)
					{
						if(option1_temp[j]==',')
						{
							option1+='`';
						}

						else
						{
							option1+=option1_temp[j];
						}
					}

					var option2_temp=document.getElementById(i).childNodes[8+node_fixed_value].value;
					var option2="";
					n=option2_temp.length;
					for(j=0;j<n;j++)
					{
						if(option2_temp[j]==',')
						{
							option2+='`';
						}

						else
						{
							option2+=option2_temp[j];
						}
					}

					var option3_temp=document.getElementById(i).childNodes[12+node_fixed_value].value;
					var option3="";
					n=option3_temp.length;
					for(j=0;j<n;j++)
					{
						if(option3_temp[j]==',')
						{
							option3+='`';
						}

						else
						{
							option3+=option3_temp[j];
						}
					}

					var option4_temp=document.getElementById(i).childNodes[16+node_fixed_value].value;
					var option4="";
					n=option4_temp.length;
					for(j=0;j<n;j++)
					{
						if(option4_temp[j]==',')
						{
							option4+='`';
						}

						else
						{
							option4+=option4_temp[j];
						}
					}				// var option5=document.getElementById(i).childNodes[20].value;
					// var n=option5.length;
					// for(j=0;j<n;j++)
					// {
					// 	if(option5[j]=='/')
					// 	{
					// 		option5[j]='`';
					// 	}
					// }	

					question=[];
					question.push((que));
					question.push((option1));
					question.push((option2));
					question.push((option3));
					question.push((option4));
					// question.push((option5));
					questions.push(question);

					// alert(questions);

				}
			}

			document.getElementById('questions_to_send').value=questions;
			document.getElementById('length_to_send').value=questions.length;
			// alert(	document.getElementById('questions_to_send').value);

		}


		function update_topic()
		{
			
			name=(document.getElementById('name').value);
			category=(document.getElementById('category').value);
			get_question();//set_question
			// set_questions();
								
		}

		function submit_questions()
		{

			set_questions();

			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function()			
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				//	document.getElementsByClassName('panel-body')[0].innerHTML=counter+". "+xmlhttp.responseText;
					
					
				}
			}
			xmlhttp.open("GET","/submit/"+name+"/"+category+"/"+(questions)+"/"+questions.length,true);
			xmlhttp.send();
			// document.location="/home";
		}
