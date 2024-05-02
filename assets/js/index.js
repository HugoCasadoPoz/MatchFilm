let movie_id;
let color;
function buscar(){
    const options = {
        method: 'GET',
        headers: {
          accept: 'application/json',
          Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1Y2EzMWVkZGFiNjE0OGVhNWM1ODY1YWQ5NWZmMWQ4MSIsInN1YiI6IjY1ZTRlNDcyMjBlNmE1MDE2MzUxZjQzOCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6IRKLCdBV7SK2KvzvVrlIPar4DjLApqE4RboCW99658'
        }
      };
      fetch('https://api.themoviedb.org/3/movie/popular?language=es-ES&page='+Math.floor(Math.random() * 20), options)
      .then(response => 
            response.json()
        )
        .then(response => {
            document.getElementById('nota').classList.remove();
            let numPeli = Math.floor(Math.random() * 20); //numero aleatorio entre 1 y 20
            console.log(response.results[numPeli]);
            document.getElementById('linkImagen').src = 'https://image.tmdb.org/t/p/w500' + response.results[numPeli].poster_path
            document.getElementById('titulo').innerHTML = response.results[numPeli].title;
            document.getElementById('descripcion').innerHTML = response.results[numPeli].overview;
            document.getElementById('nota').innerHTML = response.results[numPeli].vote_average.toFixed(1);
            document.getElementById("nota").classList.remove(color)
            color=getColor(response.results[numPeli].vote_average)
            document.getElementById('nota').classList.add(color);
            movie_id=response.results[numPeli].id;
            movie_id=response.results[numPeli].id;
        })
        .catch(err => 
            console.error(err)
        );
}
function getColor(vote){
    if(vote >= 7.5) {
        return "green";
    } else if (vote >=5 ){
        return "orange"
    }else{
        return "red";
    }
}

buscar();

let like = document.getElementById('like');
let dislike = document.getElementById('dislike');
if(localStorage.getItem("username")){
  like.addEventListener('click', function(){
    let like={
      'username' : localStorage.getItem('username'),
      'movie_id' : movie_id,
      'like': true
  }
  let url='http://localhost/MatchFilm/api/post_like.php';
  const options = {
      method: 'POST',
      headers:{
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(like),
    };
    fetch(url, options)
      .then(res => {
          if (res.status==201){
              console.log(res);
              return res.json();         
          }
          if(res.status==400){
              alert('Like fallido');
              close;
          }
      })
      .then(data => {
          buscar();
      })    
      
  });

  dislike.addEventListener('click', function  () {
    let like={
      'username' : localStorage.getItem('username'),
      'movie_id' : movie_id,
      'like': false
  }
  let url='http://localhost/MatchFilm/api/post_like.php';
  const options = {
      method: 'POST',
      headers:{
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(like),
    };
    fetch(url, options)
      .then(res => {
          if (res.status==201){
              console.log(res);
              return res.json();         
          }
          if(res.status==400){
              alert('Like fallido');
              close;
          }
      })
      .then(data => {
          buscar();
      })   
  });
}