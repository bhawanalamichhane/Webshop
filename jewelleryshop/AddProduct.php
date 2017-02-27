<?php
require './Controller/ProductController.php';
$productController = new ProductController();

$title = "Add a new jewellery";

$content ="<form action='' method='post'>
    <fieldset>
        <legend>Add a new Earring</legend>
        <label for='code'>Code: </label>
        <input type='text' class='inputField' name='txtcode' /><br/>

        <label for='name'>Name: </label>
        <input type='text' class='inputField' name='txtname' /><br/>

        <label for='type'>Type: </label>
        <select class='inputField' name='ddlType'>
            <option value='%'>All</option>"
        .$productController->CreateOptionValues($productController->GetProductTypes()).
        "</select><br/>

        <label for='price'>Price: </label>
        <input type='text' class='inputField' name='txtprice' /><br/>

        
        <label for='image'>Image: </label>
        <select class='inputField' name='ddlImage'>"
        .$productController->GetImages().
        "</select></br>

        <label for='details'>Details: </label>
        <textarea cols='70' rows='12' name='txtdetails'></textarea></br>

        <input type='submit' value='Submit'>
    </fieldset>
</form>";


if(isset($_POST["txtcode"]))
{
    $productController->InsertProduct();
}
include 'template.php';
?>
