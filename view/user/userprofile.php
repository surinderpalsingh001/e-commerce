<?php 
namespace Classes;
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">

<?php
session_start();
include('partials/adminheader.php');
include('partials/adminslider.php');
$user['id'] = $_SESSION['user']['user_id'];
$user['username'] = $_SESSION['user']['username'];

if(!isset($user['id']) && !isset($user['username']))
{
    header("location:".$baseUrl."index.php/user/login");
}
if (isset($user['id']) && isset($user['username']))
{
    $udata = getUserById($user['id'], $dbh);

    if($udata) 
    { 
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content mt-lg-4">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6 mt-lg-4 offset-3">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Your Profile</h3>
                                </div>
                                <div class="card mb-3" style="max-width: 400px;">
                                    <div class="row g-0">
                                        <div class="col-md-5 mt-lg-4 offset-1">
                                            <img src="<?php echo asset($udata['image']); ?>" class="img-fluid rounded-start" alt="You Buy">
                                        </div>
                                        <div class="col-md-3 offset-0 mt-lg-2">
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td class="card text-white bg-dark mb-2">Name:<?php echo $udata['name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="card text-white bg-dark mb-2">Username:<?php echo $udata['username']; ?><td>
                                                    </tr>
                                                    <tr>
                                                        <td class="card text-white bg-dark mb-2">Email:<?php echo $udata['email']; ?></td>
                                                    </tr>
                                                </table>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="edit.php" class="btn btn-primary">Edit Profile</a>
                                    <a href="<?php echo $baseUrl; ?>index.php/user/login" class="btn btn-warning">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </section>
        </div>
<?php 
    }
}
?>
                <!-- <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="...." class="img-fluid rounded-start" alt="You Buy">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>--->
                

<?php
include('partials/adminfooter.php');
?>


