<?php 

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header("location:".$baseUrl."e-commerce/index.php/user/login");
 }

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {


$user = getUserById($_SESSION['id'], $dbh);


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php if ($user) 
    { 
        ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<div class="shadow w-350 p-4 ">
    		<img width="200px" height="200px" src="<?php echo asset($user['image'])?>">
            <table>
            <tr>
                <td >FirstName:<?=$user['name']?></td>
            </tr>
            <tr>
                <td>UserName:<?=$user['username']?><td>
            </tr>
            <tr>
               <td>Email:<?=$user['email']?></td>
            </tr>
            <tr>
                <td><a href="edit.php" class="btn btn-primary">Edit Profile</a>
                <a href="<?php echo $baseUrl;?>index.php/user/login" class="btn btn-warning">Logout</a></td>
            </tr>

             
            </table>
		</div>
    </div>
    <?php }else { 
     header("Location:".$baseUrl."e-commerce/index.php/user/login");
     exit;
    } ?>
</body>
</html>

<?php }
else 
{
	header("Location:".$baseUrl."e-commerce/index.php/user/login");
	exit;
} 
?>