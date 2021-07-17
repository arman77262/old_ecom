<?php
include 'inc/header.php';

if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
	echo "<script>window.location='404.php'</script>";
} else {
	$id = $_GET['proid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$quantity = $_POST['quantity'];
	$addCart = $ct->addToCart($quantity, $id);
}

?>


<div class="main">
	<div class="content">
		<div class="section group">
			<div class="cont-desc span_1_of_2">
				<?php
				$getSpro = $pd->getSingleProduct($id);
				if ($getSpro) {
					while ($row = mysqli_fetch_assoc($getSpro)) {
				?>
						<div class="grid images_3_of_2">
							<img src="admin/<?= $row['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?= $row['productName'] ?> </h2>
							<div class="price">
								<p>Price: <span>$<?= $row['price'] ?></span></p>
								<p>Category: <span><?= $row['catName'] ?></span></p>
								<p>Brand:<span><?= $row['brandName'] ?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
							</div>

							<span style="color:red; font-size:18px"> 
								<?php 
									if (isset($addCart)) {
										echo $addCart;
									}
								?>
							</span>

						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?= $row['body'] ?></p>
						</div>
				<?php
					}
				}
				?>


			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php 
					
						$category = $cat->allCategory();
						if ($category) {
							while ($row = mysqli_fetch_assoc($category)) {
								?>
								<li><a href="productbycat.php?catId=<?=$row['catId']?>"><?=$row['catName']?></a></li>
								<?php
							}
						}
					
					?>
					
				</ul>

			</div>
		</div>
	</div>
	<?php
	include 'inc/footer.php';
	?>