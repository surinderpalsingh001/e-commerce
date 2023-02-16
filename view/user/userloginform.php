<?php
session_start();
if (isset($_POST['login']))
        {
            if(isset($_POST['username']) && isset($_POST['password']))
            {
                $username = $_POST['username'];
                
                $password = $_POST['password'];
        
                $data = "username=".$username;
            
                if(empty($username))
                {
                    dump($username);
                    $em = "User name is required";
                    header("Location:".$baseUrl."e-commerce//index.php/user/login?error=$em&$data");
                    exit;
                }
                else if(empty($password))
                {
                    dump($password);
                    $em = "password is required";
                    header("Location:".$baseUrl."e-commerce//index.php/user/login?error=$em&$data");
                    exit;
                }
                else
                {
                    $sql = "SELECT * FROM useradmindatas WHERE username = ? ";
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute([$username]);
                    dump($stmt->rowCount());
                    if($stmt->rowCount() >= 1)
            
                    {
        
                        $users = $stmt->fetchAll();
                        $firstUser = null;
                        foreach ($users as $user) 
                        {
                          
                          if ($user['isadmin'] == '0' && password_verify($password,$user['password']))
                          {
                            $_SESSION['admin']['adm_id'] = $user['id'];
                            $_SESSION['admin']['username'] = $user['username'];
                            header("location:".$baseUrl."e-commerce/index.php/admin/admhome");
                            exit;
                          }
                          else if ($user['isadmin'] == '1' && password_verify($password,$user['password']))
                          {                            
                            $_SESSION['user']['user_id'] = $user['id'];
                            $_SESSION['user']['username'] = $user['username'];
                            header("location:".$baseUrl."e-commerce/index.php/user/profile");
                            exit;
                          }
                          else
                          {
                            $em = "Incorect User name or password";
                            header("Location:".$baseUrl." e-commerce/admlogin.php?error=$em&$data");
                            exit();
                          }
                        }
                        // // dump($user);
                        // $name =  $user['name'];
                        // $username =  $user['username'];
                        // $pass =  $user['password'];
                        // $id =  $user['id'];
                        // $image =  $user['image'];
        
                        // if($username === $username)
                        // {
                        //    if(password_verify($password, $user['password']))
                        //    {
                        //         $_SESSION['image'] = $image;
                        //         $_SESSION['id'] = $id;
                        //         $_SESSION['name'] = $name;
                        //         $_SESSION['username'] = $username;
                        //         $_SESSION['email'] = $email;
                        //     }
                        // }
                    }
                }
            }
        }
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User Login Form</title>
  </head>
  <body>
    <div class="container">
      <div class="col col-lg-3 offset-4 mt-lg-5">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
          <h3 class="offset-3"><centre>Login Here!</centre></h3><br>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
          </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="col-form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="col-lg-5 btn btn-primary" name="login">Login</button>
            <a href="<?php echo $baseUrl; ?>e-commerce/index.php/user/signup" class="offset col-lg-6 btn btn-primary" name="register">Sign Up</a>
          </form>
        </div>
    </div>
  </body>
</html>