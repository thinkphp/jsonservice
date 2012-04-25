<?php

    $endpoint = 'http://thinkphp.ro/apps/ishackday/jsonservice/flickr.php/get?text=beach';

    $json = json_decode(get($endpoint));

    $response = $json->response;  
     
    function get($url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $head = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch); 
         return $head;  
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Get JSON from FlickrService</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <style type="text/css">
body {
      font-size:24px;
      line-height:1.5;
      color:#333;
    }
    div#index {
      width:28em;
      margin:0 auto;
    }
    h1,body { font-family:'gill sans','dejavu sans',verdana,sans-serif; }
    h1 { font-family:menlo,'dejavu sans mono',monospace; }

    h1 {
      font-weight:bold;
      font-size:55px;
      letter-spacing:1px;
      color:#000;
      margin-bottom:0;
    }
   body {margin-left: 10px}
   ul {float: left;width: 400px}
   ul li {float: left}
   </style>
</head>
<body class="yui-skin-sam">
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Get JSON From FlickrService</h1></div>
   <div id="bd" role="main">
	<div class="yui-g">

<?php echo$response; ?>
	</div>
<pre><code>
INPUT: GET('http://thinkphp.ro/apps/ishackday/jsonservice/flickr.php/get?text=beach')
OUTPUT: {'status'=>'Okay', 'response': '...'}
</code></pre>
	</div>
   <div id="ft" role="contentinfo"><p>Created By +<a href="http://thinkphp.ro/+">thinkphp</a></p></div>
</div>
</body>
</html>