function validatestock() {
    var form = document.getElementById("myform");
    form.addEventListener('submit', function(event) {
        if (
          
          validatestock()!=false
        ) 
        {
        form.submit();
        }
      });
         
          var itemid=document.getElementById("id").value;  
          var itemName=document.getElementById("name").value;  
          var letters = /^[a-zA-Z][a-zA-Z\s]*$/;
          var isValid = letters.test(document.getElementById("name").value);
       
          if (itemid==null || itemid==""){  
            swal({
              icon:"error",
              text: "Item id is required",
              closeOnClickOutside: false,
            }); 
          return false;   
          }else if(itemName==null || itemName==""){ 
            swal({
              icon:"error",
              text: "Item name is required",
              closeOnClickOutside: false,
            });   
          return false;
          }else if(!isValid){ 
            swal({
              icon:"error",
              text: "Item name should only contain letters",
              closeOnClickOutside: false,
            });
          return false; 
          }
      }  


  function addSuccess(){
    swal({
        text: "Added Successfully!",
        icon: "success",
      });
  }

  function addFail(){
    swal({
        text: "Adding Failed!",
        icon: "warning",
      });
  }

  function updateSuccess(){
    swal({
        text: "Updated Successfully!",
        icon: "success",
      });
  }

  function updateFail(){
    swal({
        text: "Updating Failed!",
        icon: "warning",
      });
  }

  function deleteSuccess(){
    swal({
        text: "Deleted Successfully!",
        icon: "success",
      });
  }

  function deleteFail(){
    swal({
        text: "Deleting Failed!",
        icon: "warning",
      });
  }

  function searchFail(){
    swal({
        text: "Undefined ID!",
        icon: "warning",
      });
  }

  function imageFail(){
    swal({
        text: "Image is Required",
        icon: "error",
      });
  }




  
  