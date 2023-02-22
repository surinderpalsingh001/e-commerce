<?php
include('partials/adminheader.php');
include('partials/adminslider.php');
$obj = new CategoryController();
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['edit'])
{
  $dbh = $obj->editcatog($_POST);
}
?>

<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 mt-5 offset-1">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Update Category or Subcategory</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <?php
              if(isset($_GET['id']))
              {
                  $category_id = $_GET['id'];
                  $query = "SELECT * FROM categories WHERE id=:categ_id";
                  $statement = $dbh->prepare($query);
                  $data = [':categ_id' => $category_id];
                  $statement->execute($data);
                  $result = $statement->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
              }
              ?>

              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Update Category</label>
                    <input type="hidden" id="category_id" name="categ_id" value="<?php echo $category_id; ?>">
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="<?php echo $result['title']; ?>" aria-describedby="emailHelp">
                  </div>
                </div>
                <div class="card-footer">
                  <!-- <input type="submit" class="offset col-lg-3 btn btn-primary" name="submit" value="Add Category"> -->
                  <button type="submit" class="btn btn-success" name="edit" value="Edit Category">Update Category</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php
  include('partials/adminfooter.php');
?>