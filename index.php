<?php

include('includes/includes.php');
include('models/Product.php');

$products = Product::getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/normalize.css@8.0.1/normalize.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <table id="products-table">
        <thead>
            <tr>
                <th>Product Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product) { ?>
                <tr onclick="window.location='product.php?product_id=<?php echo $product->product_id; ?>'">
                    <td><?php echo htmlspecialchars($product->product_name) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>