function checkform(){
    let formElement = document.querySelector("#checkform");
    let userName = formElement.username; 
    let pass1 = formElement.pass1; 
    let pass2 = formElement.pass2; 

    let enspasswords = false; 
    let passlængde = false; 

    if(pass1.value == pass2.value){
        enspasswords = true; 
    }

    if(pass1.value.length > 8){
        passlængde = true; 
    }

    if(enspasswords && passlængde){
        return true;
        
    }else{
        alert("Dit password er enten ikke ens eller for kort det skal minimum være 8 cifre");
        return false;
    }

}