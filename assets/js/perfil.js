document.getElementById('nombreUser').innerHTML='Nombre Usuario: '+localStorage.getItem('username')
function cargarAmigos(){
    let nombreUsuario = localStorage.getItem('username');

    if (nombreUsuario) {
        let url = `http://localhost/MatchFilm/api/post_amigos.php?nombre_usuario=${nombreUsuario}`;
        let options={
            method: 'GET',
            headers:{
                "Content-Type": "application/json" 
            }
        }
        fetch(url,options)
            .then(res => {
                if(res.status == 200){
                    return res.json();
                }else{
                    let amigos = document.getElementById('amigo');
                    amigos.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">No tienes amigos</h5>
                            <input type="text" id="nombreAmigo" class="form-control" placeholder="Nombre de usuario"><br>
                            <button type="submit" onclick="agregarAmigo(document.getElementById('nombreAmigo'))" class="btn btn-primary">Agrega a un Amigo</button>
                        </div>`;
                }
            })
            .then(data => {
                let amigos = document.getElementById('amigo');
                if (data[0].nombre_amigo==nombreUsuario){
                    amigos.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>${data[0].nombre_usuario}</b></h5>
                            <a href="#" class="btn btn-primary">Ver perfil</a>
                            <button type="submit" onclick="eliminarAmigo('${data[0].nombre_usuario}')" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>`;
                }else{
                    amigos.innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><b>${data[0].nombre_amigo}</b></h5>
                            <a href="#" class="btn btn-primary">Ver perfil</a>
                            <button type="submit" onclick="eliminarAmigo('${data[0].nombre_amigo}')" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>`;
                }
                    
                
            })
            .catch(error => {
                console.error(error);
            });
    } else {
        console.error('No se encontró el nombre de usuario en el almacenamiento local');
    }
}
cargarAmigos();

function agregarAmigo(){
    let nuevoUser = {
        'nombre_usuario': localStorage.getItem('username'),
        'nombre_amigo' : document.getElementById('nombreAmigo').value,
        'notificacion' : "amistad",
    }
    
    let url = 'http://localhost/MatchFilm/api/post_notificacion.php';
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
            alert ('Solicitud de amistad enviada Correctamente');
            location.href='./index.php';
        }) 
    }

    
    function eliminarAmigo(nombreAmigo){
        let nombreUsuario = localStorage.getItem('username');
        let amigos = {
            "nombre_usuario": nombreUsuario,
            "nombre_amigo": nombreAmigo,
        }
        let url = `http://localhost/MatchFilm/api/gestionAmigos.php`;
        let options= {
            method: 'DELETE',
            body: JSON.stringify(amigos)
        }
        fetch(url, options)
        .then(res => {
            if(res.status == 201){
                return res;
            }else{
                alert('Error al eliminar amigo');
            }
        })
        .then(data => {
            alert('Amigo eliminado');
            cargarAmigos();
            cargarNotificaciones()
        })
        .catch(error => {
            console.error(error);
        })
    }
    function cargarNotificaciones(){
        let nombreUsuario = localStorage.getItem('username');

        if (nombreUsuario) {
            let url = `http://localhost/MatchFilm/api/post_notificacion.php?nombre_usuario=${nombreUsuario}`;
            let options = {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
            };            
            fetch(url, options)
                .then(res => {
                    let notificaciones = document.getElementById('notificaciones');
                        notificaciones.innerHTML = '';
                    if (res.status == 200){

                        return res.json();
                    }else{
                        let notificaciones = document.getElementById('notificaciones');
                        notificaciones.innerHTML = 'No tienes notificaciones';
                    }
                })
                .then(data => {
                    
                        data.forEach(notificacion => {
                            if (notificacion.notificacion == 'amistad' && notificacion.nombre_usuario == nombreUsuario){

                            }else if(notificacion.notificacion == 'amistad'){
                                notificaciones.innerHTML += `
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>${notificacion.nombre_usuario}</b></h5>
                                        <p class="card-text">${notificacion.notificacion}</p>
                                        <a href="#" onclick="aceptarAmigo('${notificacion.nombre_usuario}')" class="btn btn-primary">Aceptar</a>
                                        <a href="#" onclick="eliminarNotificacion('${notificacion.nombre_usuario}','${notificacion.nombre_amigo}','${notificacion.notificacion}')" class="btn btn-danger">Rechazar</a>
                                    </div>
                                </div>`;
                            }else if (notificacion.nombre_usuario != nombreUsuario){
                                notificaciones.innerHTML += `
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>${notificacion.nombre_usuario}</b></h5>
                                        <p class="card-text">${notificacion.notificacion}</p>
                                    </div>
                                </div>`;
                                eliminarNotificacion(`${notificacion.nombre_usuario}`, `${notificacion.nombre_amigo}`, `${notificacion.notificacion}`)
                            }else{
                                notificaciones.innerHTML += `
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>${notificacion.nombre_amigo}</b></h5>
                                        <p class="card-text">${notificacion.notificacion}</p>
                                    </div>
                                </div>`;
                                eliminarNotificacion(`${notificacion.nombre_usuario}`, `${notificacion.nombre_amigo}`, `${notificacion.notificacion}`)
                            }
                              
                        });   
                });
        } else {
            window.location='index.html';
        }
        
    };

    function aceptarAmigo( nombre_amigo){
        let nombreUsuario = localStorage.getItem('username');
        let nuevoAmigo = {
            'nombre_usuario': nombreUsuario,
            'nombre_amigo' : nombre_amigo,
        }
        
        let url = 'http://localhost/MatchFilm/api/gestionAmigos.php';
        const options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(nuevoAmigo)
        };
        fetch(url, options)
            .then(res => {
                if (res.status == 200) {
                    return res.json(); 
                }
            })
            .then(data => {
                alert ('Amigo agregado Correctamente');

            }).finally(()=>{
                console.log(nombreUsuario + nombre_amigo);
                eliminarNotificacion(nombre_amigo,nombreUsuario , 'amistad')
                cargarNotificaciones();
                cargarAmigos();
            
            })
            
        
    }
    cargarNotificaciones();
                               
    function eliminarNotificacion(nombre_usuario, nombre_amigo, notificacion){
        let eliminar={
            "nombre_usuario": nombre_usuario,
            "nombre_amigo": nombre_amigo,
            "notificacion": notificacion
        }
        console.log(eliminar);
        let url = `http://localhost/MatchFilm/api/delete_notificacion.php`;
        const opciones= {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(eliminar)
        }
        fetch(url, opciones)
            .then(response=>{
                return response.json();
            }).then(datos =>{ 
            }).catch(error=> {
                console.log(error)
            })
            
    }                            
    if(localStorage.getItem('username')){
        document.getElementById('cerrarSesión').addEventListener('click', cerrarSesion)
        function cerrarSesion(){
            localStorage.clear();
            window.location.href = './index.php';
        }
    }else{
        localStorage.removeItem('token');        
        localStorage.removeItem('username');        
        alert ('Necesita iniciar sesion');
        location.href="./login.php";
    }
        
