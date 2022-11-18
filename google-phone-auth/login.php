
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Google phone auth-send_otp</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   </head>
   <body>
 
   <div id="recaptcha-container" style="display:none;"></div>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>
    <script type="text/javascript">
    const config = {
    apiKey: "AIzaSyArCAgzbztQ1bJT8MRbJJ4z586ccvahyx4",
    authDomain: "phoneverification-136b3.firebaseapp.com",
    projectId: "phoneverification-136b3",
    storageBucket: "phoneverification-136b3.appspot.com",
    messagingSenderId: "725052259351",
    appId: "1:725052259351:web:f002152cda6416e7e07052",
    measurementId: "G-TT7FYC4XMH"
        };
        
        firebase.initializeApp(config);
    </script>
 <script type="text/javascript">  
  // reCAPTCHA widget    
 window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
     'size': 'invisible',
     'callback': (response) => {
         // reCAPTCHA solved, allow signInWithPhoneNumber.
         onSignInSubmit();
     }
 });

 function validatePhoneNumber(input_str) {
     var re = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;

     return re.test(input_str);
 }
function err(str){
    alert(str)
}

 function sendOtp() {
     var number = document.getElementById('phone-number').value;
     var countryCode = '+91';
     var phoneNumber = countryCode + number;
     if (!validatePhoneNumber(number)) {
         err("Phone number is not valid")
     } else {
         //showing loading icon inside send otp btn
         $("#send-otp-btn").html("<div class='small_loader'></div>")
         const appVerifier = window.recaptchaVerifier;
         firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
             .then((confirmationResult) => {
                 // SMS sent. Prompt user to type the code from the message, then sign the
                 // user in with confirmationResult.confirm(code).
                 //console.log(confirmationResult.verificationId)
                 var sessionInfo = confirmationResult.verificationId;
                 $("#sessionInfo").val(sessionInfo)
                 $(".send_otp").hide();
                 $(".verify_otp").show();
                 $("#send-otp-btn").html("Send Otp")

             }).catch((error) => {
                 //error.message;
                 err(error.message)
                 $("#send-otp-btn").html("Try again")
             });
     }
 }   

 function verifyOtp(){
 var sessionInfo=$("#sessionInfo").val();
 var otp=$("#otp").val();
     $.ajax({
         url:'verify.php',
         method:'POST',
         data:{"sessionInfo":sessionInfo,"otp":otp},
         success: function(response){
            console.log(response)
             console.log(response.localId)
         },
         error: function(error){
             console.log(error)
         }
     })
 }
 </script>
<div class="send_otp">
    <input type="tel" name="" id="phone-number">
    <button type="button" id="send-otp-btn" onclick="sendOtp()">Send Otp</button>
</div>
<div class="verify_otp" style="display:none">
    <input type="tel" name="" id="otp">
    <input type="hidden" id="sessionInfo">
    <button type="button" id="verify-otp-btn" onclick="verifyOtp()">Verify</button>
</div>
</html>