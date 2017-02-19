<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css" integrity="sha384-UQiGfs9ICog+LwheBSRCt1o5cbyKIHbwjWscjemyBMT9YCUMZffs6UqUTd0hObXD" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/loadingtext.css">
<link rel="stylesheet" href="css/tooltipster.bundle.min.css">
<link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://apis.google.com/js/api.js"></script>
<script src="js/youtube.js" type="text/javascript"></script>
<script src="js/tooltipster.bundle.min.js" type="text/javascript"></script>
<style>
	body
	{
		background: #282537;
		 background-image: -webkit-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
		 background-image: -moz-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
		 background-image: -o-radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
		 background-image: radial-gradient(top, circle cover, #3c3b52 0%, #252233 80%);
		 color:#EDEDED;
		 font-family: 'Pangolin', cursive;
	}
	.pure-g
	{
		width:100%;
		height:100%;
	}
	.centercontent
	{
		position:absolute;
		left:50%;
		right:50%;
		transform: translate(-50%, 50%);
		top:40%;
	}
	.pure-input-1
	{
		height:50px;
	}
	
	#logo
	{
		position:absolute;
		top:-40px;
		left:-30px;
		-ms-transform: rotate(-30deg); /* IE 9 */
    	-webkit-transform: rotate(-30deg); /* Chrome, Safari, Opera */
    	transform: rotate(-30deg);
		z-index:-1;
	}
	
	#beta
	{
		position:absolute;
		top:-120px;
		left:80%;
		-ms-transform: rotate(10deg); /* IE 9 */
    	-webkit-transform: rotate(10deg); /* Chrome, Safari, Opera */
    	transform: rotate(10deg);
	}
	
	
	.content
	{
		width:100%;
		height:100%;
	}
	.content #overlay
	{
		position:absolute;
		left:0;
		right:0;
		background-color:black;
		opacity:0.6;
		width:100%;
		height:100%;
		z-index:1;
	}
	
	.resultbox
	{
		position:absolute;
		left:50%:
		right:50%;
		transform:translate(30%,20%);
		width:60%;
		height:60%;
		z-index:2;
	}
	.videos
	{
		position:absolute;
		width:100%;
		height:100%;
		z-index:2;
		left:50%:
		right:50%;
		transform:translate(0%,0%);
	}
	
	.videos img { border:#E7E7E7 solid 1px; border-radius:5px;}
	.videos a { padding:5px;}
	.animation img
	{
		position:absolute;
		left:41%;!important
		transform:translate(40%,-12%);!important
	}
	
	.resultbox hr { position:relative; left:0; width:100%; }
	.resultbox p { font-family: 'Pangolin', cursive; font-size:20px; font-weight:bold;};
	
	#suggestions { color:white; }
	#suggestions ul { list-style-type:none; }
	#suggestions ul li{display:inline;	}
	
	.close{z-index:3;}
	
	#results { font-size:15px;}
	
	a { color:white; text-transform:none; font-family: 'Pangolin', cursive;	}
	a:hover { color:#EFEFEF; text-transform:none;}
	
	input { color:#3A3A3A;}
</style>
<script>
	$(document).ready(function()
	{
		init();
		$(".close").click(function()
		{
			$(".content").fadeOut(500);
			$(".search").fadeIn(500);
		});
		$(".searchinput").keypress(function(e)
		{
			if(e.keyCode == 13)
			{
					$(".main").fadeOut(500);
					$(".animation").fadeIn(100);
					$(".videos").empty();
					searchYoutube($(".searchinput").val());
					$(".searchinput").val("");
			}
		});
		$('.tooltip').tooltipster({
			theme: 'tooltipster-noir'
		});
	});
	
	function init()
	{
		$(".animation,.content").hide();
	}
	
	function searchYoutube(name)
	{
		var maxSize = 35;
		//Search Youtube
		$.ajax({
			url:"../webtor/framework/lib/google.php?q=" + name +"&maxResults=" + maxSize,
			type : "GET",
			dataType:"json",
			success : function(data)
			{
				$(".content").fadeIn(500);
				$(".animation").fadeOut(500);
				//Populate Results
				$("#results").empty().text("Showing : " + maxSize + " of " + data.data.pageInfo.totalItems);
				for(var i=0; i< maxSize; i++)
				{
					$(".videos").append("<a href='#'><img src=" + youtubeThumbnail(data.data.results[i].videoId) + " width='150' height='100' />");
				}
			},
		});
	}
	
	function retrieveYoutubeInfo(id,key)
	{
		$.getJSON("https://www.googleapis.com/youtube/v3/videos?key=" + key + "&part=snippet&id=" + id,function()
		{
			
		});
	}
	
	function youtubeThumbnail(id)
	{
		return "https://img.youtube.com/vi/" + id + "/0.jpg";
	}
</script>
</head>

<body>
	<div class="pure-g main search">
    	<div class="pure-u-1-2 pure-u-md-1-2 centercontent">
            <div class="pure-form">
            	<img id="logo" src="img/logo.png" width="100" height="100">
                <img id="beta" src="img/beta.png" width="200" height="100">
            	<input type="text" class="pure-input-1 searchinput" style="font-family: 'Pangolin', cursive;" placeholder="Search Any thing from youtube">
                <br>
                <div id="suggestions">
                    <ul>
                    	<li>List of suggestions : </li>
                    	<li><a href="#">#MUSIC</a></li>
                        <li><a href="#">#TRENDING</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- While searching display animation -->
    <div class="pure-g main animation">
    	<div class="pure-u-5-5 pure-u-md-1-2 centercontent">
        	<img src="img/loader.png" width="200" height="200" class="animated infinite bounce" />
            <div id="loadingtext">
            	<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>
            </div>
        </div>
    </div>
    <!-- Search Results -->
    <div class="pure-g content">
    	<div id="overlay"></div>
    	<div class="pure-u-1 pure-u-md-1-2 resultbox">
        	<div class="pure-u-3-5 pull-left"><p id="results"></p></div>
            <div class="pure-u-2-5">
                <a href="#" class="close wrapper"><i class="fa fa-2x fa-close fa-pull-right tooltip" title="Close" style="padding-top:15px;"></i></a>
            	<a href="#" class="next wrapper"><i class="fa fa-2x fa-arrow-right fa-pull-right tooltip" title="Next page" style="padding-top:15px;"></i></a>
                <a href="#" class="prev wrapper"><i class="fa fa-2x fa-arrow-left fa-pull-right tooltip" title="Prev page" style="padding-top:15px;"></i></a>
            </div>
            <br><hr>
            <div class="pure-u-1-5 videos">
        		
        	</div>
        </div>
        
    </div>
</body>
</html>