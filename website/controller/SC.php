<?php
class SC extends Controller{
    function __construct(){
        parent::__construct();
        session_start();
        if($_SESSION['usertype']!="sales_co"){
            session_destroy();
            header('location: '.URL.'Login/log'); 
            exit;
        }
    }

    function home(){
    	$this->view->render('SC/SC_home');
    }

    function priceList(){
        if(isset($_POST['momali'])){
            $this->view->data=$this->model->getPrice("Momali");
            $this->view->data2=sizeof($this->view->data);
            $this->view->render('SC/priceList');

        }else if(isset($_POST['ferroli'])){
            $this->view->data=$this->model->getPrice("Ferroli");
            $this->view->data2=sizeof($this->view->data);
            $this->view->render('SC/priceList');

        }else if(isset($_POST['aquaflex'])){
            $this->view->data=$this->model->getPrice("Aquaflex");
            $this->view->data2=sizeof($this->view->data);
            $this->view->render('SC/priceList');

        }else{
            $this->view->data=$this->model->getPrice("Momali");
            $this->view->data2=sizeof($this->view->data);
            $this->view->render('SC/priceList');
        }
    }

    function itemDetails(){
        if(isset($_POST['searchP'])){
            $id=$_POST['id'];
            $this->view->detail=$this->model->searchID(array('ItemID','ItemName','Price', 'Category'), $id);
            if($this->view->detail!=0){
                $category=$this->view->detail[0]['Category'];
                $this->view->data=$this->model->getPrice("Category='$category'");
                $this->view->render('SC/priceList');
            }else{
                header('location: '.URL.'SC/priceList?alert=invalid');
            }    
        }

        if(isset($_POST['searchQ'])){
            $id=$_POST['id'];
            $this->view->detail=$this->model->searchID(array('ItemID','ItemName','Quantity', 'Category'), $id);
            if($this->view->detail!=0){
                $category=$this->view->detail[0]['Category'];
                $this->view->data=$this->model->getStock("Category='$category'");
                $this->view->render('SC/stock');
            }else{
                header('location: '.URL.'SC/stock?alert=invalid');
            }    
        }
    }

    function updateP($itemid, $price){
        $data = array();
        $data['itemid']=$itemid;
        $data['price']=$price;
        $result=$this->model->updatePrice($data);
        if($result=='true'){
            header('location: '.URL.'SC/priceList?alert=success');   
        }else{
            header('location: '.URL.'SC/priceList?alert=fail');   
        }     
    }   

    function orders(){
        $this->view->data=$this->model->getNewOrders();
        if($this->view->data!=0){
            foreach($this->view->data as $key=>$values){
                if($values["ItemID"]=="DB"){
                    $this->view->data[$key]['modelname']="Display Board";
                    $this->view->data[$key]['stockquantity']="";
                }else{
                    $itemModelNames="";
                    $itemStockQuantity="";
                    $itemid=explode(',', $values["ItemID"]);
                    foreach($itemid as $id){
                        $name=$this->model->getItemModelName($id);
                        $itemModelNames .= "{$name[0]['Name']},";
                        $itemStockQuantity .= "{$name[0]['Quantity']},";
                    }
                    $itemModelNames = rtrim($itemModelNames, ',');
                    $itemStockQuantity = rtrim($itemStockQuantity, ',');
                    $this->view->data[$key]['modelname']=$itemModelNames;
                    $this->view->data[$key]['stockquantity']=$itemStockQuantity;
                }
            }
        }

        $this->view->data2=$this->model->getItemCount();
        $this->view->data3=$this->model->getisDeleteCount();
        $this->view->render('SC/newOrders');
    }

    function forward($orderid){
        $result=$this->model->forwardToHOM($orderid);
        if($result){
            header('location: '.URL.'SC/orders?alert=success');
        }else{
            header('location: '.URL.'SC/orders?alert=fail');
        }
    }

    function delete($orderid, $itemid){
        $result=$this->model->removeItem($orderid, $itemid);
        if($result){
            header('location: '.URL.'SC/orders');
        }else{
            header('location: '.URL.'SC/orders?alert=removefail');
        }
    }

    function deleteOrder($orderid, $dealerid){
        $result=$this->model->orderDelete($orderid);
        if($result){
            $data=$this->model->getDealerName($dealerid);
            $name=$data[0]['f_name'];
            $email=$data[0]['email'];
            $recipient=$email;
            $subject="Informing the order cancellation";
            $message="<p>Mr/Mrs.{$name},</p>";
            $message.="<p>Your order Order No. - {$orderid} has been deleted and cancelled due to the unavailability of the ordered items. We try our best to fulfill your orders in future and keep ordering with us.</p>";
            $message.="<p>Sorry for your inconvienience.</p>";
            $message.="<p>Thank You.<br/>BrandlinkOverseas Team.</p>";
            $header="From: info.brandlinkoverseas@gmail.com\r\nContent-Type: text/html;";
            mail($recipient, $subject, $message, $header);
            header('location: '.URL.'SC/orders?alert=deletesuccess');
        }else{
            header('location: '.URL.'SC/orders?alert=deletefail');
        }
    }

