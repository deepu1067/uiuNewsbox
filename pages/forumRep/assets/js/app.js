var cancelBtn = document.getElementById("closeUpdate");
var updateContainer = document.getElementById("upper");
var trigger = document.getElementById("changeBtn");


trigger.addEventListener('click', ()=>{
    updateContainer.className = "d-flex";
})

cancelBtn.addEventListener('click', ()=>{
    updateContainer.className = "d-none";
})


var newpass = document.getElementById("newpass");
var confirmpass = document.getElementById("confirmpass");
var error = document.getElementById("errormsg");
var updateBtn = document.getElementById("updateBtn");

confirmpass.addEventListener('keyup', ()=>{
    var pass = newpass.value;
    var con_pass = confirmpass.value;

    console.log(con_pass);

    if(pass != con_pass){
        error.className  = "m-0 mt-1 fw-bold";
        var disable = document.createAttribute("disabled");
        updateBtn.setAttributeNode(disable);
    }
    else{
        error.className = "d-none";
        updateBtn.removeAttribute("disabled");
    }
})
