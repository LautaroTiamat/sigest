// Alertas:
function getHtmlAlert(mensaje){
    return `<div class="form-group">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    ${mensaje}
                </div>
            </div>`;
}
 
function showAlert(mensaje){
    document.getElementById("alert").innerHTML= getHtmlAlert(mensaje);
}

function showAlert1(mensaje){
    document.getElementById("alert1").innerHTML= getHtmlAlert(mensaje);
}

function showAlert2(mensaje){
    document.getElementById("alert2").innerHTML= getHtmlAlert(mensaje);
}
// Fin: Alertas

// Validaciones:
function emailVerify(email){
    if(!(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(email))){
        return false;
    }
    return true;
}

function validarCuil(cuil){
    let resultado = 0;
    let digitos = cuil.split(""); // ("4", "2", ...)
    let ultimoDigito = digitos.pop();
 
    for(let i = 0; i < digitos.length; i++){
        resultado += digitos[9 - i] * (2 + (i % 6));
    }
 
    let digitoVerificador = 11 - (resultado % 11);

    if(ultimoDigito == digitoVerificador){
        return true;
    } else if(ultimoDigito == '0' && digitoVerificador == '11'){
        return true;
    } else {
        return false;
    }
}

function today(){
    let date = new Date();
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();

    if(month < 10){
        fechaActual = `${year}-0${month}-${day}`;
        return fechaActual;
    } else {
        fechaActual = `${year}-${month}-${day}`;
        return fechaActual;
    }
}

function validateNumbers(event){
	return (event.charCode >= 48 && event.charCode <= 57);
}

function validateLetters(event){
	return (event.charCode >= 65 && event.charCode <= 122) || event.charCode == 32;
}

// Formularios:
function loginValidate(){
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    if(!emailVerify(email)){
        showAlert("Por favor, ingrese un email válido");
        return false;
    }
    
    if(password.length < 1){
        showAlert("Por favor, ingrese una contraseña");
		return false;
    }

    return true;
}

function addPerson(){
    let name = document.getElementById("name").value;
    let lastname = document.getElementById("lastname").value;
    let cuil = document.getElementById("cuil").value;
    let birthday = document.getElementById("birthday").value;
    
    if(name.length < 1){
        showAlert("Por favor, ingrese un nombre");
		return false;
    } else if(lastname.length < 1){
        showAlert("Por favor, ingrese un apellido");
        return false;
    } else if(cuil.length != 11){
        showAlert("Por favor, ingrese un CUIL válido");
        return false;
    } else if(!validarCuil(cuil)){
        showAlert("CUIL ingresado no válido");
        return false;
    } else if(birthday == ''){
        showAlert("Por favor, ingrese una fecha");
        return false;
    } else if(birthday == today() || birthday > today()){
        showAlert("La fecha ingresada no puede ser mayor o igual a la fecha actual");
        return false;
    }

    return true;
}

function editPerson(){
    let name = document.getElementById("name").value;
    let lastname = document.getElementById("lastname").value;
    let cuil = document.getElementById("cuil").value;
    let birthday = document.getElementById("birthday").value;
    
    if(name.length < 1){
        showAlert("Por favor, ingrese un nombre");
		return false;
    } else if(lastname.length < 1){
        showAlert("Por favor, ingrese un apellido");
		return false;
    } else if(cuil.length != 11){
        showAlert("Por favor, ingrese un CUIL válido");
        return false;
    } else if(!validarCuil(cuil)){
        showAlert("CUIL ingresado no válido");
        return false;
    } else if(birthday == ''){
        showAlert("Por favor, ingrese una fecha");
        return false;
    } else if(birthday == today() || birthday > today()){
        showAlert("La fecha ingresada no puede ser mayor o igual a la fecha actual");
        return false;
    }

    return true;
}

function addUser(){
    let person = document.getElementById("person").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let repassword = document.getElementById("repassword").value;

    if(person == ''){
        showAlert("Por favor, seleccione una persona");
        return false;
    } else if(!emailVerify(email)){
        showAlert("Por favor, ingrese un email válido");
        return false;
    } else if(password.length < 1){
        showAlert("Por favor, ingrese una contraseña");
        return false;
    } else if(repassword.length < 1){
        showAlert("Por favor, confirme la contraseña");
        return false;
    } else if(password !== repassword){
        showAlert("Las contraseñas no coinciden");
        return false;
    }

    return true;
}

function editUser1(){
    let email = document.getElementById("email").value;

    if(!emailVerify(email)){
        showAlert1("Por favor, ingrese un email válido");
        return false;
    }

    return true;
}

function editUser2(){
    let password = document.getElementById("password").value;
    let repassword = document.getElementById("repassword").value;

    if(password.length < 1){
        showAlert2("Por favor, ingrese una contraseña");
        return false;
    } else if(repassword.length < 1){
        showAlert2("Por favor, confirme la contraseña");
        return false;
    } else if(password !== repassword){
        showAlert2("Las contraseñas no coinciden");
        return false;
    }
}
// Fin: Formularios