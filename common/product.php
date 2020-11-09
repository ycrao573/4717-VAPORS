<div class="product" style="margin-right: 12%;">
    <div class="row product__image">
        <?php
        echo '<a href="./product.php?id=' . $product_id . '" class="user-flex">';
        echo '<img id="' . $section_id . '_img_' . $product_id . '"></a>';
        ?>
    </div>
    <div class="row product__name">
        <?php
        echo '<a href="./product.php?id=' . $product_id . '">' . $product_name . '</a>';
        ?>
    </div>
    <div class="row product__price">
        <div class="product__price--current">
            <h2 class="header">
                <?php
                $discounted_price = (1 - $product_discount / (float)100) * $product_price;
                echo '$' . number_format($discounted_price, 2);
                ?>
            </h2>
        </div>
        <?php
        if ($product_discount > 0) {
            echo '<div class="product__price--pre-discount">' . '$' . number_format($product_price, 2) . '</div>';
        }
        ?>
    </div>
    <div class="row product__color">
        <?php
        $qry = 'SELECT inventory.color FROM inventory WHERE inventory.productID = ' . $product_id . ';';
        $inventory_result = $conn->query($qry);
        $inventory_num_rows = $inventory_result->num_rows;
        $displayed_colors = array();
        for ($j = 0; $j < $inventory_num_rows; $j++) {
            $inventory_row = $inventory_result->fetch_assoc();

            $color = strtolower($inventory_row["color"]);
            if (!in_array($color, $displayed_colors)) {
                $size = $inventory_row["size"];
                $button_id = $section_id . '_button_' . $product_id . '_' . $color;
                echo '<button class="product__color--' . $color . '" onclick="pickColor(this)" id="' . $button_id . '"></button>';
                if ($j == 0) {
                    echo '<script>fetchImg("' . $button_id . '");</script>';
                }
                array_push($displayed_colors, $color);
            }
        }

        ?>
    </div>
</div>