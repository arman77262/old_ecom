<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include '../classes/Product.php';

$pd = new Product();

if (isset($_GET['delpro'])) {
	$id = $_GET['delpro'];
	$delpro = $pd->deleteProduct($id);
}

?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>

		<span>
			<?php

			if (isset($delpro)) {
				echo $delpro;
			}
			?>
		</span>

		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Sl</th>
						<th>Product Name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Details</th>
						<th>Price</th>
						<th>Image</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$getPd = $pd->getAllProduct();
					if ($getPd) {
						$i = 0;
						while ($row = mysqli_fetch_assoc($getPd)) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?= $i ?></td>
								<td><?= $row['productName'] ?></td>
								<td><?= $row['catName'] ?></td>
								<td><?= $row['brandName'] ?></td>
								<td><?= $pd->fr->textSorten($row['body'], 20); ?></td>
								<td><?= $row['price'] ?></td>
								<td><img src="<?= $row['image'] ?>" height="40px" width="60px" alt=""></td>
								<td>
									<?php
									if ($row['ptype'] == 0) {
										echo 'Featured';
									} else {
										echo 'General';
									}
									?>
								</td>
								<td><a href="productedit.php?editpro=<?= $row['productId'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')" href="?delpro=<?= $row['productId'] ?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>


				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>