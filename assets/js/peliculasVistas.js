if (localStorage.getItem('token')) {

    let resultados = document.getElementById("resultados");

    peliculasVistas();

    function peliculasVistas() {
        resultados.innerHTML = '';
        resultados.innerHTML = '';
        let url = `http://localhost/matchfilm/api/get_likes.php`;
        let options = {
            method: 'GET',
            headers: {
                'Authorization': `${localStorage.getItem('token')}`,
            },
        };
        fetch(url, options)
            .then(res => {
                if (res.status == 200) {
                    return res.json();
                }
                if (res.status == 400) {
                    resultados.innerHTML = "<h2>No has visto ninguna película</h2>";
                }
            }).then(data => {
                console.log(data);
                if (data.length === 0) {
                    resultados.innerHTML = "<h2>No has visto ninguna película</h2>";
                }
                data.forEach(pelicula => {
                    console.log(pelicula.movie_id);
                    fetch(`http://localhost/matchfilm/assets/php/get_movie.php?id=${pelicula.movie_id}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            resultados.innerHTML += `
                            <div id="movie">
                                <img src="https://image.tmdb.org/t/p/w500${data.poster_path}" alt="${data.title}"/>
                                <div id="movie-info">
                                    <h3>${data.title}</h3>
                                    <span class="${getColor(data.vote_average)}">${data.vote_average.toFixed(1)}</span>
                                </div>
                                <div id="overview">
                                <h3>Descripción:</h3>
                                <p>${data.overview}</p>
                                </div>
                            </div>
                            `;
                        })
                        .catch(err => console.error(err));
                });
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
} else {
    localStorage.removeItem('token');
    localStorage.removeItem('username');
    localStorage.clear();
    document.getElementById('alert').innerHTML = `
    <div class="container-fluid bg-light p-5 text-center">
    <h1>No has iniciado sesión</h1>
    <p>Inicia sesión para acceder al contenido.</p>
    <a href="./login.php" id="irLogin" class="btn btn-primary">Iniciar sesión</a>
    </div>`;
}
