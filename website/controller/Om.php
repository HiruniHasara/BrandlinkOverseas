<?php
class Om extends Controller{
    function __construct()
    {
        parent::__construct();
        session_start();
        if($_SESSION['usertype']!="op_manager"){
            session_destroy();
            header('location: '.URL.'Login/log'); 
            exit;
        }
    }

    function home(){
    	$this->view->render('OM/OM_home');
    }

    function orders(){
        $this->view->data=$this->model->getAOrders();
        // $this->view->value=$this->model->getAItems();
       
           
    	$this->view->render('OM/approvedOrders');
    }

    function settings(){
        $this->view->data=$this->model->profile();
    	$this->view->render('OM/profile');
    }
     
    function notification(){
        // $this->view->count=$this->model->count();
        $this->view->data = $this->model->notification();
        $this->view->render('OM/notification');
    }

    function changePassword(){
        if(isset($_POST['Pchange'])){
            $uname = $_POST['Pchange'];
            $opass= $_POST['oldpassword'];
            $npass = $_POST['newpassword'];
            $vpass = $_POST['repassword'];
            if($npass == $vpass && $npass !=""){
                if($this->model->password($uname,$opass,$npass)){
                 header('location: '.URL.'OM/settings?alert=passsuccess'); 
                }else{
                 header('location: '.URL.'OM/settings?alert=passfail');  
                }
 
            }else{
                 header('location: '.URL.'OM/settings?alert=mismatched');  
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
                header('location: '.URL.'OM/settings?alert=profilesuccess');    
            }else{
                header('location: '.URL.'OM/settings?alert=profilefail');  
            }

        }
    }


    function report(){
        $this->view->data=$this->model->stockreport();
        $this->view->value=$this->model->stockcategory();
    	$this->view->render('OM/reportGeneration');
    }
    function month(){
        $this->view->data = $this->model->monthrep();
        $this->view->render('OM/monthlyreport');
    }
    function annualy(){
        $this->view->data = $this->model->annualrep();
        $this->view->render('OM/annualyreport');
    }
    function monthlyspare(){
        $this->view->data = $this->model->sparerep();
        $this->view->value=$this->model->sparecategory();
        $this->view->render('OM/monthlysparereport');
    }
    function reportGen(){
        if(isset($_POST['rgen'])){
            $datefrom = $_POST['date'];
            $dateto = $_POST['date2'];
            $this->view->data=$this->model->getreport($datefrom,$dateto);
            $this->view->render('OM/stockreport');
        }
        if(isset($_POST['spare'])){
            $this->view->data = $this->model->sparerep();
            $this->view->value=$this->model->sparecategory();
            $this->view->render('OM/monthlysparereport'); 
        }
        if(isset($_POST['stock'])){
            $this->view->data = $this->model->monthrep();
            $this->view->render('OM/monthlyreport');
        }
    }
    
    // function getItemStock(){
    //     $id=$_POST['id'];
    //     $this->view->data=$this->model->getItem($id);
    //     $this->view->value=$this->model->getID($id);
    //     $this->view->render('OM/item');
    // }

    function stockMomali(){
        $this->view->data=$this->model->getMomali();
    	$this->view->render('OM/stockMomali');
    }
    
    function stockFerroli(){
        $this->view->data=$this->model->getFerroli();
    	$this->view->render('OM/stockFerroli');
    }

    function stockAqua(){
        $this->view->data=$this->model->getAqua();
    	$this->view->render('OM/stockAquaflex');
    }

    function sparePartMomali(){
        $this->view->data=$this->model->getSMomali();
    	$this->view->render('OM/sparePartStock');
    }

    function sparePartFerroli(){
        $this->view->data=$this->model->getSFerroli();
    	$this->view->render('OM/sparePartStock1');
    }

    function sparePartAqua(){
        $this->view->data=$this->model->getSAqua();
    	$this->view->render('OM/sparePartStock2');
    }
      
