<?php

class HOM_Model extends Model{
    function __construct(){
        parent::__construct(); 
    }

   function getOrders(){
        return $this->db->selectAll('orders', array('OrderID', 'DealerID', 'Type', 'Date', 'Status'));
   }

   function getPayments(){
       return $this->db->quaryexe("SELECT payment.OrderID,orders.DealerID,DATEDIFF(CURRENT_DATE,payment.IssuedDate) AS diff FROM payment INNER JOIN orders ON payment.OrderID = orders.OrderID");
   }

   function acceptOrder($id){
       return $this->db->update('orders',array('Status' => 'Approved'),"OrderID = '$id'");
   }

   function deleteOrder($id){
       return $this->db->delete('orders',"OrderID='$id'");
   }

   function forwardSE($id){
        return $this->db->update('orders',array('send' => 'Yes'),"OrderID = '$id'");
   }

   function paymentData(){
        return $this->db->quaryexe("SELECT payment.InvoiceNo,orders.DealerID,payment.PaymentDate,payment.Amount,dealers.f_name FROM payment INNER JOIN orders ON payment.OrderID = orders.OrderID JOIN dealers ON dealers.u_id = orders.DealerID WHERE payment.Copy='yes'");
   }

   function dealerData(){
       //return $this->db->selectAll('dealers',array('u_id','f_name','contact'));
       //return $this->db->quaryexe("SELECT dealers.f_name, dealers.contact, orders.OrderID, orders.DealerID, payment.Amount, payment.IssuedDate, payment.InvoiceNo FROM dealers, orders, payment WHERE payment.OrderID=orders.OrderID AND orders.DealerID=dealers.u_id");
       return $this->db->quaryexe("SELECT dealers.f_name, dealers.contact, GROUP_CONCAT(orders.OrderID) AS orderid, orders.DealerID, GROUP_CONCAT(payment.Amount) AS amount, GROUP_CONCAT(payment.IssuedDate) AS date, GROUP_CONCAT(payment.InvoiceNo) AS invoice FROM dealers, orders, payment WHERE payment.OrderID=orders.OrderID AND orders.DealerID=dealers.u_id GROUP BY orders.DealerID");
   }

   function getProfile(){
    return $this->db->selectWhere('users, employee', array('users.u_name', 'employee.Name', 'employee.Address', 'employee.Email', 'employee.Telephone'), "users.u_id=employee.UserID AND users.u_id='{$_SESSION['homid']}'");
    }

    function getOldPassword(){
        return $this->db->selectWhere('users', array('password'), "u_id='{$_SESSION['homid']}'");
    }

    function updatePassword($newpswrd){
        return $this->db->update('users', array('password' => $newpswrd), "u_id='{$_SESSION['homid']}'");
    }

    function updateProfile($data){
        return $this->db->update('users, employee', array('users.u_name' => $data['username'], 'employee.Name' => $data['name'], 'employee.Address' => $data['address'], 'employee.Telephone' => $data['telephone'], 'employee.Email' => $data['email']), "users.u_id=employee.UserID AND users.u_id='{$_SESSION['homid']}'");
    }
}

