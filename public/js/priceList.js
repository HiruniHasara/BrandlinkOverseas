function search(){
    var input, filter, table, tr, td, i;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("table1");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td") ; 
        for(j=0 ; j<td.length ; j++)
        {
        let tdata = td[j] ;
        if (tdata) {
            if (tdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
            break ; 
            } else {
            tr[i].style.display = "none";
            }
        } 
        }
    }
}

function reset(elementid, price){
    document.getElementById(elementid).value=price;
}

function update(elementid, itemid){
    var price=document.getElementById(elementid).value;
    if(!check(elementid)){
        return false;
    }else{
        // swal({
        //     title: "Are you sure?",
        //     text: "This action will remove this item from your shopping cart.",
        //     buttons: true,
        //     dangerMode: true,
        //     closeOnClickOutside: false,
        // })
        // .then((willDelete) => {
        //     if (willDelete) {
        //         window.location.assign("deleteCartItem/"+itemid);
        //     }
        // });
        window.location.assign("updateP/"+itemid+"/"+price);
    }
}

function check(elementid){
    if(isNaN(document.getElementById(elementid).value)){
        swal({
            icon:"error", 
            text:"Please enter a valid price",
            closeOnClickOutside: false,
        });
        return false;
    }

    if(document.getElementById(elementid).value=="0" || document.getElementById(elementid).value=="0.00" || document.getElementById(elementid).value==""){
        swal({
            icon:"error", 
            text:"Please enter a valid price",
            closeOnClickOutside: false,
        });
        return false;
    }
    return true;
}

function priceSuccess(){
    swal({
        icon:"success", 
        text:"Price Updated Successfully!",
        closeOnClickOutside: false,
    });
}

function priceFail(){
    swal({
        icon:"warning", 
        text:"Error!",
        closeOnClickOutside: false,
    });
}
