<?php
use Classes\VarientController;
ob_start();
include('vendor/autoload.php');

include('connection/useradminconnection.php');
include('config/baseurl.php');
include('class/categorycontroller.php');
include('class/helper.php');
//dump($_SERVER);
$route = $_SERVER['PATH_INFO'];

$route = [
        "user" => 
        [
            "login" => "/user/userloginform.php",
            "signup" => "/user/userregisterform.php",
            "profile" => "/user/userprofile.php"
        ],
        "admin" => 
        [
            "admlogin" => "/admin/adminloginform.php",
            "admhome" => "/admin/adminhome.php",
            "product" => "/admin/addproducts.php",
            "cat/view" => "/admin/category/view.php",
            "cat" => "/admin/category.php",
            "pdtcontroller" => "/admin/prodectcontroller.php",
            "edit" => "/admin/editcategory.php",
            "varients" => "/admin/addvarients.php",
            "viewvarient" => "/admin/viewprodvar.php",
            "varient/save"=>["method"=>"POST","controller"=>VarientController::class,"function"=>"save"]
        ]
];

//    $routeArr = explode('/',$_SERVER['PATH_INFO']);
//    include("views".$routes[$routeArr[1]][$routeArr[2]]);
//    dd($routeArr[2]);

$routeArr = explode('/',$_SERVER['PATH_INFO']);
$uri = $routeArr[2];
if(isset($routeArr[3]))
{
    $uri = implode('/', array_slice($routeArr, 2));
}
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
    // code here
}
else
{
?>
<script> let baseurl = "<?php echo $baseUrl; ?>"; </script>
<?php
}
if(!is_array($route[$routeArr[1]][$uri]))
{
    include("view".$route[$routeArr[1]][$uri]);
}
else
{
    ob_clean();
    $class= VarientController::class;
    extract($route[$routeArr[1]][$uri]);
    
    if($method=="POST" && $_SERVER['REQUEST_METHOD']=="POST")
    {
        $obj =  new $controller();
       
        $obj->$function($_POST);
        dd("Logic goes here", $controller ,$route[$routeArr[1]][$uri], new $class());
    }
    else
    {
        dd("Your Method to call is ".$_SERVER["REQUEST_METHOD"]);
    }
    
}
//include("view".$route[$routeArr[1]][$uri]);
//dd($routeArr);
?>