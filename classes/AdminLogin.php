<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Session.php');
    Session::loginCheck();
    
    include_once ($filepath .'/../lib/Database.php');
    include_once ($filepath .'/../helpers/Fromat.php');
    class AdminLogin{

        private $db;
        private $fr;

        public function __construct()
        {
            $this->db = new Database();
            $this->fr = new Fromat();
        }

        public function adminLogin($adminUser, $adminPass){
            $adminUser = $this->fr->validation($adminUser);
            $adminPass = $this->fr->validation($adminPass);

            $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
            $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

            if (empty($adminUser) || empty($adminPass)) {
                $loginMsg = "Username & Password Fild Must Not Be Empty";
                return $loginMsg;
            }else {
                $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass'";
                $result = $this->db->select($query);
                if ($result != false) {
                    $row = mysqli_fetch_assoc($result);
                    Session::set('login' , true);
                    Session::get('adminId', $row['adminId']);
                    Session::get('adminUser', $row['adminUser']);
                    Session::get('adminName', $row['adminName']);
                    header('Location:index.php');
                }else {
                    $loginMsg = "Username Or Password Is Not Match";
                    return $loginMsg;
                }
            }
        }

    }

?>