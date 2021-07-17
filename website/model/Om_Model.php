<?php

class Om_Model extends Model{
    function __construct(){
        parent::__construct(); 
    }

    function getMomali(){
        return $this->db->selectWhere('stock', '*' , "Category='Momali'"); 
    }

    function getItem($id){
        return $this->db->selectWhere('items', '*' , "ModelID='$id'"); 
    }

    function getID($id){
        return $this->db->selectWhere('stock', '*' , "ModelID='$id'"); 
    }

    function getFerroli(){
        return $this->db->selectWhere('stock', '*' , "Category='Ferroli'"); 
    }

    function getAqua(){
        return $this->db->selectWhere('stock', '*' , "Category='Aquaflex'"); 
    }

    function getSMomali(){
        return $this->db->selectWhere('spareparts_stock', '*' , "category='momali'"); 
    }
 
    function getSFerroli(){
        return $this->db->selectWhere('spareparts_stock', '*' , "category='ferroli'"); 
    }

    function getSAqua(){
        return $this->db->selectWhere('spareparts_stock', '*' , "category='aquaflex'"); 
    }

    function insert($item,$name,$image,$table,$category)
    {
        $query = "insert into $table (`ModelID`,`Name`,`Category`,`Image`) values('$item','$name','$category','$image')";
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

    function insertItem($id,$item,$size,$quantity,$price,$photoTmpPath,$table)
    {
        if($size != "" && $photoTmpPath != ""){
            $image = addslashes(file_get_contents($photoTmpPath));
            $query = "insert into $table (`ModelID`,`ItemID`,`Size`,`Quantity`,`Price`,`Image`) values('$id','$item','$size','$quantity','$price','$image')";
            $result = mysqli_query($this->db->conn,$query);
        }
        else{
            $query = "INSERT INTO $table (`ModelID`,`ItemID`,`Size`,`Quantity`,`Price`,`Image`) 
            SELECT '$id','$item','default','$quantity','$price', stock.Image
            FROM stock
            WHERE stock.ModelID='$id'";
            $result = mysqli_query($this->db->conn,$query);  
        }
        
        
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function insertS($item,$name,$quantity,$price,$img,$table,$category)
    {
        $query = "insert into $table (`itemNo`,`name`,`quantity`,`unitPrice`,`photo`,`category`) values('$item','$name','$quantity','$price','$img','$category')";
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

    function insertcart($item,$table)
    {
        $query = "insert into $table (`ID`) values('$item')";
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


    function fetch($id,$table,$category)
    {
        $query = "SELECT * FROM $table WHERE ModelID='$id' && Category='$category' LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        $finale=array();
        if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($finale, $row);
                }
                return $finale;                
        }
        
    }

    function fetchS($id,$table,$category)
    {
        $query = "SELECT * FROM $table WHERE itemNo='$id' && category='$category' LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        $finale=array();
        if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($finale, $row);
                }
                return $finale;                
        }
        
    }

