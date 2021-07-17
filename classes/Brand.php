<?php

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath .'/../lib/Database.php');
    include_once ($filepath .'/../helpers/Fromat.php');


    class Brand{

        public $db;
        public $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Fromat();
        }

        public function addBrand($brandName){
            $brandName = $this->fr->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if (empty($brandName)) {
                $brandMsg = "<span style='font-size: 18px; color:red'>
                            Brand Name Fild Must Not Be Empty
                        </span>";
                return $brandMsg;
            }else {
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $result = $this->db->insert($query);
                if ($result) {
                    $brandMsg = "<span style='font-size: 18px; color:green'>
                                Brand Added Successfully
                            </span>";
                    return $brandMsg;
                }else {
                    $brandMsg = "<span style='font-size: 18px; color:red'>
                                    Something Wrong Brand is not Added
                                </span>";
                    return $brandMsg;
                }
            }
        }


        public function allBrand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            if ($result != false) {
                return $result;
            }else {
                return false;
            }
        }

        public function showSignleBrand($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            if ($result != false) {
                return $result;
            } else {
                return false;
            }
        }

        public function editBrand($brandName, $id){
            $brandName = $this->fr->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if (empty($brandName)) {
                $brandMsg = "<span style='font-size: 18px; color:red'>
                                Brand Name Fild Must Not Be Empty
                            </span>";
                return $brandMsg;
            } else {
                $query = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandID='$id'";
                $result = $this->db->update($query);
                if ($result) {
                    $brandMsg = "<span style='font-size: 18px; color:green'>
                                    Brand Updated Successfully
                                </span>";
                    return $brandMsg;
                } else {
                    $brandMsg = "<span style='font-size: 18px; color:red'>
                                        Something Wrong Brand is not Update
                                    </span>";
                    return $brandMsg;
                }
            }
        }

        public function deleteBrand($id){
            $query = "DELETE FROM tbl_brand WHERE brandId='$id'";
            $result = $this->db->delete($query);
            if ($result) {
                $catMsg = "<span style='font-size: 18px; color:green'>
                                    Brand Delete Successfylly
                                </span>";
                return $catMsg;
            } else {
                $catMsg = "<span style='font-size: 18px; color:red'>
                                    Something Wrong Brand Is Not Delete;
                                </span>";
                return $catMsg;
            }
        }
    }

?>