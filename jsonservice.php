<?php

   /**
    * JSON Service for HTTP REST GET
    */
    class JsonService {

          private $instance;

          public function __construct($instance) {
     
                 $this->instance = $instance;
          }

          public function getParam( $name ) {

             if($this->hasParam($name)):
  
                 if(get_magic_quotes_gpc()) {

                   $x = stripslashes( $_GET[$name] );

                 } else {

                   $x = $_GET[$name];
                 } 

                return $x; 

             endif;

            return NULL;  
          }
     
          public function hasParam( $name ) {

                 return isset($_GET[$name]);
          }

          public function created() {

              error_reporting(0);

              $ex = 0;

              header('content-type: application/json');

              try{ 
  
                 if(empty($_SERVER['PATH_INFO'])) {
 
                          throw new Exception('Could not extract method name!'); 
                 }

                 //get method name
                 $methodName = substr($_SERVER['PATH_INFO'],1);

                 //define arguments array
                 $args = array();

                 //get method
                 $method = new ReflectionMethod(get_class($this->instance), $methodName);  

                 //get all parameter of the method
                 $params = $method->getParameters();

                 //for each parameter execyte
                 foreach( $params as $param ) {

                         //get the name of the parameter
                         $name = $param->getName();

                         //check if the paramenter is sent GET
                         if($this->hasParam($name)) {

                            $args[] = $this->getParam($name); 

                         //check if the parameter is optional
                         } else if($param->isOptional() && $param->isDefaultValueAvailable()) {

                            $args[] = $param->getDefaultValue();    

                         //otherwise, throw an exception
                         } else {

                            throw new Exception('Parameter "'. $name . '" is required!'); 
                         }
                 }

                 //set status ok
                 $status = 'okay';

                 $response = $method->invokeArgs($this->instance, $args);

              } catch( Exception $e ) {

                 //flag that indicates we have exceptions
                 $ex = 1;

                 echo json_encode( array( "status" => $e->getMessage(), "response" => get_class($e) ) );     
              }

              //if we haven't exceptions return json
              if( !$ex ) {
       
                  echo json_encode(array( "status" => $status, "response" => $response ));
              }
          } 
    }

?>