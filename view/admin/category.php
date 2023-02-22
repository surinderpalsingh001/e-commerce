<?php
namespace Classes;
include('partials/adminheader.php');
include('partials/adminslider.php');
$obj = new CategoryController();
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'])
{
  $dbh = $obj->items($_POST);
}
?>
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 mt-5 offset-1">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Insert Category or Subcategory</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Category or Subcategory Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="title" placeholder="Category or Subcategory">
                  </div>
                </div>
                <!-- hidden input parent_id -->
                <input type="hidden" class="form-control" id="exampleInputEmail1" name="parent_id" value="<?php if(isset($_GET['parent_id'])){ echo $_GET['parent_id']; }else{ ?>0<?php }?>">
                <!-- /.hidden input parent_id -->
                <div class="card-footer">
                  <!-- <input type="submit" class="offset col-lg-3 btn btn-primary" name="submit" value="Add Category"> -->
                  <button type="submit" class="btn btn-primary" name="submit" value="Add Category">Insert Category</button>
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
