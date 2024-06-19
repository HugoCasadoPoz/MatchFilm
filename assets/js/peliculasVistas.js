if (localStorage.getItem('token')) {

    let resultados = document.getElementById("resultados");

    peliculasVistas();

    function peliculasVistas() {
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

    document.getElementById('searchActionButton').addEventListener('click', function() {
        var movieTitle = document.getElementById('searchInput').value;
        if(movieTitle) {
            console.log(movieTitle);
            fetch(`http://localhost/matchfilm/assets/php/buscarPeliculas.php?query=${movieTitle}`)
            .then(response => {
                console.log(response)
                return response.json()
            })
            .then(data => {
                var resultados = document.getElementById('resultados');
                resultados.innerHTML = '';

                if (data.results && data.results.length > 0) {
                    data.results.forEach(movie => {
                        var movieItem = document.createElement('div');
                        movieItem.className = 'result-item';
                        movieItem.innerHTML = `
                            <h5>${movie.title}</h5>
                            <p>${movie.overview}</p>
                            <input type="checkbox" class="movie-checkbox" data-movie-id="${movie.id}">
                        `;
                        resultados.appendChild(movieItem);
                    });
                } else {
                    resultados.innerHTML = '<p>No se encontraron resultados.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching movie data:', error);
            });
        } else {
            alert('Por favor, ingresa el nombre de una película.');
        }
    });

    document.getElementById('peliculasVistasButton').addEventListener('click', function() {
        var checkedMovies = document.querySelectorAll('.movie-checkbox:checked');
        var movieIds = [];
        checkedMovies.forEach(checkbox => {
            movieIds.push(checkbox.dataset.movieId);
        });

        if (movieIds.length > 0) {
            fetch('http://localhost/matchfilm/api/marcar_vistas.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `${localStorage.getItem('token')}`,
                },
                body: JSON.stringify({ movieIds: movieIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Películas marcadas como vistas.');
                    peliculasVistas(); // Actualizar la lista de películas vistas
                } else {
                    alert('Hubo un problema al marcar las películas como vistas.');
                }
            })
            .catch(error => console.error('Error marking movies as seen:', error));
        } else {
            alert('Por favor, selecciona al menos una película.');
        }
    });

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
