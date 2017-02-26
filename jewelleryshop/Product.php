<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

require '/var/www/html/jewelleryshop/Controller/ProductController.php';
$productController = new ProductController();

if(isset($_POST['types']))
{
    //Fill page with product of the selected type
    $productTables = $productController->CreateProductTables($_POST['types']);
}
else 
{
    //Page is loaded for the first time, no type selected -> Fetch all types
    $productTables = $productController->CreateProductTables('%');
}

//Output page data
$title = 'Jewellery overview';
$content = $productController->CreateProductDropdownList(). $productTables;

include 'template.php';
?>
