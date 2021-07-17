function stockSuccess(){
    swal({
        text: "Stock Updated Successfully!",
        icon: "success",
      });
  }

  function stockFail(){
    swal({
        text: "Stock Update Failed!",
        icon: "warning",
      });
  }

  function mailSuccess(){
    swal({
        text: "Stock Updated & Invoice Sent Successfully!",
        icon: "success",
      });
  }

  function mailFail(){
    swal({
        text: "Invoice Not Sent!",
        icon: "warning",
      });
  }