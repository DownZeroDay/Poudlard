const buttonEdit = document.querySelector('#Edit-Profile');
const buttonValideEdit = document.querySelector('#Valide-Profile');
const buttonEditEvent = document.querySelectorAll('.edit_event');
const buttonEditCate = document.querySelectorAll('.edit_catevent'); 
const buttonEditUser = document.querySelectorAll('.edit_user');
const buttonEditSection = document.querySelectorAll('.edit_section'); 

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

if(typeof(buttonEditEvent) !== undefined && buttonEditEvent !== null){
    buttonEditEvent.forEach((b) => {
       b.onclick = function(){
        for(f of this.form){
            if(f.disabled === true && f.name !== 'infoCreator') {
                f.disabled = false;
            }
            if(f.name === "imageEventTab") f.hidden = false;
        }
        b.hidden = true;
        this.form['validIcon'].hidden = false;
    }
    });

}

if(typeof(buttonEditCate !== undefined) && buttonEditCate !== null){
    buttonEditCate.forEach((b) => {
        b.onclick = function(){
         for(f of this.form){
             if(f.disabled === true && f.name !== 'infoCreator') {
                 f.disabled = false;
             }
         }
         b.hidden = true;
         this.form['validIcon'].hidden = false;
     }
     });
}

if(typeof(buttonEditUser !== undefined) && buttonEditUser !== null){
    buttonEditUser.forEach((b) => {
        b.onclick = function(){
         for(f of this.form){
             if(f.disabled === true && f.name !== 'infoCreator') {
                 f.disabled = false;
             }
         }
         b.hidden = true;
         this.form['validIcon'].hidden = false;
     }
     });
}

if(typeof(buttonEditSection !== undefined) && buttonEditSection !== null){
    buttonEditSection.forEach((b) => {
        b.onclick = function(){
         for(f of this.form){
             if(f.disabled === true && f.name !== 'infoCreator') {
                 f.disabled = false;
             }
         }
         b.hidden = true;
         this.form['validIcon'].hidden = false;
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
    let reloaded = false;
    let link ='';
    if(selectedForm.className === 'formEventTab'){
        if(selectedForm['validIcon'].hidden === false){
             link = selectedForm['linkEdit'].value;
        }else{
             link = selectedForm['linkDelete'].value;
        }
        reloaded = true;
    }else{
         link = selectedForm['link'].value;
    } 
    if(link !== undefined && link !== null && link !== '') {
        event.preventDefault();
        sendForm(selectedForm,link,true,() => {
            window.location.reload();
        }); 
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

document.querySelector('.categList').addEventListener('change', redirectCateg)

function redirectCateg(){
    console.log(this)
    let categ = this.options[this.selectedIndex].value;
    window.location = '/default/0?categorie=' + categ
}