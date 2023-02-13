<?php
session_start();
//$user_id = $_SESSION['user_id'];
$user['id'] = $_SESSION['user']['user_id'];
$user['username'] = $_SESSION['user']['username'];
?>



<?php $_SESSION['image'] ?>
<h3>ID : <?php $user['id'] ?></h3>
<h3>Name : <?php $user['username'] ?></h3>
<h3>Username : <?php $_SESSION['username'] ?></h3>
<h3>Email : <?php $_SESSION['email'] ?></h3>
