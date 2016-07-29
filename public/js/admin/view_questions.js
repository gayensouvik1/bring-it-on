

function add_topic(topic,username)
{


	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
				location.reload();
			// document.getElementById('questions_page').innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET',"/admin/add_topic/"+topic+"/"+username);
	xmlhttp.send();

}


function delete_topic(topic,username)
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState==4 && xmlhttp.status==200)
		{
				location.reload();
					// console.log('/admin/');

			// document.getElementById('questions_page').innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET',"/admin/delete_topic/"+topic+"/"+username);
	xmlhttp.send();
}