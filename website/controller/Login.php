<?php
class Login extends Controller{
    function __construct()
    {
        parent::__construct();
    }

    function log(){
    	$this->view->render('Login/login');
    }

    function check(){
        if(isset($_POST['login'])){
            $data = array();
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $this->view->data = $this->model->check($data);   
            if($this->view->data==0){
                $this->view->render('Login/login');
                echo "<script>swal('Incorrect User name or Password!', 'Please check the user name and password again!!!!', 'error');</script>";  
            }   
        }
    }
    
    function logout(){
            session_unset();
            session_destroy();
            header('location: '.URL.'Login/log'); 
        	exit;
    }

    function resetpass(){
        $this->view->render('Login/forgetpass');
    }

    function checkmail(){
        $Email=$_POST['email'];
        //$this->view->data=$this->model->getID();
        $this->view->data=$this->model->getEmail($Email);
        foreach($this->view->data as $Values){
            if($Values['Count']!='0'){
                $id=$Values['u_id'];
                $code = rand(999999, 111111);
                $this->view->data=$this->model->updateCode($code,$Email);
                header('location: '.URL.'Login/resetcode/'.$id);
            }else{
                //header('location: '.URL.'Login/resetpass?alert=noMail');
                $this->view->render('Login/forgetpass');
                echo "<script>swal('Email Not Exists !!!!', '', 'error');</script>";
            } 
        }

    }

    function resetcode($uid){
        $this->view->id=$uid;
        $this->view->render('Login/resetcode');
    }

    function codeCheck(){
        $id=$_POST['id'];
        $OTP=$_POST['otp'];
        $this->view->data=$this->model->getCode($OTP);
        foreach($this->view->data as $Values){
            if($Values['Count']!='0'){
                //echo "True";
                header('location: '.URL.'Login/newpass/'.$id);
            }else{
                $this->view->render('Login/resetcode');
                echo "<script>swal('OTP Code Not match !!!!', '', 'error');</script>";
            } 
        }
    }

    function newPass($id){
        $this->view->id=$id;
        $this->view->render('Login/newpassword');
    }

    function passUpdate(){
        $id=$_POST['id'];
        $pass=$_POST['password'];
        $cpass=$_POST['cpassword'];
        if($pass==$cpass){
            $passset = password_hash ($_POST['password'] , PASSWORD_DEFAULT);
            if($this->model->updatepass($id,$passset)){
                $this->view->render('Login/newpassword');
                echo "<script>swal('Password Updated !!!!', '', 'success');</script>";
            }
            }
              
        }
    

    
        
}
?>