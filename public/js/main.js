const buttonEdit = document.querySelector('#Edit-Profile');
const buttonValideEdit = document.querySelector('#Valide-Profile');
const buttonCategorieEvent = document.querySelector('#button-categorieEvent');
const buttonEventForm = document.querySelector('#submit-EventForm');

const inputNom = document.querySelector('#nom-Profile');
const inputPreNom = document.querySelector('#prenom-Profile');
const inputId = document.querySelector('#id-Profile');
const inputLibelleEvent = document.querySelector('#input-categoriEvent');

const formProfile = document.getElementById('form-Profile');
const formCategorieEvent = document.getElementById('form-categoriEvent');
const formEvent = document.getElementById('form-eventForm');

/////////////////////Profile Function////////////////////////////////////////
buttonEdit.addEventListener('click', function (event) {
    event.preventDefault();
    if (!buttonEdit.hidden) {
        buttonEdit.hidden = true;
        buttonValideEdit.hidden = false;
        switchInput();

    }
});


buttonValideEdit.addEventListener('click', function (event) {
    event.preventDefault();
    sendForm(formProfile, '/user/edit', false, function () {
        switchInput();
        buttonEdit.hidden = false;
        buttonValideEdit.hidden = true;
    });
});

buttonCategorieEvent.addEventListener('click', function (event) {
    event.preventDefault();
    sendForm(formCategorieEvent, '/event/categorie', true);
})

buttonEventForm.addEventListener('click', function (event) {
    event.preventDefault();
    sendFormAndFile(formEvent, '/event/create', false);
})

function switchInput() {
    inputNom.disabled = !inputNom.disabled;
    inputPreNom.disabled = !inputPreNom.disabled;
}

//////////Global Function///////////////

function sendForm(form, url, isReset, after = () => { }) {
    var data = new FormData(form);
    object = new Object();
    for ([key, value] of data.entries()) {
        object[key] = value;
    }
    const options = {
        method: 'POST',
        body: JSON.stringify(object),
        headers: {
            'Content-Type': 'application/json'
        }
    }
    fetch(url, options)
        .then(function (response) {
            if (isReset) form.reset();
            after();
        })
}

function sendFormAndFile(form, url, isReset, after = () => { }) {
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


