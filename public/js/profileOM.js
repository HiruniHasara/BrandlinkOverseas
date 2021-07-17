function proSuccess(){
    swal({
        text: "Profile Updated Successfully!",
        icon: "success",
      });
  }

  function proFail(){
    swal({
        text: "Profile Update Failed!",
        icon: "warning",
      });
  }
  function passSuccess(){
    swal({
        text: "Password Updated Successfully!",
        icon: "success",
      });
  }

  function passFail(){
    swal({
        text: "Existing Password is not Verified!",
        icon: "warning",
      });
  }
  function mismatched(){
    swal({
        text: "New Passwords are Mismatching!",
        icon: "warning",
      });
  }