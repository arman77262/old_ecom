<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include '../classes/Brand.php';
$allBrand = new Brand();

$showBrand = $allBrand->allBrand();

if (isset($_GET['brandDel'])) {
    $id = $_GET['brandDel'];
    $delCat = $allBrand->deleteBrand($id);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>

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
                    if ($showBrand) {
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($showBrand)) {
                            $i++;
                    ?>
                            <tr class="odd gradeX">
                                <td><?= $i ?></td>
                                <td><?= $row['brandName'] ?></td>
                                <td><a href="brandedit.php?editId=<?= $row['brandId'] ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')" href="?brandDel=<?= $row['brandId'] ?>">Delete</a></td>
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