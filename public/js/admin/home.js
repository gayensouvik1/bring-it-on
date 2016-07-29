
function display_questions(topic,category,username)
{


	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
					console.log('/admin/'+topic+"/"+category+"/"+username+"/view");

			document.getElementById('questions_page').innerHTML=xmlhttp.responseText;
			document.getElementById('questions_page').style.transition="top 0.5s linear 0s";
			document.getElementById('questions_page').style.zIndex=205;
			document.getElementById('questions_page').style.top=50+"px";
    	    document.getElementById('questions_page').style.display="block";
    	    document.getElementById('blur').style.display="block";

		}
	}
	xmlhttp.open('GET','/admin/'+topic+"/"+category+"/"+username+"/view");
	xmlhttp.send();
}


function hide_questions()
{

	document.getElementById('questions_page').style.transition="top 0.5s linear 0s";
	document.getElementById('questions_page').style.zIndex=120;
	document.getElementById('questions_page').style.display="none";
    document.getElementById('blur').style.display="none";

}