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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Products Table</title>
  </head>
    <body>
        <div class="container">
            <div class="col col-lg-10 offset-2 mt-lg-5">
                <h1>Categories Table</h1>
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
                    $query = "SELECT * FROM categories WHERE parent_id=".$_GET['id']." ORDER BY id DESC LIMIT {$offset},{$limit}";
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
                    // $stmt1->setFetchMode(PDO::FETCH_ASSOC);
                    // $result1 = $stmt1->fetchAll();
                    if($stmt1->rowCount()>0)
                    {
                        //dd($stmt1->rowCount());
                        $result1 = $stmt1->fetchAll();
                        $total_records = $stmt1->rowCount();
                        $total_page = ceil($total_records / $limit);
                        echo '<ul class="pagination admin-pagination">';
                        for($i=1; $i<=$total_page; $i++)
                        {
                            echo '<li><a href="'.$baseUrl.'index.php/admin/pdtcontroller?page='.$i.'">'.$i.'</a></li>';
                        }
                        echo '</ul>';
                    }
                ?>
                    
                    <!-- <li>
                        <a>2</a>
                    </li>
                    <li>
                        <a>3</a>
                    </li> -->
                </ul>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
<?php
include('partials/adminfooter.php');
?>