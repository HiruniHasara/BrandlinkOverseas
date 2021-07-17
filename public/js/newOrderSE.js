function orderSuccess(){
    swal({
        text: "Placed Order Successfully!",
        icon: "success",
      });
  }

  function orderFail(){
    swal({
        text: "Failed to Place Order!",
        icon: "warning",
      });
  }

  function searchFail(){
    swal({
        text: "Undefined ID!",
        icon: "warning",
      });
  }