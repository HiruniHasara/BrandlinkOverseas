function deleteItem(clickedbutton){
    var itemid=clickedbutton.id;
    swal({
        title: "Are you sure?",
        text: "This action will remove this item from your shopping cart.",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
    })
    .then((willDelete) => {
        if (willDelete) {
            window.location.assign("deleteCartItem/"+itemid);
        }
    });
}

function changeQuantity(quantity, price, clickedbutton){
    var itemid=clickedbutton.id;
    
    swal({
        title: "Sub Total: Rs."+quantity*price,
        text: "Quantity",
        buttons: [true, "Save Changes"],
        closeOnClickOutside: false,
        content: {
            element: "input",
            attributes: {
                type: "number",
                min: 1,
                max: 1000,
                step: 1,
                value: quantity,
            },
        },
    })
    .then((value) => {
        if(value!=null && value!=""){
            window.location.assign("changeQuantity/"+itemid+"/"+value);
        }
    });
}

function boardPopup(){
    var modelid = document.getElementById("changeValue").value;
    if(modelid==0){
        swal({
            title: "Display Board Order",
            text: "The display boards get differ according to the dealer and the location. Therefore the price will be informed at the distpaching.",
            icon: "info",
            closeOnClickOutside: false,
        });
        document.getElementById("changeValue").value=1;
    }else{
        document.getElementById("changeValue").value=0;
    } 
}

function orderSuccess(){
    swal({
        icon:"success", 
        title:"Order Placed Successfully!",
        closeOnClickOutside: false,
    });
}

function orderFail(){
    swal({
        icon:"error", 
        title:"Order Placement Failed.",
        closeOnClickOutside: false,
    });
}