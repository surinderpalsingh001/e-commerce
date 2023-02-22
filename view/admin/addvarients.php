<?php
include('partials/adminheader.php');
include('partials/adminslider.php');
?>


<div class="content-wrapper">
  <!-- Main content -->
  <section class="content mt-lg-4">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10 offset-1 mt-4">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Product Varients</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="varient_form" name="varient_form" method="POST" onsubmit="return saveData(this)">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Category</label>
                    <select class="form-control" name="category_id">
                      <option>Select Category</option>
                      <?php
                      $sql = "SELECT * FROM categories WHERE parent_id = 0";
                      $query = $dbh->prepare($sql);
                      $query->execute();
                      $results = $query->fetchAll();
                      
                      foreach ($results as $row)
                      {
                      ?>
                        <option value="<?php echo $row['id'];  ?>"><?php echo $row['title'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <div class="form-group mt-3">
                      <label for="exampleInputPassword1">ADD Product Varient</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="varient_title" placeholder="Varient">
                    </div>
                    <!-- New Section Add on 5/2/2023 -->
                    <div class="table-repsonsive">
                      <span id="error"></span>
                        <table class="table table-bordered" id="item_table" style="text-align:center; border:hidden">
                          <tr>
                            <th>Key</th>
                            <th>Value</th>
                            <th><button type="button" name="add" class="btn btn-success" onclick="create_tr('table_body')"><i class="fa fa-plus-square align-items-md-center"></i></button></th>
                          </tr>

                          <tbody id="table_body">
                            <tr>
                              <td>
                                <input type="text" class="form-control" placeholder="key" name="key[]">
                              </td>
                              <td>
                                <input type="text" class="form-control" placeholder="Value" name="value[]">
                              </td>
                              <td>
                                <div class="action_container">
                                  <button class="btn btn-danger" onclick="remove_tr(this)">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <!-- New Section Add on 5/2/2023 -->

                      <!-- /.card-body -->
                        <div class="card-footer">
                          <button type="submit" class="btn btn-info" name="add_var">Submit</button>
                        </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
</div>
<script src="<?php echo $baseUrl; ?>js/app.js?V=<?php echo  time(); ?>"></script>
<script>
    function saveData(e){
        let form = document.querySelector("#varient_form");
        let data = new FormData(form)
        fetch(baseurl +"index.php/admin/varient/save",{method:"POST", body:data})
        .then(r=>{ return r.json()}).then(data=>{console.log(data); alert(data.msg);})
        console.log("Save Called",form, data);
        return false; 
    }
</script>
<?php
include('partials/adminfooter.php');
?>