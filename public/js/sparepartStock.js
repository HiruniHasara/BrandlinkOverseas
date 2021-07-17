function validate() {
    var form = document.getElementById("myform");
    form.addEventListener('submit', function(event) {
        // Prevent default behaviour
        //event.preventDefault();
        if (
          
          validate()!=false
        ) 
        {
        form.submit();
        }
      });
         
          var itemid=document.getElementById("id").value;  
          var itemName=document.getElementById("name").value;  
          var quantity=document.getElementById("quantity").value; 
          var price=document.getElementById("price").value; 
          var letters = /^[a-zA-Z][a-zA-Z\s]*$/;
          var isValid = letters.test(document.getElementById("name").value);
        //  var file = document.getElementById("image").value;
        //   var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        
          if (itemid==null || itemid==""){  
            swal({
              icon:"error",
              text: "Item id is required",
              closeOnClickOutside: false,
            }); 
          return false;   
          // }else if(file ==""){
          //   swal({
          //     icon:"error",
          //     text: "Please upload an image",
          //     closeOnClickOutside: false,
          //   }); 
          // return false; 
          // }else if(!allowedExtensions.exec(file)){
          //   swal({
          //     icon:"error",
          //     text: "Invalid file type",
          //     closeOnClickOutside: false,
          //   });
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
          }else if(quantity==null || quantity==""){  
            swal({
              icon:"error",
              text: "Quantity is required",
              closeOnClickOutside: false,
            });
          return false;  
          }else if (isNaN(quantity)){  
            document.getElementById("quantity").innerHTML="Enter Numeric value only";
            swal({
              icon:"error",
              text: "Quantity should be a Numeric value",
              closeOnClickOutside: false,
            }); 
          return false;  
          }else if(price==null || price==""){ 
            swal({
              icon:"error",
              text: "Unit price is required",
              closeOnClickOutside: false,
            });  
          return false;  
          }else if (isNaN(price)){  
            document.getElementById("price").innerHTML="Enter Numeric value only"; 
            swal({
              icon:"error",
              text: "Unit price should be a Numeric value",
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

     

      

