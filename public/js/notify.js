function invalid(){
    swal({
        icon:"error", 
        text:"Invalid ID",
        closeOnClickOutside: false,
    });
}

function sendSuccess(){
    swal({
        icon:"success", 
        title:"Message sent Successfully.",
        closeOnClickOutside: false,
    });
}

function sendFail(){
    swal({
        icon:"error", 
        title:"Failed to send.",
        closeOnClickOutside: false,
    });
}