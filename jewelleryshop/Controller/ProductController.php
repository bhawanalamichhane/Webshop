<script>
//Display a confirmation box when trying to delete an object
function showConfirm(id)
{
    // build the confirmation box
    var c = confirm("Are you sure you wish to delete this item?");
    
    // if true, delete item and refresh
    if(c)
        window.location = "ProductOverview.php?delete=" + id;
}
</script>

<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

require ("./Model/ProductModel.php");

//Contains non-database related function for the Product page
class ProductController {

    function CreateOverviewTable() {
        $result = "
            <table class='overViewTable'>
                <tr>
                    <td></td>
                    <td></td>
                    <td><b>id</b></td>
                    <td><b>Code</b></td>
                    <td><b>Name</b></td>
                    <td><b>Type</b></td>
                    <td><b>Details</b></td>
                    <td><b>Price</b></td>
                </tr>";

        $productArray = $this->GetProductByType('%');

        foreach ($productArray as $key => $value) {
            $result = $result .
                    "<tr>
                        <td><a href='ProductAdd.php?update=$value->id'>Update</a></td>
                        <td><a href='#' onclick='showConfirm($value->id)'>Delete</a></td>
                        <td>$value->id</td>
                        <td>$value->product_code</td>
                        <td>$value->product_name</td>    
                        <td>$value->product_type</td> 
                        <td>$value->product_desc</td>
                        <td>$value->price</td>   
                    </tr>";
        }

        $result = $result . "</table>";
        return $result;
    }

    function CreateProductDropdownList() {
        $productModel = new ProductModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($productModel->GetProductTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }


    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }
    

    function CreateProductTables($types)
    {
        $productModel = new ProductModel();
        $productArray = $productModel->GetProductByType($types);
        $result = "";
        
        //Generate a productTable for each productEntity in array
        foreach ($productArray as $key => $product) 
        {
            $result = $result .
                    "<table class = 'productTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$product->product_img_name' /></th>
                            <th width = '75px' >Code: </th>
                            <td>$product->product_code</td>
                        </tr>
                        
                        <tr>
                            <th>Name: </th>
                            <td>$product->product_name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$product->product_type</td>
                        </tr>

                        <tr>
                            <th>Price: </th>
                            <td>$product->price</td>
                        </tr>
                        
                        <tr>
                            <th>Details: </th>
                            <td colspan='2'>$product->product_desc</td>
                        </tr>
                        
                        
                        
                                            
                     </table>";
        }        
        return $result;
        
    }

    //Returns list of files in a folder.
    function GetImages() {
        //Select folder to scan
        $handle = opendir("images/");

        //Read all files and store names in array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }

        closedir($handle);

        //Exclude all filenames where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2) {
                array_push($imageArray, $image);
            }
        }

        //Create <select><option> Values and return result
        $result = $this->CreateOptionValues($imageArray);
        return $result;
    }

     function InsertProduct() {
        $product_code = $_POST["txtcode"];
        $product_name = $_POST["txtname"];
        $product_type = $_POST["ddlType"];
        $product_desc = $_POST["txtdetails"];
        $price = $_POST["txtprice"];
        $product_img_name = $_POST["ddlImage"];
        

        $product = new ProductEntity(-1, $product_code, $product_name, $product_type, $product_desc, $product_img_name, $price);
        $productModel = new ProductModel();
        $productModel->InsertProduct($product);
    }

    function UpdateProduct($id) {
        $product_code = $_POST["txtcode"];
        $product_name = $_POST["txtname"];
        $product_type = $_POST["ddlType"];
        $product_desc = $_POST["txtdetails"];
        $price = $_POST["txtprice"];
        $product_img_name = $_POST["ddlImage"];
        

        $product = new ProductEntity($id, $product_code, $product_name, $product_type, $product_desc, $product_img_name, $price);
        $productModel = new ProductModel();
        $productModel->UpdateProduct($id, $product);
        
    }

    function DeleteProduct($id) {
        $productModel = new ProductModel();
        $productModel->DeleteProduct($id);
        
    }
    //</editor-fold>
    
    //<editor-fold desc="Get Methods">
    function GetProductById($id) {
        $productModel = new ProductModel();
        return $productModel->GetProductById($id);
    }

    function GetProductByType($type) {
        $productModel = new ProductModel();
        return $productModel->GetProductByType($type);
    }

    function GetProductTypes() {
        $productModel = new ProductModel();
        return $productModel->GetProductTypes();
    }

}

?>
