<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Fromat.php');

    class Product{

        public $db;
        public $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Fromat();
        }

    

        //select category fro Product Add
        public function allCategory()
        {
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            if ($result != false) {
                return $result;
            } else {
                return false;
            }
        }

        /* Select Brand Fro Add Product */
        public function allBrand()
        {
            $brand_query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $select_brand = $this->db->select($brand_query);
            if ($select_brand != false) {
                return $select_brand;
            } else {
                return false;
            }
        }

        //Add Product
        public function addProduct($data, $file){
            $productName = $this->fr->validation($data['productName']);
            $catId = $this->fr->validation($data['catId']);
            $brandId = $this->fr->validation($data['brandId']);
            $body = $this->fr->validation($data['body']);
            $price = $this->fr->validation($data['price']);
            $ptype = $this->fr->validation($data['selct_type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
            $upload_image = 'upload/'.$unique_image;

            if ($productName=="" || $catId=="" || $brandId=="" || $body=="" || $price=="" || $price=="" || $file_name=="") {
                $pMsg = "<span style='font-size: 18px; color:red'>
                                Fild Must Not Be Empty
                            </span>";
                return $pMsg;
            }elseif ($file_size > 1048567) {
                $pMsg = "<span style='font-size: 18px; color:red'>
                                    Image size should be less than 1MB
                                </span>";
                return $pMsg;
            }elseif (in_array($file_ext, $permited) == false) {
                $pMsg = "<span style='font-size: 18px; color:red'>You can upload Only:-".implode(', ',$permited)."</span>";
                return $pMsg;
            }else {
                move_uploaded_file($file_temp, $upload_image);

                $query = "INSERT INTO `tbl_product`(`productName`, `catId`, `brandId`, `body`, `price`, `image`, `ptype`) VALUES ('$productName', '$catId', '$brandId', '$body', '$price', '$upload_image', '$ptype')";

                $result = $this->db->insert($query);
                if ($result) {
                    $pMsg = "<span style='font-size: 18px; color:green'>
                                        Product Added Sussessfully
                                    </span>";
                    return $pMsg;
                }else {
                    $pMsg = "<span style='font-size: 18px; color:red'>
                                      Something Wrong Product is Not Added
                                    </span>";
                    return $pMsg;
                }
            }
        }


        public function getAllProduct(){

            $query = "SELECT p.*, c.catName, b.brandName FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b WHERE p.catId = c.catId AND p.brandId = b.brandId ORDER BY p.productId DESC";

            /* $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId ORDER BY tbl_product.productId Desc"; */
            $result = $this->db->select($query);
            if ($result != false) {
                return $result;
            }else {
                return false;
            }
        }

        public function getProById($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            }else {
                return false;
            }
        }

        public function editProduct($data, $file, $id){
            $productName = $this->fr->validation($data['productName']);
            $catId = $this->fr->validation($data['catId']);
            $brandId = $this->fr->validation($data['brandId']);
            $body = $this->fr->validation($data['body']);
            $price = $this->fr->validation($data['price']);
            $ptype = $this->fr->validation($data['selct_type']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_temp = $file['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $upload_image = 'upload/' . $unique_image;

            if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $price == "") {
                $pMsg = "<span style='font-size: 18px; color:red'>
                                    Fild Must Not Be Empty
                                </span>";
                return $pMsg;
            }else {
                if (!empty($file_name)) {
                    if ($file_size > 1048567) {
                        $pMsg = "<span style='font-size: 18px; color:red'>
                                            Image size should be less than 1MB
                                        </span>";
                        return $pMsg;
                    }elseif (in_array($file_ext, $permited) == false) {
                        $pMsg = "<span style='font-size: 18px; color:red'>You can upload Only:-".implode(', ',$permited)."</span>";
                        return $pMsg;
                    }else {
                        move_uploaded_file($file_temp, $upload_image);

                        $query = "UPDATE tbl_product SET productName='$productName', catId='$catId', brandId='$brandId', body='$body',price='$price', image='$upload_image', ptype='$ptype' WHERE productId = '$id'";

                        $result = $this->db->update($query);
                        if ($result) {
                            $pMsg = "<span style='font-size: 18px; color:green'>
                                                Product Updated Sussessfully
                                            </span>";
                            return $pMsg;
                        }else {
                            $pMsg = "<span style='font-size: 18px; color:red'>
                                            Something Wrong Product is Not Updated
                                            </span>";
                            return $pMsg;
                        }
                    }
                }else {
                    $query = "UPDATE tbl_product SET productName='$productName', catId='$catId', brandId='$brandId', body='$body',price='$price', ptype='$ptype' WHERE productId = '$id'";

                    $result = $this->db->update($query);
                    if ($result) {
                        $pMsg = "<span style='font-size: 18px; color:green'>
                                    Product Updated Sussessfully
                                </span>";
                        return $pMsg;
                    } else {
                        $pMsg = "<span style='font-size: 18px; color:red'>
                                Something Wrong Product is Not Updated
                                </span>";
                        return $pMsg;
                    }
                }
            }
        }

        public function deleteProduct($id){
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $getData = $this->db->select($query);
            if ($getData) {
               while ($delImg = mysqli_fetch_assoc($getData)) {
                   $dellink = $delImg['image'];
                   unlink($dellink);
               }
            }

            $delquery = "DELETE FROM tbl_product WHERE productId = '$id'";
            $deldata = $this->db->delete($delquery);
            if ($deldata) {
                $pMsg = "<span style='font-size: 18px; color:green'>
                        Product Delete Successfully
                        </span>";
                return $pMsg;
            }else {
                $pMsg = "<span style='font-size: 18px; color:red'>
                        Something Wrong Product is Not Delete
                        </span>";
                return $pMsg;
            }
        }

        public function getFetruedProduct(){
            $query = "SELECT * FROM tbl_product WHERE ptype='0' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            }else {
                return false;
            }
        }

        public function getNewProduct(){
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            }else {
                return false;
            }
        }

        public function getSingleProduct($id){

            /* $query = "SELECT p.*, c.catName, b.brandName FROM tbl_product AS p, tbl_category AS c, tbl_brand AS b WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$id'"; */


            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId INNER JOIN tbl_brand ON tbl_product.brandId=tbl_brand.brandId WHERE tbl_product.productId='$id'";
            $result = $this->db->select($query);
            if ($result) {
                return $result;
            }else {
                return false;
            }
        }


        public function getIphone(){
            $selectIphone = "SELECT * FROM tbl_product WHERE brandId='10' ORDER BY productId DESC LIMIT 1";
            $iphone_result = $this->db->select($selectIphone);
            return $iphone_result;
        }

        public function getSamsung(){
            $selectIphone = "SELECT * FROM tbl_product WHERE brandId='11' ORDER BY productId DESC LIMIT 1";
            $iphone_result = $this->db->select($selectIphone);
            return $iphone_result;
        }

        public function getAcer(){
            $selectIphone = "SELECT * FROM tbl_product WHERE brandId='9' ORDER BY productId DESC LIMIT 1";
            $iphone_result = $this->db->select($selectIphone);
            return $iphone_result;
        }

        public function getCanon(){
            $selectIphone = "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1";
            $iphone_result = $this->db->select($selectIphone);
            return $iphone_result;
        }

        //select product by category
        public function getProductByCategory($id){
            $query = "SELECT * FROM tbl_product WHERE catId='$id' ORDER BY productId DESC";
            $result = $this->db->select($query);
            return $result;
        }
    }