<?php

include('../../includes/includes.php');
include('../../models/Product.php');

$product_id = $_POST["product_id"] ? $_POST["product_id"] : false;
$product = Product::getProduct($product_id);
if (!$product) exit;

if (isset($_POST['product_name'])) {
    $product->product_name = $_POST["product_name"];
}
if (isset($_POST['category'])) {
    $product->category = $_POST["category"];
}
if (isset($_POST['season'])) {
    $product->season = $_POST["season"];
}
if (isset($_POST['date_expected'])) {
    $product->date_expected = new DateTime($_POST["date_expected"]);
}

foreach ($product->product_variants as &$product_variant) {
    $product_variant->enabled = isset($_POST["variant_enabled"][$product_variant->variant_id]) && $_POST["variant_enabled"][$product_variant->variant_id] == "on" ? "1" : "0";
}

$product->save();

$_SESSION["message"] = "Product updated successfully!";

header("Location: ../../product.php?product_id=" . $product->product_id);
die();