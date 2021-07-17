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
