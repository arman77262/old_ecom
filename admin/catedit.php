<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include '../classes/Category.php';
$cat = new Category();

if (!isset($_GET['editId']) || $_GET['editId'] == NULL) {
    echo "<script>Window.location='catlist.php'</script>";
} else {
    $id = $_GET['editId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];
    
    $catUpdate = $cat->editCategory($catName, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>



        <div class="block copyblock">
            <?php
            $showCat = $cat->ShowEditCat($id);
            if ($showCat) {
                while ($row = mysqli_fetch_assoc($showCat)) {
            ?>
                    <form action="" method="post">
                        <table class="form">
                            <span>
                                <?php
                                if (isset($catUpdate)) {
                                    echo $catUpdate;
                                }
                                ?>
                            </span>
                            <tr>
                                <td>
                                    <input type="text" value="<?=$row['catName']?>" class="medium" name="catName" />
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