<?php
    class Dealer_Model extends Model{
        function __construct(){
            parent::__construct(); 
        }

        function getTrendingItems(){
            return $this->db->selectWhere('stock, items, order_items', array('items.Image', 'items.ModelID', 'items.Price', 'stock.Name', 'SUM(order_items.Quantity) AS Quantity'), "order_items.ItemID=items.ItemID AND items.ModelID=stock.ModelID GROUP BY order_items.ItemID ORDER BY Quantity DESC LIMIT 5");
        }
        // SELECT order_items.ItemID, stock.Name, SUM(order_items.Quantity)AS summ FROM order_items, stock, items WHERE order_items.ItemID=items.ItemID AND items.ModelID=stock.ModelID GROUP BY ItemID ORDER BY summ DESC LIMIT 5 
        
        function getItems($category){
            return $this->db->selectWhere('stock', array('ModelID','Name','Image'), $category); 
        }

        function getPrice($id){
            return $this->db->selectWhere('items', array('MIN(Price)', 'MAX(Price)'), "ModelID='$id'");
        }

        function getModelName($id){
            return $this->db->selectWhere('stock', array('Name'), "ModelID='$id'");
        }

        function getModelItems($id){
            return $this->db->selectWhere('items', array('ModelID','ItemID', 'Size', 'Price', 'Image'), "ModelID='$id'");
        }

        function addCartItem($data){
            $result = $this->db->selectWhere('cart_items', array('1'), "CartID='{$data['cartid']}' AND ItemID='{$data['itemid']}'");
            if($result[0][1]==1){
                $this->db->updateCart('cart_items', array('Quantity' => $data['quantity']), "CartID='{$data['cartid']}' AND ItemID='{$data['itemid']}'");
            }else{
                $this->db->insert('cart_items', array('CartID' => $data['cartid'], 'ItemID' => $data['itemid'], 'Quantity' => $data['quantity']));
            }
        }        

        function getCart(){
            return $this->db->selectWhere('cart_items', array('ItemID', 'Quantity'), "CartID='{$_SESSION['cartid']}'");
        }

        function getDetails($id){
            return $this->db->selectWhere('items', array('ModelID', 'Size', 'Price', 'Image'), "ItemID='$id'");
        }

        function getDealerDetails(){
            return $this->db->selectWhere('dealers', array('f_name', 'address'), "u_id='{$_SESSION['dealerid']}'");
        }

        function deleteFromCart($id){
            $this->db->delete('cart_items', "CartID='{$_SESSION['cartid']}' AND ItemID='$id'");
        }

        function changeItemQuantity($data){
            $this->db->update('cart_items', array('Quantity' => $data['quantity']), "CartID='{$_SESSION['cartid']}' AND ItemID='{$data['itemid']}'");
        }

        function addOrder($data){
            $status=false;
            if($data['total']>0){
                $result=$this->db->selectWhere('cart_items', array('ItemID', 'Quantity'), "CartID='{$_SESSION['cartid']}'");
                
                $this->db->insert('orders', array('DealerID' => $_SESSION['dealerid'], 'Type' => "Item", 'TotalAmount' => $data['total'], 'ShippingAddress' => $data['address'], 'Status' => "Ordered"));
                
                $id=$this->db->lastID();
                foreach($result as $values){
                    $this->db->insert('order_items', array('OrderID' => $id, 'ItemID' => $values['ItemID'], 'Quantity' => $values['Quantity']));
                } 

                $status=$this->db->delete('cart_items', "CartID='{$_SESSION['cartid']}'");
            }

            if($data['board'] != 0){
                $this->db->insert('orders', array('DealerID' => $_SESSION['dealerid'], 'Type' => "Board", 'ShippingAddress' => $data['address'], 'Status' => "Ordered"));
                $id=$this->db->lastID();
                $status=$this->db->insert('order_items', array('OrderID' => $id, 'ItemID' => "DB", 'Quantity' => 1));
            }
            return $status;
        }

        function getCountOngoing(){
            return $this->db->selectWhere('orders', array('Status', 'COUNT(Status) AS Count'), "DealerID='{$_SESSION['dealerid']}' GROUP BY Status");
            // return $this->db->selectGroupBy($table, array('Status', 'COUNT(Status) AS Count'), "Status");
            // SELECT Status, COUNT(Status) AS NumberOfProducts FROM orders WHERE DealerID=3 GROUP BY Status 
            // SELECT payment.Status, COUNT(payment.Status) AS NumberOfProducts FROM orders, payment WHERE orders.OrderID=payment.OrderID AND orders.DealerID=35 GROUP BY Status 
        }

        function getCountDelivered(){
            return $this->db->selectWhere('orders, payment', array('payment.Status', 'COUNT(payment.Status) AS Count'), "orders.OrderID=payment.OrderID AND orders.DealerID='{$_SESSION['dealerid']}' GROUP BY Status");
        }

        function getHistory(){
            // return $this->db->selectWhere('orders', array('OrderID', 'TotalAmount', 'Status'), "DealerID='{$_SESSION['dealerid']}'");
            return $this->db->selectWhere('orders, order_items', array('orders.OrderID', 'orders.TotalAmount', 'orders.Status', 'GROUP_CONCAT(order_items.ItemID) AS ItemID', 'GROUP_CONCAT(order_items.Quantity) AS Quantity'), "orders.OrderID=order_items.OrderID AND orders.DealerID='{$_SESSION['dealerid']}' GROUP BY order_items.OrderID");
        }

        // SELECT orders.OrderID, orders.TotalAmount, orders.Status, order_items.ItemID, order_items.Quantity FROM orders, order_items WHERE orders.OrderID=order_items.OrderID AND orders.DealerID=3
        // SELECT orders.OrderID, orders.TotalAmount, orders.Status, order_items.ItemID, order_items.Quantity, items.ModelID FROM orders, order_items, items WHERE orders.OrderID=order_items.OrderID AND orders.DealerID=3 AND order_items.ItemID=items.ItemID 
        // SELECT orders.OrderID, orders.TotalAmount, orders.Status, order_items.ItemID, order_items.Quantity, GROUP_CONCAT(order_items.ItemID) AS yoo FROM orders, order_items WHERE orders.OrderID=order_items.OrderID AND orders.DealerID=3 GROUP BY order_items.OrderID 
        // SELECT orders.OrderID, orders.TotalAmount, orders.Status, GROUP_CONCAT(order_items.ItemID) AS ItemID, GROUP_CONCAT(order_items.Quantity) AS Quantity FROM orders, order_items WHERE orders.OrderID=order_items.OrderID AND orders.DealerID=3 GROUP BY order_items.OrderID 

        // function getOrderItems($orderid){
        //     return $this->db->selectWhere('order_items', array('ItemID', 'Quantity'), "OrderID='$orderid'");
        // }

        function getItemModelName($itemid){
            return $this->db->selectWhere('stock, items', array('stock.Name'), "stock.ModelID=items.ModelID AND ItemID='$itemid'");
        }

        function getPaymentStatus($orderid){
            return $this->db->selectWhere('payment', array('InvoiceNo', 'Discount', 'DATE_ADD(IssuedDate, INTERVAL 90 DAY) as duedate', 'Status'), "OrderID='$orderid'");
        }

        function sendComplaint($data){
            if($data['type']=="service complaint" OR $data['type']=="other"){
                return $this->db->insert('complaint', array('DealerID' => $_SESSION['dealerid'], 'Type' => $data['type'], 'Complaint' => $data['complaint'], 'Photo' => $data['img'], 'Status' => "new"));
            }else{
                $status=false;
                $status=$this->db->insert('complaint', array('DealerID' => $_SESSION['dealerid'], 'Type' => $data['type'], 'InvoiceNo' => $data['invoiceno'], 'Complaint' => $data['complaint'], 'Photo' => $data['img'], 'Status' => "new"));
                $id=$this->db->lastID();
                if($data['brand1']=="momali"){
                    $status=$this->db->insert('complaint_brand', array('ComplaintID' => $id, 'Brand' => $data['brand1']));
                }
                if($data['brand2']=="ferroli"){
                    $status=$this->db->insert('complaint_brand', array('ComplaintID' => $id, 'Brand' => $data['brand2']));
                }
                if($data['brand3']=="aquaflex"){
                    $status=$this->db->insert('complaint_brand', array('ComplaintID' => $id, 'Brand' => $data['brand3']));
                }
                return $status;
            }
        }

        function getProfile(){
            return $this->db->selectWhere('users, dealers', array('users.u_name', 'dealers.f_name', 'dealers.address', 'dealers.email', 'dealers.contact'), "users.u_id=dealers.u_id AND users.u_id='{$_SESSION['dealerid']}'");
        }

        function getOldPassword(){
            return $this->db->selectWhere('users', array('password'), "u_id='{$_SESSION['dealerid']}'");
        }

        function updatePassword($newpswrd){
            return $this->db->update('users', array('password' => $newpswrd), "u_id='{$_SESSION['dealerid']}'");
        }

        function updateProfile($data){
            return $this->db->update('users, dealers', array('users.u_name' => $data['username'], 'dealers.f_name' => $data['name'], 'dealers.address' => $data['address'], 'dealers.contact' => $data['telephone'], 'dealers.email' => $data['email']), "users.u_id=dealers.u_id AND users.u_id='{$_SESSION['dealerid']}'");
        }

        function deleteDealerAcc(){
            return $this->db->joindelete('users, dealers', "users.u_id=dealers.u_id AND users.u_id='{$_SESSION['dealerid']}'");
        }
        // DELETE users, dealers FROM users,dealers WHERE users.u_id=dealers.u_id AND users.u_id=36 

        function namecheck(){
            return $this->db->SelectAll('users','u_name');
        }

        // function cartItem($data){
        //     $this->db->updateCart('cart',array('amount' => $data['amount']),"ID = '{$data['ID']}'");
        // }
    }
?>