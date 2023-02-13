<?php
namespace Classes;


class VarientController{

    public $dbh;
    function __construct()
    {
        global $dbh;
        $this->dbh = $dbh;
        $errors = "";
        $msg = "";
    }
    function save($postedData)
    {

        dump($postedData);
        if(isset($postedData['category_id']))
        {
            $category_id = $postedData['category_id'];
            $varient_title = $postedData['varient_title'];

            $data = array(
                'key' => $postedData['key'],
                'value' => $postedData['value']
            );
            echo json_encode(["msg"=>"ok! saved", "type"=>"success"]);

            //Insert Data Using Sql Query
            $query = "INSERT INTO productvarient (category_id, varient_title) VALUES ('$category_id','$varient_title')";
            dump($query);
            //Execute Sql Query
            $sql = $this->dbh->prepare($query);
            $sql->execute();

            if ($sql)
            {
                dump($sql);
                $lastId = $this->dbh->lastInsertId();
                foreach($postedData['key'] as $index=>$key)
                {
                    dump($key,$postedData['value'][$index]);
                    $val = $postedData['value'][$index];
                    $lastId;

                    $query1 = "INSERT INTO varientattributes (last_varient_id, attribute_key, attribute_value) VALUES ('$lastId','$key','$val')";
                    dump($query1);
                    $stmt = $this->dbh->prepare($query1);
                    $stmt->execute();
                }
                
                echo "Last Inserted Varient = ".$lastId;
            } 
            exit();

            
        }
    }
    
}

?>