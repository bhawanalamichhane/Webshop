<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require ("./Entities/ProductEntity.php");
;
//Contains database related code for the Coffee page.
class ProductModel {

    //Get all product types from the database and return them in an array.
    function GetProductTypes() {
        require 'config.php';

        //Open connection and Select database.   
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
       }

       $sql = "SELECT DISTINCT product_type FROM products";
       $result = mysqli_query($conn, $sql);
       $productArray = array();

       
       while($row = mysqli_fetch_array($result,MYSQLI_NUM)) {
        array_push($productArray, $row[0]);
       }
  

        //Close connection and return result.
        mysqli_close($conn);
        return $productArray;
       }

    //Get productEntity objects from the database and return them in an array.
    function GetProductByType($type) {
        require 'config.php';
        //Open connection and Select database.   
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
       }

       $sql = "SELECT * from products where product_type like '$type'";
       $result = mysqli_query($conn, $sql);
       $productArray = array();
        
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM)) {
            $id = $row[0];
            $product_code = $row[1];
            $product_name = $row[2];
            $product_type = $row[3];
            $product_desc = $row[4];
            $product_img_name = $row[5];
            $price = $row[6];

            //Create coffee objects and store them in an array.
            $product = new ProductEntity($id, $product_code, $product_name, $product_type, $product_desc, $product_img_name, $price);
            array_push($productArray, $product);
        }
        //Close connection and return result
        mysqli_close($conn);
        return $productArray;
    }


    function GetProductById($id) {
        require ('config.php');
        //Open connection and Select database.   
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
       }

       $sql = "SELECT * from products where id = $id";
       $result = mysqli_query($conn, $sql);    
        
        

        //Get data from database.
        while ($row = mysqli_fetch_array($result,MYSQLI_NUM)) {
            $product_code = $row[1];
            $product_name = $row[2];
            $product_type = $row[3];
            $product_desc = $row[4];
            $product_img_name = $row[5];
            $price = $row[6];

            //Create product
            $product = new ProductEntity($id, $product_code, $product_name, $product_type, $product_desc, $product_img_name, $price);
        }
        //Close connection and return result
        mysqli_close($conn);
        return $product;
    }


     function InsertProduct(ProductEntity $product) {
        require 'config.php';

        // Create connection
       $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
       if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
}
       $query = sprintf("INSERT INTO products
                          (product_code, product_name, product_type, product_desc, product_img_name, price)
                          VALUES
                          ('%s','%s','%s','%s','%s','%s')",
                mysqli_real_escape_string($conn,$product->product_code),
                mysqli_real_escape_string($conn,$product->product_name),
                mysqli_real_escape_string($conn,$product->product_type),
                mysqli_real_escape_string($conn,$product->product_desc),
                mysqli_real_escape_string($conn,"images/" . $product->product_img_name),
                mysqli_real_escape_string($conn,$product->price));

       mysqli_query($conn,$query);
       mysqli_close($conn);
        
    }


    function UpdateProduct($id, ProductEntity $product) {
        require 'config.php';
       // Create connection
       $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
       if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }
        $query = sprintf("UPDATE products
                            SET product_code = '%s', product_name = '%s', product_type = '%s', product_desc = '%s', product_img_name = '%s', price = '%s'
                          WHERE id = $id",
                mysqli_real_escape_string($conn,$product->product_code),
                mysqli_real_escape_string($conn,$product->product_name),
                mysqli_real_escape_string($conn,$product->product_type),
                mysqli_real_escape_string($conn,$product->product_desc),
                mysqli_real_escape_string($conn,"images/" . $product->product_img_name),
                mysqli_real_escape_string($conn,$product->price));

       mysqli_query($conn,$query);
       mysqli_close($conn);        
                          
        
  }

  function DeleteProduct($id) {
        require 'config.php';
        // Create connection
       $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
       if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }

        $query = "DELETE FROM products WHERE id = $id";
        mysqli_query($conn,$query);
        mysqli_close($conn);
        
    }

}

?>
