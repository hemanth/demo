<! DOCTYPE HTML>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>Imgur Images from Reddit front page </title> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery(".content").hide();
  jQuery(".heading").click(function()
  {
    jQuery(this).next(".content").slideToggle(500);
  });
});
</script>
<style type="text/css"> 
body {
    height:100%
    margin: 20px auto;
    background-color : black;
    font: 12px Verdana,Arial, Helvetica, sans-serif;
    font-color: white;
}
h1{color: white;}
b {color: white;}
.main {
margin: 0;
padding: 0;
width:100%;
height:100%;
margin:auto;
}
 
.heading {
margin: 1px;
color: #fff;
padding: 3px 10px;
cursor: pointer;
position: relative;
background-color:#c30;
}
.content {
padding: 5px 10px;
background-color:#fafafa;
}
p { padding: 5px 0; }
.content img {max-width: 100%;}
</style> 
</head> 
<body> 
<h1> imgur images from reddit front page, brought to you by <a href="www.h3manth.com">h3manth.com</a></h1><i><b>Click on the headings to toggle</b></i>
<div class="main">
<?php
ini_set("allow_url_fopen", "On");
$reddit_url = 'http://api.reddit.com';
$json = json_decode(file_get_contents($reddit_url),true);

foreach($json['data']['children'] as $child)
{
    $url = $child['data']['url'];
    $title = $child["data"]["title"];
    if (strlen(strstr($url,'imgur'))>0){
	if (strpos($url,'jpg') === false && strpos($url,'png') === false && strpos($url,'gif') === false){
	    $url .= ".jpg";
	}
	if(strlen(strstr($url,"#")) > 0){
	    $img = explode("#",basename($url));
            $url = "http://www.imgur.com/".$img[1];
        }
	print "<p class=\"heading\">$title</p>";
	print "<div class=\"content\"><p><img src='$url'</img></p></div>";
    }
}
print "<a href=\"javascript:scroll(0,0)\">Top</a>";
?>

