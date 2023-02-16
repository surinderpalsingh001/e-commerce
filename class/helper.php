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
function getUserById($id, $db){

    $sql = "SELECT * FROM useradmindatas WHERE id = ?";

    $sql = "SELECT * FROM users WHERE id = ?";

	$stmt = $db->prepare($sql);
	$stmt->execute([$id]);
    
    if($stmt->rowCount() == 1){
        $user = $stmt->fetch();
        return $user;
    }else {
        return 0;
    }

} 
?>


?>

