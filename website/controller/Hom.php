<?php
class Hom extends Controller{
    function __construct()
    {
        parent::__construct();
        session_start();
        if($_SESSION['usertype']!="hom"){
            session_destroy();
            header('location: '.URL.'Login/log'); 
            exit;
        }
    }

    function home(){
    	$this->view->render('HOM/HOM_home');
    }

    function dealers(){
        $this->view->data=$this->model->dealerData();
    	$this->view->render('HOM/dealerDetails');
    }

    function latePayments(){
        $this->view->data=$this->model->paymentData();
        //print_r($this->view->data);
    	$this->view->render('HOM/latePayments');
    }

    function newOrders(){
        $this->view->data=$this->model->getOrders();
        $this->view->payment_data=$this->model->getPayments();
        // print_r($this->view->payment_data);
    	$this->view->render('HOM/newOrders');
    }

    function settings(){
        $this->view->data=$this->model->getProfile();
        $this->view->render('Hom/profile');
    }

    function changePassword(){
        $oldpassword=$this->model->getOldPassword();
        if(password_verify($_POST['oldpassword'], $oldpassword[0]['password'])){
            $newpassword = password_hash ($_POST['newpassword'] , PASSWORD_DEFAULT);
            $result=$this->model->updatePassword($newpassword);
            if($result=='true'){
                header('location: '.URL.'Hom/settings?alert=success');   
            }else{
                header('location: '.URL.'Hom/settings?alert=fail');   
            }
        }else{
            header('location: '.URL.'Hom/settings?alert=wrong');  
        }
    }

    function changeProfile(){
        $data = array();
        $data['username'] = $_POST['username'];
        $data['name'] = $_POST['name'];
        $data['address'] = $_POST['address'];
        $data['email'] = $_POST['mail'];
        $data['telephone'] = $_POST['telephone'];
        $result=$this->model->updateProfile($data);
        if($result=='true'){
            header('location: '.URL.'Hom/settings?alert=success');   
        }else{
            header('location: '.URL.'Hom/settings?alert=fail');   
        }
    }

    function confirmOrder($id){
        // $this->view->data=$this->model->acceptOrder($id);
        // // print_r($this->view->data);
        // header('location: '.URL.'Hom/newOrders');
        if($this->model->acceptOrder($id)){
            header('location: '.URL.'Hom/newOrders?alert=success');   
        }else{
            header('location: '.URL.'Hom/newOrders?alert=fail');   
        }
    }

    function rejectOrder($id){
        if($this->model->deleteOrder($id)){
            header('location: '.URL.'Hom/newOrders?alert=rejectsuccess');
        }else{
            header('location: '.URL.'Hom/newOrders?alert=rejectFail');
        }  
    }

    function forward($id){
        $this->view->data=$this->model->forwardSE($id);
        header('location: '.URL.'Hom/newOrders');
    }

    // function getPayment(){
    //     $this->view->data=$this->model->paymentData($id);
    //     header('location: '.URL.'Hom/latePayments'); 
    // }
    
}
?>