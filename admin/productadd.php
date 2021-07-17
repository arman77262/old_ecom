<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
include '../classes/Product.php';
$product = new Product();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    /* $productName = $_POST['productName'];
        $catId = $_POST['catId'];
        $brandId = $_POST['brandId'];
        $body = $_POST['body'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $type = $_POST['type']; */

    $addProduct = $product->addProduct($_POST, $_FILES);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">

            <span>
                <?php
                if (isset($addProduct)) {
                    echo $addProduct;
                }
                ?>
            </span>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Enter Product Name..." class="medium" />
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
                                        <option value="<?= $row['catId'] ?>"><?= $row['catName'] ?></option>
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
                                <option value="<?=$brow['brandId']?>"><?=$brow['brandName']?></option>
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
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="selct_type">
                                <option>Select Type</option>
                                <option value="0">Featured</option>
                                <option value="1">General</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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