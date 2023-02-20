<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">

<?php 
session_start();
$user['id'] = $_SESSION['user']['user_id'];
$user['username'] = $_SESSION['user']['username'];

if(!isset($user['id']) && !isset($user['username']))
{
    header("location:".$baseUrl."e-commerce/index.php/user/login");
}
if (isset($user['id']) && isset($user['username']))
{
    $udata = getUserById($user['id'], $dbh);

    if($udata) 
    { 
    ?>
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="shadow w-350 p-4 ">
                    <table>
                        <tr>
                            <td>
                                <img src="<?php echo asset($udata['image']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td >Name:<?php echo $udata['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Username:<?php echo $udata['username']; ?><td>
                        </tr>
                        <tr>
                            <td>Email:<?php echo $udata['email']; ?></td>
                        </tr>
                        <tr>
                            <td><a href="edit.php" class="btn btn-primary">Edit Profile</a>
                            <a href="<?php echo $baseUrl; ?>e-commerce/index.php/user/login" class="btn btn-warning">Logout</a></td>
                        </tr>
                    </table>
            </div>
        </div>
    <?php 
    }
}
    ?>