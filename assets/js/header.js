let logotipos = document.getElementById('logotipos');
if(localStorage.getItem('token')){
    let url = 'http://localhost/matchfilm/api/get_image.php' 
    let options = {
        method: 'GET',
        headers: {
            'Authorization': localStorage.getItem('token')
        }
    }
    fetch(url, options)
    .then(res => {
        if(res.status==200){
            return res.json();
        }else if (res.status==401){
            console.log('Token caducado');
            localStorage.clear()
            alert('Su sesión ha expidado tiene que iniciar sesión de nuevo')
            window.location.href = 'http://localhost/matchfilm/pages/login.php'
            close
        }else{
            console.log('Error en la consulta');
            localStorage.clear()
            close
        }
    })
    .then(data => {
        if (data.image){
            logotipos.innerHTML += `
            <div class="perfil">
                <a href="http://localhost/matchfilm/pages/perfil.php">
                <b>${localStorage.getItem('username')}</b>
                <img src="data:image/jpeg;base64,${data.image}" alt="Logo de perfil" width="45px" height="45px" style="border-radius: 50%; border: 2px solid #000;">
                </a>
            </div>`
        }else{
            logotipos.innerHTML+=`<div class="perfil">
            <a href="http://localhost/matchfilm/pages/perfil.php">
            <b>${localStorage.getItem('username')}</b>
            <img src="http://localhost/matchfilm/assets/img/usuario.png" alt="Logo de perfil" width="45px" height="45px">
            </a>
          </div>`;
        }
    })
    
}else{
    logotipos.innerHTML+=`<div id='botones' class="perfil">
                            <a href="http://localhost/matchfilm/pages/login.php">
                                <button class="btn btn-primary">Login</button>
                            </a>
                            <a href="http://localhost/matchfilm/pages/register.php">
                                <button class="btn btn-primary">Registro</button>
                            </a>
                          </div>`
}