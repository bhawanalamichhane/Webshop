<?php
$title = "Manage jewellery objects";
include './Controller/ProductController.php';
$productController = new ProductController();

$content = $productController->CreateOverviewTable();

if(isset($_GET["delete"]))
{
    $productController->DeleteProduct($_GET["delete"]);
}
        
include './template.php';      
?>
