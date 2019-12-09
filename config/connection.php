<?php
    require_once "global.php";

    $connection = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

    mysqli_query( $connection, 'SET NAMES "'.DB_ENCODE.'"');

    //Si tenemos un posible error en la conexion, lo mostramos
    if(mysqli_connect_errno()){
        printf("Fail connection to dabase: %s\n",mysqli_connect_errno());
        exit();
    }

    if(!function_exists('runQuery')){
        function runQuery($sql){
            global $connection;
            $query = $connection->query($sql);
            return $query;
        }

        function runQuerySingleRow($sql){
            $query = $connection->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        }
        
        function runQueryReturnID($sql){
            global $connection;
            $query = $connection->query($sql);
            return $connection->insert_id;
        }

        function cleanString($str){
            global $connection;
            $str = mysqli_real_escape_string($connection,trim($str));
            return htmlspecialchars($str);
        }
    }
?>