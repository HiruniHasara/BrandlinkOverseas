function checkform(){
    var a=document.getElementById('employeeform');

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
    if(isNaN(document.employeeform.tp.value)){
        swal({
            icon:"error", 
            text:"Please enter a valid telephone number",
            closeOnClickOutside: false,
        });
        return false;
    }

    if(document.employeeform.tp.value=="0"){
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

function deleteEmployee(){
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
