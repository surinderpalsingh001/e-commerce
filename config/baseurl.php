<?php
    $baseUrl = 'http://'.$_SERVER['SERVER_NAME']."/";
    function asset($src){
        global $baseUrl;
        return $baseUrl.'assets/upload_images/'.$src;
    }

?>