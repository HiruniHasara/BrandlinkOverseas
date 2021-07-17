window.onload = function() {
    document.getElementById("passwordpanel").style.display = 'none';
}

function showContent(){
    document.getElementById("password").style.display = "none";
    document.getElementById("passwordpanel").style.display = "block";
}

function hideContent(){
    document.getElementById("password").style.display = "block";
    document.getElementById("passwordpanel").style.display = "none";
}

function validityChecking(){
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;

    if (document.passwordform.newpassword.value.match(lowerCaseLetters) && document.passwordform.newpassword.value.match(upperCaseLetters) && document.passwordform.newpassword.value.match(numbers) && document.passwordform.newpassword.value.length>=8){
        document.getElementById('validity').style.color = 'green';
        document.getElementById('validity').innerHTML = 'strong password';
    }else {
        document.getElementById('validity').style.color = 'red';
        document.getElementById('validity').innerHTML = 'weak password';
    }
}

function pswrdMatching(){
    if (document.passwordform.newpassword.value == document.passwordform.repassword.value){
        document.getElementById('popup').style.color = 'green';
        document.getElementById('popup').innerHTML = 'matching';
    }else {
        document.getElementById('popup').style.color = 'red';
        document.getElementById('popup').innerHTML = 'not matching';
    }
}

function checkform(){
    var a=document.getElementById('passwordForm');

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
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;

    if(document.passwordform.newpassword.value != document.passwordform.repassword.value){
        swal({
            icon:"error", 
            text:"Passwords are not matching",
            closeOnClickOutside: false,
        });
        return false;
    }

    // if (document.passwordform.newpassword.value.match(lowerCaseLetters) || document.passwordform.newpassword.value.match(upperCaseLetters) || document.passwordform.newpassword.value.match(numbers) || document.passwordform.newpassword.value.length>=8){
    //     swal({
    //         icon:"error", 
    //         text:"Your password is too weak to proceed",
    //         closeOnClickOutside: false,
    //     });
    //     return false;
    // }

    return true;
}

function checkComplete(){
    var a=document.getElementById('bioForm');

    a.addEventListener('submit', function(event) {
        event.preventDefault();
        if(!checking()){
           return false;
        }
        if(checking()){
            a.submit();
        }
    });
}

function checking(){
    var mailFormat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

    // if(!document.bioform.mail.value.match(mailFormat)){
    //     swal({
    //         icon:"error", 
    //         text:"Please enter the email correctly",
    //         closeOnClickOutside: false,
    //     });
    //     return false;
    // }

    if (isNaN(document.bioform.telephone.value)){
        swal({
            icon:"error", 
            text:"Please enter the telephone number correctly",
            closeOnClickOutside: false,
        });
        return false;
    }

    return true;
}

function deleteProfile(){
        swal({
            title: "Are you sure?",
            text: "This action will delete your account permanently.",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location.assign("deleteAccount");
            }
        });
}

function updateSuccess(){
    swal({
        icon:"success", 
        title:"Updated Successfully.",
        closeOnClickOutside: false,
    });
}

function updateFail(){
    swal({
        icon:"error", 
        title:"Failed to update.",
        closeOnClickOutside: false,
    });
}

function wrongPswrd(){
    swal({
        icon:"error", 
        title:"Please enter the old password correctly.",
        closeOnClickOutside: false,
    });
}

function deleteFail(){
    swal({
        icon:"error", 
        title:"Failed to delete.",
        closeOnClickOutside: false,
    });
}
