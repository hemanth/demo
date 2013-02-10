<!DOCTYPE html>
<html>
<head>
<link href='./h/themes/bigbox.css' rel='stylesheet'>
<script src='./h/humane.min.js'></script>
<title>Google hourly trends</title>
</head>
<body onload="log('Google Hot trends, from h3manth.com');">
<script>
function log(trend){
    humane.log(trend);
}
</script>
<?php
$trends = new GoogleHotrends();
$keywords = $trends->fetch_trends();

if (strstr($_SERVER['HTTP_USER_AGENT'], 'curl -A')){
 echo json_encode($keywords);
}
else{
    echo '<div id=trends>'.json_encode($keywords).'</div>';

    foreach ($keywords as &$trends) {
    echo "<script>log('$trends');</script>";
    }
}
class GoogleHotrends {
private $trendsurl = 'http://www.google.com/trends/hottrends/atom/hourly';

    public function fetch_trends()
    {
        $c = curl_init($this->trendsurl);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        $responsedata = curl_exec($c);
        curl_close($c);
        return $this->parse_trend_feed( $responsedata );
    }

    private function parse_trend_feed( $data ){
        preg_match_all('/.+?<a href=".+?">(.+?)<\/a>.+?/',$data,$matches);
        return $matches[1];
    }
}
?>
<script>
log('HOT Trends!');
</script>
</body>

</html>
