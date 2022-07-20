<?php

require_once 'ProductVariant.php';

class Product {
    public $product_id;
    public $product_name;
    public $category;
    public $season;
    public $date_expected;
    public $product_variants;

    public function __construct($data) {
        $this->product_id = $data["product_id"];
        $this->product_name = $data["product_name"];
        $this->category = $data["category"];
        $this->season = $data["season"];
        $this->date_expected = new DateTime($data["date_expected"]);
        $this->product_variants = ProductVariant::getProductVariantsByProductID($data["product_id"]);
    }

    public function save() {
        global $conn;
        $sql = "UPDATE products SET
            product_id = '" . mysqli_real_escape_string($conn, $this->product_id) . "',
            product_name = '" . mysqli_real_escape_string($conn, $this->product_name) . "',
            category = '" . mysqli_real_escape_string($conn, $this->category) . "',
            season = '" . mysqli_real_escape_string($conn, $this->season) . "',
            date_expected = '" . mysqli_real_escape_string($conn, $this->date_expected->format("Y-m-d")) . "'
            WHERE product_id = '" . mysqli_real_escape_string($conn, $this->product_id) . "'";
        $result = mysqli_query($conn, $sql);

        foreach ($this->product_variants as $product_variant) {
            $product_variant->save();
        }
    }

    public function getLeadTime() {
        return $this->date_expected->getTimestamp() - (new DateTime())->getTimeStamp();
    }

    public static function getProduct($product_id) {
        global $conn;
        if (!$product_id) return false;
        $escaped_product_id = "'" . mysqli_real_escape_string($conn, $product_id) . "'";
        $sql = "SELECT * FROM products WHERE product_id = $escaped_product_id";
        $result = mysqli_query($conn, $sql);
        $products = $result->num_rows ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
        $products = array_map(function($product) { 
            return new Product($product); 
        }, $products);
        return count($products) > 0 ? $products[0] : false;
    }

    public static function getAllProducts() {
        global $conn;
        $sql = "SELECT * FROM products";
        $result = mysqli_query($conn, $sql);
        $products = $result->num_rows ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
        $products = array_map(function($product) { 
            return new Product($product); 
        }, $products);
        return $products;
    }
}