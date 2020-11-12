<div class="product" style="margin-right: 12%;">
    <div class="row card--image">
        <?php
        echo '<a href="./product.php?id=' . $prod_id . '">';
        echo '<img id="' . $section_id . '_img_' . $prod_id . '"></a>';
        ?>
    </div>
    <div class="row card--name">
        <?php
        echo '<a href="./product.php?id=' . $prod_id . '">' . $prod_name . '</a>';
        ?>
    </div>
    <div class="row card--price">
        <div class="card--price--current">
            <h2 class="header">
                <?php
                $res_price = (1 - $prod_discount / (float)100) * $prod_price;
                echo '$' . number_format($res_price, 2);
                ?>
            </h2>
        </div>
    </div>
    <div class="row card--color">
        <?php
        $qry = 'SELECT inventory.color FROM inventory WHERE inventory.productID = ' . $prod_id . ';';
        $inventory_result = $conn->query($qry);
        $inventory_num_rows = $inventory_result->num_rows;
        $allcolors = array();
        for ($j = 0; $j < $inventory_num_rows; $j++) {
            $inventory_row = $inventory_result->fetch_assoc();

            $color = strtolower($inventory_row["color"]);
            if (!in_array($color, $allcolors)) {
                $size = $inventory_row["size"];
                $button_id = $section_id . '_button_' . $prod_id . '_' . $color;
                echo '<button class="card--color--' . $color . '" onclick="pickColor(this)" id="' . $button_id . '"></button>';
                if ($j == 0) {
                    echo '<script>fetchImg("' . $button_id . '");</script>';
                }
                array_push($allcolors, $color);
            }
        }

        ?>
    </div>
</div>