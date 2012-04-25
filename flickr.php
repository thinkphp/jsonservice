<?php

    require_once('jsonservice.php');

    class Flickr {

          /**
           * Photos who's title, description, tags contain the text will be returned.
           * @param $text    String  - A free text search.
           * @param $has_geo Boolean - Any photo that has been geotagged, or 0 any photo that has not been geotagged.
           * @return JSON object     - {'status': 'okay','response': '<ul><li>...</li></ul>'} 
           * 
           */
          public function get($text,$has_geo=1) {

                 $endpoint = 'http://query.yahooapis.com/v1/public/yql?q=';
 
                 $yql = 'select * from flickr.photos.search where has_geo="true" and text="'. $text .'" and api_key="e407090ddb7d7c7c36e0a0474289ec74"';

                 $xml = $endpoint . urlencode($yql). '&format=xml';

                 $photos = simplexml_load_file($xml);

            return $this->build_photos($photos->results->photo); 
          } 

          private function build_photos($photos) {

                 $output = '<ul>';

                 if(count($photos) > 0) {

                    foreach($photos as $photo) {

                      $output .="<li><a href='http://www.flickr.com/photos/{$photo['owner']}/{$photo['id']}' target='_blank'><img src='http://farm{$photo['farm']}.static.flickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}.jpg' alt='{$photo['title']}' width='75' height='75'/></a></li>";
                    }

                 } else {

                     $output .= '<li>No Photos found.</li>';
                 }

                 $output .= '</ul>';      

              return $output;
          }
    }

    $obj = new Flickr();

    $service = new JsonService($obj);  

    $service->created(); 
?>