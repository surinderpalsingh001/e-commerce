<?php
class Helper
{
    /** 
    *To Reditrect
    *@return void
    */

    public static function reditrect(string $location): void
    {
        global $baseUrl;
        header("location: ".$baseUrl."index.php".$location);
        exit();
    }
}
?>