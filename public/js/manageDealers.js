function checkform(){
    var a=document.getElementById('dealerform');

    a.addEventListener('submit', function(event) {
        event.preventDefault();
        if(!check()){
           return false;
        }
        if(check()){
            a.submit();
        }
    });
}

function check(){
    if(isNaN(document.dealerform.tp.value)){
        swal({
            icon:"error", 
            text:"Please enter a valid telephone number",
            closeOnClickOutside: false,
        });
        return false;
    }

    if(document.dealerform.tp.value=="0"){
        swal({
            icon:"error", 
            text:"Please enter a telephone number",
            closeOnClickOutside: false,
        });
        return false;
    }
    return true;
}

function updateSuccess(){
    swal({
        icon:"success", 
        text:"Records Updated Successfully!",
        closeOnClickOutside: false,
    });
}

function updateFail(){
    swal({
        icon:"warning", 
        text:"Error!",
        closeOnClickOutside: false,
    });
}

function insertSuccess(){
    swal({
        icon:"success", 
        text:"Records Inserted Successfully!",
        closeOnClickOutside: false,
    });
}

function insertFail(){
    swal({
        icon:"warning", 
        text:"Error!",
        closeOnClickOutside: false,
    });
}

function deletedealer(){
    swal({
        icon:"success", 
        text:"Deleted Successfully",
        closeOnClickOutside: false,
    });
}

function invalid(){
    swal({
        icon:"error", 
        text:"Invalid ID",
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
