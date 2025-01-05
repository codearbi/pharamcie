function valide(){
    var input = document.getElementById('matricule');
    var input1 = document.getElementById('pwd');
    if (!input) {
        console.error("l element ID matricule non trouvé");
        return;
    }
    var value= input.value;
    var value1= input1.value;
    var msg= document.getElementById('msg');
    var msg1= document.getElementById('msg1')
    if (!msg) {
        console.error("l element ID msg non trouvé");
        return;
    }
    if (value.length > 3 || value == 0 || isNaN(value)) {
        input.style.color = 'red';
        msg.textContent = 'matricule entre 1 et 3 chiffres ';
        msg.style.color = 'red';
       
    }else{
        input.style.color= 'green';
        msg.textContent= 'longueur valable';
        msg.style.color= 'green'
    }
    if (value1.length < 6) {
        input1.style.color = 'red';
        msg1.textContent= 'min mot de passe 6 caracteres';
        msg1.style.color= 'red';
    }else{
        input1.style.color= 'green';
        msg1.textContent= 'longueur valable';
        msg1.style.color= 'grey';
    }
}