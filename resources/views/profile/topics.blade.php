<style type="text/css">
	span{
		/*border:1px solid white;	*/
		cursor: pointer;
	}
</style>

	<figure class="snip1336" style="background: #242121">

	<figcaption style="background: #242121">

	  
	   <a onclick="rank_list()" style="cursor: pointer;background: black" class="info">Rank list</a>
	   <a onclick="my_topics()" style="cursor: pointer;background: black" class="info">My Topics</a>

	</figcaption>
	</figure>

<table class="table table-hover" style="font-size:18px">
  <tr> 
	  <th>#</th>
	  <th>Topic</th>
	  <th>Category</th>
	  <th>Action</th>
  </tr>
	
	<?php
	$i=0;
		foreach ($topics as $topic) {
			$i++;
			$row="<tr><td>".$i."</td><td>".$topic->topic."</td><td>".$topic->category."</td><td><span onclick='delete_topic(".$topic->id.")'>Delete</span></td></tr>";
			echo($row);
		}
	?>

</table>