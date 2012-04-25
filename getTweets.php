<?php
    if(isset($_GET['user'])):
       $user = $_GET['user'];
    else:
       $user = 'thinkphp';
    endif;  

    $endpoint = 'http://thinkphp.ro/apps/ishackday/jsonservice/twitter.php/get?username=' . $user ;

    $json = json_decode(file_get_contents($endpoint));

    $response = $json->response;      
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Get Tweets/JSON from TwitterService</title>
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
      font-size:35px;
      letter-spacing:1px;
      color:#000;
      margin-bottom:0;
    }
   body {margin-left: 10px}
   ul {float: left;width: 700px;font-size: 17px}
   ul li {float: left;width: 700px;padding: 5px}
   li.tweet {background: #E8E8E8;margin: 2px}
   </style>
</head>
<body class="yui-skin-sam">
<div id="doc" class="yui-t7">
   <div id="hd" role="banner"><h1>Usage TwitterService</h1></div>
   <div id="bd" role="main">
           <?php echo"<b>$user</b>'s tweets"; ?>
	<div class="yui-g">

           <?php echo$response; ?>

	</div>
<pre><code>
</code></pre>
	</div>
   <div id="ft" role="contentinfo"><p>Created By +<a href="http://thinkphp.ro/+">thinkphp</a></p></div>
</div>
</body>
</html>
