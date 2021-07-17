<?php
    class Admin_Model extends Model{
        function __construct(){
            parent::__construct(); 
        }

        function getDealer(){
            return $this->db->selectAll('pending_dealers','*'); 
        }

        function searchID($id){
            return $this->db->selectWhere('dealers','*', "u_id='$id'"); 
        }

        function updateDealer($data){
            return $this->db->update('dealers',array('f_name' => $data['f_name'],'address' => $data['address'],'email' => $data['email'],'contact' => $data['contact']),"u_id = '{$data['id']}'");
        }

        function deleteDealer($id){
            return $this->db->delete('users',"u_id='$id'"); 
        }

       function acceptRequest($id){
            $result=$this->db->selectWhere('pending_dealers', array('UserName', 'Password', 'Name', 'Address', 'Telephone', 'Email'), "UserID=$id");
            $this->db->insert('users', array('u_name' => $result[0]['UserName'], 'password' => $result[0]['Password']));
            $Uid=$this->db->lastID();
            $this->db->insert('dealers', array('u_id' => $Uid, 'f_name' => $result[0]['Name'], 'address' => $result[0]['Address'], 'contact' => $result[0]['Telephone'], 'email' => $result[0]['Email']));
            $this->db->insert('Cart', array('DealerID' => $Uid));
            $this->db->delete('pending_dealers', "UserID=$id");
            return $this->db->selectWhere('dealers', array('Email'), "u_id=$Uid");
        }

        function getRegDealer(){
            return $this->db->selectAll('dealers','*'); 
        }

        function rejectRequest($id){
            $result=$this->db->selectWhere('pending_dealers', array('Email'), "UserID=$id");
            $this->db->delete('pending_dealers',"UserID=$id");
            return $result;
        }

        function salesreport(){
            $query = "SELECT Type, COUNT(*) AS total FROM orders GROUP BY Type";
            $result = mysqli_query($this->db->conn,$query);
            return $result;  
        }

        function salesStatus(){
            $query = "SELECT Status, COUNT(*) AS total FROM orders GROUP BY Status";
            $result = mysqli_query($this->db->conn,$query);
            return $result; 
        }

        public function monthrep(){
            $query = "SELECT stock.ModelID, order_items.ItemID, stock.Name, sum(order_items.Quantity)*items.Price AS Total
            FROM order_items
            INNER JOIN orders ON orders.OrderID=order_items.OrderID
            INNER JOIN items ON order_items.ItemID=items.ItemID
            INNER JOIN stock ON items.ModelID=stock.ModelID 
            WHERE Date >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) && orders.Status='Delivered' group by order_items.ItemID";
            $result = mysqli_query($this->db->conn,$query);
            return $result;  
           
        }

        public function annualrep(){
            $query = "SELECT stock.ModelID, order_items.ItemID, stock.Name, sum(order_items.Quantity)*items.Price AS Total
            FROM order_items
            INNER JOIN orders ON orders.OrderID=order_items.OrderID
            INNER JOIN items ON order_items.ItemID=items.ItemID
            INNER JOIN stock ON items.ModelID=stock.ModelID 
            WHERE Date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY) && orders.Status='Delivered' group by order_items.ItemID";
            $result = mysqli_query($this->db->conn,$query);
            return $result;  
           
        }

        public function getreport($datefrom,$dateto){
            $query = "SELECT stock.ModelID, order_items.ItemID, stock.Name, sum(order_items.Quantity)*items.Price AS Total
            FROM order_items
            INNER JOIN orders ON orders.OrderID=order_items.OrderID
            INNER JOIN items ON order_items.ItemID=items.ItemID
            INNER JOIN stock ON items.ModelID=stock.ModelID 
            WHERE Date between '$datefrom' and '$dateto' && orders.Status='Delivered' group by order_items.ItemID";
            $result = mysqli_query($this->db->conn,$query);
            return $result;  
        
       }

       public function complaintCategory(){
           $query = "SELECT complaint_brand.Brand, COUNT(*) AS total FROM complaint_brand group by Brand";
           $result = mysqli_query($this->db->conn,$query);
           return $result;  
       }
       function getEmployee(){
            return $this->db->quaryexe("SELECT employee.UserID,employee.Name,employee.Address,employee.Telephone,employee.Email,users.u_type,users.u_name FROM employee INNER JOIN users ON users.u_id = employee.UserID"); 
        }

        function addEmployee($data,$pass){
            $this->db->insert('users', array('u_name' => $data['u_name'], 'password' => $pass, 'u_type' => $data['type']));
            $Uid=$this->db->lastID();
            return $this->db->insert('employee', array('UserID' => $Uid, 'Name' => $data['name'], 'Address' => $data['address'], 'Telephone' => $data['tp'], 'Email' => $data['email']));

        }

        function deleteteEmployee($data){
            return $this->db->delete('users',"u_id='$id'"); 
        }

    // function deleteEmployee($id){
    //     return $this->db->delete('users',"UserID='$id'"); 
    // }

    function getProfile(){
        return $this->db->selectWhere('users, employee', array('users.u_name', 'employee.Name', 'employee.Address', 'employee.Email', 'employee.Telephone'), "users.u_id=employee.UserID AND users.u_id='{$_SESSION['adminid']}'");
    }

    function getOldPassword(){
        return $this->db->selectWhere('users', array('password'), "u_id='{$_SESSION['adminid']}'");
    }

    function updatePassword($newpswrd){
        return $this->db->update('users', array('password' => $newpswrd), "u_id='{$_SESSION['adminid']}'");
    }

    function updateProfile($data){
        return $this->db->update('users, employee', array('users.u_name' => $data['username'], 'employee.Name' => $data['name'], 'employee.Address' => $data['address'], 'employee.Telephone' => $data['telephone'], 'employee.Email' => $data['email']), "users.u_id=employee.UserID AND users.u_id='{$_SESSION['adminid']}'");
    }
    }

?>