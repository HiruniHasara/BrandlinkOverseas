<?php
class Acc extends Controller{
    function __construct(){
        parent::__construct();
        session_start();
        if($_SESSION['usertype']!="accountant"){
            session_destroy();
            header('location: '.URL.'Login/log'); 
            exit;
        }
    }

    function home(){
    	$this->view->render('Acc/Acc_home');
    }

    function report(){
        $this->view->data=$this->model->salesreport();
    	$this->view->render('Acc/reportGeneration');
    }

    function month(){
        $this->view->data = $this->model->monthrep();
        // $this->view->date = $this->model->date();
        $this->view->render('Acc/monthlyreport');
    }

    function year(){
        $this->view->data = $this->model->annualrep();
        // $this->view->date = $this->model->date();
        $this->view->render('Acc/annualreport');
    }

    function reportGen(){
        if(isset($_POST['rgen'])){
            $datefrom = $_POST['date'];
            $dateto = $_POST['date2'];
            $this->view->data=$this->model->getrep($datefrom,$dateto);
            $this->view->render('Acc/getreport');
        }
        
        if(isset($_POST['month'])){
            $this->view->data = $this->model->monthrep();
            $this->view->render('Acc/monthlyreport');
        }
    }


    function history(){
        if(isset($_POST['date'])){
            $this->view->data=$this->model->getHistoryDate();
            $this->view->render('Acc/paymentHistory');

        }else if(isset($_POST['dealer'])){
            $this->view->data=$this->model->getHistoryDealer();
            $this->view->render('Acc/paymentHistory');

        }else if(isset($_POST['paid'])){
            $this->view->data=$this->model->getHistory("Paid");
            $this->view->render('Acc/paymentHistory');

        }else if(isset($_POST['unpaid'])){
            $this->view->data=$this->model->getHistory("Not Paid");
            $this->view->render('Acc/paymentHistory');

        }else{
            $this->view->data=$this->model->getHistoryDate();
            $this->view->render('Acc/paymentHistory');
        }
    }

    function collection(){
        $this->view->date=$this->model->datediff();
        $this->view->value=$this->model->collectionAmount();
        $this->view->render('Acc/SEcollection');
    }

    function confirmPayment($ino){
        if($this->model->confirm($ino)){
                $this->view->date=$this->model->datediff();
                $this->view->value=$this->model->collectionAmount();
            header('location: '.URL.'ACC/collection?alert=success');
        }else{
            $this->view->date=$this->model->datediff();
            $this->view->value=$this->model->collectionAmount();
            header('location: '.URL.'ACC/collection?alert=fail');
        }
        //}
    }

    function settings(){
        $this->view->data=$this->model->profile();
    	$this->view->render('ACC/profile');
    }

    function changePassword(){
        if(isset($_POST['Pchange'])){
            $uname = $_POST['Pchange'];
            $opass= $_POST['oldpassword'];
            $npass = $_POST['newpassword'];
            $vpass = $_POST['repassword'];
            if($npass == $vpass && $npass !=""){
                if($this->model->password($uname,$opass,$npass)){
                 header('location: '.URL.'ACC/settings?alert=passsuccess'); 
                }else{
                 header('location: '.URL.'ACC/settings?alert=passfail');  
                }
 
            }else{
                 header('location: '.URL.'ACC/settings?alert=mismatched');  
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
                header('location: '.URL.'ACC/settings?alert=profilesuccess');    
            }else{
                header('location: '.URL.'ACC/settings?alert=profilefail');  
            }

        }
    }
}