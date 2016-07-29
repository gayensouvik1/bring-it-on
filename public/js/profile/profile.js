function countnumbers(n){
    var result=0;

    if(n===0){
        return 1;
    }

    while(n>=1){
        result++;
        n/=10;
    }

    return result;
}

function ring(games_win,games_lose){
	var win = games_win;
	var lose = games_lose;
	var centerX = 150;
	var centerY = 75;
	var w=win,l=lose;
	var winC = countnumbers(games_win), loseC = countnumbers(games_lose);

	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");

	ctx.fillStyle = '#FFFFFF'
	ctx.beginPath();
	ctx.arc(centerX, centerY, 60, 0, win*2 * Math.PI/(win+lose));
	ctx.lineWidth = 15;
	ctx.strokeStyle = '#00FF00';
	ctx.stroke();

	ctx.fillStyle = '#FFFFFF'
	ctx.beginPath();
	ctx.arc(centerX, centerY, 60,  win*2 * Math.PI/(win+lose),2*Math.	PI);
	ctx.lineWidth = 15;
	ctx.strokeStyle = '#FF0000';
	ctx.stroke();

	ctx.fillStyle = '#00FF00';
	ctx.font = "20px Arial";
	ctx.fillText("W : "+win,centerX-11-7*winC,centerY-15);

	ctx.fillStyle = '#FF0000';
	ctx.font = "20px Arial";
	ctx.fillText("L : "+lose,centerX-11-7*loseC,centerY+25);

}


function show_upload_profile()
{
	document.getElementById('profile_pic_upload').style.display="block";
	document.getElementById('blur').style.display="block";
}

function show_upload_cover()
{
	document.getElementById('cover_pic_upload').style.display="block";
	document.getElementById('blur').style.display="block";
}

function cancel()
{
	document.getElementById('profile_pic_upload').style.display="none";
	document.getElementById('cover_pic_upload').style.display="none";
	document.getElementById('blur').style.display="none";
}

//   function show_popup() {
//   var p = window.createPopup()
//   var pbody = p.document.body
//   pbody.style.backgroundColor = "lime"
//   pbody.style.border = "solid black 1px"
//   pbody.innerHTML = "This is a pop-up! Click outside to close."
//   p.show(150,150,200,50,document.body)

// }

