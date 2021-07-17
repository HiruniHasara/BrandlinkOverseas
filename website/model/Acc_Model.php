<?php

class Acc_Model extends Model{
    function __construct(){
        parent::__construct(); 
    }

    public function salesreport()
    {
        $query = "SELECT Status, COUNT(*) AS total FROM payment GROUP BY Status";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function date(){
        $query = "SELECT DATEDIFF(PaymentDate,IssuedDate) as diff FROM payment WHERE Status='Pending'";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function monthrep(){
        $query = "SELECT Status,SUM(Amount) AS totalAmount FROM payment WHERE IssuedDate >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) GROUP BY Status";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function annualrep(){
        $query = "SELECT Status,SUM(Amount) AS totalAmount FROM payment WHERE IssuedDate >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY) GROUP BY Status";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function getrep($datefrom,$dateto){
        $query = "SELECT Status,SUM(Amount) AS totalAmount FROM payment WHERE IssuedDate between '$datefrom' and '$dateto' GROUP BY Status";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }
    
    public function datediff(){
        $query = "SELECT InvoiceNo, DATEDIFF(payment.PaymentDate,payment.IssuedDate) as diff FROM payment WHERE Status='Pending'";
        $result = mysqli_query($this->db->conn,$query);
        return $result;
    }

    public function collectionAmount(){
        $query = "SELECT payment.InvoiceNo, payment.Amount, payment.Discount,payment.IssuedDate, payment.PaymentDate, dealers.f_name
                FROM payment
                INNER JOIN orders ON orders.OrderID=payment.OrderID
                INNER JOIN dealers ON dealers.u_id=orders.DealerID
                WHERE payment.Status='pending' GROUP BY `InvoiceNo`";
        $result = mysqli_query($this->db->conn,$query);
        return $result;
    }

    public function confirm($no){
        $query = "UPDATE payment SET Status='Paid' WHERE InvoiceNo='$no'";
        $result = mysqli_query($this->db->conn,$query);
        return $result;
    }

    public function profile(){
        $query = "SELECT * FROM users 
                  INNER JOIN employee ON employee.UserID=users.u_id WHERE users.u_type='accountant' LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function password($uname,$opass,$npass){
        $quary = "SELECT * FROM users WHERE `u_name` = '$uname'";            
        $result = mysqli_query($this->db->conn,$quary);
        if($result->num_rows==0){
        }else{

                $datarow = $result->fetch_assoc();
                if(password_verify($opass,$datarow['password'])){
                    // if($npass == $vpass){
                    $hashed_password = password_hash($npass, PASSWORD_DEFAULT);
                   $query1="UPDATE users SET password='$hashed_password' WHERE u_name = '$uname'";
                   $result1 = mysqli_query($this->db->conn,$query1);
                   if($result1)
                   {
                        return true;
                   }
                        else
                   {
                        return false;
                    }
            }
                return false;
        } 
    
   }

   public function updateProfile($name,$add,$tel,$email){
    $query = "UPDATE employee 
              INNER JOIN users ON employee.UserID=users.u_id
              SET employee.Name = '".$name."',employee.Address = '".$add."', employee.Telephone = '$tel',employee.Email = '$email' 
              WHERE users.u_type ='accountant'";
    $result = mysqli_query($this->db->conn,$query);
    if($result)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getHistory($status){
    return $this->db->selectWhere('payment, orders', array('payment.OrderID', 'payment.InvoiceNo', 'orders.DealerID', 'payment.IssuedDate', '(CASE WHEN DATEDIFF(CURRENT_DATE, payment.IssuedDate)>90 THEN payment.Amount ELSE payment.Discount END) as payment', 'payment.Status'), "payment.Status='$status' AND payment.OrderID=orders.OrderID");
}

function getHistoryDealer(){
    return $this->db->selectWhere('payment, orders', array('GROUP_CONCAT(payment.OrderID) AS OrderID', 'GROUP_CONCAT(payment.InvoiceNo) AS InvoiceNo', 'orders.DealerID', 'GROUP_CONCAT(payment.IssuedDate) as IssuedDate', 'GROUP_CONCAT(CASE WHEN DATEDIFF(CURRENT_DATE, payment.IssuedDate)>90 THEN payment.Amount ELSE payment.Discount END) AS payment', 'GROUP_CONCAT(payment.Status) AS Status'), "payment.OrderID=orders.OrderID GROUP BY orders.DealerID");
} 

function getHistoryDate(){
    return $this->db->selectWhere('payment, orders', array('payment.OrderID', 'payment.InvoiceNo', 'orders.DealerID', 'payment.IssuedDate', '(CASE WHEN DATEDIFF(CURRENT_DATE, payment.IssuedDate)>90 THEN payment.Amount ELSE payment.Discount END) as payment', 'payment.Status'), "payment.OrderID=orders.OrderID ORDER BY payment.IssuedDate DESC");
}

}
?>