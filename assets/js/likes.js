if(localStorage.getItem('username')){
        
    let resultados = document.getElementById("resultados")
    document.getElementById('matches').addEventListener('click', matches)
    document.getElementById('like').addEventListener('click', likes);

    // function matches(){
    //     document.getElementById("resultados").innerHTML = "<h2>Todavía no tienes ningún match</h2>";
    // }
    function likes(){
        let url = 'http://localhost/MatchFilm/api/get_likes.php';
        let options = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        };
        fetch(url, options)
            .then(res => {
                if (res.status == 200) {
                    return res.json()
                        
                }
                if (res.status == 400) {
                    alert('Credenciales no válidas');
                }
            }).then(data => {
                console.log(data);
                if (data.length === 0) {
                    resultados.innerHTML = "<h2>No tienes ningún like</h2>";
                }
                data.forEach(pelicula => {
                    let url = `https://api.themoviedb.org/3/movie/${pelicula.movie_id}?language=es-ES`
                    const options = {
                        method: 'GET',
                        headers: {
                          accept: 'application/json',
                          Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1Y2EzMWVkZGFiNjE0OGVhNWM1ODY1YWQ5NWZmMWQ4MSIsInN1YiI6IjY1ZTRlNDcyMjBlNmE1MDE2MzUxZjQzOCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6IRKLCdBV7SK2KvzvVrlIPar4DjLApqE4RboCW99658'
                        }
                      };
                    fetch(url, options)
                    .then(response => response.json())
                    .then(data => {
                        resultados.innerHTML+=`
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
                        `
                    })
                });
            }) 
    }
    function getColor(vote){
        if(vote>=7.5) {
            return "green";
        } else if (vote >=5 ){
            return "orange"
        }else{
            return "red";
        }
    }
}else{
    localStorage.removeItem('token');        
    localStorage.removeItem('username');        
    alert ('Necesita iniciar sesion');
    location.href="./login.php";
}