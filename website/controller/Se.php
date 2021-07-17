<?php
class Se extends Controller{
    function __construct()
    {
        parent::__construct();
        session_start();
        if($_SESSION['usertype']!="sales_executive"){
            session_destroy();
            header('location: '.URL.'Login/log'); 
            exit;
        }
    }

    function home(){
    	$this->view->render('SE/SE_home');
    }

    function payment(){
    	$this->view->render('SE/collectPayment');
    }

    function pay(){
        if(isset($_POST['find'])){
            $id= $_POST["InvoiceNo"];
            $date = $_POST['date'];
            // $this->view->data=$this->model->Datediff($id);
			if($this->view->value=$this->model->updatepayment($id)){
                $this->view->render('SE/collectPayment');
            }elseif($this->view->value=$this->model->updatepayment2($id)){
                $this->view->render('SE/collectPayment');
                //header('location: '.URL.'SE/payment?alert=fail'); 
            }else{
                header('location: '.URL.'SE/payment?alert=fail');
            }
            // $this->view->render('SE/collectPayment');
        }
        else if(isset($_POST['update'])){
            $id= $_POST["InvoiceNo"];
            $date= $_POST["date"];
            if(isset($_POST['check'])){
                if($this->view->value=$this->model->setpaymentcopy($id,$date)){
                    header('location: '.URL.'SE/payment?alert=paycopysuccess');  
                }else{
                    header('location: '.URL.'SE/payment?alert=paycopyfail'); 
                }
            }
            else{
                if($this->view->value=$this->model->setpayment($id,$date)){
                    header('location: '.URL.'SE/payment?alert=paysuccess'); 
                }else{
                    header('location: '.URL.'SE/payment?alert=payfail'); 
                }
            }
            
            // $this->view->render('SE/collectPayment');
        }
    }

    function complaint(){
        $this->view->data=$this->model->getComplaint();
    	$this->view->render('SE/complaints');
    }

    function dealer(){
        $this->view->data=$this->model->getDealers();
        $this->view->render('SE/dealerInfo');
    }

    function newOrder(){
        $this->view->data=$this->model->getNewOrder();
        // $this->view->value=$this->model->getNewOrderF();
        // $this->view->values=$this->model->getNewOrderA();
        $this->view->render('SE/newOrders');
    }

    function orderform(){
        if(isset($_POST["retrive"])){
            $did=$_POST['dId'];
            if($this->view->datas=$this->model->retrieveDealer($did)){
                $this->view->data=$this->model->getNewOrder();
                $this->view->render('SE/newOrders');
            }else{
                header('location: '.URL.'SE/newOrder?alert=searchFail'); 
            }
        }

        if(isset($_POST["checkout"])) {
            $name=$_POST['name'];
            $dId=$_POST['dId'];
            $total=$_POST['sum'];
            $add=$_POST['adress'];

            $checkbox1=$_POST['chk1'];
            $quantity1=$_POST['number'];
            $quantity = array();
            foreach($quantity1 as $qty){
                if($qty != ""){
                   array_push($quantity,$qty); 
                }
            }

            if(!empty($checkbox1)){
            if($this->model->addOrder($dId,$total,$add)){
                $id=$this->model->lastID();
            for($i=0; $i<count($checkbox1); $i++){
                $check_id = $checkbox1[$i];
                $qty = $quantity[$i];
                    
                    $this->model->addOrderItem($check_id,$qty,$id);
                    header('location: '.URL.'SE/newOrder?alert=success');
            }
                }else{
                    header('location: '.URL.'SE/newOrder?alert=fail'); 
                }
                  
            
            }else{
                header('location: '.URL.'SE/newOrder?alert=fail'); 
            }
    }
}

    function notEligible(){
        $this->view->data=$this->model->notEligible();
    	$this->view->render('SE/notEligible');
    } 

    function notelligible($oid){
        // if(isset($_POST['delete'])){
            // $oid=$_POST['delete'];
            if($this->model->deleteNotEligible($oid)){
                header('location: '.URL.'SE/notEligible?alert=eligiblesuccess');   
            }else{
                header('location: '.URL.'SE/notEligible?alert=eligiblefail');
            }
        //}
    }

    function settings(){
        $this->view->data=$this->model->profile();
    	$this->view->render('SE/profile');
    }

    function changePassword(){
        if(isset($_POST['Pchange'])){
            $uname = $_POST['Pchange'];
            $opass= $_POST['oldpassword'];
            $npass = $_POST['newpassword'];
            $vpass = $_POST['repassword'];
            if($npass == $vpass && $npass !=""){
                if($this->model->password($uname,$opass,$npass)){
                 header('location: '.URL.'SE/settings?alert=passsuccess'); 
                }else{
                 header('location: '.URL.'SE/settings?alert=passfail');  
                }
 
            }else{
                 header('location: '.URL.'SE/settings?alert=mismatched');  
            }
         }
    }

    function changeProfile(){
        if(isset($_POST['save'])){
            $name= $_POST['name'];
            $add= $_POST['address'];
            $tel= $_POST['telephone'];
            $email= $_POST['mail'];
            if($this->model->updateProfile($name,$add,$tel,$email)){
                header('location: '.URL.'SE/settings?alert=profilesuccess');    
            }else{
                header('location: '.URL.'SE/settings?alert=profilefail');  
            }

        }
    }

    
}
?>