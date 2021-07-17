<?php
    class SC_Model extends Model{
        function __construct(){
            parent::__construct(); 
        }

        function getPrice($category){
            return $this->db->selectWhere('stock, items', array('stock.ModelID', 'stock.Name', 'stock.Image', 'GROUP_CONCAT(items.ItemID) AS ItemID', 'GROUP_CONCAT(items.Size) AS Size', 'GROUP_CONCAT(items.Price) AS Price'), "stock.ModelID=items.ModelID AND stock.Category='$category' GROUP BY stock.ModelID ORDER BY stock.ModelID"); 
        }
        // SELECT stock.ModelID, stock.Name, GROUP_CONCAT(items.ItemID) AS ItemID, GROUP_CONCAT(items.Price) AS Price from stock, items WHERE stock.ModelID=items.ModelID AND stock.Category="momali" GROUP BY stock.ModelID ORDER BY stock.ModelID 

        function updatePrice($data){
            return $this->db->update('items',array('Price' => $data['price']), "ItemID = '{$data['itemid']}'");
        }

        function getStock($category){
            return $this->db->selectWhere('stock, items', array('stock.ModelID', 'stock.Name', 'items.ItemID', 'items.Size', 'items.Quantity'), "stock.ModelID=items.ModelID AND stock.Category='$category' ORDER BY stock.ModelID"); 
        }

        function getModelCount($category){
            return $this->db->selectWhere('stock', array('COUNT(ModelID) as count'), "Category='$category'"); 
            // SELECT COUNT(ModelID) AS NumberOfProducts FROM stock WHERE Category="momali" 
        }

        function getDealerName($id){
            return $this->db->selectWhere('dealers', array('u_id', 'f_name', 'email'), "u_id='$id'"); 
        }

        function getComplaints(){
            return $this->db->selectWhere('complaint', array('ComplaintID', 'DealerID', 'Type', 'Complaint', 'Photo'), "Status='new'"); 
        }

        function getCount(){
            return $this->db->selectGroupBy('complaint', array('Type', 'COUNT(Type) AS Count'), "Type, Status HAVING Status='new'");
        }
        // SELECT Type, COUNT(Type) AS NumberOfProducts FROM complaint GROUP BY Type, Status HAVING Status='new' 

        function forwardToSE($complaintid){
            return $this->db->update('complaint', array('Status' => 'forward'), "ComplaintID='$complaintid'");
        }
        
        function getProfile(){
            return $this->db->selectWhere('users, employee', array('users.u_name', 'employee.Name', 'employee.Address', 'employee.Email', 'employee.Telephone'), "users.u_id=employee.UserID AND users.u_id='{$_SESSION['scid']}'");
        }

        function getOldPassword(){
            return $this->db->selectWhere('users', array('password'), "u_id='{$_SESSION['scid']}'");
        }

        function updatePassword($newpswrd){
            return $this->db->update('users', array('password' => $newpswrd), "u_id='{$_SESSION['scid']}'");
        }

        function updateProfile($data){
            return $this->db->update('users, employee', array('users.u_name' => $data['username'], 'employee.Name' => $data['name'], 'employee.Address' => $data['address'], 'employee.Telephone' => $data['telephone'], 'employee.Email' => $data['email']), "users.u_id=employee.UserID AND users.u_id='{$_SESSION['scid']}'");
        }

        function getNewOrders(){
            return $this->db->selectWhere('orders, order_items', array('orders.OrderID', 'orders.DealerID', 'GROUP_CONCAT(order_items.ItemID) AS ItemID', 'GROUP_CONCAT(order_items.Quantity) AS Quantity'), "orders.OrderID=order_items.OrderID AND orders.Status='Ordered' AND order_items.isDeleted='NO' GROUP BY order_items.OrderID");
        }

        function getItemModelName($itemid){
            return $this->db->selectWhere('stock, items', array('stock.Name', 'items.Quantity'), "stock.ModelID=items.ModelID AND ItemID='$itemid'");
        }

        function getItemCount(){
            return $this->db->selectWhere('orders, order_items', array('order_items.ItemID', 'SUM(order_items.Quantity) as tobeIssued'), "orders.OrderID=order_items.OrderID AND (orders.Status='pending' OR orders.Status='approved') GROUP BY order_items.ItemID");
        }

        function getisDeleteCount(){
            return $this->db->selectWhere('orders, order_items', array("SUM(CASE WHEN order_items.isDeleted='YES' THEN 1 ELSE 0 END) as deletecount"), "orders.OrderID=order_items.OrderID AND orders.Status='Ordered' GROUP BY order_items.OrderID");
        }
        // SELECT orders.OrderID, SUM(CASE WHEN order_items.isDeleted='YES' THEN 1 ELSE 0 END) FROM orders, order_items WHERE orders.OrderID=order_items.OrderID AND orders.Status='Ordered' GROUP BY order_items.OrderID

        function forwardToHOM($orderid){
            return $this->db->update('orders', array('Status' => 'Pending'), "OrderID='$orderid'");
        }

        function removeItem($orderid, $itemid){
            return $this->db->update('order_items', array('isDeleted' => 'YES'), "OrderID='$orderid' AND ItemID='$itemid'");
        }

        function getDeletedItems($orderid){
            return $this->db->selectWhere('stock, items, order_items', array('stock.Name', 'order_items.ItemID'), "order_items.OrderID='$orderid' AND order_items.isDeleted='YES' AND items.ItemID=order_items.ItemID AND items.ModelID=stock.ModelID");
        }
        // SELECT order_items.ItemID, stock.Name from order_items, stock, items WHERE order_items.OrderID=42 AND order_items.isDeleted='YES' AND items.ItemID=order_items.ItemID AND items.ModelID=stock.ModelID
        
        function deleteItem($orderid){
            $this->db->delete('order_items', "OrderID='$orderid' AND isDeleted='YES'");
        }

        function orderDelete($orderid){
            return $this->db->delete('orders', "OrderID='$orderid'");
        }

        function searchID($array,$id){
            return $this->db->selectWhere('item', $array, "ItemID='$id'"); 
        }
    }
?>