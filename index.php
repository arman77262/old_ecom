<?php
include 'inc/header.php';
include 'inc/slider.php';


?>


<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getFpd = $pd->getFetruedProduct();
			if ($getFpd) {
				while ($frow = mysqli_fetch_assoc($getFpd)) {
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?proid=<?= $frow['productId'] ?>"><img src="admin/<?= $frow['image'] ?>" alt="" /></a>
				<h2><?= $frow['productName'] ?></h2>
				<p><?= $fr->textSorten($frow['body'], 60) ?></p>
				<p><span class="price">$<?= $frow['price'] ?></span></p>
				<div class="button"><span><a href="preview.php?proid=<?= $frow['productId'] ?>" class="details">Details</a></span></div>
			</div>
			<?php
				}
			}
			?>

		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$getNpro = $pd->getNewProduct();
			if ($getNpro) {
				while ($nrow = mysqli_fetch_assoc($getNpro)) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview.php?proid=<?= $nrow['productId'] ?>"><img src="admin/<?= $nrow['image'] ?>" alt="" /></a>
						<h2><?= $nrow['productName'] ?></h2>
						<p><span class="price">$<?= $nrow['price'] ?></span></p>
						<div class="button"><span><a href="preview.php?proid=<?= $nrow['productId'] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
	<?php include 'inc/footer.php'; ?>