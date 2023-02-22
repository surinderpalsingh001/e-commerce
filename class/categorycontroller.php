<?php
namespace Classes;

use Exception;

class CategoryController
{
    public $dbh;
    function __construct()
    {
        global $dbh;
        $this->dbh = $dbh;
        $errors = "";
        $msg = "";
    }
    //Define Category Class
    public function items($postedData)
    {

        $title = $postedData['title'];
        $parent_id = $postedData['parent_id'];


        if (empty($title)) {
            $errors['title'] = "Category is Required...!";
        }
        //Insert Data Using Sql Query
        $query = "INSERT INTO categories (title,parent_id) VALUES ('$title','$parent_id')";
        //Execute Sql Query
        $sql = $this->dbh->prepare($query);
        $sql->execute();

        if ($sql) {
            echo "Category Added Successfully";
            Helper::reditrect('/admin/pdtcontroller');
        } 
        exit();
    }
    public function delcatog($postedData)
    {
        if (isset($postedData['del'])) 
        {
                $id = $postedData['del'];

                $query = "DELETE FROM categories WHERE id=:id";
                $sql = $this->dbh->prepare($query);
                $data = [':id' => $id];
                $query_exe = $sql->execute($data);
                if($query_exe) 
                {
                    echo "Data Deleted Successfully";
                    Helper::reditrect('/admin/pdtcontroller');
                } else {
                    echo "Data Not Delete";
                }

        } 
    }
    public function editcatog($postedData)
    {
        
        
        if(isset($postedData['edit']))
        {
            $category_id = $postedData['categ_id'];
            $title = $postedData['title'];

            try
            {
                $query = "UPDATE categories SET title=:title WHERE id=:categ_id";
                var_dump($query);
                $statement = $this->dbh->prepare($query);

                $data = [
                            ':title' => $title,
                            ':categ_id' => $category_id
                        ];
                print_r($data);
                $query_execute = $statement->execute($data);
                if($query_execute)
                {
                    echo "Data Updated Successfully";
                    Helper::reditrect('/admin/pdtcontroller');
                    exit();
                }
                else
                {
                    echo "Data Not Updated";
                    exit();
                }

            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }

    public function addproduct($postedData,$files)
    {
        if(isset($postedData['subproduct']))
        {
            $catid = $postedData['catid'];
            $product = $postedData['product'];
            $images = $files['images'];

            if($postedData['catid'] == '') 
            {
                $errors['catid'] = '*Please Select Category First*';
            }
            if($postedData['product'] == '') 
            {
                $errors['password'] = '*Please Add Product Name*';
            }
            if($_FILES['image'] == '') 
            {
                $errors['image'] = '*Upload Product Image Compulsory*';
            }    

            if(count($errors)>0)
            {
                print_r($errors);
                die;
            }

        
            // Count total files
			$countfiles = count($files['files']['name']);
			
			// Prepared statement
			$query = "INSERT INTO newproducts (catid,product,name,image) VALUES('$catid','$product','?','".basename($images)."',?)";

			$statement  = $this->dbh->prepare($query);

			// Loop all files
			for($i=0;$i<$countfiles;$i++)
            {

				// File name
			   	$filename = $files['files']['name'][$i];

			   	// Get extension
          		$ext = end((explode(".", $filename)));
			       $ext = substr($ext, 1);


          		// Valid image extension
          		$valid_ext = array("png","jpeg","jpg");

          		if(in_array($ext, $valid_ext))
                {
          			// Upload file
				   	if(move_uploaded_file($files['files']['tmp_name'][$i],'upload/'.$filename))
                    {
				   		// Execute query
						$statement->execute(array($filename,'upload/'.$filename));
					}
          		}
			   	
			}
			echo "Images Uploaded Successfully";
		}
    }


    public function getSubCats($data)
    {
        $sql = "SELECT * FROM categories WHERE parent_id = ?";
        $statement  = $this->dbh->prepare($sql);
        $data = $statement->execute([$data['id']]);
        $res = $statement->fetchAll();
        echo json_encode($res);
        exit();

    }

    public function getSubVar($data1){
        $sql1 = "SELECT * FROM varientattributes WHERE last_varient_id = ?";
        $statement1  = $this->dbh->prepare($sql1);
        $data1 = $statement1->execute([$data1['id']]);
        $res1 = $statement1->fetchAll();
        echo json_encode($res1);
        exit();

    }
}

?>