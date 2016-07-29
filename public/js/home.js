function my_topics()
{
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
  {
    if(xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById('topics_rank').innerHTML=xmlhttp.responseText;
    }

  }

  xmlhttp.open('GET','/profile/display/topics')
  xmlhttp.send();
}

function rank_list()
{

  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
  {
    if(xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById('topics_rank').innerHTML=xmlhttp.responseText;
    }
  }

  xmlhttp.open('GET','/profile/combined/rank_list');
  xmlhttp.send();

}

function delete_topic(id)
{
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function()
  {
    if(xmlhttp.readyState==4 && xmlhttp.status==200)
    document.getElementById('topics_rank').innerHTML=xmlhttp.responseText;
  }

  xmlhttp.open('GET','/profile/topic/delete/'+id);
  xmlhttp.send();
}

