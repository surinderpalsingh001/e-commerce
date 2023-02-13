<?php
session_start();
    //include('../../connection/useradminconnection.php');
    $errors=[];
    $msg = "";
    if(isset($_POST['register']))
    {

      $name = $_POST['name'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $image = $_FILES['image'];

        if($_POST['username'] == '') 
        {
            $errors['username'] = '*Please enter Valid Username*';
        }
        if($_POST['password'] == '') 
        {
            $errors['password'] = '*Please enter a Valid Password*';
        }
        if($_FILES['image'] == '') 
        {
            $errors['image'] = '*Please enter a Valid image*';
        }

        //Hashing (Ecrypted) the Password in Database
        $password = crypt($password, PASSWORD_DEFAULT);        

        if(count($errors)>0)
        {
            print_r($errors);
            die;
        }

         //$msg = "";
         $image = $_FILES['image']['name'];
         $target = "assets/upload/".basename($image);
 
         if(move_uploaded_file($_FILES['image']['tmp_name'],$target))
         {
             $msg = "Image Uploaded Successfully";
         }
         else
         {
             $msg = "Image Not Uploaded";
         }
         $sql = "INSERT INTO useradmindatas (name,email,username,password,image)
         VALUES ('$name','$email','$username','$password','".basename($image)."')";
         $query = $dbh->exec($sql);
        $data = ob_get_clean();
        //dd($data);
        ob_clean();
        header("location:".$baseUrl."index.php/user/login");
        exit();
        //header("location:".$baseUrl."index.php/user/login");
        //dd($baseUrl."index.php/user/login");
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

    <title>Register Form</title>
  </head>
  <body>
    <div class="container">
      <div class="col col-lg-3 offset-4 mt-lg-5">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
          <h3 class="offset-3"><centre>Register Here!</centre></h3><br>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Select a Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp">
          </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="col-form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="col-form-label">Your Image</label>
              <input type="file" class="form-control" id="exampleInputPassword1" name="image" value="<?php echo $msg; ?>">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary col-lg-4" name="register">Register</button>
          </form>
        </div>
    </div>
  </body>
</html>