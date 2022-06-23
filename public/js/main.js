const buttonEdit = document.querySelector('#Edit-Profile');
const buttonValideEdit = document.querySelector('#Valide-Profile');

const inputNom = document.querySelector('#nom-Profile');
const inputPreNom = document.querySelector('#prenom-Profile');
const inputId = document.querySelector('#id-Profile');

const formProfile = document.getElementById('form-Profile');

/////////////////////Profile Function////////////////////////////////////////
if(typeof(buttonEdit) !== undefined && buttonEdit !== null) {
    buttonEdit.addEventListener('click', function (event) {
        event.preventDefault();
        if (!buttonEdit.hidden) {
            buttonEdit.hidden = true;
            buttonValideEdit.hidden = false;
            switchInput();  
        }
    });
}

if(typeof(buttonValideEdit) !== undefined && buttonValideEdit !== null) {
    buttonValideEdit.addEventListener('click', function (event) {
        event.preventDefault();
        sendForm(formProfile, '/user/edit', false, function () {
            switchInput();
            buttonEdit.hidden = false;
            buttonValideEdit.hidden = true;
        });
    });
}

function switchInput() {
    inputNom.disabled = !inputNom.disabled;
    inputPreNom.disabled = !inputPreNom.disabled;
}

//////////Global Function///////////////

document.addEventListener('submit', function (event) {
    const selectedForm = this.activeElement.form;
    const link = selectedForm['link'].value;
    if(link !== undefined && link !== null) {
        event.preventDefault();
        sendForm(selectedForm,link,true)
    }
    
});

function sendForm(form, url, isReset, after = () => { }) {
    var data = new FormData(form);
    const options = {
        method: 'POST',
        body: data,
    }
    fetch(url, options)
        .then(function (response) {
            if (isReset) form.reset();
            after();
        })
}