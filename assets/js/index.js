if (localStorage.getItem('token')) {
    let movie_id;
    let color;
    let amigo;

    function peliculasAmigo() {
        let url = `http://localhost/matchfilm/api/post_amigos.php`;
        const options = {
            method: 'GET',
            headers: {
                'Authorization': `${localStorage.getItem('token')}`,
                'Content-Type': 'application/json'

            }
        };
        fetch(url, options)
            .then(res => {
                if (res.status == 200) {
                    return res.json();
                } else {
                    buscar();
                }
            })
            .then(data => {
                if (data[0].nombre_usuario == localStorage.getItem("username")) {
                    amigo = data[0].nombre_amigo;
                } else {
                    amigo = data[0].nombre_usuario;
                }
                let pareja = {
                    'usuario': localStorage.getItem("username"),
                    'amigo': amigo
                };
                console.log(pareja);
                let url = 'http://localhost/matchfilm/api/get_pelisPendientes.php';
                const options = {
                    method: 'POST',
                    headers: {
                        'Authorization': `${localStorage.getItem('token')}`,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(pareja),
                };
                fetch(url, options)
                    .then(res => {
                        if (res.status == 200) {
                            return res.json();
                        } else if (res.status == 401) {
                            buscar();
                        }
                    })
                    .then(data => {
                        console.log(data[0].movie_id);
                        buscarId(data[0].movie_id);
                    });
            });
    }

    function buscarId(id) {
        fetch(`http://localhost/matchfilm/assets/php/buscarId.php?id=${id}`)
            .then(response => response.json())
            .then(response => {
                console.log(response);
                document.getElementById('nota').classList.remove();
                document.getElementById('linkImagen').src = 'https://image.tmdb.org/t/p/w500' + response.poster_path;
                document.getElementById('titulo').innerHTML = response.title;
                document.getElementById('descripcion').innerHTML = response.overview;
                document.getElementById('nota').innerHTML = response.vote_average.toFixed(1);
                document.getElementById("nota").classList.remove(color);
                color = getColor(response.vote_average);
                document.getElementById('nota').classList.add(color);
                movie_id = response.id;
                like.addEventListener('click', function () {
                    let nuevoUser = {
                        'nombre_amigo': amigo,
                        'notificacion': "match",
                    };
                    let url = 'http://localhost/matchfilm/api/post_notificacion.php';
                    const options = {
                        method: 'POST',
                        headers: {
                            'Authorization': `${localStorage.getItem('token')}`,
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
                            // handle data if needed
                        });
                });
            })
            .catch(err => console.error(err));
    }

    function buscar() {
        fetch('http://localhost/matchfilm/assets/php/buscar.php')
            .then(response => response.json())
            .then(response => {
                document.getElementById('nota').classList.remove();
                let numPeli = Math.floor(Math.random() * 20);
                console.log(response.results[numPeli]);
                document.getElementById('linkImagen').src = 'https://image.tmdb.org/t/p/w500' + response.results[numPeli].poster_path;
                document.getElementById('titulo').innerHTML = response.results[numPeli].title;
                document.getElementById('descripcion').innerHTML = response.results[numPeli].overview;
                document.getElementById('nota').innerHTML = response.results[numPeli].vote_average.toFixed(1);
                document.getElementById("nota").classList.remove(color);
                color = getColor(response.results[numPeli].vote_average);
                document.getElementById('nota').classList.add(color);
                movie_id = response.results[numPeli].id;
            })
            .catch(err => console.error(err));
    }

    function getColor(vote) {
        if (vote >= 7.5) {
            return "green";
        } else if (vote >= 5) {
            return "orange";
        } else {
            return "red";
        }
    }

    peliculasAmigo();
    let like = document.getElementById('like');
    let dislike = document.getElementById('dislike');
    if (localStorage.getItem("username")) {
        like.addEventListener('click', function () {
            let like = {
                'movie_id': movie_id,
                'like': true
            };
            let url = 'http://localhost/matchfilm/api/post_like.php';
            const options = {
                method: 'POST',
                headers: {
                    'Authorization': `${localStorage.getItem('token')}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(like),
            };
            fetch(url, options)
                .then(res => {
                    if (res.status == 201) {
                        console.log(res);
                        return res.json();
                    }
                    if (res.status == 400) {
                        document.getElementById('alert').innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <strong>Like Fallido</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    }
                })
                .then(data => {
                    peliculasAmigo();
                });
        });

        dislike.addEventListener('click', function () {
            let like = {
                'movie_id': movie_id,
                'like': false
            };
            let url = 'http://localhost/matchfilm/api/post_like.php';
            const options = {
                method: 'POST',
                headers: {
                    'Authorization': `${localStorage.getItem('token')}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(like),
            };
            fetch(url, options)
                .then(res => {
                    if (res.status == 201) {
                        console.log(res);
                        return res.json();
                    }
                    if (res.status == 400) {
                        document.getElementById('alert').innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                            <strong>Like Fallido</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    }
                })
                .then(data => {
                    peliculasAmigo();
                });
        });
    }
} else {
    localStorage.removeItem('token');
    localStorage.removeItem('username');
    document.getElementById('movie').innerHTML = `
    <div class="container-fluid bg-light p-5 text-center" style= border-radius:22px>
    <h1>No tienes la sesión iniciada</h1>
    <p>Inicia sesión para acceder al contenido.</p>
    <a href="./login.php" id="irLogin" class="btn btn-primary">Iniciar sesión</a>
    </div>`;
}
