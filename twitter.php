<?php

    require_once('jsonservice.php');

    class Twitter {

          const endpoint = 'http://twitter.com/statuses/user_timeline/';

          public function get( $username, $count = 10 ) {

                 //call private method _curl for retrieve the data from service API Twitter in format xml 
                 $statuses = $this->_curl( $username, $count );

                 $beforeHTML="<div class='wrapper-content-tweets'><ul>";

                 $startHTML="<li class=\"tweet\"><div class=\"tweet-status\">";

                 $endHTML="</div></li>";

                 $afterHTML="</ul></div><!-- end wrapper content tweets -->";

                 $output = '';

               //for each tweet format the result
               foreach( $statuses as $key => $status ) {  

                      if(substr_count($status->text,'https://') != 0 | 
                                substr_count($status->text,'@') != 0 | 
                                substr_count($status->text,'#') != 0 | 
                                substr_count($status->text,'http://') != 0):
                        $tweet = $this->_tweetify($status->text);
                      else:
                        $tweet = $status->text;
                      endif;
                      $output .= $startHTML . $tweet . $endHTML;
               }

             return $beforeHTML . $output . $afterHTML;
          } 

          private function _curl( $id, $count ) {

                 $url = self::endpoint.$id.".xml?count=" . $count;
                 $ch = curl_init();
                 curl_setopt($ch,CURLOPT_URL,$url);
                 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                 curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,3);
                 curl_setopt($ch,CURLOPT_TIMEOUT,3);
                 $data = curl_exec($ch);
                 $info = curl_getinfo($ch);
                 curl_close($ch);
                 if(intval($info['http_code']) == 200):
                      if(class_exists('simpleXMLElement')):
                          $xml = new SimpleXMLElement($data); 
                          return $xml;
                     else:
                          return $data;
                     endif;
                 else:
                  return false;
                 endif;
          }

          private function _tweetify( $text ) {

                 $text = preg_replace("/(https?:\/\/[\w\-:;?&=+.%#\/]+)/i", '<a href="$1">$1</a>',$text);
                 $text = preg_replace("/(^|\W)@(\w+)/i", '$1<a href="http://twitter.com/$2">@$2</a>',$text);
                 $text = preg_replace("/(^|\W)#(\w+)/i", '$1#<a href="http://search.twitter.com/search?q=%23$2">$2</a>',$text); 

            return $text;
          }

    }

    $obj = new Twitter();

    $service = new JsonService($obj);  

    $service->created(); 
?>