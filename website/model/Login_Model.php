<?php
    class Login_Model extends Model{
        function __construct(){
            parent::__construct(); 
        }

        public function check($data){
            
            $quary = "SELECT * FROM users WHERE `u_name` = '".$data['username']."'";            
            $result = mysqli_query($this->db->conn,$quary);
            if($result->num_rows==0){

            }else{
                $datarow = $result->fetch_assoc();

                if(password_verify($data['password'],$datarow['password'])){
                    session_start();
                    $_SESSION['loggedin'] = 1;
                if ($datarow['u_type']=="dealer") {
                    $_SESSION['usertype'] = $datarow['u_type'];
                    $cartID=$this->db->selectWhere('cart', array('CartID'), "DealerID='{$datarow['u_id']}'" );
                    $_SESSION['dealerid'] = $datarow['u_id'];
                    $_SESSION['cartid'] = $cartID[0]['CartID'];
                    $_SESSION['total'] = 0;
                    header("location:../Dealer/home");
                }
                if ($datarow['u_type']=="admin") {
                    $_SESSION['usertype'] = $datarow['u_type'];
                    $_SESSION['adminid'] = $datarow['u_id'];
                    header("location:../Admin/home");
                }
                if ($datarow['u_type']=="accountant") {
                    $_SESSION['usertype'] = $datarow['u_type'];
                    header("location:../Acc/home");
                }
                if ($datarow['u_type']=="op_manager") {
                    $_SESSION['usertype'] = $datarow['u_type'];
                    header("location:../OM/home");
                }
                if ($datarow['u_type']=="sales_executive") {
                    $_SESSION['usertype'] = $datarow['u_type'];
                    header("location:../SE/home");
                }
                if ($datarow['u_type']=="hom") {
                    $_SESSION['usertype'] = $datarow['u_type'];
                    $_SESSION['homid'] = $datarow['u_id'];
                    header("location:../HOM/home");
                }		
                if ($datarow['u_type']=="sales_co") {
                    $_SESSION['usertype'] = $datarow['u_type'];
                    $_SESSION['scid'] = $datarow['u_id'];
                    header("location:../SC/home");
                }
            }
            return false;
        }
        
    }

    function getEmail($Email){
        //return $this->db->selectAll('dealers',array('email'));
        return $this->db->selectWhere('dealers', array('COUNT(email) AS Count','u_id'), "email='$Email'"); 
    }

    function updateCode($code,$Email){
        return $this->db->update('dealers',array('code' => $code),"email = '$Email'");
    }

    function getCode($OTP){
        return $this->db->selectWhere('dealers', array('COUNT(code) AS Count'), "code='$OTP'"); 
    }

    function updatepass($id,$passset){
        return $this->db->update('users',array('password' => $passset),"u_id = '$id'");
    }
}
?>