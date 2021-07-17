<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include '../classes/Category.php';
$allCat = new Category();

$showCat = $allCat->allCategory();

if (isset($_GET['catDel'])) {
	$id = $_GET['catDel'];
	$delCat = $allCat->deleteCategory($id);
}

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>

			<span>
				<?php
				
					if (isset($delCat)) {
						echo $delCat;
					}
				?>
			</span>

		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($showCat) {
						$i = 0;
						while ($row = mysqli_fetch_assoc($showCat)) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?=$i?></td>
								<td><?=$row['catName']?></td>
								<td><a href="catedit.php?editId=<?=$row['catId']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')" href="?catDel=<?=$row['catId']?>">Delete</a></td>
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