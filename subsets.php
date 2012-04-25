<?php

    require_once('jsonservice.php');

    class Subsets {

          public function get( $n ) {

             return$ret = $this->_generate($n);
          } 

          private function _generate( $n ) {

                 $arr = array();
                 for($i=0;$i<$n;$i++):
                     $arr[$i] = 0;
                 endfor;

                 $s = 0;
                 $ret = ''; 
                 do {
                    $arr[$n-1]++;

                    for($j=$n-1;$j>0;$j--):
                        if($arr[$j]>1):
                           $arr[$j] = 0;
                           $arr[$j-1] += 1;  
                        endif;
                    endfor;

                    $ret .= '{';

                    $temp = '';

                    for($k=0;$k<$n;$k++):
                        if($arr[$k]):
                           $temp .= ($k+1) . ',';
                        endif;
                    endfor;

                    $temp = substr($temp, 0, -1);
 
                    $ret .= $temp. '}, ';

                    $s = 0;
                    for($k=0;$k<$n;$k++):
                        $s += intval($arr[$k]); 
                    endfor;
                 }while($s<$n);

            return $ret=substr($ret,0,-2);
          }
    }

    $obj = new Subsets();

    $service = new JsonService( $obj );  

    $service->created(); 
?>
