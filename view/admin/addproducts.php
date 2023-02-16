<?php
include('partials/adminheader.php');
include('partials/adminslider.php');
$obj = new addCat();
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['subproduct'])
{
  $dbh = $obj->addproduct($_POST, $_FILES);
}
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
                <h3 class="card-title">Products</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Categories</label>
                    <select class="form-control" name="category_id">
                      <option>Categories</option>
                    <?php
                        $sql = "SELECT * FROM categories WHERE parent_id = 0";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll();
                        foreach ($results as $row)
                        {
                          ?>
                          <option value="<?php echo $row['id']; ?>"><?php echo $row['title'] ?></option>
                        <?php
                        }
                    ?>
                    </select>
                    <?php
                    if(isset($_GET['id']))
                    {
                      dump($_GET['id']);
                        //$category_id = $_GET['id'];
                        $query2 = "SELECT * FROM categories WHERE id";
                        $statement2 = $dbh->prepare($query2);
                        //$data = [':categ_id' => $category_id];
                        $statement2->execute();
                        $result2 = $statement2->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC
                        foreach($result2 as $value)
                        {
                            ?>
                            <input type="text" id="category_id" name="categ_id" value="<?php echo $value['id']; ?>">
                            <?php
                        }
                    }
                    ?>
                    

                    <label for="exampleInputEmail1">Select Sub Categories</label>
                    <select class="form-control" name="sub_category_id">
                      <option>Sub Categories</option>
                    <?php
                        $sql1 = "SELECT * FROM products WHERE id";
                        $query1 = $dbh->prepare($sql1);
                        $query1->execute();
                        $results1 = $query1->fetchAll();
                    ?>
                    </select>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Product Name</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Products">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">About Product</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Product Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <!-- /.card -->
    </section>
</div>
<?php
include('partials/adminfooter.php');
?>