<?php
session_start();
?>
<!-- cart section starts here -->
<div id="cart">
    <table id="tableCart">
        <thead>
            <tr>
                <th class="thcart">Product Image</th>
                <th class="thcart">Product Name</th>
                <th class="thcart">Product Quantity</th>
                <th class="thcart">Product Price</th>
                <th class="thcart">Remove</th>
            </tr>
        </thead>
        <!-- tbody section starts here -->
        <tbody id="tbodyCart">
            <?php
            // function to display the cart
            function displayCart()
            {
                $i = 0;
                foreach ($_SESSION['cart'] as $productKey => $productValue) {
                    echo "<tr><td><img src='" . $_SESSION['cart'][$productKey]['pimg'] . "'></td><td>" . $_SESSION['cart'][$productKey]['pname'] . "</td><td>" . $_SESSION['cart'][$productKey]['pquantity'] . "</td><td>" . $_SESSION['cart'][$productKey]['pprice'] . "</td><td><form  action='#' method='POST'><input type='submit' class='remove' value='Remove' name='remove'><input type='hidden' name='hidden' value='" . $i . "'></form></td></tr>";
                    $i++;
                }
            }
            // adding item in cart on button click
            if (isset($_POST['add'])) {
                $val = $_POST['hiddenproduct'];
                $index = 0;
                $ind = 0;
                $name;
                foreach ($_SESSION['products'] as $key => $value) {
                    if ($ind == $val) {
                        $name = $_SESSION['products'][$key]['title'];
                    }
                    $ind++;
                }
                $flag = 0;
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($_SESSION['cart'][$key]['pname'] == $name) {
                        $_SESSION['cart'][$key]['pprice'] += ($_SESSION['cart'][$key]['pprice'] / $_SESSION['cart'][$key]['pquantity']);
                        $_SESSION['cart'][$key]['pquantity'] += 1;
                        $flag = 1;

                        displayCart();
                    }
                }
                if ($flag == 0) {
                    foreach ($_SESSION['products'] as $key => $value) {
                        if ($index == $val) {
                            array_push(
                                $_SESSION['cart'],
                                array(
                                    'pimg' => $_SESSION['products'][$key]['img'],
                                    'pname' => $_SESSION['products'][$key]['title'],
                                    'pquantity' => 1,
                                    'pprice' => $_SESSION['products'][$key]['price']
                                )
                            );
                        }
                        $index++;
                    }
                    displayCart();
                }
            }
            // removing item in cart on button click
            if (isset($_POST['remove'])) {
                $val = $_POST['hidden'];
                $ind = 0;
                $name;
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($ind == $val) {
                        $name = $_SESSION['cart'][$key]['pname'];
                    }
                    $ind++;
                }
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($_SESSION['cart'][$key]['pname'] == $name) {
                        unset($_SESSION['cart'][$key]);
                    }
                }
                displayCart();
            }
            ?>
        </tbody>
    </table>