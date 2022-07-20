<?php

class ProductVariant {
    public $variant_id;
    public $product_id;
    public $enabled;
    public $color;
    public $size;

    public function __construct($data) {
        $this->variant_id = $data["variant_id"];
        $this->product_id = $data["product_id"];
        $this->enabled = $data["enabled"] ? true : false;
        $this->color = $data["color"];
        $this->size = $data["size"];
    }

    public function save() {
        global $conn;
        $sql = "UPDATE products_variants SET
            variant_id = '" . mysqli_real_escape_string($conn, $this->variant_id) . "',
            enabled = '" . mysqli_real_escape_string($conn, $this->enabled) . "',
            color = '" . mysqli_real_escape_string($conn, $this->color) . "',
            size = '" . mysqli_real_escape_string($conn, $this->size) . "'
            WHERE variant_id = '" . mysqli_real_escape_string($conn, $this->variant_id) . "'";
        $result = mysqli_query($conn, $sql);
    }

    public static function getProductVariantsByProductID($product_id) {
        global $conn;
        $escaped_product_id = "'" . mysqli_real_escape_string($conn, $product_id) . "'";
        $sql = "SELECT * FROM products_variants WHERE product_id = $escaped_product_id";
        $result = mysqli_query($conn, $sql);
        $product_variants = $result->num_rows ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
        $product_variants = array_map(function($product_variant) { 
            return new ProductVariant($product_variant); 
        }, $product_variants);
        return $product_variants;
    }
}