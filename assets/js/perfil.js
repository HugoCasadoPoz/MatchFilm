function cargarAmigos(){
    let nombreUsuario = localStorage.getItem('username');

    if (nombreUsuario) {
        let url = `http://localhost/MatchFilm/api/post_amigos.php?nombre_usuario=${nombreUsuario}`;
        fetch(url)
            .then(res => {
                console.log(res);
                    return res.json();
              
                
            })
            .then(data => {
                console.log(data);
                let amigos = document.getElementById('amigo');
                    amigos.innerHTML = '';
                if (data.status == 200){
                        amigos.innerHTML += `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><b>${data[0].nombre_amigo}</b></h5>
                                <a href="#" class="btn btn-primary">Ver perfil</a>
                                <button type="submit" onclick="eliminarAmigo('${data[0].nombre_amigo}')" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>`;
                }else if(data.status==400){
                    amigos.innerHTML += `
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">No tienes amigos</h5>
                            <input type="text" id="nombreAmigo" class="form-control" placeholder="Nombre de usuario"><br>
                            <button type="submit" onclick="agregarAmigo(document.getElementById('nombreAmigo'))" class="btn btn-primary">Agrega a un Amigo</button>
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
            "nombre_amigo": nombreAmigo
        }
        console.log(JSON.stringify(amigos) );
        let url = `http://localhost/MatchFilm/api/gestionAmigos.php`;
        let options= {
            method: 'DELETE',
            body: JSON.stringify(amigos)
        }
        fetch(url, options)
        .then(res => {
            return res.json();
        })
        .then(data => {
            console.log(data);
            if(data.status == 201){
                alert('Amigo eliminado');
                cargarAmigos();
            }else{
                alert('Error al eliminar amigo');
            }
        })
        .catch(error => {
            console.error(error);
        })
    }
    // if(localStorage.getItem('username')){
    //     document.getElementById('cerrarSesión').addEventListener('click', cerrarSesion)
    //     function cerrarSesion(){
    //         localStorage.clear();
    //         window.location.href = './index.php';
    //     }
    // }else{
    //     localStorage.removeItem('token');        
    //     localStorage.removeItem('username');        
    //     alert ('Necesita iniciar sesion');
    //     location.href="./login.php";
    // }
        
