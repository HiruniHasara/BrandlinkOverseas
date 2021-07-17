<?php

class Se_Model extends Model{
    function __construct(){
        parent::__construct(); 
    }

    function getDealers(){
        return $this->db->selectAll('dealers', '*' ); 
    }

    function getNewOrderF(){
        $query = "SELECT stock.ModelID, stock.Name, items.Size, items.Image, items.ItemID, items.Price 
                    FROM stock
                    INNER JOIN items ON stock.ModelID=items.ModelID
                    WHERE stock.Category='Ferroli'";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getNewOrderA(){
        $query = "SELECT stock.ModelID, stock.Name, items.Size, items.Image, items.ItemID, items.Price 
                    FROM stock
                    INNER JOIN items ON stock.ModelID=items.ModelID
                    WHERE stock.Category='Aquaflex'";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getNewOrder(){
        $query = "SELECT items.ModelID, stock.Name, stock.Category, items.Size, items.Image, items.ItemID, items.Price
                    FROM items
                    INNER JOIN stock ON stock.ModelID=items.ModelID";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function retrieveDealer($did){
        $query = "SELECT * FROM dealers WHERE u_id=$did LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        $finale=array();
        if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($finale, $row);
                }
                return $finale;  
                   
        }
    }

    function addOrder($dId,$total,$add){
        $query= "INSERT INTO orders (`DealerID`,`Type`,`Date`,`TotalAmount`,`shippingAddress`,`Status`) VALUES ('$dId','item order',NOW(),'$total','$add','Ordered')";
        $result = mysqli_query($this->db->conn,$query);
        return $result;
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function lastID(){
        return mysqli_insert_id($this->db->conn);
    }

    function addOrderItem($check_id,$quantity,$id){
        $query = "INSERT INTO order_items (`OrderID`,`ItemID`,`Quantity`) 
        VALUES ('$id','$check_id','$quantity')";
        $result = mysqli_query($this->db->conn,$query);
        return $result;
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }            
    }

  
    function updatepayment($id)
    {
        $query = "SELECT payment.InvoiceNo, payment.OrderID,(payment.Amount) AS total, orders.DealerID, dealers.f_name
        FROM payment 
        INNER JOIN orders ON payment.OrderID=orders.OrderID
        INNER JOIN order_items ON order_items.OrderID=orders.OrderID
        INNER JOIN dealers ON orders.DealerID=dealers.u_id
        WHERE payment.InvoiceNo='$id' && payment.Status='Not Paid' && DATEDIFF(CURRENT_DATE,payment.IssuedDate)>90 LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        $finale=array();
        if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($finale, $row);
                }
                return $finale;  
                   
        }

        
    }

    function updatepayment2($id)
    {
        $query = "SELECT payment.InvoiceNo, payment.OrderID,(payment.Discount) AS total, orders.DealerID, dealers.f_name
        FROM payment 
        INNER JOIN orders ON payment.OrderID=orders.OrderID
        INNER JOIN order_items ON order_items.OrderID=orders.OrderID
        INNER JOIN dealers ON orders.DealerID=dealers.u_id
        WHERE payment.InvoiceNo='$id' && payment.Status='Not Paid' && DATEDIFF(CURRENT_DATE,payment.IssuedDate)<90 LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        $finale=array();
        if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($finale, $row);
                }
                return $finale;  
                   
        }
        
        
    }

    function setpayment($id,$date)
    {
        $query = "UPDATE payment SET PaymentDate = '".$date."', Status = 'Pending' WHERE InvoiceNo =$id";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function setpaymentcopy($id,$date)
    {
        $query = "UPDATE payment SET PaymentDate = '".$date."', Status = 'Pending', Copy='yes' WHERE InvoiceNo =$id";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  

        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getComplaint(){
        $query = "SELECT * FROM complaint WHERE Status='forward'";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function notEligible(){
        $query = "SELECT * FROM orders INNER JOIN dealers ON orders.DealerID=dealers.u_id
                  WHERE orders.send='Yes'";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function deleteNotEligible($oid){
        $query = "UPDATE orders SET send='No' WHERE OrderID=$oid";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function profile(){
        $query = "SELECT * FROM users 
                  INNER JOIN employee ON employee.UserID=users.u_id WHERE users.u_type='sales_executive' LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function updateProfile($name,$add,$tel,$email){
        $query = "UPDATE employee 
                INNER JOIN users ON employee.UserID=users.u_id
                SET employee.Name = '".$name."',employee.Address = '".$add."', employee.Telephone = '$tel',employee.Email = '$email' 
                WHERE users.u_type ='sales_executive'";
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
}

?>