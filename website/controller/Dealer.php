<?php
class Dealer extends Controller{
    function __construct(){
        parent::__construct();
        session_start();
        if($_SESSION['usertype']!="dealer"){
            session_destroy();
            header('location: '.URL.'Login/log'); 
            exit;
        }
    }

    function home(){
        $this->view->data=$this->model->getTrendingItems();
    	$this->view->render('Dealer/Dealer_home');
    }

    function category(){
    	$this->view->render('Dealer/itemCategory');
    }

    function momali(){
        $this->view->data=$this->model->getItems("Category='Momali'");
        if($this->view->data!=0){
            foreach($this->view->data as $key=>$values){
                $this->view->data[$key]['prices']=$this->model->getPrice($values["ModelID"]);
            }
        }else{
            
        }    
        $this->view->render('Dealer/momaliItems');
    }

    function ferroli(){
        $this->view->data=$this->model->getItems("Category='Ferroli'");
        if($this->view->data!=0){
            foreach($this->view->data as $key=>$values){
                $this->view->data[$key]['prices']=$this->model->getPrice($values["ModelID"]);
            }
        }else{
            
        }    
        $this->view->render('Dealer/ferroliItems');
    }

    function aquaflex(){
        $this->view->data=$this->model->getItems("Category='Aquaflex'");
        if($this->view->data!=0){
            foreach($this->view->data as $key=>$values){
                $this->view->data[$key]['prices']=$this->model->getPrice($values["ModelID"]);
            }
        }else{
            
        }    
        $this->view->render('Dealer/aquaflexItems');
    }

    function details($id){
        $this->view->data=$this->model->getModelItems($id);
        $this->view->data2=$this->model->getModelName($id);
        $this->view->render('Dealer/itemDetails');
    }

    function addtoCart($modelid, $itemid, $quantity){
        $data = array();
        $data['cartid'] = $_SESSION['cartid'];
        $data['itemid'] = $itemid;
        $data['quantity'] = $quantity;
        $this->model->addCartItem($data);
        header('location: '.URL.'Dealer/details/'.$modelid);
    }

    function cart(){
        $this->view->data=$this->model->getCart();
        $this->view->data2=$this->model->getDealerDetails();
        if($this->view->data!=0){
            $var=0;
            foreach($this->view->data as $key=>$values){
                $this->view->data[$key]['details']=$this->model->getDetails($values["ItemID"]);
                $modelid = $this->view->data[$var]['details'][0]["ModelID"];
                $this->view->data[$key]['modelname']=$this->model->getModelName($modelid);
                $var++;
            }
        }else{
            // return null;
        }    
        $this->view->render('Dealer/cart');
    }

    function deleteCartItem($itemid){
        $this->model->deleteFromCart($itemid);
        header('location: '.URL.'Dealer/cart');
    }

    function changeQuantity($itemid, $quantity){
        $data = array();
        $data['itemid'] = $itemid;
        $data['quantity'] = $quantity;
        $this->model->changeItemQuantity($data);
        header('location: '.URL.'Dealer/cart');
    }

    function confirmOrder(){
        $data = array();
        $data['address'] = $_POST['address'];
        $data['board'] = $_POST['board'];
        $data['total'] = $_POST['total'];
        $result=$this->model->addOrder($data);
        if($result=='true'){
            header('location: '.URL.'Dealer/cart?alert=success');   
        }else{
            header('location: '.URL.'Dealer/cart?alert=fail');   
        }
    }

    function history(){
        $this->view->data2=$this->model->getCountOngoing();
        $this->view->data3=$this->model->getCountDelivered();
        $this->view->data=$this->model->getHistory();
        if($this->view->data!=0){
            foreach($this->view->data as $key=>$values){
                if($values["ItemID"]=="DB"){
                    $this->view->data[$key]['modelname']="Display Board";
                }else{
                    $itemModelNames="";
                    $itemid=explode(',', $values["ItemID"]);
                    foreach($itemid as $id){
                        $name=$this->model->getItemModelName($id);
                        $itemModelNames .= "{$name[0]['Name']},";
                    }
                    $itemModelNames = rtrim($itemModelNames, ',');
                    $this->view->data[$key]['modelname']=$itemModelNames;
                }

                if($values["Status"]=="Delivered"){
                    $status=$this->model->getPaymentStatus($values["OrderID"]);
                    $this->view->data[$key]['Status']=$status[0]['Status'];
                    $this->view->data[$key]['InvoiceNo']=$status[0]['InvoiceNo'];
                    $this->view->data[$key]['Discount']=$status[0]['Discount'];
                    $this->view->data[$key]['Discountdue']=$status[0]['duedate'];
                }
            }
            // print_r($this->view->data);
        }
    	$this->view->render('Dealer/orderHistory');
    }

    function complaint(){
        $this->view->render('Dealer/complaint');
    }

    function sendComplaint(){
        $data = array();
        $data['type'] = $_POST['complaintType'];
        $data['invoiceno'] = $_POST['invoiceno'];
        $data['brand1'] = $_POST['momali'];
        $data['brand2'] = $_POST['ferroli'];
        $data['brand3'] = $_POST['aquaflex'];
        if(!empty($_FILES['img']['name'])){
            $data['img'] = addslashes(file_get_contents($_FILES['img']['tmp_name']));
        }
        $data['complaint'] = $_POST['complaint'];

        if(substr(($_FILES["img"]["type"]), 0, 5) !="image" AND !empty($_FILES['img']['name'])){
            header('location: '.URL.'Dealer/complaint?alert=notimg');   
            return false;
        }            

        $result=$this->model->sendComplaint($data);
        if($result=='true'){
            header('location: '.URL.'Dealer/complaint?alert=success');   
        }else{
            header('location: '.URL.'Dealer/complaint?alert=fail');   
        }
    }

    function profile(){
        $this->view->data=$this->model->getProfile();
        $this->view->render('Dealer/profile');
    }

    function changePassword(){
        $oldpassword=$this->model->getOldPassword();
        if(password_verify($_POST['oldpassword'], $oldpassword[0]['password'])){
            $newpassword = password_hash ($_POST['newpassword'] , PASSWORD_DEFAULT);
            $result=$this->model->updatePassword($newpassword);
            if($result=='true'){
                header('location: '.URL.'Dealer/profile?alert=success');   
            }else{
                header('location: '.URL.'Dealer/profile?alert=fail');   
            }
        }else{
            header('location: '.URL.'Dealer/profile?alert=wrong');  
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
            header('location: '.URL.'Dealer/profile?alert=success');   
        }else{
            header('location: '.URL.'Dealer/profile?alert=fail');   
        }
    }

    function deleteAccount(){
        $result=$this->model->deleteDealerAcc();
        if($result=='true'){
            session_unset();
            session_destroy();
            header('location: '.URL);   
        }else{
            header('location: '.URL.'Dealer/profile?alert=faildelete');   
        }
    }

    // function addCart(){
    //     $data = array();
    //     $data['amount'] = $_POST['quantity'];
    //     $data['ID'] = $_POST['var'];

    //     $this->model->cartItem($data);
    //     header('location: '.URL.'Dealer/momali');
    // }
}
?>