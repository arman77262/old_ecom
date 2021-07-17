<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include '../classes/Product.php';
$product = new Product();

if (!isset($_GET['editpro']) || $_GET['editpro'] == NULL) {
    echo "<script>Window.location='productlist.php'</script>";
} else {
    $id = $_GET['editpro'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $editProduct = $product->editProduct($_POST, $_FILES, $id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        <div class="block">

            <span>
                <?php
                if (isset($editProduct)) {
                    echo $editProduct;
                }
                ?>
            </span>

            <?php
            $getPro = $product->getProById($id);
            if ($getPro) {
                while ($prow = mysqli_fetch_assoc($getPro)) {
            ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="productName" value="<?= $prow['productName'] ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="catId">
                                        <option>Select Category</option>
                                        <?php
                                        $getCat = $product->allCategory();
                                        if ($getCat) {
                                            while ($row = mysqli_fetch_assoc($getCat)) {
                                        ?>
                                                <option <?= $prow['catId'] == $row['catId'] ? 'selected' : '' ?> value="<?= $row['catId'] ?>"><?= $row['catName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Brand</label>
                                </td>
                                <td>
                                    <select id="select" name="brandId">
                                        <option>Select Brand</option>
                                        <?php
                                        $getBrand = $product->allBrand();
                                        if ($getBrand) {
                                            while ($brow = mysqli_fetch_assoc($getBrand)) {
                                        ?>
                                                <option <?= $prow['brandId'] == $brow['brandId'] ? 'selected' : '' ?> value="<?= $brow['brandId'] ?>"><?= $brow['brandName'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>


                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Description</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?= $prow['body'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Price</label>
                                </td>
                                <td>
                                    <input type="text" name="price" value="<?= $prow['price'] ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <input type="file" name="image" /><br>
                                    <img src="<?= $prow['image'] ?>" height="80px" width="80px" alt="">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Product Type</label>
                                </td>
                                <td>
                                    <select id="select" name="selct_type">
                                        <option>Select Type</option>
                                        <?php
                                        if ($prow['ptype'] == 0) {
                                        ?>
                                            <option selected='selected' value="0">Featured</option>
                                            <option value="1">General</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="0">Featured</option>
                                            <option selected='selected' value="1">General</option>
                                        <?php
                                        }
                                        ?>


                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>