    function operationStock(){
        if(isset($_POST['invoice'])){
            $id=$_POST['keyToIssue'];
            $this->view->data=$this->model->getInvoice($id);
            $this->view->value=$this->model->getInvoiceDealer($id);
            $this->view->render('OM/issueinvoice');
        }
    }

    function sendinvoice(){
        
        if(isset($_POST['invoice'])) {
            $date = $_POST['date'];
            $oid = $_POST['oid'];
            $total = $_POST['total'];
            $list = $_POST['body'];
            $odate = $_POST['odate'];
            $this->view->data=$this->model->getAOrders();
            
            $this->view->value=$this->model->getInvoice($oid);
            $name = $_POST['name'];
            $subject = "Invoice";
            $email = $_POST['email'];
            $message = "Dear valued customer,
                    Invoice for your order is stated below.";
            $mail_subject = "Invoice from Brandlink Overseas";
            $email_body = "<p><b>From:</b> Brandlink Overseas</p>"; 
            $email_body .= "<p><b>To:</b> {$name} </p>"; 
            $email_body .= "<p><b>To:</b> {$name} </p>";
            $email_body .= "<p><b>Order ID:</b> {$oid} </p>"; 
            $email_body .= "<p><b>Ordered Date:</b> {$odate} </p>"; 
            $email_body .= "<p><b>Issued Date:</b> {$date} </p>"; 
            $email_body .= "<p><b>Total Amount:</b> {$total} </p>"; 
            $email_body .= "<p><b>Item List:</b><br> {$list} <br><br>"; 
                //}                          
            $email_body .= "<b>Brandlink Overseas Company</b><br>No 125/D, Kalalgoda, Pannipitiya, Sri Lanka<br>0094(0)777282324<br>branklink@slt.lk<br>";
            $header = "From: Brandlink\r\nContent-Type: text/html;";

            if(mail($email,$mail_subject,$email_body,$header)){
                $this->model->sendInvoice($oid,$date,$total);
                $this->model->updatestock($oid);
                $this->model->updateOrder($oid);
                header('location: '.URL.'OM/orders?alert=success');

            }else{
                header('location: '.URL.'OM/orders?alert=fail');
            }
           
        }
     
    }

    function deletefunction($itemid){
        if($this->model->deleteI($itemid,'items')){
            $this->model->delete($itemid,'stock','Momali');
            $this->view->data=$this->model->getMomali();
            header('location: '.URL.'OM/stockMomali?alert=deletesuccess');
        }else{
            $this->view->data=$this->model->getSMomali();
            header('location: '.URL.'OM/stockMomali?alert=deletefail');
        } 
    }

    function deletefunctionS($itemid){
        if($this->model->deleteS($itemid,'spareparts_stock','momali')){
            $this->view->data=$this->model->getSMomali();
            header('location: '.URL.'OM/sparePartMomali?alert=deletesuccess');
        }else{
            $this->view->data=$this->model->getSMomali();
            header('location: '.URL.'OM/sparePartMomali?alert=deletefail');
        }
    }

