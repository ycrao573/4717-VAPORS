<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>
<style>

</style>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();
    ?>
    <div class="container">
        <div class="row">
            <div class="col" style="width: 30%; max-width: 400px; min-width: 265px;">
                <?php include './common/filter.php' ?>
            </div>
            <div class="col" style="width: 67%; padding: 20px; margin-left: 18px;">
                <?php
                $prod_query = "SELECT p.id, p.name, p.price, p.discount FROM products AS p, inventory AS i WHERE p.id=i.productID";

                foreach ($_GET as $category_key => $category_value_arr) {
                    if ($category_key != 'tag') {
                        $prod_query = $prod_query . ' AND ';
                        $item_1 = true;
                        foreach ($category_value_arr as $category_value) {
                            if ($item_1) {
                                // append product query, 1st item query is different
                                $prod_query = $prod_query . $category_key . '="' . $category_value . '"';
                                $item_1 = false;
                            } else {
                                $prod_query = $prod_query . ' OR ' . $category_key . '="' . $category_value . '"';
                            }
                        }
                    }
                }

                if (isset($_GET["search"])) {
                    $prod_query .= ' p.name LIKE "%' . $_GET["search"] . '%"';
                }

                $prod_query = $prod_query . ' GROUP BY p.id;';
                $prod_res = $conn->query($prod_query);
                if ($prod_res) {
                    $rownum = $prod_res->num_rows;
                    if ($rownum > 0) {
                        echo '<div class="row">';
                        $section_id = "collection--search";
                        for ($i = 0; $i < $rownum; $i++) {
                            $row = $prod_res->fetch_assoc();
                            $prod_id = $row["id"];
                            $prod_name = $row["name"];
                            $prod_price = $row["price"];
                            $prod_discount = $row["discount"];
                            echo '<div class="onethird col">';
                            include './common/product.php';
                            echo '</div>';
                        }
                        echo '</div>';
                    } else {
                        echo 'No product meets requirement';
                    }
                } else {
                    include './common/error.php';
                    exit();
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <?php
    include './common/copyright.php';
    ?>
</body>

</html>