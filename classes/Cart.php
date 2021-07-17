<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath .'/../lib/Database.php');
    include_once ($filepath .'/../helpers/Fromat.php');


    class Cart
    {
        private $db;
        private $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Fromat();
        }

        public function addToCart($quantity, $id){
            $quantity = $this->fr->validation($quantity);
            $productId = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $squery = "SELECT * FROM tbl_product WHERE productId='$productId'";
            $result = $this->db->select($squery)->fetch_assoc();

            $productName = $result['productName'];
            $price = $result['price'];
            $image = $result['image'];

            //check dubplicate product
            $checkProduct = "SELECT * FROM tbl_cart WHERE productId='$productId' AND sId = '$sId'";
            $checkResult = $this->db->select($checkProduct);
            //check dubplicate product

            if ($checkResult) {
                $error = "This Product Already Added Into Cart !";
                return $error;
            }else {
                
                $insertQuery = "INSERT INTO tbl_cart(sId, productId, productName, price, quantity, image) VALUE('$sId', '$productId', '$productName', '$price', '$quantity', '$image')";

                $insertRow = $this->db->insert($insertQuery);
                if ($insertRow) {
                header('Location:cart.php');
                }else {
                    header('Location:404.php');
                }
            }
        }

        //Cart Product tula nea asar jonno 
        public function getCartProduct(){
            $sId = session_id();
            $squery = "SELECT * FROM tbl_cart WHERE sId='$sId'";
            $result = $this->db->select($squery);
            if ($result) {
                return $result;
            }else {
                return false;
            }
        }


        //Cart Quenatity Update
        public function updateCartProduct($cartId, $quantity){
            $cartId = $this->fr->validation($cartId);
            $quantity = $this->fr->validation($quantity);

            $update = "UPDATE tbl_cart SET quantity='$quantity' WHERE cartId = '$cartId'";
            $update_result = $this->db->update($update);

            if ($update_result) {
                $pMsg = "<span style='font-size: 18px; color:green'>
                            Cart Quantity Updated Sussessfully
                        </span>";
                return $pMsg;
            }else {
                $pMsg = "<span style='font-size: 18px; color:red'>
                                Something Wrong Cart Quantity Is Not Updated
                            </span>";
                return $pMsg;
            }
        }

        //Delete Cart Product
        public function delCatProduct($id){
            $delete_query = "DELETE FROM tbl_cart WHERE cartId='$id'";
            $deleteProduct = $this->db->delete($delete_query);
                if ($deleteProduct) {
                    $pMsg = "<span style='font-size: 18px; color:green'>
                                Sussessfully Delete Producat From Cart
                            </span>";
                    return $pMsg;
                }else {
                    $pMsg = "<span style='font-size: 18px; color:green'>
                                Something wrong product is not delete
                            </span>";
                    return $pMsg;
                }
        }

        //selce cart Product for show header empty place
        public function showProductQty(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $select_result = $this->db->select($query);

            if ($select_result) {
                $row = mysqli_num_rows($select_result);
                return $row;
                //return $select_result;
            }else {
                return 0;
            }

        }
    }
    
?>