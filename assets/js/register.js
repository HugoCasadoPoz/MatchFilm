if (!(localStorage.getItem('token'))){
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
        document.getElementById('passwordError').innerHTML = 'La contraseña debe contener al menos una letra minúscula, mayúscula y un número';
        validar=false;
    } else {
        document.getElementById('passwordError').innerHTML = '';
        validar=true;
    }
}

document.getElementById('registerBtn').addEventListener('click', function() {
    if (!validar || username.value.trim()=='' || email.value.trim()=='' || password.value.trim()=='') {
        document.getElementById('alert').innerHTML=`
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <strong>Error en el formulario</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`
        return false;
    }else{
        let nuevoUser = new FormData();
            nuevoUser.append('username', document.getElementById('username').value.trim())
            nuevoUser.append('email', document.getElementById('email').value.trim())
            nuevoUser.append('password', document.getElementById('password').value.trim())
            nuevoUser.append('image', document.getElementById('image').files[0])
        console.log(nuevoUser);
        if( validar && password.value.trim()!='') {
            let url = 'http://localhost/matchfilm/api/post_register.php';
            const options = {
                method: 'POST',
                body: nuevoUser,
            };
            fetch(url, options)
                .then(res => {
                    console.log(res);
                    if (res.status == 201) {
                        return res.json(); 
                    }else{
                        document.getElementById('alert').innerHTML=`
                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <strong>Error de registro</strong>
                            <a href="./login.php" class="btn btn-primary mr-2">Ir al inicio de sesión</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`
                        close
                    }
                })
                .then(data => {
                    console.log(data);
                    document.getElementById('alert').innerHTML=`
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <strong>Te has registrado correctamente!</strong>
                        <a href="./login.php" class="btn btn-primary mr-2">Ir al inicio de sesión</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`
                    
                }).catch(e=>{
                    console.log(e);
                })
                
        
            
    }else{
        document.getElementById('alert').innerHTML=`
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>Credenciales no válidas</strong>
            <a href="./index.php" class="btn btn-primary mr-2">Ir al Inicio</a>
        </div>`    }
    
    }
    });
}else{
    document.getElementById('alert').innerHTML=`
                    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        <strong>Ya estás logueado!</strong>
                        <a href="./index.php" class="btn btn-primary mr-2">Ir al Inicio</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`
}
    
    
