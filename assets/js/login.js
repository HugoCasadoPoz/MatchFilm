if (!(localStorage.getItem('username'))){

    let username = document.getElementById('username');
    let password = document.getElementById('password');
    document.getElementById('loginBtn').addEventListener('click', login);

    function login(){
        let logusername={
            'username' : username.value.trim(),
            'password' : password.value.trim()
        }

        console.log(logusername);
        let url='http://localhost/MatchFilm/api/post_login.php';
        const options = {
            method: 'POST',
            headers:{
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(logusername),
          };
          fetch(url, options)
            .then(res => {
                if (res.status==200){
                    console.log(res);
                    return res.json();         
                }
                if(res.status==401){
                    alert('Credenciales no válidas');
                    close;
                }
                else{
                    alert('Credenciales no válidas');
                    close
                }
            })
            .then(data => {
                console.log(data);
                localStorage.setItem('token', data.token);        
                localStorage.setItem('username', data.username);        
                const currentDate = new Date();
                localStorage.setItem('tokenStartTime', currentDate.getTime());
                alert ('Login correcto');    
                location.href="./index.php";
            })        
}
}else{  
    alert ('Ya tienes iniciada sesión');
    location.href="./index.php";
}