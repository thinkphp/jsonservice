<?php

    require_once('jsonservice.php');

    class InsertionSort {

          public function sort( $arr ) {

                 $arr = split(",",$arr); 

                 $n = count( $arr );    

                 for($i=1;$i<$n;$i++):

                     $temp = $arr[$i];
                     $j = $i - 1;
                     
                     while($j>=0 && $arr[$j]>$temp):

                           $arr[$j+1] = $arr[$j];
                           $j--;

                     endwhile;
 
                     $arr[$j+1] = $temp;

                  endfor;
 
              return $arr;   
          } 
    }

    $obj = new InsertionSort();

    $service = new JsonService( $obj );  

    $service->created(); 
?>
