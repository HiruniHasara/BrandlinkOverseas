function confirmSuccess(){
    swal({
        icon:"success", 
        text:"Order Confirmed Successfully!",
        closeOnClickOutside: false,
    });
}

function confirmFail(){
    swal({
        icon:"warning", 
        text:"Error!",
        closeOnClickOutside: false,
    });
}

function rejectOrder(){
    swal({
        icon:"success", 
        text:"Order Rejected Successfully",
        closeOnClickOutside: false,
    });
}

function rejectFail(){
    swal({
        icon:"error", 
        text:"Something went wrong!",
        closeOnClickOutside: false,
    });
}

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