    function stock(){
        if(isset($_POST['momali'])){
            $this->view->data=$this->model->getStock("Momali");
            $this->view->data2=sizeof($this->view->data);
            $this->view->data3=$this->model->getModelCount("Momali");
            $this->view->render('SC/stock');

        }else if(isset($_POST['ferroli'])){
            $this->view->data=$this->model->getStock("Ferroli");
            $this->view->data2=sizeof($this->view->data);
            $this->view->data3=$this->model->getModelCount("Ferroli");
            $this->view->render('SC/stock');

        }else if(isset($_POST['aquaflex'])){
            $this->view->data=$this->model->getStock("Aquaflex");
            $this->view->data2=sizeof($this->view->data);
            $this->view->data3=$this->model->getModelCount("Aquaflex");
            $this->view->render('SC/stock');

        }else{
            $this->view->data=$this->model->getStock("Momali");
            $this->view->data2=sizeof($this->view->data);
            $this->view->data3=$this->model->getModelCount("Momali");
            // printf($this->view->data3[0]['count']);
            $this->view->render('SC/stock');
        }
    }

    function complaint(){
        $this->view->data=$this->model->getComplaints();
        $this->view->data2=$this->model->getCount();
        $this->view->render('SC/complaints');
    }

    function complaintForward($complaintid, $dealerid){
        $result=$this->model->forwardToSE($complaintid);
        if($result){
            $dealer=$this->model->getDealerName($dealerid);
            $recipient=$dealer[0]['email'];
            $subject="Regarding the complaint";
            $message="<p>Mr/Mrs.{$dealer[0]['f_name']},</p>";
            $message.="<p>Your order complaint is received by us and now it has taken into consideration. Your complaint is forwarded to our Sales Executive team and they will visit you soon to handle and give our optimum service to overcome this.</p>";
            $message.="<p>Sorry for your inconvienience.</p>";
            $message.="<p>Thank You.<br/>BrandlinkOverseas Team.</p>";
            $header="From: info.brandlinkoverseas@gmail.com\r\nContent-Type: text/html;";
            mail($recipient, $subject, $message, $header);
            header('location: '.URL.'SC/complaint');
        }else{
            header('location: '.URL.'SC/complaint?alert=fail');
        }  
    }

    function notify(){
        $this->view->render('SC/notifyDealers');
    }

    function inform($orderid, $dealerid, $deletecount){
        $this->view->id=$orderid;
        if($deletecount==0){
            $this->view->data=$this->model->getDealerName($dealerid);
            $this->view->render('SC/notifyDealers');
        }else{
            $content="Regarding your order Order No. - {$orderid}.\r\nFollowing items has been removed from your order due to those items are out of stock.\r\n\n";
            $this->view->data=$this->model->getDealerName($dealerid);
            $this->view->data2=$this->model->getDeletedItems($orderid);
            foreach($this->view->data2 as $values) {
                $content .= $values['Name']."-".$values['ItemID'].".\r\n";
            }
            $content .= "\r\nSorry for our unavailability and we are now processing your order and remaining ordered items will be delivered to you as soon as possible.";
            $this->view->content=$content;
            $this->view->render('SC/notifyDealers');
        }
    }

    function getName(){
        $id=$_POST['id'];
        $this->view->data=$this->model->getDealerName($id);
        if($this->view->data!=0){
            $this->view->render('SC/notifyDealers');
        }else{
            header('location: '.URL.'SC/notify?alert=invalid');
        }    
        // $this->view->render('SC/notifyDealers');
    }

    function sendMail(){
        $recipient=$_POST['mail'];
        $subject="Message from BrandlinkOverseas";
        $message="<p>Mr/Mrs.{$_POST['name']},</p>";
        $message.="<p>{$_POST['message']}</p>";
        $message.="<p>Thank You.<br/>BrandlinkOverseas Team.</p>";
        $header="From: info.brandlinkoverseas@gmail.com\r\nContent-Type: text/html;";
        if(mail($recipient, $subject, $message, $header)){
            if($_POST['orderid']==''){
                header('location: '.URL.'SC/notify?alert=success');
            }else{
                $this->model->deleteItem($_POST['orderid']);
                header('location: '.URL.'SC/notify?alert=success');
            }
        }else{
            header('location: '.URL.'SC/notify?alert=fail');
        }
    }

    function profile(){
        $this->view->data=$this->model->getProfile();
        $this->view->render('SC/profile');
    }

    function changePassword(){
        $oldpassword=$this->model->getOldPassword();
        if(password_verify($_POST['oldpassword'], $oldpassword[0]['password'])){
            $newpassword = password_hash ($_POST['newpassword'] , PASSWORD_DEFAULT);
            $result=$this->model->updatePassword($newpassword);
            if($result=='true'){
                header('location: '.URL.'SC/profile?alert=success');   
            }else{
                header('location: '.URL.'SC/profile?alert=fail');   
            }
        }else{
            header('location: '.URL.'SC/profile?alert=wrong');  
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
            header('location: '.URL.'SC/profile?alert=success');   
        }else{
            header('location: '.URL.'SC/profile?alert=fail');   
        }
    }
}
?>

    <!-- function priceList(){
        $this->view->data=$this->model->getPrice();
        $this->view->render('SC/priceList');
    }
    function getPrice(){
        if(isset($_POST['momali'])){
            $this->view->data=$this->model->getPrice();
            $this->view->render('SC/priceList');
        }

        if(isset($_POST['ferroli'])){
            $this->view->data=$this->model->getPrice1();
            $this->view->render('SC/priceList');
        }

        // header('location: '.URL.'SC/priceList'); not worked
    } -->

    <!-- $this->view->alert="Update success"; -->

    <!-- $this->view->alert="<script>alert('updated')</script>"; -->

    <!-- <?php 
        if(isset($this->alert)){
            echo $this->alert;
        }
    ?> -->