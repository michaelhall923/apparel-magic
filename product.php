<?php

include('includes/includes.php');
include('models/Product.php');

$product_id = $_GET["product_id"] ? $_GET["product_id"] : false;
$product = Product::getProduct($product_id);
$color_variants = ["BLU", "YLW"];
$size_variants = ["XS", "S", "M", "L", "XL"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/normalize.css@8.0.1/normalize.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>
<body>
    <div>
        <a href="index.php"><- Products</a>
    </div>
    <form action="api/product/update.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product->product_id); ?>">
        <table id="product-details">
            <tbody>
                <tr>
                    <th>Product Name</th>
                    <td><input type="text" name="product_name" value="<?php echo htmlspecialchars($product->product_name); ?>"></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td><input type="text" name="category" value="<?php echo htmlspecialchars($product->category); ?>"></td>
                </tr>
                <tr>
                    <th>Season</th>
                    <td><input type="text" name="season" value="<?php echo htmlspecialchars($product->season); ?>"></td>
                </tr>
                <tr>
                    <th>Date Expected</th>
                    <td>
                        <input type="text" name="date_expected_picker" data-default-date="<?php echo htmlspecialchars($product->date_expected->format("Y-m-d")); ?>">
                        <input type="hidden" name="date_expected" value="<?php echo htmlspecialchars($product->date_expected->format("Y-m-d")); ?>">
                        <button type="button" id="toggle-date-format" value = "EU">EU</button>
                    </td>
                </tr>
                <tr>
                    <th>Lead Time</th>
                    <td id="lead-time-label"><?php echo htmlspecialchars(floor($product->getLeadTime() / 60 / 60 / 24)) . " days"; ?></td>
                </tr>
            </tbody>
        </table>

        <table id="product-variant-details">
            <thead>
                <tr>
                    <th></th>
                    <th>XS</th>
                    <th>S</th>
                    <th>M</th>
                    <th>L</th>
                    <th>XL</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($color_variants as $color_variant) { ?>
                    <tr>
                        <th><?php echo htmlspecialchars($color_variant); ?></th>
                    </tr>
                    <tr class="product-variant-details-row">
                        <th><img src="img/<?php echo htmlspecialchars($color_variant); ?>.png" alt="<?php echo htmlspecialchars($color_variant); ?>" height="50" width="50"></th>
                        <?php foreach ($size_variants as $size_variant) { 
                            $current_product_variant = null;
                            foreach ($product->product_variants as $product_variant) {
                                if ($product_variant->color == $color_variant && $product_variant->size == $size_variant) {
                                    $current_product_variant = $product_variant;
                                    break;
                                }
                            }
                            ?>
                            <td>
                                <div class="variant-checkbox-container">
                                    <input type="checkbox" name="variant_enabled[<?php echo htmlspecialchars($current_product_variant->variant_id); ?>]" <?php if ($current_product_variant->enabled) echo "checked"; ?>>
                                </div>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit">Save Changes</button>
        <?php if (isset($_SESSION["message"]) && $_SESSION["message"]) { ?>
        <div style="color: green;"><?php echo htmlspecialchars($_SESSION["message"]); ?></div>
        <?php 
            unset($_SESSION["message"]);
        } ?>
    </form>

    <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="js/product.js"></script>
</body>
</html>