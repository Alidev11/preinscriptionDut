const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnFourth = document.querySelector(".prev-2");
const submitBtn = document.querySelector(".submit");
const progressText = document.querySelectorAll(".step p");
const progressCheck = document.querySelectorAll(".step .check");
const bullet = document.querySelectorAll(".step .bullet");

var inputUser = document.querySelector(".input_user");
let inputpwd = document.querySelector(".input_pwd");
let inputName = document.querySelector(".input_name");
let inputPrenom = document.querySelector(".input_prenom");
let inputEmail = document.querySelector(".input_email");
let inputTel = document.querySelector(".input_email");
let msgUser = document.querySelector(".msgUser");

var fileInput = document.querySelectorAll(".file_input");
var emailCd = document.querySelector(".emailCd");
let current = 1;

// ---------------------- ADMIN PAGE -------------------------

let dashLink = document.querySelector(".dashLink");
let principLink = document.querySelector(".principLink");
let waitLink = document.querySelector(".waitLink");


//Remove border and padding from file Input
for (var i=0; i<fileInput.length; i++) {
  fileInput[i].style.border = "none";
  fileInput[i].style.paddingLeft = "0px";
}

//-----------------------------------------------------------------------------------------------
//Next Button events
nextBtnFirst.addEventListener("click", function(event){
  var usernameCandidat = $('input[name=usernameCandidat]').val();
  var passwordCandidat = $('input[name=passwordCandidat]').val();
  
  if(usernameCandidat != '' && passwordCandidat != '' && msgUser.childNodes.length === 0){
    var formDataObj = new FormData(document.getElementById("myForm"));
    $('#message').html('<span style="color: red">Processing form. . . please wait. . .</span>');
    $.ajax(
      {
        url: "./submit.php", 
        type: 'POST',
        data: formDataObj,
        processData: false,  // tell jQuery not to process the data            
        contentType: false,
        cache: false, 
        success: function(response){
          event.preventDefault();
          slidePage.style.marginLeft = "-33.33%";
          bullet[current - 1].classList.add("active");
          progressCheck[current - 1].classList.add("active");
          progressText[current - 1].classList.add("active");
          current += 1;
          // var res = JSON.parse(response);
          var res = response;
          console.log(res);
          console.log(res.success);
          },
        error: function(error){
          alert(error);
        }
    });
  }
  else
  {
    // $('#message').html('<span style="color: red">Check your fields</span>');
  }
}); 

nextBtnSec.addEventListener("click", function(event){
  var photo = $('input[name=photo]').val();
  var nomCandidat = $('input[name=nomCandidat]').val();
  var prenomCandidat = $('input[name=prenomCandidat]').val();
  var emailCandidat = $('input[name=emailCandidat]').val();
  var teleCandidat = $('input[name=teleCandidat]').val();
  var adresseCandidat = $('input[name=adresseCandidat]').val();
  var cinCandidat = $('input[name=cinCandidat]').val();
  var cneCandidat = $('input[name=cneCandidat]').val();   
  var cinFileCandidat = $('input[name=cinFileCandidat]').val();
  var formDataObj = new FormData(document.getElementById("myForm"));
  if(nomCandidat != '' && photo != '' && prenomCandidat != '' && emailCandidat != '' && teleCandidat != ''
  && adresseCandidat != '' && cinCandidat != '' && cneCandidat != '' && cinFileCandidat != ''){
    $('#message').html('<span style="color: red">Processing form. . . please wait. . .</span>');
    $.ajax(
      {
        url: "./submitForm1.php", 
        type: 'POST',
        enctype: 'multipart/form-data',
        data: formDataObj,
        processData: false,  // tell jQuery not to process the data            
        contentType: false,
        cache: false,
        success: function(response){
          event.preventDefault();
          slidePage.style.marginLeft = "-66.66%";
          bullet[current - 1].classList.add("active");
          progressCheck[current - 1].classList.add("active");
          progressText[current - 1].classList.add("active");
          current += 1;
          // var res = JSON.parse(response);
          var res = response;
          console.log(res);
          console.log(res.success);
          },
        error: function(error){
          alert(error);
        }
    });
  }
}); 

function clear() {
  return p1 * p2;
}

submitBtn.addEventListener("click", function(){
  var filiereCandidat = $('select[name=filiereCandidat]').val();
  var anneeBacCandidat = $('select[name=anneeBacCandidat]').val();
  var noteCandidat = $('input[name=noteCandidat]').val();
  var bacCandidat = $('input[name=bacCandidat]').val();
  var releveNoteCandidat = $('input[name=releveNoteCandidat]').val();
  var formDataObj = new FormData(document.getElementById("myForm")); 
  if(filiereCandidat != '' && noteCandidat != '' && bacCandidat != '' && releveNoteCandidat != '' 
  && anneeBacCandidat != ''){
    $('#message').html('<span style="color: red">Processing form. . . please wait. . .</span>');
    $.ajax({
        url: "./submitForm2.php", 
        type: 'POST',
        data: formDataObj,
        processData: false,  // tell jQuery not to process the data            
        contentType: false,
        cache: false,
        success: function(response){
          bullet[current - 1].classList.add("active");
          progressCheck[current - 1].classList.add("active");
          progressText[current - 1].classList.add("active");
          current += 1;
          // var res = JSON.parse(response);
          var res = response;
          console.log(res);
          console.log(res.success);
          alert("Your Form Successfully Signed up");
          location.reload();
          document.getElementById("myForm").reset();
          },
        error: function(error){
          alert(error);
        }
    });
  }
});

prevBtnSec.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "0%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});
prevBtnFourth.addEventListener("click", function(event){
  event.preventDefault();
  slidePage.style.marginLeft = "-33.33%";
  bullet[current - 2].classList.remove("active");
  progressCheck[current - 2].classList.remove("active");
  progressText[current - 2].classList.remove("active");
  current -= 1;
});

//-----------------------------------------------------------------------------------------------

//Validate form on input
inputUser.addEventListener("input", function(event){
  
  var usernameRegex = /^[\w]{3,8}$/;
  var currentValue = event.target.value;
  console.log(currentValue);
  if (!(usernameRegex.test(currentValue))) {
    $('.msgUser').html('<span style="color: red">Svp inserer des caracteres alphanumeriques entre 3 et 8 caractères</span>');
  }
  else{
    $('.msgUser').html('');
  }
});

inputpwd.addEventListener("input", function(event){
  
  var pwdRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  var currentValue = event.target.value;
  console.log(currentValue);
  if (!(pwdRegex.test(currentValue))) {
    $('.msgPwd').html('<span style="color: red;">Svp inserer minimum 8 caractères, au moins 1 lettre maj, une lettre min, un chiffre et un caractère spécial</span>');
  }
  else{
    $('.msgPwd').html('');
  }
});