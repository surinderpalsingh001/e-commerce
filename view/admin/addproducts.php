<?php

use Classes\CategoryController;

include('partials/adminheader.php');
include('partials/adminslider.php');
$obj = new CategoryController();
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
                    <div  id="container">
                      <label for="exampleInputEmail1">Select Categories</label>
                        <select class="form-control" name="category_id" id="category">
                          <option>Categories</option>
                          <?php
                            $sql = "SELECT * FROM categories WHERE parent_id = 0";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll();
                            foreach ($results as $value)
                            {
                          ?>
                            <option value="<?php echo $value['id']; ?>"><?php echo $value['title'] ?></option>
                          <?php
                            }
                          ?>
                        </select>
                    </div>
                    <script>
                      let sel = document.querySelector("#category");
                      console.log(sel);
                      sel.addEventListener("change",myFunction)
                      function myFunction(e)
                      {
                        
                        let pid = e.target.value;
                        console.log(pid);
                        fetch("<?php echo $baseUrl; ?>index.php/admin/category/subcat?id="+pid,)
                          .then(data=>data.json())
                          .then(response => {
                              if(response.length)
                              {
                                //NEED TO CREATE ANOTHER CHILD SELECTOR
                                createChildSelector(response) 
                              }
                          });
                      }
                      function createChildSelector(res)
                      {
                        var select = document.querySelector('#childCat');
                        console.log('select', typeof(select));
                        
                        if(select!=null){
                          select.parentNode.removeChild(select);
                          select = document.querySelector('#childCat');
                        }
                        if(select==null)
                        {
                          const container = document.getElementById("container");
                          const select = document.createElement("select");
                          select.setAttribute('id','childCat');
                          console.log(select);
                          container.appendChild(select);
                          for(let o = 0; o < res.length; o++)
                          {
                            const option = document.createElement("option");
                            option.textContent = res[o]['title'];
                            option.value = res[o]['id'];
                            select.appendChild(option);
                          };
                        }
                      }
                    </script>
                  <!-- Product Varient Selector  -->
                    <div  id="container">
                      <label for="exampleInputEmail1">Select Varients</label>
                        <select class="form-control" name="varient_id" id="varient">
                          <option>Varients</option>
                          <?php
                            $sql = "SELECT * FROM productvarient WHERE category_id";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results1 = $query->fetchAll();
                            foreach ($results1 as $value1)
                            {
                          ?>
                            <option value="<?php echo $value1['id']; ?>"><?php echo $value1['varient_title'] ?></option>
                          <?php
                            }
                          ?>
                        </select>
                    </div>
                
                    <script>
                      let vel = document.querySelector("#varient");
                      console.log(vel);
                      vel.addEventListener("change",myFunction)
                      function myFunction(a)
                      {
                        
                        let lid = a.target.value1;
                        console.log(lid);
                        fetch("<?php echo $baseUrl; ?>index.php/admin/category/subvar?id="+lid,)
                          .then(data1=>data1.json())
                          .then(responsed => {
                              if(responsed.length)
                              {
                                //NEED TO CREATE ANOTHER CHILD SELECTOR
                                createChildSelector(responsed) 
                              }
                          });
                      }
                      function createChildSelector(res1)
                      {
                        var select = document.querySelector('#childVar');
                        console.log('select', typeof(select));
                        
                        if(select!=null){
                          select.parentNode.removeChild(select);
                          select = document.querySelector('#childVar');
                        }
                        if(select==null)
                        {
                          const container = document.getElementById("container");
                          const select = document.createElement("select");
                          select.setAttribute('id','childVar');
                          console.log(select);
                          container.appendChild(select);
                          for(let i = 0; i < res1.length; i++)
                          {
                            const option = document.createElement("option");
                            option.textContent = res1[i]['attribute_key'];
                            option.value = res1[i]['last_attribute_id'];
                            select.appendChild(option);
                          };
                        }
                      }
                    </script>

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