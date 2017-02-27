<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$currency = '&#8377; '; //Currency Character or code

$servername= 'localhost';
$username = 'root';
$password = 'comp123';
$dbname = 'jewellery';

$shipping_cost      = 1.50; //shipping cost
$taxes              = array( //List your Taxes percent here.
                            'VAT' => 12,
                            'Service Tax' => 5
                            );                     
//connect to MySql                     
?>
