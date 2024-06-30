"use strict";
function isNumberKey(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
  return false;
  return true;
  }
  
  function successToast(msg) {
    Toastify({
        text: msg,
        duration: 3000,
        close: true,
        style: {
            background: "linear-gradient(to right, #000000, #434343)",
        },
    }).showToast();
}

function errorToast(msg) {
    Toastify({
        text: msg,
        duration: 3000,
        close: true,
        closMultiple: false,
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #ff0000, #ff7f7f)",
        },
    }).showToast();
}
