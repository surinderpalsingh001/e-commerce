<?php
    $baseUrl = 'http://'.$_SERVER['SERVER_NAME']."/e-commerce/";
    function asset($src){
        global $baseUrl;
        return $baseUrl.'assets/upload_images/'.$src;
    }

?>