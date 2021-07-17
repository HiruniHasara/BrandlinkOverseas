function unavailable(cross, orderid, number, dealerid){
    var itemcount=document.getElementById(number+","+orderid).value;
    var unavailable=document.getElementById(orderid).value;
    var itemid=cross.id;

    swal({
        title: "Are you sure?",
        text: "This action will remove the item "+itemid+" from the new order.",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
    })
    .then((willDelete) => {
        if (willDelete) {
            if(itemcount==1 && unavailable==1){
                window.location.assign("deleteOrder/"+orderid+"/"+dealerid);
            }else{
                window.location.assign("delete/"+orderid+"/"+itemid);
            }
        }
    });
}

function hoverIn(cross, orderid){
    document.getElementById(orderid+cross.id).style.backgroundColor = 'rgb(135,206,250)';
}

function hoverOut(cross, orderid){
    document.getElementById(orderid+cross.id).style.backgroundColor = 'transparent';
}

function forwardOrder(orderid, deletecount){
    if(document.getElementById(orderid).value == 1){
        swal({
            icon:"warning", 
            text:"There are unavailable items. Please remove them before forwarding.",
            closeOnClickOutside: false,
        });
        return false;
    }

    if(deletecount > 0){
        swal({
            icon:"warning", 
            text:"You have deleted items in this order. Please message and inform the dealer before forwarding.",
            closeOnClickOutside: false,
        });
        return false;
    }

    window.location.assign("forward/"+orderid);
}

function deleteOrder(orderid, number, dealerid){
    if(document.getElementById(number).value == 1){
        swal({
            icon:"error", 
            text:"Can't delete this order. This order contains available items.",
            closeOnClickOutside: false,
        });
    }else{
        swal({
            title: "Are you sure?",
            text: "This action will remove this new order due to items' unavailability and will notify the dealer.",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.assign("deleteOrder/"+orderid+"/"+dealerid);
            }
        });
    }
}

function message(orderid, dealerid, deletecount){
    window.location.assign("inform/"+orderid+"/"+dealerid+"/"+deletecount);
}

function forwardSuccess(){
    swal({
        icon:"success", 
        title:"Order Forwarded Successfully!",
        closeOnClickOutside: false,
    });
}

function forwardFail(){
    swal({
        icon:"error", 
        title:"Forwarding Failed.",
        closeOnClickOutside: false,
    });
}

function removeFail(){
    swal({
        icon:"error", 
        title:"Item removing Failed.",
        closeOnClickOutside: false,
    });
}

function deleteSuccess(){
    swal({
        icon:"success", 
        title:"Order Deleted Successfully!",
        closeOnClickOutside: false,
    });
}

function deleteFail(){
    swal({
        icon:"error", 
        title:"Order Deletion Failed.",
        closeOnClickOutside: false,
    });
}