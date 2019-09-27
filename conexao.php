<?php

    class ConnectDB{
        public static function get_connect(){
            $con = new mysqli("localhost", "root", "r00t", "webii");
   
            if($con->connect_error){
                die("Connect failed: %s\n" . mysqli_connect_error());
                exit();
            }
            // else{
            //     echo "Successfully Connected.\n";
            // }
            return $con;
        }
    }
    
?>