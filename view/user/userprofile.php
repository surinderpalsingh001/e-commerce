<?php
session_start();
//$user_id = $_SESSION['user_id'];
$user['id'] = $_SESSION['user']['user_id'];
$user['username'] = $_SESSION['user']['username'];
?>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content mt-lg-4">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Record</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Courses</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <?php
                            $query = "SELECT * FROM useradmindatas";
                            $statement = $dbh->prepare($query);
                            $statement->execute();

                            $statement->setFetchMode(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                            $result = $statement->fetchAll();
                            if($result)
                            {
                                foreach($result as $row)
                                {
                                    ?>
                                    
                                    <td><img height="100" width="100" src="<?php echo asset($row['image'])?>" /></td>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        
                                        <td>
                                        <a href="" class=" btn btn-primary ">
                                        <i class="fa fa-user"></i>
                                        </a>
                                        <a href="" class=" btn btn-success ">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="<?php echo $baseUrl ;?>e-commerce/index.php/admin/record?id=<?php echo $row['id'];?>" class=" btn btn-danger ">
                                        <i class=" fa fa-trash"></i>
                                    </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            
                        ?>
                        </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           
                       
             
                
    <br>
    <br>

    



