<?php
session_start();
include_once("config.php");
if (!isset($_SESSION['products'])) {
	$_SESSION['products'] = $products;
}
if (!isset($_SESSION['cart'])) {
	$_SESSION['cart'] = array();
}
?>
<!-- head section starts here -->

<head>
	<title>
		Products
	</title>
	<link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
	<?php
	include_once("header.php");
	?>
	<div id="main">
		<!-- displaying products in product gallery -->
		<div id="products">
			<?php
			$i = 0;
			foreach ($_SESSION['products'] as $productKey => $productValue) {
				echo "<div id='product-101' class='product'><img src='" . $_SESSION['products'][$productKey]['img'] . "'><h3 class='title'><a href='#'>" . $_SESSION['products'][$productKey]['title'] . "</a></h3><span>" . "$" . $_SESSION['products'][$productKey]['price'] . "</span><form  action='#' method='POST'><input type='submit' class='add-to-cart' value='Add to Cart' name='add'><input type='hidden' name='hiddenproduct' value='" . $i . "'></form></div>";
				$i++;
			}
			?>
		</div>
		<!-- cart section starts -->
		<?php
		include_once("cart.php");
		?>
		<!-- total price section starts here -->
		<?php
		function totalPrice()
		{
			$total = 0;
			foreach ($_SESSION['cart'] as $key => $value) {
				$total += $_SESSION['cart'][$key]['pprice'];
			}
			echo "<div id='totalPrice'>Total Price : $" . $total . "</div>";
		}
		totalPrice();
		?>
	</div>
	</div>
	<?php
	include_once("footer.php");
	?>
</body>