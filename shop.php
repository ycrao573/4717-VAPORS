<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();
    ?>
    <div class="container">
        <div class="row">
            <div class="three column">
                <?php include './common/filter.php' ?>
            </div>
            <div class="nine column">
                <?php
                    $product_query = "SELECT p.id, p.name, p.price, p.discount FROM products AS p, stock AS s WHERE p.id=s.productsID";

                    foreach ($_GET as $category_key => $category_value_arr) {
                        // TODO: change condition here
                        if ($category_key != 'tag' && $category_key != 'price--min' && $category_key != 'price--max') {
                            $product_query = $product_query . ' AND (';
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
                            $product_query = $product_query . ')';
                        }
                    }
                    $product_query = $product_query . ' GROUP BY p.id;';
                    // echo $product_query;
                    $connection_success = $conn->query($product_query);

                    if ($connection_success) {
                        $row_number = $connection_success->num_rows;
                        if ($row_number > 0) {
                            echo '<div class="row">';
                            $section_id = "collection--search";
                            for ($counter = 0; $counter < $row_number; $counter++) {
                                $row = $connection_success->fetch_assoc();
                                $product_id = $row["id"];
                                $product_name = $row["name"];
                                $product_price = $row["price"];
                                $product_discount = $row["discount"];
                                echo '<div class="four column">';
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
    <?php
    include './common/homepage.php';
    include './common/copyright.php';
    ?>
</body>
</html>
