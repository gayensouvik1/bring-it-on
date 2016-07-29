

counter=0;
started_playing=false;

function doFirst(){

			speed=5000;
			if(counter==50)
			{
			 clearTimeout(setTimeout);
			
			}

			xml();
			
			if(counter<50){
			counter++;
			setTime=setTimeout('doFirst()',speed);	
			}			

			// else{
			// 	clearTimeout(setTimeout);
			// }	
	
			}
// function warning()
// 	{
// 			if()
// 			return "You will loose the game if you refresh or close the window";
// 	}


function user_left_page()
	{
		if(started_playing)
		{
			warning();
		}

		else
		{
			var xmlhttpobject=new XMLHttpRequest();
			xmlhttpobject.onreadystatechange=function()
			{
				if(xmlhttpobject.readyState==4 && xmlhttpobject.status==200)
				{
					// result_shown=true;
					console.log("done");
					// document.getElementById('hidden_questions').innerHTML=xmlhttpobject.responseText;
				}
			}

			xmlhttpobject.open('GET','/game/user_left_before_starting');
			xmlhttpobject.send();

		}
	}

	window.addEventListener('load',doFirst,false);

