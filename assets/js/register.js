if (!(localStorage.getItem('username'))){
let username = document.getElementById('username');
let email = document.getElementById('email');
let password = document.getElementById('password');
let validar = false;

username.onblur = function() {
    if (username.value.length < 5) {
        document.getElementById('usernameError').innerHTML = 'El Usuario tiene que tener al menos 5 caracteres';
        validar=false
    } else {
        document.getElementById('usernameError').innerHTML = '';
        validar=true
    }
}

email.onblur = function() {
    let emailValue = email.value;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailValue)) {
        document.getElementById('emailError').innerHTML = 'El Email no es válido';
        validar=false;
    } else {
        document.getElementById('emailError').innerHTML = '';
        validar=true;
    }
}

password.onblur = function() {
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{5,}$/.test(password.value)) {
        document.getElementById('passwordError').innerHTML = 'La contraseña debe contener al menos una letra minúscula, una letra mayúscula y un número';
        validar=false;
    } else {
        document.getElementById('passwordError').innerHTML = '';
        validar=true;
    }
}

document.getElementById('registerBtn').addEventListener('click', function() {
    if (!validar || username=='' || email=='' || password=='') {
        alert('Error en el formulario');
        return false;
    }else{
        let nuevoUser = {
            'username': username.value.trim(),
            'email': email.value.trim(),
            'password': password.value.trim(),
        }
        if( validar && password.value.trim()!='') {
            let url = 'http://localhost/MatchFilm/api/post_register.php';
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(nuevoUser)
            };
            fetch(url, options)
                .then(res => {
                    if (res.status == 200) {
                        return res.json(); 
                    }
                })
                .then(data => {
                    alert ('Usuario registrado correctamente');
                    location.href='./login.php';
                }) 
                
        
            
    }else{
        alert('Campos no válidos');
    }
    
    }
    });
}else{
    alert('Usuario ya esta logueado')
    location.href='./index.php';
}
    
    
