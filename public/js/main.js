


const buttonEdit = document.querySelector('#Edit-Profile');
const buttonValideEdit = document.querySelector('#Valide-Profile');

const inputNom = document.querySelector('#nom-Profile');
const inputPreNom = document.querySelector('#prenom-Profile');
const inputAge = document.querySelector('#age-Profile');

const inputId = document.querySelector('#id-Profile');



buttonEdit.addEventListener('click',function(event){
    event.preventDefault();
    if(!buttonEdit.hidden){
        buttonEdit.hidden = true;
        buttonValideEdit.hidden = false;
        switchInput();
       
    }
});
/***
 
 */

 buttonValideEdit.addEventListener('click',function(event){
    event.preventDefault();

    const user = {
        id:inputId.value,
        nom: inputNom.value,
        prenom: inputPreNom.value
    }
    const options = {
        method: 'POST',
        body: JSON.stringify(user),
        headers: {
            'Content-Type': 'application/json'
        }
    }

    console.log(user)

    fetch("/user/edit",options)
    .then(function(response){
        console.log(inputId.value);
        switchInput();
        buttonEdit.hidden = false;
        buttonValideEdit.hidden = true;
    });
});


function switchInput()
{
    inputNom.disabled = !inputNom.disabled;
    inputPreNom.disabled = !inputPreNom.disabled;
}