    function fetchName($name,$table,$category)
    {
        $query = "SELECT * FROM $table WHERE Name='$name' && Category='$category' LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        $finale=array();
        if (mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    array_push($finale, $row);
                }
                return $finale;                
        }
        
    }

    public function update($id,$name,$photoTmpPath,$table,$category)
    {
        if($photoTmpPath != ""){
            $image = addslashes(file_get_contents($photoTmpPath));
            $query = "UPDATE $table SET Name = '".$name."', Image='$image' WHERE ModelID ='".$id."' && Category='$category'";
            $result = mysqli_query($this->db->conn,$query);
           
        } else{
            $query = "UPDATE $table SET Name = '".$name."' WHERE ModelID ='".$id."' && Category='$category'";
            $result = mysqli_query($this->db->conn,$query);  
           
        }
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
        
        
    }

    public function updateI($id,$photoTmpPath,$table){
        if($photoTmpPath != ""){
        $image = addslashes(file_get_contents($photoTmpPath));
        $query = "UPDATE $table SET Image = '$image' WHERE ModelID='$id' && Size='default'";
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
    }

    public function updateItem($id,$item,$size,$quantity,$price,$photoTmpPath,$table)
    {
        if($photoTmpPath != ""){
            $image = addslashes(file_get_contents($photoTmpPath));
            $query = "UPDATE $table SET Size = '".$size."',Quantity = '".$quantity."',Price = '".$price."', Image='$image' WHERE ModelID ='".$id."' && ItemID = '".$item."";
            $result = mysqli_query($this->db->conn,$query);
        } else{
            $query = "UPDATE $table SET Size = '".$size."',Quantity = '".$quantity."',Price = '".$price."' WHERE ModelID ='".$id."' && ItemID = '".$item."'";
            $result = mysqli_query($this->db->conn,$query);   
        }

        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

    public function updateS($id,$name,$quantity,$price,$photoTmpPath,$table,$category)
    {
        if($photoTmpPath != ""){
            $image = addslashes(file_get_contents($photoTmpPath));
            $query = "UPDATE $table SET name = '".$name."',itemNo = '".$id."',quantity = '".$quantity."',unitPrice = '".$price."', photo='$image' WHERE itemNo ='".$id."' && category='$category'";
            $result = mysqli_query($this->db->conn,$query);
        } else{
            $query = "UPDATE $table SET name = '".$name."',itemNo = '".$id."',quantity = '".$quantity."',unitPrice = '".$price."' WHERE itemNo ='".$id."' && category='$category'";
            $result = mysqli_query($this->db->conn,$query);   
        }

        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }

    public function delete($id,$table,$category)
    {
        $query = "DELETE FROM `$table` WHERE ModelID = '$id' && Category='$category'";
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

    public function deleteI($id,$table){
        $query = "DELETE FROM `$table` WHERE ModelID = '$id'";
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

    public function deleteItem($id,$item,$table)
    {
        $query = "DELETE FROM `$table` WHERE ModelID = '$id' && ItemID='$item'";
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

    public function deleteS($id,$table,$category)
    {
        $query = "delete from `$table` where itemNo = '$id' && category='$category'";
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

    public function getAOrders()
    {
        $query = "SELECT orders.OrderID, dealers.f_name, dealers.contact, orders.TotalAmount, GROUP_CONCAT(order_items.ItemID 
        ORDER BY order_items.ItemID ASC SEPARATOR '<br><br>') AS id, GROUP_CONCAT(stock.Name  ORDER BY stock.Name ASC SEPARATOR '<br><br>') AS name, GROUP_CONCAT(order_items.Quantity ORDER BY order_items.Quantity ASC SEPARATOR '<br><br>') AS quantity 
                    FROM order_items 
                    INNER JOIN orders ON orders.OrderID=order_items.OrderID
                    INNER JOIN items ON order_items.ItemID=items.ItemID
                    INNER JOIN stock ON items.ModelID=stock.ModelID
                    INNER JOIN dealers ON orders.DealerID=dealers.u_id
                    WHERE orders.Status='Approved' GROUP BY OrderID";
        $result = mysqli_query($this->db->conn,$query);
        
        return $result;             
        
    }

    public function updatestock($oid)
    {
        $query = "UPDATE items
                    INNER JOIN order_items ON items.ItemID=order_items.ItemID
                    INNER JOIN orders ON order_items.ORderID=orders.OrderID
                    SET items.Quantity = items.Quantity-order_items.Quantity
                    WHERE orders.OrderID='$oid' && orders.Status='Approved'"; 
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

    public function getInvoice($id)
    {
        $query = "SELECT stock.ModelID, stock.Name, items.Size, order_items.Quantity, order_items.Quantity*items.Price AS Amount
                    FROM orders
                    INNER JOIN order_items ON orders.OrderID=order_items.OrderID
                    INNER JOIN items ON order_items.ItemID=items.ItemID
                    INNER JOIN stock ON items.ModelID=stock.ModelID
                    WHERE orders.OrderID='$id'";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function getInvoiceDealer($id)
    {
        $query = "SELECT orders.OrderID, dealers.f_name, dealers.address, dealers.email, dealers.contact, orders.TotalAmount, orders.Date
                    FROM orders
                    INNER JOIN order_items ON orders.OrderID=order_items.OrderID
                    INNER JOIN items ON order_items.ItemID=items.ItemID
                    INNER JOIN stock ON items.ModelID=stock.ModelID
                    INNER JOIN dealers ON dealers.u_id=orders.DealerID
                    WHERE orders.OrderID='$id' LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function sendInvoice($oid,$date,$total)
    {
        $discount = ($total * 0.95);
        $query = "INSERT INTO payment (`OrderID`,`Amount`,`Discount`,`IssuedDate`,`Status`) VALUES ('$oid','$total','$discount','$date','Not Paid')";
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
    public function updateOrder($oid){
        $query = "UPDATE orders SET `Status`='Delivered' WHERE OrderID='$oid'";
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

    public function stockreport()
    {
        $query = "SELECT stock.ModelID, stock.Name, sum(items.Quantity) AS TotalQuantity 
                    FROM stock
                    INNER JOIN items ON items.ModelID=stock.ModelID
                    group by ModelID";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function sparerep()
    {
        $query = "SELECT * FROM spareparts_stock group by itemNo";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function stockcategory()
    {
        $query = "SELECT stock.Category, sum(items.Quantity) AS TotalQuantity 
                    FROM stock 
                    INNER JOIN items ON items.ModelID=stock.ModelID
                    group by Category";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function sparecategory()
    {
        $query = "SELECT category, sum(quantity) AS TotalQuantity FROM spareparts_stock group by category";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function getreport($datefrom,$dateto)
    {
        $query = "SELECT stock.ModelID, order_items.ItemID, stock.Name, sum(order_items.Quantity) AS TotalQuantity
                    FROM order_items 
                    INNER JOIN orders ON orders.OrderID=order_items.OrderID
                    INNER JOIN items ON order_items.ItemID=items.ItemID
                    INNER JOIN stock ON items.ModelID=stock.ModelID
                    WHERE Date between '$datefrom' and '$dateto' && orders.Status='Delivered' group by ModelID";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function monthrep(){
        $query = "SELECT stock.ModelID, order_items.ItemID, stock.Name, sum(order_items.Quantity) AS TotalQuantity
        FROM order_items
        INNER JOIN orders ON orders.OrderID=order_items.OrderID
        INNER JOIN items ON order_items.ItemID=items.ItemID
        INNER JOIN stock ON items.ModelID=stock.ModelID 
        WHERE Date >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) && orders.Status='Delivered' group by ModelID";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function annualrep(){
        $query = "SELECT stock.ModelID, order_items.ItemID, stock.Name, sum(order_items.Quantity) AS TotalQuantity
        FROM order_items
        INNER JOIN orders ON orders.OrderID=order_items.OrderID
        INNER JOIN items ON order_items.ItemID=items.ItemID
        INNER JOIN stock ON items.ModelID=stock.ModelID 
        WHERE Date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY) && orders.Status='Delivered' group by ModelID";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function notification(){
        $query = "SELECT * FROM items 
                INNER JOIN stock ON stock.ModelID = items.ModelID
                WHERE items.Quantity <= items.ReorderLevel";
        $result = mysqli_query($this->db->conn,$query);
        return $result;  
    }

    public function count(){
        $query = "SELECT COUNT(*) AS totalcount FROM items WHERE `Quantity` < `ReorderLevel`";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }
    
    public function profile(){
        $query = "SELECT * FROM users 
                  INNER JOIN employee ON employee.UserID=users.u_id WHERE users.u_type='op_manager' LIMIT 1";
        $result = mysqli_query($this->db->conn,$query);
        return $result; 
    }

    public function updateProfile($name,$add,$tel,$email){
        $query = "UPDATE employee 
                INNER JOIN users ON employee.UserID=users.u_id
                SET employee.Name = '".$name."',employee.Address = '".$add."', employee.Telephone = '$tel',employee.Email = '$email' 
                WHERE users.u_type ='op_manager'";
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