function forward(complaintid, dealerid){
    window.location.assign("complaintForward/"+complaintid+"/"+dealerid);
}

function forwardFail(){
    swal({
        icon:"error", 
        title:"Forwarding Failed.",
        closeOnClickOutside: false,
    });
}