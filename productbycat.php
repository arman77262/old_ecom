<?php
include 'inc/header.php';


if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
	echo "<script>Window.location='catlist.php'</script>";
} else {
	$id = $_GET['catId'];
}

?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Latest from Category</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php
			//this function is made in Produce Class
			$product = $pd->getProductByCategory($id);
			if ($product) {
				while ($row = mysqli_fetch_assoc($product)) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview.php?proid=<?= $row['productId'] ?>"><img src="admin/<?=$row['image']?>" alt="" /></a>
					<h2><?=$row['productName']?> </h2>
					<p><?=$fr->textSorten($row['body'], 60)?></p>
					<p><span class="price">$<?=$row['price']?></span></p>
					<div class="button"><span><a href="preview.php?proid=<?= $row['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php
				}
			}else{
				header('location:404.php');
			}
			?>


		</div>



	</div>

	<?php
	include 'inc/footer.php';
	?>