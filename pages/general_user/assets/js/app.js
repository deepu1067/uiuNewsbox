var admin_box = document.getElementById("admin");
var type_section = document.getElementById("type-section");
var type_radio = type_section.getElementsByClassName("form-check-input");


admin_box.addEventListener("click", ()=>{

    if(admin_box.checked){
        type_section.className = "d-none";
        type_radio[0].removeAttribute("required");
        type_radio[0].removeAttribute("name");

        type_radio[1].removeAttribute("required");
        type_radio[1].removeAttribute("name");

        var nameAtt = document.createAttribute("name");
        nameAtt.value = "type";

        admin_box.setAttributeNode(nameAtt);
    }
    else if(!admin_box.checked){
        admin_box.removeAttribute("name");
        type_section.className = "d-flex flex-column align-items-center";

        var reqAtt = document.createAttribute("required");
        var nameAtt = document.createAttribute("name");
        nameAtt.value = "type";

        type_radio[0].setAttributeNode(reqAtt);
        type_radio[0].setAttributeNode(nameAtt);

        var nameAtt2 = document.createAttribute("name");
        nameAtt2.value = "type";
        type_radio[1].setAttributeNode(document.createAttribute("required"));
        type_radio[1].setAttributeNode(nameAtt2);
        
    }
        
})
