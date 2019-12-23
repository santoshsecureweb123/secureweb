<style type="text/css">#NewsDiv{ position: absolute;}</style>

<body class="news-scroll" onMouseover="scrollspeed=0" onMouseout="scrollspeed=current" OnLoad="NewsScrollStart();">
	<div id="NewsDiv">
		<div class="scroll-text-if">
		@foreach ($news as $newVal)
			<span class="scroll-title-if"><br>
			</span> <?php echo $newVal['title']; ?>
			<a href="<?php echo $newVal['link']; ?>">Read More</a>.
			<br><br>
		 @endforeach
		</div>
	</div>

<script type="text/javascript">
var startdelay 		= 2; 		// START SCROLLING DELAY IN SECONDS
var scrollspeed		= 1.1;		// ADJUST SCROLL SPEED
var scrollwind		= 1;		// FRAME START ADJUST
var speedjump		= 30;		// ADJUST SCROLL JUMPING = RANGE 20 TO 40
var nextdelay		= 0; 		// SECOND SCROLL DELAY IN SECONDS 0 = QUICKEST
var topspace		= "2px";	// TOP SPACING FIRST TIME SCROLLING
var frameheight		= 176;		// IF YOU RESIZE THE CSS HEIGHT, EDIT THIS 

current = (scrollspeed);
function HeightData(){
	AreaHeight=dataobj.offsetHeight
	if (AreaHeight===0){
		setTimeout("HeightData()",( startdelay * 1000 ))
	}
	else {
		ScrollNewsDiv()
	}
}

function NewsScrollStart(){
	dataobj=document.all? document.all.NewsDiv : document.getElementById("NewsDiv")
	dataobj.style.top=topspace
	setTimeout("HeightData()",( startdelay * 1000 ))
}

function ScrollNewsDiv(){
	dataobj.style.top=scrollwind+'px';
	scrollwind-=scrollspeed;
	if (parseInt(dataobj.style.top)<AreaHeight*(-1)) {
		dataobj.style.top=frameheight+'px';
		scrollwind=frameheight;
		setTimeout("ScrollNewsDiv()",( nextdelay * 1000 ))
	}
	else {
		setTimeout("ScrollNewsDiv()",speedjump)
	}
}

</script>
