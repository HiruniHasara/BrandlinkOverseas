<?php
class Admin extends Controller{
    function __construct(){
        parent::__construct();
        session_start();
        if($_SESSION['usertype']!="admin"){
            session_destroy();
            header('location: '.URL.'Login/log'); 
            exit;
        }
    }

    function home(){
      	$this->view->render('Admin/Admin_home');
    }

    function employees(){
        $this->view->data=$this->model->getEmployee();
         $this->view->render('Admin/ManageEmployee');
    }

    function pendingDealers(){
        $this->view->data=$this->model->getDealer();
    	$this->view->render('Admin/pendingDealers');
    }


    function settings(){
        $this->view->data=$this->model->getProfile();
        $this->view->render('Admin/profile');
    }

    function changePassword(){
        $oldpassword=$this->model->getOldPassword();
        if(password_verify($_POST['oldpassword'], $oldpassword[0]['password'])){
            $newpassword = password_hash ($_POST['newpassword'] , PASSWORD_DEFAULT);
            $result=$this->model->updatePassword($newpassword);
            if($result=='true'){
                header('location: '.URL.'Admin/settings?alert=success');   
            }else{
                header('location: '.URL.'Admin/settings?alert=fail');   
            }
        }else{
            header('location: '.URL.'Admin/settings?alert=wrong');  
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
            header('location: '.URL.'Admin/settings?alert=success');   
        }else{
            header('location: '.URL.'Admin/settings?alert=fail');   
        }
    }

    function manageDealers(){
        $this->view->data=$this->model->getRegDealer();
    	$this->view->render('Admin/ManageDealers');
    }

    function formAction(){
        if(isset($_POST['search'])){
            $id=$_POST['id'];
            $this->view->detail=$this->model->searchID($id);
            // $this->view->data=$this->model->getDealer();
            // $this->view->render('Admin/ManageDealers');

            if($this->view->detail!=0){
                $this->view->data=$this->model->getRegDealer();
                $this->view->render('Admin/ManageDealers');
            }else{
                header('location: '.URL.'Admin/ManageDealers?alert=invalid');
            }    
        }

        if(isset($_POST['update'])){
            $data = array();
            $data['id'] = $_POST['id'];
            $data['f_name'] = $_POST['name'];
            $data['address'] = $_POST['add'];
            $data['contact'] = $_POST['tp'];
            $data['email'] = $_POST['mail'];

            // $result = $this->model->updateDealer($data);
            if($this->model->updateDealer($data)){
                header('location: '.URL.'Admin/ManageDealers?alert=success');   
            }else{
                header('location: '.URL.'Admin/ManageDealers?alert=fail');   
            }
       }  
        
        if(isset($_POST['delete'])){
            $id=$_POST['id'];
            // echo $id;
            $result = $this->model->deleteDealer($id);
            if($result){
                header('location: '.URL.'Admin/ManageDealers?alert=deletesuccess');   
            }else{
                header('location: '.URL.'Admin/ManageDealers?alert=fail');   
            }
            // $this->view->data=$this->model->getRegDealer();
            // $this->view->render('Admin/ManageDealers');
        }
        if(isset($_POST['clear'])){
            $this->view->data=$this->model->getRegDealer();
    	    $this->view->render('Admin/ManageDealers');
        }
    } 
    
    function requestAcc($id){
        $accept=$this->model->acceptRequest($id);
        if($accept){
            // printf($accept[0]["Email"]);
            //the subject
            $sub = "Registered Account Accepted";
            //the message
            $msg = "Your account has been accepted by Brandlink Overseas. You can log in to your account and keep shopping with us";
            //recipient email here
            $rec = $accept[0]["Email"];
            //send email
            $header="From: info.brandlinkoverseas@gmail.com\r\nContent-Type: text/html;";
            mail($rec,$sub,$msg,$header);
            header('location: '.URL.'Admin/pendingDealers?alert=success');
        }else{
            header('location: '.URL.'Admin/pendingDealers?alert=fail');
        }
    }
        
    

    function rejectAcc($id){
        $reject=$this->model->rejectRequest($id);
        if($reject){
            $sub = "Registered Account Rejected";
            //the message
            $msg = "Your account has been rejected by Brandlink Overseas. You can contact our team using our mail if there's anything wrong happen";
            //recipient email here
            $rec = $reject[0]["Email"];
            //send email
            mail($rec,$sub,$msg);
            header('location: '.URL.'Admin/pendingDealers?alert=rejectsuccess');    
        }else{
            header('location: '.URL.'Admin/pendingDealers?alert=rejectfail');
        }
    }

    function report(){
        $this->view->data=$this->model->salesreport();
        $this->view->value=$this->model->salesStatus();
    	$this->view->render('Admin/reportGeneration');
    }

    function month(){
        $this->view->data = $this->model->monthrep();
        $this->view->render('Admin/monthlyreport');
    }
    function annualy(){
        $this->view->data = $this->model->annualrep();
        $this->view->render('Admin/annualyreport');
    }
    function complaintreport(){
        $this->view->data = $this->model->complaintCategory();
        // $this->view->value=$this->model->sparecategory();
        $this->view->render('Admin/ComplaintReport');
    }

    function reportGen(){
        if(isset($_POST['rgen'])){
            $datefrom = $_POST['date'];
            $dateto = $_POST['date2'];
            $this->view->data=$this->model->getreport($datefrom,$dateto);
            $this->view->render('Admin/salesreport');
        }
        if(isset($_POST['spare'])){
            $this->view->data = $this->model->complaintCategory();
            // $this->view->value=$this->model->sparecategory();
            $this->view->render('Admin/ComplaintReport'); 
        }

        if(isset($_POST['sales'])){
            $this->view->data = $this->model->monthrep();
            // $this->view->value=$this->model->sparecategory();
            $this->view->render('Admin/monthlyreport'); 
        }
    }

    function formActionemployee(){
        if(isset($_POST['add'])){
            $data = array();
            $data['id'] = $_POST['id'];
            $data['u_name'] = $_POST['uname'];
            $data['name'] = $_POST['name'];
            $data['address'] = $_POST['add'];
            $data['tp'] = $_POST['tp'];
            $data['type'] = $_POST['type'];
            $data['email'] = $_POST['mail'];
            $pass = password_hash ($_POST['pw'] , PASSWORD_DEFAULT);
            if($this->model->addEmployee($data,$pass)){
                header('location: '.URL.'Admin/employees?alert=insertsuccess');   
            }else{
                header('location: '.URL.'Admin/employees?alert=insertfail');   
            }
       }  
        
        // if(isset($_POST['delete'])){
        //     echo "dalete";
        //     // $id=$_POST['id'];
        //     // // $result = $this->model->deleteEmployee($id);
        //     // if($this->model->deleteEmployee($id)){
        //     //     header('location: '.URL.'Admin/employees?alert=deletesuccess');   
        //     // }else{
        //     //     header('location: '.URL.'Admin/employees?alert=fail');   
        //     // }
        //     // $this->view->data=$this->model->getEmployee();
        //     // $this->view->render('Admin/employees');
        // }

    }

    


}
?> 

