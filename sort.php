<?php
    if(isset($_GET['arr'])):
       $arr = $_GET['arr'];
    else:
       $arr = "9,8,7,6,5,4,3,2,1,0"; 
    endif;

    $endpoint = 'http://thinkphp.ro/apps/ishackday/jsonservice/sortservice.php/sort?arr='.$arr;

    $json = json_decode(file_get_contents($endpoint));

    $response = $json->response;  
     
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Insertion Sort Service</title>
   <link rel="stylesheet" href="http://yui.yahooapis.com/2.8.0r4/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
   <style type="text/css">
body {
      font-size:24px;
      line-height:1.5;
      color:#333;
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
   <div id="hd" role="banner"><h1>Insertion Sort Service</h1></div>
   <div id="bd" role="main">
	<div class="yui-g"> 
            <?php echo"<pre>";print_r($response);echo"</pre>"; ?>
	</div>
<pre><code>
</code></pre>
	</div>
   <div id="ft" role="contentinfo"><p>Created By +<a href="http://thinkphp.ro/+">thinkphp</a></p></div>
</div>
</body>
</html>
