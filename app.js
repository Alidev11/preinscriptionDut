
console.log("21");
currLoc = window.location.href;
console.log(currLoc);


let afficherBtn = document.querySelector(".afficher");
let dashBtn = document.querySelector(".dash");
let listCdBtn = document.querySelector(".listCd");
let listPrBtn = document.querySelector(".listPr");
let listAttBtn = document.querySelector(".listAtt");

let dashField1 = document.querySelector(".cards");
let dashField2 = document.querySelector(".stat");
let listCdField = document.querySelector(".tableau");
let listPrField1 = document.querySelector(".login");
let listPrField2 = document.querySelector(".tableau1");

console.log("21");

$(".prod").addClass("border");
if(currLoc == "http://localhost/Project_test/admin.php?etat=1"){
    console.log("hello");
    $(".cat").addClass("border");
    $(".ct").removeClass("border");
    $(".prod").removeClass("border");
    $(".fourn").removeClass("border");

    $(".cards").addClass("none");
    $(".stat").addClass("none");
    $(".tableau").addClass("none");
    $(".login").removeClass("none");
    $(".tableau1").removeClass("none");
}

if(currLoc == "http://localhost/Project_test/admin.php?etat1=1"){
    console.log("hello");
    $(".fourn").addClass("border");
    $(".ct").removeClass("border");
    $(".prod").removeClass("border");
    $(".cat").removeClass("border");

    $(".cards").addClass("none");
    $(".stat").addClass("none");
    $(".tableau").addClass("none");
    $(".login").addClass("none");
    $(".tableau1").addClass("none");
    $(".tableau11").removeClass("none");
    $(".login1").removeClass("none");
}


dashBtn.addEventListener("click", function(event){
    $(".prod").addClass("border");
    $(".ct").removeClass("border");
    $(".cat").removeClass("border");
    $(".fourn").removeClass("border");

    $(".cards").removeClass("none");
    $(".stat").removeClass("none");
    $(".tableau").addClass("none");
    $(".login").addClass("none");
    $(".tableau1").addClass("none");
    $(".login1").addClass("none");
    $(".tableau11").addClass("none");
});

listCdBtn.addEventListener("click", function(event){
    $(".ct").addClass("border");
    $(".prod").removeClass("border");
    $(".cat").removeClass("border");
    $(".fourn").removeClass("border");

    $(".cards").addClass("none");
    $(".stat").addClass("none");
    $(".tableau").removeClass("none");
    $(".login").addClass("none");
    $(".tableau1").addClass("none");
    $(".login1").addClass("none");
    $(".tableau11").addClass("none");
});

listPrBtn.addEventListener("click", function(event){
    $(".cat").addClass("border");
    $(".ct").removeClass("border");
    $(".prod").removeClass("border");
    $(".fourn").removeClass("border");

    $(".cards").addClass("none");
    $(".stat").addClass("none");
    $(".tableau").addClass("none");
    $(".login").removeClass("none");
    $(".tableau1").removeClass("none");
    $(".login1").addClass("none");
    $(".tableau11").addClass("none");
});

listAttBtn.addEventListener("click", function(event){
    $(".fourn").addClass("border");
    $(".ct").removeClass("border");
    $(".cat").removeClass("border");
    $(".prod").removeClass("border");

    $(".cards").addClass("none");
    $(".stat").addClass("none");
    $(".tableau").addClass("none");
    $(".login").addClass("none");
    $(".tableau1").addClass("none");
    $(".login1").removeClass("none");
    $(".tableau11").removeClass("none");
});

