<?php
include 'inc/header.php';

include_once 'classes/Cart.php';
$ct = new Cart();

if (isset($_GET['detPro'])) {
	$id = $_GET['detPro'];

	$catDel = $ct->delCatProduct($id);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];

	$catUp = $ct->updateCartProduct($cartId, $quantity);

	if ($quantity <= 0) {
		$catDel = $ct->delCatProduct($cartId);
	}
}

$cartQty = $ct->showProductQty();

?>

<?php
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
	}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2>Your Cart</h2>

				<span>
					<?php
					if (isset($catUp)) {
						echo $catUp;
					}
					?>
				</span>

				<table class="tblone">
					<tr>
						<th width="5%">SL</th>
						<th width="30%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="15%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
					$getPro = $ct->getCartProduct();
					$i = 0;
					if ($getPro) {
						$sum = 0;
						$qty = 0;
						while ($row = mysqli_fetch_assoc($getPro)) {
							$i++;
					?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $row['productName'] ?></td>
								<td><img src="admin/<?= $row['image'] ?>" style="width:100px; height: 100px;" alt="" /></td>
								<td>Tk.<?= $row['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" value="<?= $row['cartId'] ?>" name="cartId" value="1" />

										<input type="number" value="<?= $row['quantity'] ?>" name="quantity" value="1" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td>Tk. <?php
										$total = $row['price'] * $row['quantity'];
										echo $total;
										?></td>
								<td><a onclick="return confirm('Are you sure to delete')" href="?detPro=<?= $row['cartId'] ?>">X</a></td>
							</tr>

							<?php
							$sum = $sum + $total;
							$qty = $qty + $row['quantity'];
							Session::set('qty', $qty);
							?>
					<?php
						}
					}
					?>



				</table>

				<?php
				if ($cartQty) {
				?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Sub Total : </th>
							<td>TK. <?php if (isset($sum)) {
										echo $sum;
									} else {
										echo "0";
									} ?></td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>TK. 10%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td>TK. <?php
									if (isset($sum)) {
										$vat = $sum * 0.10;
										$gtotal = $sum + $vat;
										echo $gtotal;
									} else {
										echo "0";
									}
									?> </td>
						</tr>
					</table>
				<?php
				} else {
					echo "Cart Is Empty";
				}
				?>



			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="login.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<?php include 'inc/footer.php'; ?>