<?php
namespace Classes;
include('partials/adminheader.php');
include('partials/adminslider.php');
$limit = 5;
if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page = 1;
}
$offset = ($page - 1) * $limit;


$obj = new CategoryController();
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['del'])
{
  $dbh = $obj->delcatog($_POST);
}
?>

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="col-md-10 m-7 container">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 orange mt-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3>Categories Table</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-success table-striped">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Parent ID</th>
                                    <th style="width:400px;">Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                $query = "SELECT * FROM categories WHERE parent_id = 0 ORDER BY id DESC LIMIT {$offset},{$limit}";
                                $stmt = $dbh->prepare($query);
                                $stmt->execute();
                                //$stmt->setFetchMode(PDO::FETCH_ASSOC);
                                $result = $stmt->fetchAll();
                                if($result)
                                {
                                    foreach($result as $data)
                                    {
                                    ?>
                                    <tbody>
                                        <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['title']; ?></td>
                                        <td><?php echo $data['parent_id']; ?></td>
                                        <td>
                                        <a href ="<?php echo $baseUrl; ?>index.php/admin/cat" class="btn btn-primary">ADD</a>&nbsp;
                                        <a href ="<?php echo $baseUrl; ?>index.php/admin/cat/view?id=<?php echo $data['id']; ?>" class="btn btn-warning">View</a>&nbsp;
                                        <a href="<?php echo $baseUrl; ?>index.php/admin/edit?id=<?php echo $data['id']; ?>" class="btn btn-success">Edit</a>
                                        &nbsp;<form style="display:inline;" action="<?php echo $baseUrl; ?>index.php/admin/pdtcontroller" method="post">
                                            <button type="submit" class="btn btn-danger" name="del" value="<?php echo $data['id']; ?>">Delete</button>
                                        </form></td>
                                        </tr>
                                    </tbody>
                                <?php    
                                }
                                }
                                ?>  
                            </table>
                                <?php
                                    $query1 = "SELECT * FROM categories";
                                    $stmt1 = $dbh->prepare($query1);
                                    $stmt1->execute();
                                    if($stmt1->rowCount()>0)
                                    {
                                        //dd($stmt1->rowCount());
                                        $result1 = $stmt1->fetchAll();
                                        $total_records = $stmt1->rowCount();
                                        $total_page = ceil($total_records / $limit);
                                        echo '<ul class="pagination admin-pagination mt-3 offset-10">';
                                        for($i=1; $i<=$total_page; $i++)
                                        {
                                            echo '<li class="page-item active"><a href="'.$baseUrl.'index.php/admin/pdtcontroller?page='.$i.'" class="page-link"> '.$i.' </a></li>';
                                        }
                                        echo '</ul>';
                                    }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
    include('partials/adminfooter.php');
?>