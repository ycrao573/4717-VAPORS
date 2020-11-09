<!DOCTYPE html>
<html>
<?php include './common/head.php'; ?>

<body>
    <?php
    session_start();
    $conn = new mysqli("localhost", "f32ee", "f32ee", "f32ee");
    include './common/navbar.php';
    if ($conn->connect_error) exit();

    $current_email = $_SESSION["email"];
    $input_quantity = $_GET["quantity"];
    $input_color = $_GET["color"];
    $input_size = $_GET["size"];
    $input_id = $_GET["id"];
    $add_to_cart = isset($_GET["add"]);

    if (!$input_id) {
        $add_to_cart = false;
        $input_id = 1;
    }

    $qry = 'SELECT * FROM accounts WHERE email = "' . $current_email . '";';
    $query_result = $conn->query($qry);
    $row_no = $query_result->num_rows;
    $row = $query_result->fetch_assoc();
    $current_id = $row["id"];

    $qry = 'SELECT p.name, p.price, p.gender, p.category, p.discount, p.description, i.color, i.size, i.stock FROM products AS p, inventory AS i 	
WHERE p.id = ' . $input_id . ' AND p.id = i.productID ORDER BY i.color ASC;';
    $query_result = $conn->query($qry);
    if ($query_result) {
        $row_no = $query_result->num_rows;
        if ($row_no > 0) {
            $row;
            $distinct_size = array();
            $distinct_color = array();
            $inventory_array = array();

            //Inventory array
            for ($i = 0; $i < $row_no; $i++) {
                $row = $query_result->fetch_assoc();
                $stock = $row["stock"];
                $color = strtolower($row["color"]);
                $size = $row["size"];

                if (!in_array($color, $distinct_color)) {
                    array_push($distinct_color, $color);
                }

                if (!in_array($size, $distinct_size)) {
                    array_push($distinct_size, $size);
                }

                if (!isset($inventory_array[$color])) {
                    $inventory_array[$color] = array();
                }
                $inventory_array[$color][$size] = $stock;
            }
            $query_result->free();

            //Get product information
            $name = stripslashes($row["name"]);
            $discount = $row["discount"];
            $price = $row["price"];
            $discounted_price = (1 - $product_discount / (float)100) * $price;
            $gender = $row["gender"];
            $category = $row["category"];
            $description = stripslashes($row["description"]);

            if (!$input_color || !in_array($input_color, $distinct_color)) {
                // default display color
                $input_color = $distinct_color[0];
                $add_to_cart = false;
            }

            if (!$input_size || !in_array($input_size, $distinct_size)) {
                // default display size
                $input_size = $distinct_size[0];
                $add_to_cart = false;
            }

            if (!$input_quantity || $input_quantity < 1) {
                // default quantity
                $input_quantity = 1;
                $add_to_cart = false;
            }

            $stockout = false;

            if ($input_quantity > $inventory_array[$input_color][$input_size]
                ||!$inventory_array[$input_color][$input_size]) {
                $input_quantity = $inventory_array[$input_color][$input_size];
                if ($input_quantity < 1) {
                    $stockout = true;
                    $add_to_cart = false;
                }
            }
            
            //Add selected product to cart
            if ($add_to_cart) {
                $qry = 'SELECT c.id, c.cartId, c.accountId, c.name, c.category, c.gender, c.price, c.discount, c.quantity, c.paid FROM carts AS c 	
                WHERE c.accountId = ' . $current_id . ' AND c.paid = 0 LIMIT 1;';
                $query_result = $conn->query($qry);
                $row_no = $query_result->num_rows;
                // echo $row_no;
                if ($row_no) {
                    $row = $query_result->fetch_assoc();
                    $cartId = $row["cartId"];
                    // Exists active shopping cart
                    $qry = 'UPDATE carts SET quantity = quantity + ' . $input_quantity . ' WHERE accountId = ' . $current_id . ' AND cartId = ' . $cartId . ' AND paid = 0';
                    $qry = $qry . ' AND name = ' . '\'' . $name . '\'';
                    $qry = $qry . ' AND color = ' . '\'' . ucfirst($input_color) . '\'';
                    $qry = $qry . ' AND gender = ' . '\'' . $gender . '\'';
                    $qry = $qry . ' AND size = ' . '\'' . $input_size . '\'';
                    $qry = $qry . ';';
                    $query_result = $conn->query($qry);
                    echo $qry;
                    $updated = $conn->affected_rows;
                    echo $updated;
                    if ($updated < 1) {
                        // if product not in active cart
                        $qry = 'INSERT INTO `carts` (`cartId`, `accountId`, `name`, `category`, `gender`, `color`, `size`, `price`, `discount`, `quantity`, `paid`) VALUES (';
                        $qry = $qry . $cartId . ', ';
                        $qry = $qry . $current_id . ', ';
                        $qry = $qry . '\'' . $name . '\'' . ', ';
                        $qry = $qry . '\'' . $category . '\'' . ', ';
                        $qry = $qry . '\'' . $gender . '\'' . ', ';
                        $qry = $qry . '\'' . ucfirst($input_color) . '\'' . ', ';
                        $qry = $qry . $input_size . ', ';
                        $qry = $qry . $price . ', ';
                        $qry = $qry . $discount . ', ';
                        $qry = $qry . $input_quantity . ', ';
                        $qry = $qry . '0);';
                        $query_result = $conn->query($qry);
                        echo $qry;
                    }
                } else {
                    // Add new shopping cart
                    $qry = 'SELECT c.id, c.cartId, c.accountId, c.name, c.category, c.gender, c.price, c.discount, c.description, c.quantity, c.paid FROM carts AS c 	
                                WHERE c.accountId = ' . $current_id . ' ORDER BY c.cartId DESC;';
                    $query_result = $conn->query($qry);
                    if ($query_result) {
                        $row_no = $query_result->num_rows;
                        $row = $query_result->fetch_assoc();
                        $last_cartId = $row["cartId"];
                        $cartId = $last_cartId + 1;
                    } else {
                        $cartId = 1;
                    }

                    $qry = 'INSERT INTO `carts` (`cartId`, `accountId`, `name`, `category`, `gender`, `color`, `size`, `price`, `discount`, `quantity`, `paid`) VALUES (';
                    $qry = $qry . $cartId . ', ';
                    $qry = $qry . $current_id . ', ';
                    $qry = $qry . '\'' . $name . '\'' . ', ';
                    $qry = $qry . '\'' . $category . '\'' . ', ';
                    $qry = $qry . '\'' . $gender . '\'' . ', ';
                    $qry = $qry . '\'' . $color . '\'' . ', ';
                    $qry = $qry . $size . ', ';
                    $qry = $qry . $price . ', ';
                    $qry = $qry . $discount . ', ';
                    $qry = $qry . $input_quantity . ', ';
                    $qry = $qry . '0);';
                    $query_result = $conn->query($qry);
                    echo $qry;
                    if ($query_result) {
                        echo 'Create cart success.';
                    }
                }
            }

            //Product preview and thumbnails
            $section_id = 'product-details';
            echo '	<section id="' . $section_id . '" class="product-details">
                            <div class="container" style="margin: 25px">
                                <div class="row" style="margin: 25px">
                                    <div class="col" style="width: 8%; display: block">';

            // Display color picker
            foreach ($distinct_color as $color_name) {
                if ($color_name == $input_color) {
                    echo '<div class="product-thumbnails">';
                } else {
                    echo '<div class="product-thumbnails">';
                }
                $button_id = $section_id . '_button_' . $input_id . '_' . $color_name;
                echo '  <input type="image" id="' . $button_id . '" src="./pics/' . $input_id . '_' . $color_name . '.jpg" width="100%" onclick="pickColor(this)">
                          </div>';
            }

            //Container for color input
            echo '  </div>
                        <div class="onethird col">
                            <div class="product-preview">
                                 <img id="' . $section_id . '_img_' . $input_id . '" src="./pics/' . $input_id . '_' . $input_color . '.jpg" width="100%">
                            </div>
                        </div>
                        <div class="qtr col">
                            <form class="product-filters">
                                <input type="hidden" name="id" value="' . $input_id . '">
                                <input type="hidden" name="add">
                                <div id="option--color">
                                    <div>
                                        <h4>Select color</h4>
                                    </div>
                                    <div class="row">';

            foreach ($distinct_color as $color_name) {
                echo '  <div class="halfwid col">
                                <label for="color--' . $color_name . '" class="label label--checkbox">';


                if ($color_name == $input_color) {
                    echo ' <input type="radio" name="color" class="input-checkbox"
                     id="color--' . $color_name . '" value="' . $color_name . '"
                      checked>';
                } else {
                    echo ' <input type="radio" name="color" class="input-checkbox"
                     id="color--' . $color_name . '" value="' . $color_name . '"
                    >';
                }


                echo ucfirst($color_name) .
                    '</label>
                            </div>';
            }

            //Container for size input
            echo '</div>
						</div>
						<div id="option--size">
							<div>
								<h4>Select size</h4>
							</div>
                            <div class="row">';   
            sort($distinct_size);
            foreach ($distinct_size as $size) {
                echo '<div class="halfwid col">
                <label for="size--' . $size . '" >';

                if ($size == $input_size) {
                    echo '<input type="radio" name="size" class="input-checkbox" id="size--' . $size . '" value="' . $size . '" checked>';
                } else {
                    echo '<input type="radio" name="size" class="input-checkbox" id="size--' . $size . '" value="' . $size . '">';
                }
                echo $size .
                    '</label>	
                            </div>';
            }


            echo '  </div>
                    </div>';

            //Container for quantity input + submit button
            echo ' <div class="option--quantity" id="option--quantity"' . ($stockout ? ' style="display:none;"' : '') . '>
							<div>Quantity</div>
							<input type="number" min="1" max="' . $inventory_array[$input_color][$input_size] . '" name="quantity" class="input--text" id="product-quantity" value="' . ($input_quantity > 0 ? $input_quantity : 1) . '">
						</div>
						<button type="submit" class="submitbutton"' . ($stockout ? ' style="display:none;"' : '') . '>
							Add to Cart
						</button>
						<span class="submitbutton"' . ($stockout ? '' : ' style="display:none;"') . '>Out of Stock</span>
					</form>
				</div>';
            //Display product information
            echo ' <div class="onethird col">
                            <div class="product-info">
                                <div>
                                    <h2>' . $name . '</h2><br>
                                </div>
                                <div>
                                    <h2>$' . number_format($discounted_price, 2) . '</h2>';

            echo '          </div>
                                <div class="product-info__description"><br>' .
                nl2br($description) .
                '</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>';
        }
    }
    $conn->close();
    include './common/copyright.php';
    ?>
</body>

</html>