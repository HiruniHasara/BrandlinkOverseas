window.onload = function() {
    document.getElementById("details").style.display = 'none';
}

function changeContent(){
    var x = document.getElementById("details");
    x.style.display = "block";
}

function hideDetails(){
    var x = document.getElementById("details");
    x.style.display = "none";
}

function checkform(){
    var a=document.getElementById('complaintForm');

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
    if(document.complaintform.complaintType.value=="order complaint"){
        if(document.complaintform.invoiceno.value==""){
            swal({
                icon:"error", 
                text:"Please enter the Invoice No.",
                closeOnClickOutside: false,
            });
            return false;
        } 
    }
    return true;
}

function sendingSuccess(){
    swal({
        icon:"success", 
        title:"Sent Successfully.",
        closeOnClickOutside: false,
    });
}

function sendingFail(){
    swal({
        icon:"error", 
        title:"Sending Failed. Please check whether the Invoice No. is correct.",
        closeOnClickOutside: false,
    });
}

function onlyImg(){
    swal({
        icon:"error", 
        title:"Only image files are allowed.",
        closeOnClickOutside: false,
    });
}