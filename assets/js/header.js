let logotipos = document.getElementById('logotipos');
if(localStorage.getItem('username')){
    logotipos.innerHTML+=`<a href="perfil.php">
                          <img src="./assets/img/usuario.png" alt="Logo de perfil" width="45px" height="45px">
                          </a>`;
}else{
    logotipos.innerHTML+=`<div id='botones'>
                            <a href="./login.php">
                                <button class="btn btn-primary">Login</button>
                            </a>
                            <a href="./register.php">
                                <button class="btn btn-primary">Registro</button>
                            </a>
                          </div>`
}