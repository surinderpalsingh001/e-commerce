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
        header("location: ".$baseUrl."e-commerce/index.php".$location);
        exit();
    }
}
function getUserById($id, $dbh)
{
    $sql = "SELECT * FROM useradmindatas WHERE id = ?";

	$stmt = $dbh->prepare($sql);
	$stmt->execute([$id]);
    
    if($stmt->rowCount() == 1)
    {
        $udata = $stmt->fetch();
        return $udata;
    }
    else 
    {
        return 0;
    }

} 
?>