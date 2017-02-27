<?php

class ProductEntity
{
    public $id;
    public $product_code;
    public $product_name;
    public $product_type;
    public $product_desc;
    public $product_img_name;
    public $price;

    function __construct($id, $product_code, $product_name, $product_type, $product_desc, $product_img_name, $price) {
        $this->id = $id;
        $this->product_code = $product_code;
        $this->product_name = $product_name;
        $this->product_type = $product_type;
        $this->product_desc = $product_desc;
        $this->product_img_name = $product_img_name;
        $this->price = $price;
        
    }

}

?>