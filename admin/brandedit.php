<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include '../classes/Brand.php';
$brand = new Brand();

if (!isset($_GET['editId']) || $_GET['editId'] == NULL) {
    echo "<script>Window.location='brandlist.php'</script>";
} else {
    $id = $_GET['editId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brandName'];

    $brandEdit = $brand->editBrand($brandName, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Brand</h2>



        <div class="block copyblock">
            <?php
            $showB = $brand->showSignleBrand($id);
            if ($showB) {
                while ($row = mysqli_fetch_assoc($showB)) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <span>
                                <?php
                                if (isset($brandEdit)) {
                                    echo $brandEdit;
                                }
                                ?>
                            </span>
                            <tr>
                                <td>
                                    <input type="text" value="<?=$row['brandName']?>" class="medium" name="brandName" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
            <?php
                }
            }
            ?>

        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>