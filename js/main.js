
    /*====================[ Validate Caps Lock On ]*/

var input = document.getElementById("username");
var text = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
	text.style.display = "block";
  } else {
	text.style.display = "none"
  }
});

var input = document.getElementById("pass");
var text = document.getElementById("text");
input.addEventListener("keyup", function(event) {

if (event.getModifierState("CapsLock")) {
	text.style.display = "block";
  } else {
	text.style.display = "none"
  }
});

//======================================================

function check(form)//function to check userid & password
{
var un = document.myform.username.value;
var pw = document.myform.pass.value;

var valid = false;
var unArray = ["admin", "user1"];  // as many as you like - no comma after final entry
var pwArray = ["admin", "pass1"];  // the corresponding passwords;
for (var i=0; i <unArray.length; i++) {
if ((un == unArray[i]) && (pw == pwArray[i])) {
valid = true;
break;
}
}
if (valid) {
window.open ('homepage.html');
return false;
}

 else
 {
   alert("Error Username or Password")   //displays error message
  }
}

 /*the following code checkes whether the entered userid and password are matching*/
/*  if(form.username.value == "admin" && form.pass.value == "admin")
  {
	window.open('homepage.html')/*opens the target page while Id & password matches*/
 /* } */

(function ($) {
    "use strict";

   /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);