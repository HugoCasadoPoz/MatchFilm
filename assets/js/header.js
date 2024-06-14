let logotipos = document.getElementById('logotipos');
if(localStorage.getItem('token')){
    logotipos.innerHTML+=`<div class="perfil">
                            <a href="http://localhost/matchfilm/pages/perfil.php">
                            <b>${localStorage.getItem('username')}</b>
                            <img src="http://localhost/matchfilm/assets/img/usuario.png" alt="Logo de perfil" width="45px" height="45px">
                            </a>
                          </div>`;
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