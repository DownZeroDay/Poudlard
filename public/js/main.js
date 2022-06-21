const buttonEdit = document.querySelector('#Edit-Profile');
const buttonValideEdit = document.querySelector('#Valide-Profile');

const inputNom = document.querySelector('#nom-Profile');
const inputPreNom = document.querySelector('#prenom-Profile');
const inputAge = document.querySelector('#age-Profile');

const inputId = document.querySelector('#id-Profile');

const formProfile = document.getElementById('form-Profile');


/////////////////////Profile Function////////////////////////////////////////
buttonEdit.addEventListener('click',function(event){
    event.preventDefault();
    if(!buttonEdit.hidden){
        buttonEdit.hidden = true;
        buttonValideEdit.hidden = false;
        switchInput();
       
    }
});


 buttonValideEdit.addEventListener('click',function(event){
    event.preventDefault();
    sendForm(formProfile,'/user/edit',function(){
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


//////////Global Function///////////////


function sendForm(form,url,after){
    var data = new FormData(form);
    object = {};
    for([key,value] of data.entries()){
        object[key] = value;
    }
    const options = {
            method: 'POST',
            body: JSON.stringify(object),
            headers: {'Content-Type': 'application/json'
        }
    }

    fetch(url,options)
    .then(function(response){
        after();
    })
}



