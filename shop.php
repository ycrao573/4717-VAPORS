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
                    $product_query = "SELECT p.id, p.name, p.price, p.discount FROM products AS p, inventory AS i WHERE p.id=i.productID";

                    foreach ($_GET as $category_key => $category_value_arr) {
                        if ($category_key != 'tag') {
                            $product_query = $product_query . ' AND ';
                            $item_1 = true;
                            foreach ($category_value_arr as $category_value) {
                                if ($item_1) {
                                    // append product query, 1st item query is different
                                    $product_query = $product_query . $category_key . '="' . $category_value . '"';
                                    $item_1 = false;
                                } else {
                                    $product_query = $product_query . ' OR ' . $category_key . '="' . $category_value . '"';
                                }
                            }
                        }
                    }

                    if (isset($_GET["search"])) {
                        $product_query .= ' p.name LIKE "%' . $_GET["search"] . '%"';
                    }
                    $product_query = $product_query . ' GROUP BY p.id;';
                    $product_res = $conn->query($product_query);
                    if ($product_res) {
                        $row_number = $product_res->num_rows;
                        if ($row_number > 0) {
                            echo '<div class="row">';
                            $section_id = "collection--search";
                            for ($i = 0; $i < $row_number; $i++) {
                                $row = $product_res->fetch_assoc();
                                $product_id = $row["id"];
                                $product_name = $row["name"];
                                $product_price = $row["price"];
                                $product_discount = $row["discount"];
                                echo '<div class="onethird col">';
                                include './common/product.php';
                                echo '</div>';
                            }
                            echo '</div>';
                        } else { 
                            echo 'No products as search result.';
                        }
                    } else {
                        echo 'Database connection error.';
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
