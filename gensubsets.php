<?php
    if(isset($_GET['n'])):
       $n = $_GET['n'];
    else:
       $n = 3; 
    endif;

    $set = "{";
    for($i=1;$i<=$n;$i++):
        $set .= $i.","; 
    endfor; 
    $set = substr($set,0,-1);
    $set .="}";
 
    $endpoint = 'http://thinkphp.ro/apps/ishackday/jsonservice/subsets.php/get?n='.$n;

    $json = json_decode(file_get_contents($endpoint));

    $response = $json->response;  
     
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
   <title>Generating Subsets From Service</title>
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
   <div id="hd" role="banner"><h1>Generating subsets</h1></div>
   <div id="bd" role="main">
	<div class="yui-g"> 
            <?php echo"A= $set; <br/> 2^$n Subsets => {void}, ", $response; ?>
	</div>
<pre><code>
</code></pre>
	</div>
   <div id="ft" role="contentinfo"><p>Created By +<a href="http://thinkphp.ro/+">thinkphp</a></p></div>
</div>
</body>
</html>