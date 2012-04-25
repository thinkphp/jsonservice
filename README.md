# JSON Sevice

  The 'JsonService' wraps a class instance and makes all its public methods callable through HTTP,
  accepting named parameters and returning the result JSON encoded.

## How to use

In this example we'll create a flickr service **flickrservice.php**

    require_once('jsonservice.php');

    class Flickr {

          public function get($text,$has_geo=1) {

                 $endpoint = 'http://query.yahooapis.com/v1/public/yql?q=';
 
                 $yql = 'select * from flickr.photos.search where has_geo="true" and text="'. $text .'" and api_key="e407090ddb7d7c7c36e0a0474289ec74"';

                 $xml = $endpoint . urlencode($yql). '&format=xml';

                 $photos = simplexml_load_file($xml);

            return $this->build_photos($photos->results->photo); 
          } 

          public function build_photos($photos) {

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

    //create a new object of Flickr
    $obj = new Flickr();

    //create a new instance of JsonService by passing flickr object.
    $service = new JsonService($obj);  

    //the flickr service is created.
    $service->created(); 

Now make an HTTP call to flickrservice.php/get?text=beach and you will get this response:

    {
      "status" : "okay",
      "response":"<ul><li>...</li><li>...</li><li>...</li></ul>"
    }


## MIT license

This project is licensed under an [MIT license][http://www.opensource.org/licenses/mit-license.php].