    function deleteferroli($itemid){
        $this->model->deleteI($itemid,'items');
            if($this->model->delete($itemid,'stock','Ferroli')){
                $this->view->data=$this->model->getFerroli();
                header('location: '.URL.'OM/stockFerroli?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getFerroli();
                header('location: '.URL.'OM/stockFerroli?alert=deletefail');
            }
    }

    function deleteferroliS($itemid){
        if($this->model->deleteS($itemid,'spareparts_stock','ferroli')){
            $this->view->data=$this->model->getSFerroli();
            header('location: '.URL.'OM/sparePartFerroli?alert=deletesuccess');
        }else{
            $this->view->data=$this->model->getSFerroli();
            header('location: '.URL.'OM/sparePartFerroli?alert=deletefail');
        }
    }

    function deleteaqua($itemid){
        $this->model->deleteI($itemid,'items');
            if($this->model->delete($itemid,'stock','Aquaflex')){
                $this->view->data=$this->model->getAqua();
                header('location: '.URL.'OM/stockAqua?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getAqua();
               header('location: '.URL.'OM/stockAqua?alert=deletefail');
            }
    }

    function deleteaquaS($itemid){
        if($this->model->deleteS($itemid,'spareparts_stock','aquaflex')){
            $this->view->data=$this->model->getSAqua();
            header('location: '.URL.'OM/sparePartAqua?alert=deletesuccess');
        }else{
            $this->view->data=$this->model->getSAqua();
            header('location: '.URL.'OM/sparePartAqua?alert=deletefail');
        }
    }

    // function deleteStockItem($id,$itemid){
    //     if($this->model->deleteItem($id,$itemid,'items')){
    //         // header('location: '.URL.'OM/getItemStock?alert=deletesuccess');
    //         $this->view->data=$this->model->getItem($id);
    //         $this->view->value=$this->model->getID($id);
    //         $this->view->alert = 'deletesuccess';
    //         $this->view->render('OM/item');
            

    //     }else{
    //         $this->view->data=$this->model->getItem($id);
    //         $this->view->value=$this->model->getID($id);
    //         $this->view->alert = 'deletefail';
    //         $this->view->render('OM/item');

    //     }
    // }

    function operationMomali(){
		
		if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            $name=$_POST['name'];
            $photoTmpPath=$_FILES['image']['name'];
            $target_file = basename($_FILES["image"]["name"]);
            //select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //valid file extensions
            $extension_arr = array('jpg','jpeg','png"','gif');
            //check extension
            if(in_array($imageFileType,$extension_arr)){
                //convert to base64
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                if($this->model->insert($id,$name,$image,'stock','Momali')){
                    $this->view->data=$this->model->getMomali();
                    header('location: '.URL.'OM/stockMomali?alert=success');
                }else{
                    $this->view->data=$this->model->getMomali();
                    header('location: '.URL.'OM/stockMomali?alert=fail');
                }    
            }else{
                $this->view->data=$this->model->getMomali();
                header('location: '.URL.'OM/stockMomali?alert=imagefail');
            }
            
        }

        if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            
            $this->model->insertcart($id,'cart');
        }

        if(isset($_POST['additem'])){
            $id=$_POST['additem'];
            // $cat=$_POST['cat'];
            $this->view->data=$this->model->getItem($id);
            $this->view->value=$this->model->getID($id);
            $this->view->render('OM/item');
            
        }

        else if(isset($_POST['search']))
        {
            $this->view->data=$this->model->getMomali();
            $id= $_POST['id'];
            $name= $_POST['name'];
			if($this->view->value=$this->model->fetch($id,'stock','Momali')){
                $this->view->render('Om/stockMomali');
            }elseif($this->view->value=$this->model->fetchName($name,'stock','Momali')){
                $this->view->render('Om/stockMomali');
            }else{
                header('location: '.URL.'OM/stockMomali?alert=searchFail');
            }
            
        }  
        
        else if(isset($_POST['delete']))
        {
            $id= $_POST['id'];
            if($this->model->deleteI($id,'items')){
                $this->model->delete($id,'stock','Momali');
                $this->view->data=$this->model->getMomali();
                header('location: '.URL.'OM/stockMomali?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/stockMomali?alert=deletefail');
            }
        }
            
        else if(isset($_POST['clear']))
        {
            $this->view->data=$this->model->getMomali();
            $this->view->render('Om/stockMomali');
            
        }

        else if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $photoTmpPath = $_FILES['image']['tmp_name'];
            $this->model->updateI($id,$photoTmpPath,'items');
            if($this->model->update($id,$name,$photoTmpPath,'stock','Momali')){
                $this->view->data=$this->model->getMomali();
                header('location: '.URL.'OM/stockMomali?alert=updatesuccess');
            }else{
                $this->view->data=$this->model->getMomali();
                header('location: '.URL.'OM/stockMomali?alert=updatefail');
            }
          
        }
        
    }

    function operationItem(){
		
		if(isset($_POST['add']))
		{
            $id=$_POST['id'];
            $item=$_POST['item'];
            $size=$_POST['size'];
            $quantity=$_POST['quantity'];
            $price=$_POST['price'];
            $photoTmpPath=$_FILES['image']['tmp_name'];
           
                if($this->model->insertItem($id,$item,$size,$quantity,$price,$photoTmpPath,'items')){
                    $this->view->data=$this->model->getItem($id);
                    $this->view->value=$this->model->getID($id);
                    $this->view->alert = 'success';
                    $this->view->render('OM/item');
                }else{
                    $this->view->data=$this->model->getItem($id);
                    $this->view->value=$this->model->getID($id);
                    $this->view->alert = 'fail';
                    $this->view->notification = $this->model->count();
                    $this->view->render('OM/item');
                }    
            }
            
        else if(isset($_POST['back'])){
            $category = $_POST['back'];
            if($category == "Momali"){
                $this->view->data=$this->model->getMomali();
                $this->view->render('OM/stockMomali');   
            }else if($category == "Ferroli"){
                $this->view->data=$this->model->getFerroli();
    	        $this->view->render('OM/stockFerroli');
            }else{
                $this->view->data=$this->model->getAqua();
                $this->view->render('OM/stockAquaflex'); 
            }

        }
        else if(isset($_POST['delete']))
        {
            $id= $_POST['id'];
            $item= $_POST['item'];
            if($this->model->deleteItem($id,$item,'items')){
                $this->view->data=$this->model->getItem($id);
                $this->view->value=$this->model->getID($id);
                $this->view->alert = 'deletesuccess';
                $this->view->render('OM/item');

            }else{
                $this->view->data=$this->model->getItem($id);
                $this->view->value=$this->model->getID($id);
                $this->view->alert = 'deletefail';
                $this->view->render('OM/item');

            }
        }
            
        else if(isset($_POST['clear']))
        {
            $id= $_POST['id'];
            $this->view->data=$this->model->getItem($id);
            $this->view->value=$this->model->getID($id);
            $this->view->render('Om/item');
            
        }
        
        else if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $item = $_POST['item'];
            $size = $_POST['size'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $photoTmpPath = $_FILES['image']['tmp_name'];

            if($this->model->updateItem($id,$item,$size,$quantity,$price,$photoTmpPath,'items')){
                $this->view->data=$this->model->getItem($id);
                $this->view->value=$this->model->getID($id);
                $this->view->alert = 'updatesuccess';
                $this->view->render('OM/item');
            }else{
                $this->view->data=$this->model->getItem($id);
                $this->view->value=$this->model->getID($id);
                $this->view->alert = 'updatefail';
                $this->view->render('OM/item');
            }
          
        }
        
    }
    
    function operationFerroli(){
		
		if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            $name=$_POST['name'];
            $photoTmpPath=$_FILES['image']['name'];
            $target_file = basename($_FILES["image"]["name"]);
            //select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //valid file extensions
            $extension_arr = array('jpg','jpeg','png"','gif');
            //check extension
            if(in_array($imageFileType,$extension_arr)){
                //convert to base64
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                if($this->model->insert($id,$name,$image,'stock','Ferroli')){
                    $this->view->data=$this->model->getFerroli();
                    header('location: '.URL.'OM/stockFerroli?alert=success');
                }else{
                    $this->view->data=$this->model->getFerroli();
                    header('location: '.URL.'OM/stockFerroli?alert=fail');
                }    
            }else{
                $this->view->data=$this->model->getFerroli();
                header('location: '.URL.'OM/stockFerroli?alert=imagefail');
            }
        }

        if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            
            $this->model->insertcart($id,'cart');
        }

        if(isset($_POST['additem'])){
            $id=$_POST['additem'];
            $this->view->data=$this->model->getItem($id);
            $this->view->value=$this->model->getID($id);
            $this->view->render('OM/item');
        }

        else if(isset($_POST['search']))
        {
            $this->view->data=$this->model->getFerroli();
            $id= $_POST['id'];
            $name= $_POST['name'];
			if($this->view->value=$this->model->fetch($id,'stock','Ferroli')){
                $this->view->render('Om/stockFerroli');
            }elseif($this->view->value=$this->model->fetchName($name,'stock','Ferroli')){
                $this->view->render('Om/stockFerroli');
            }else{
                header('location: '.URL.'OM/stockFerroli?alert=searchFail');
            }
            
        }   
            
        else if(isset($_POST['delete']))
        {
            $id= $_POST['id'];
            $this->model->deleteI($id,'items');
            if($this->model->delete($id,'stock','Ferroli')){
                $this->view->data=$this->model->getFerroli();
                header('location: '.URL.'OM/stockFerroli?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getFerroli();
                header('location: '.URL.'OM/stockFerroli?alert=deletefail');
            }
            
        }

        else if(isset($_POST['clear']))
        {
            $this->view->data=$this->model->getFerroli();
            $this->view->render('Om/stockFerroli');
            
        }

        else if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $photoTmpPath = $_FILES['image']['tmp_name'];
            $this->model->updateI($id,$photoTmpPath,'items');

            if($this->model->update($id,$name,$photoTmpPath,'stock','Ferroli')){
                $this->view->data=$this->model->getFerroli();
                header('location: '.URL.'OM/stockFerroli?alert=updatesuccess');
            }else{
                $this->view->data=$this->model->getFerroli();
                header('location: '.URL.'OM/stockFerroli?alert=updatefail');
            }
          
        }
        
    }
    
    function operationAqua(){
		
		if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            $name=$_POST['name'];
            $photoTmpPath=$_FILES['image']['name'];
            $target_file = basename($_FILES["image"]["name"]);
            //select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //valid file extensions
            $extension_arr = array('jpg','jpeg','png"','gif');
            //check extension
            if(in_array($imageFileType,$extension_arr)){
                //convert to base64
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                if($this->model->insert($id,$name,$image,'stock','Aquaflex')){
                    $this->view->data=$this->model->getAqua();
                    header('location: '.URL.'OM/stockAqua?alert=success');
                }else{
                    $this->view->data=$this->model->getAqua();
                    header('location: '.URL.'OM/stockAqua?alert=fail');
                }    
            }else{
                $this->view->data=$this->model->getAqua();
                header('location: '.URL.'OM/stockAqua?alert=imagefail');
            }
        }

        if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            
            $this->model->insertcart($id,'cart');
        }
    

        if(isset($_POST['additem'])){
            $id=$_POST['additem'];
            $this->view->data=$this->model->getItem($id);
            $this->view->value=$this->model->getID($id);
            $this->view->render('OM/item');
        }

        else if(isset($_POST['search']))
        {
            $this->view->data=$this->model->getAqua();
            $id= $_POST['id'];
            $name= $_POST['name'];
			if($this->view->value=$this->model->fetch($id,'stock','Aquaflex')){
                $this->view->render('Om/stockAquaflex');
            }elseif($this->view->value=$this->model->fetchName($name,'stock','aquaflex')){
                $this->view->render('Om/stockAquaflex');
            }else{
                header('location: '.URL.'OM/stockAqua?alert=searchFail');
            }
            
        }   
            
        else if(isset($_POST['delete']))
        {
            $id= $_POST['id'];
            $this->model->deleteI($id,'items');
            if($this->model->delete($id,'stock','Aquaflex')){
                $this->view->data=$this->model->getAqua();
                header('location: '.URL.'OM/stockAqua?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getAqua();
               header('location: '.URL.'OM/stockAqua?alert=deletefail');
            }
            
        }

        else if(isset($_POST['clear']))
        {
            $this->view->data=$this->model->getAqua();
            $this->view->render('Om/stockAquaflex');
            
        }

        else if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $photoTmpPath = $_FILES['image']['tmp_name'];

            $this->model->updateI($id,$photoTmpPath,'items');
            if($this->model->update($id,$name,$photoTmpPath,'stock','Aquaflex')){
                $this->view->data=$this->model->getAqua();
                header('location: '.URL.'OM/stockAqua?alert=updatesuccess');
            }else{
                $this->view->data=$this->model->getAqua();
                header('location: '.URL.'OM/stockAqua?alert=updatefail');
            }
        }
    }

    function operationSMomali(){
		
		if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            $name=$_POST['name'];
            $quantity=$_POST['quantity'];
            $price=$_POST['price'];
            $photoTmpPath=$_FILES['image']['name'];
            $target_file = basename($_FILES["image"]["name"]);
            //select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //valid file extensions
            $extension_arr = array('jpg','jpeg','png"','gif');
            //check extension
            if(in_array($imageFileType,$extension_arr)){
                //convert to base64
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                if($this->model->insertS($id,$name,$quantity,$price,$image,'spareparts_stock','momali')){
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/sparePartMomali?alert=success');
                }else{
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/sparePartMomali?alert=fail');
               }
            }else{
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/sparePartMomali?alert=fail');
            }
        }

        else if(isset($_POST['search']))
        {
            $this->view->data=$this->model->getSMomali();
            $id= $_POST['id'];
            $name= $_POST['name'];
			if($this->view->value=$this->model->fetchS($id,'spareparts_stock','momali')){
                $this->view->render('Om/sparePartStock');
            }else{
                header('location: '.URL.'OM/sparePartMomali?alert=searchFail');
            }
            
        }   
            
        else if(isset($_POST['delete']))
        {
            $id= $_POST['id'];
            if($this->model->deleteS($id,'spareparts_stock','momali')){
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/sparePartMomali?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/sparePartMomali?alert=deletefail');
            }
        }

        else if(isset($_POST['clear']))
        {
            $this->view->data=$this->model->getSMomali();
            $this->view->render('Om/sparePartStock');
            
        }

        else if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $photoTmpPath = $_FILES['image']['tmp_name'];

            if($this->model->updateS($id,$name,$quantity,$price,$photoTmpPath,'spareparts_stock','momali')){
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/sparePartMomali?alert=updatesuccess');
            }else{
                $this->view->data=$this->model->getSMomali();
                header('location: '.URL.'OM/sparePartMomali?alert=updatefail');
            }
          
        }
        
    }

    function operationSFerroli(){
		
		if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            $name=$_POST['name'];
            $quantity=$_POST['quantity'];
            $price=$_POST['price'];
            $photoTmpPath=$_FILES['image']['name'];
            $target_file = basename($_FILES["image"]["name"]);
            //select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //valid file extensions
            $extension_arr = array('jpg','jpeg','png"','gif');
            //check extension
            if(in_array($imageFileType,$extension_arr)){
                //convert to base64
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                if($this->model->insertS($id,$name,$quantity,$price,$image,'spareparts_stock','ferroli')){
                $this->view->data=$this->model->getSFerroli();
                header('location: '.URL.'OM/sparePartFerroli?alert=success');
               }else{
                $this->view->data=$this->model->getSFerroli();
                header('location: '.URL.'OM/sparePartFerroli?alert=fail');
            }
           }else{
            $this->view->data=$this->model->getSFerroli();
            header('location: '.URL.'OM/sparePartFerroli?alert=fail');
           }
        }


        else if(isset($_POST['search']))
        {
            $this->view->data=$this->model->getSFerroli();
            $id= $_POST['id'];
            $name= $_POST['name'];
			if($this->view->value=$this->model->fetchS($id,'spareparts_stock','ferroli')){
                $this->view->render('Om/sparePartStock1');
            }else{
                header('location: '.URL.'OM/sparePartMomali?alert=searchFail');
            }
            
        }   
            
        else if(isset($_POST['delete']))
        {
            $id= $_POST['id'];
            if($this->model->deleteS($id,'spareparts_stock','ferroli')){
                $this->view->data=$this->model->getSFerroli();
                header('location: '.URL.'OM/sparePartFerroli?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getSFerroli();
                header('location: '.URL.'OM/sparePartFerroli?alert=deletefail');
            }
            
        }

        else if(isset($_POST['clear']))
        {
            $this->view->data=$this->model->getSFerroli();
            $this->view->render('Om/sparePartStock1');
            
        }

        else if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $photoTmpPath = $_FILES['image']['tmp_name'];

            if($this->model->updateS($id,$name,$quantity,$price,$photoTmpPath,'spareparts_stock','ferroli')){
                $this->view->data=$this->model->getSFerroli();
                header('location: '.URL.'OM/sparePartFerroli?alert=updatesuccess');
            }else{
                $this->view->data=$this->model->getSFerroli();
                header('location: '.URL.'OM/sparePartFerroli?alert=updatefail');
            }
          
        }
        
    }

    function operationSAqua(){
		
		if(isset($_POST['add']))
		{
            
            $id= $_POST['id'];
            $name=$_POST['name'];
            $quantity=$_POST['quantity'];
            $price=$_POST['price'];
            $photoTmpPath=$_FILES['image']['name'];
            $target_file = basename($_FILES["image"]["name"]);
            //select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            //valid file extensions
            $extension_arr = array('jpg','jpeg','png"','gif');
            //check extension
            if(in_array($imageFileType,$extension_arr)){
                //convert to base64
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                if($this->model->insertS($id,$name,$quantity,$price,$image,'spareparts_stock','aquaflex')){
                $this->view->data=$this->model->getSAqua();
                header('location: '.URL.'OM/sparePartAqua?alert=success');
               }else{
                $this->view->data=$this->model->getSAqua();
                header('location: '.URL.'OM/sparePartAqua?alert=fail');
               }
           }else{
            $this->view->data=$this->model->getSAqua();
            header('location: '.URL.'OM/sparePartAqua?alert=fail');
           }
        }

        else if(isset($_POST['search']))
        {
            $this->view->data=$this->model->getSAqua();
            $id= $_POST['id'];
            $name= $_POST['name'];
			if($this->view->value=$this->model->fetchS($id,'spareparts_stock','aquaflex')){
                $this->view->render('Om/sparePartStock2');
            }else{
                header('location: '.URL.'OM/sparePartMomali?alert=searchFail');
            }
        }   
            
        else if(isset($_POST['delete']))
        {
            $id= $_POST['id'];
            if($this->model->deleteS($id,'spareparts_stock','aquaflex')){
                $this->view->data=$this->model->getSAqua();
                header('location: '.URL.'OM/sparePartAqua?alert=deletesuccess');
            }else{
                $this->view->data=$this->model->getSAqua();
                header('location: '.URL.'OM/sparePartAqua?alert=deletefail');
            }
            
        }

        else if(isset($_POST['clear']))
        {
            $this->view->data=$this->model->getSAqua();
            $this->view->render('Om/sparePartStock2');
            
        }

        else if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $photoTmpPath = $_FILES['image']['tmp_name'];

            if($this->model->updateS($id,$name,$quantity,$price,$photoTmpPath,'spareparts_stock','aquaflex')){
                $this->view->data=$this->model->getSAqua();
                header('location: '.URL.'OM/sparePartAqua?alert=updatesuccess');
            }else{
                $this->view->data=$this->model->getSAqua();
                header('location: '.URL.'OM/sparePartAqua?alert=updatefail');
            }
        }
    }


    
    
    


    
}
?>