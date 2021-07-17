<?php

    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath .'/../lib/Database.php');
    include_once ($filepath .'/../helpers/Fromat.php');


    class Category{

        public $db;
        public $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Fromat();
        }

        public function addCategory($catName){
            $catName = $this->fr->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if (empty($catName)) {
                $catMsg = "<span style='font-size: 18px; color:red'>
                        Category Fild Must Not Be Empty
                    </span>";
                return $catMsg;
            }else {
                $query = "INSERT INTO tbl_category(catName) VALUE('$catName')";
                $result = $this->db->insert($query);
                if ($result) {
                    $catMsg = "<span style='font-size: 18px; color:green'>
                        Category Inserted Successfylly
                    </span>";
                    return $catMsg;
                }else {
                    $catMsg = "<span style='font-size: 18px; color:red'>
                            Something Wrong Category Is Not added
                        </span>";
                    return $catMsg;
                }
            }
        }

        public function allCategory(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            if ($result != false) {
                return $result;
            }else {
                return false;
            }
        }

        public function ShowEditCat($id){
            $query = "SELECT * FROM tbl_category WHERE catId = '$id'";
            $result = $this->db->insert($query);
            if ($result != false) {
                return $result;
            } else {
                return false;
            }
        }

        public function editCategory($catName, $id){
            $catName = $this->fr->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if (empty($catName)) {
                $catMsg = "<span style='font-size: 18px; color:red'>
                            Category Fild Must Not Be Empty
                        </span>";
                return $catMsg;
            }else {
                $query = "UPDATE tbl_category SET catName='$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if ($result) {
                    $catMsg = "<span style='font-size: 18px; color:green'>
                            Category Updated Successfylly
                        </span>";
                        return $catMsg;
                }else {
                    $catMsg = "<span style='font-size: 18px; color:red'>
                            Something Wrong Category Is Not Updated
                        </span>";
                        return $catMsg;
                }
            }
        }

        public function deleteCategory($id){
            $query = "DELETE FROM tbl_category WHERE catId='$id'";
            $result = $this->db->delete($query);
            if ($result) {
                $catMsg = "<span style='font-size: 18px; color:green'>
                                Category Delete Successfylly
                            </span>";
                return $catMsg;
            }else {
                $catMsg = "<span style='font-size: 18px; color:red'>
                                Something Wrong Category Is Not Delete;
                            </span>";
                return $catMsg;
            }
        }

    }

?>