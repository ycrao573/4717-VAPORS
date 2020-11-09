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
    $get_quantity = $_GET["quantity"];
    $get_size = $_GET["size"];
    $get_color = $_GET["color"];
    $get_id = $_GET["id"];
    $add2cart = isset($_GET["add"]);

    if (!$get_id) {
        $add2cart = false;
        $get_id = 1;
    }

    $qry = 'SELECT * FROM accounts WHERE email = "' . $current_email . '";';
    $query_result = $conn->query($qry);
    $row_no = $query_result->num_rows;
    $row = $query_result->fetch_assoc();
    $current_id = $row["id"];

    $qry = 'SELECT p.name, p.price, p.gender, p.category, p.discount, p.description, i.color, i.size, i.stock FROM products AS p, inventory AS i 	
WHERE p.id = ' . $get_id . ' AND p.id = i.productID ORDER BY i.color ASC;';
    $query_result = $conn->query($qry);
    if ($query_result) {
        $row_no = $query_result->num_rows;
        if ($row_no > 0) {
            $row;
            $listsize = array();
            $listcolor = array();
            $liststock = array();

            //Inventory array
            for ($i = 0; $i < $row_no; $i++) {
                $row = $query_result->fetch_assoc();
                $stock = $row["stock"];
                $color = strtolower($row["color"]);
                $size = $row["size"];

                if (!in_array($color, $listcolor)) array_push($listcolor, $color);
                if (!in_array($size, $listsize)) array_push($listsize, $size);
                if (!isset($liststock[$color])) $liststock[$color] = array();
                $liststock[$color][$size] = $stock;
            }
            $query_result->free();

            //Get product information
            $name = stripslashes($row["name"]);
            $price = $row["price"];
            $discount = $row["discount"];
            $discounted_price =  $price * (1 - $product_discount / (float)100);
            $gender = $row["gender"];
            $category = $row["category"];
            $description = stripslashes($row["description"]);

            if (!$get_color || !in_array($get_color, $listcolor)) {
                // default display color
                $get_color = $listcolor[0];
                $add2cart = false;
            }

            if (!$get_size || !in_array($get_size, $listsize)) {
                // default display size
                $get_size = $listsize[0];
                $add2cart = false;
            }

            if (!$get_quantity || $get_quantity < 1) {
                // default quantity
                $get_quantity = 1;
                $add2cart = false;
            }

            $stockout = false;

            if (
                !$liststock[$get_color][$get_size] ||
                $get_quantity > $liststock[$get_color][$get_size]
            ) {
                $get_quantity = $liststock[$get_color][$get_size];
                if ($get_quantity < 1) {
                    $stockout = true;
                    $add2cart = false;
                }
            }

            //Add selected product to cart
            if ($add2cart) {
                $qry = 'SELECT c.id, c.cartId, c.accountId, c.name, c.category, c.gender, c.price, c.discount, c.quantity, c.paid FROM carts AS c 	
                WHERE c.accountId = ' . $current_id . ' AND c.paid = 0 LIMIT 1;';
                $query_result = $conn->query($qry);
                $row_no = $query_result->num_rows;
                // echo $row_no;
                if ($row_no) {
                    $row = $query_result->fetch_assoc();
                    $cartId = $row["cartId"];
                    // Exists active shopping cart
                    $qry = 'UPDATE carts SET quantity = quantity + ' . $get_quantity . ' WHERE accountId = ' . $current_id . ' AND cartId = ' . $cartId . ' AND paid = 0';
                    $qry = $qry . ' AND name = ' . '\'' . $name . '\'';
                    $qry = $qry . ' AND color = ' . '\'' . ucfirst($get_color) . '\'';
                    $qry = $qry . ' AND gender = ' . '\'' . $gender . '\'';
                    $qry = $qry . ' AND size = ' . '\'' . $get_size . '\'';
                    $qry = $qry . ';';
                    $query_result = $conn->query($qry);
                    // echo $qry;
                    $updated = $conn->affected_rows;
                    // echo $updated;
                    if ($updated < 1) {
                        // if product not in active cart
                        $qry = 'INSERT INTO `carts` (`cartId`, `accountId`, `name`, `category`, `gender`, `color`, `size`, `price`, `discount`, `quantity`, `paid`) VALUES (';
                        $qry = $qry . $cartId . ', ';
                        $qry = $qry . $current_id . ', ';
                        $qry = $qry . '\'' . $name . '\'' . ', ';
                        $qry = $qry . '\'' . $category . '\'' . ', ';
                        $qry = $qry . '\'' . $gender . '\'' . ', ';
                        $qry = $qry . '\'' . ucfirst($get_color) . '\'' . ', ';
                        $qry = $qry . $get_size . ', ';
                        $qry = $qry . $price . ', ';
                        $qry = $qry . $discount . ', ';
                        $qry = $qry . $get_quantity . ', ';
                        $qry = $qry . '0);';
                        $query_result = $conn->query($qry);
                        // echo $qry;
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
                    $qry = $qry . '\'' . ucfirst($get_color) . '\'' . ', ';
                    $qry = $qry . $get_size . ', ';
                    $qry = $qry . $price . ', ';
                    $qry = $qry . $discount . ', ';
                    $qry = $qry . $get_quantity . ', ';
                    $qry = $qry . '0);';
                    $query_result = $conn->query($qry);
                    // echo $qry;
                    // if ($query_result) {
                    //     echo 'Create cart success.';
                    // }
                }
            }

            //Product preview and thumbnails
            $section_id = 'product-details';
            echo '	<section id="' . $section_id . '" class="product-details">
                            <div class="container" style="margin: 25px">
                                <div class="row" style="margin: 25px">
                                    <div class="col" style="width: 8%; display: block">';

            // Display color picker
            foreach ($listcolor as $color_element) {
                echo '<div class="product-img-thumb">';
                $button_id = 
                $section_id .
                '_button_' . $get_id . '_' .
                $color_element;
                echo '  <input type="image" id="' . $button_id . '" src="./pics/' . $get_id . '_' . $color_element . '.jpg" width="100%" onclick="pickColor(this)">
                          </div>';
            }

            // selection area for color
            echo ' 
            </div>
                        <div class="qtr col" style="max-width: 500px;">
                            <div class="product-preview">
                                 <img id="' . $section_id . '_img_' . $get_id . '" src="./pics/' . $get_id . '_' . $get_color . '.jpg" width="100%">
                            </div>
                        </div>
                        <div class="col" style="width: 30%; display: block; min-width: 260px; margin-left: 10px; margin-right: 25px">
                            <form class="product-filters">
                                <input type="hidden" name="id" value="' . $get_id . '">
                                <input type="hidden" name="add">
                                <div>
                                    <div>
                                        <h3>Select color</h3><hr>
                                    </div>
                                    <div class="row">';

            foreach ($listcolor as $color_element) {
                echo '  <div class="halfwid col">
                                <label style="margin: 5px" for="color--' . $color_element . '">';
                if ($color_element == $get_color) {
                    echo ' <input id="color--' . $color_element . '" value="' . $color_element . '" type="radio" name="color" class="input-checkbox" checked>';
                } else {
                    echo ' <input id="color--' . $color_element . '" value="' . $color_element . '" type="radio" name="color" class="input-checkbox">';
                }

                echo ucfirst($color_element) .
                    '</label>
                            </div>';
            }

            // selection area for size
            echo '</div>
						</div>
						<div>
							<div><br>
								<h3>Select size</h3><hr>
							</div>
                            <div class="row">';
            sort($listsize);
            
            foreach ($listsize as $size) {
                echo '<div class="halfwid col">
                <label style="margin: 5px" for="size--' . $size . '" >';

                if ($size == $get_size) {
                    echo '<input name="size" id="size--' . $size . '" value="' . $size . '" type="radio" class="input-checkbox"  checked>';
                } else {
                    echo '<input name="size" id="size--' . $size . '" value="' . $size . '" type="radio" class="input-checkbox">';
                }
                echo $size .
                    '</label>
                            </div>';
            }


            echo '  </div>
                    </div>';

            //Container for quantity input + submit button
            echo ' <div' . ($stockout ? ' style="display:none;"' : '') . '>
							<div><br><h3>Quantity</h3><hr><br></div>
							<input type="number" min="1" max="' . $liststock[$get_color][$get_size] . '" name="quantity" class="input--text" id="product-quantity" value="' . ($get_quantity > 0 ? $get_quantity : 1) . '">
						</div>
						<button type="submit" class="submitbutton"' . ($stockout ? ' style="display:none;"' : '') . '>
							Add to Cart
						</button>
						<span class="submitbutton"' . ($stockout ? '' : ' style="display:none;"') . '>Out of Stock</span>
					</form>
				</div>';
            //Display product information
            echo ' <div class="col" style="width: 30%">
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