function onJsonPreferiti(json){
    console.log("json");
    console.log(json);
    posts = document.querySelector("section");
    fetch("check_preferiti.php").then(onResponse).then(function (json_preferiti){
        fetch("check_current_user.php").then(onResponse).then(function (json_current){
            for (let i = 0; i < json.length; i++){
                for (let j = 0; j < json_preferiti.length; j++){                   
                    if(json[i].id === json_preferiti[j].contenent && json_current === json_preferiti[j].user){
                        const zero_preferiti = document.querySelector('h1');
                        zero_preferiti.innerHTML = 'Guarda i tuoi post preferiti:';

                        post = document.createElement('div');
                        post.classList.add('post');
                    
                        id = document.createElement('div');
                        id.classList.add('id');
                        id.innerHTML = json[i].id;
                        post.appendChild(id);
                    
                        img = document.createElement('img');
                        img.classList.add('foto');
                        img.src = json[i].foto;
                        post.appendChild(img);
                    
                        text = document.createElement('div');
                        text.classList.add('contenuti');
                    
                        title = document.createElement('div');
                        title.classList.add('titolo');
                        title.innerHTML = json[i].titolo;
                        text.appendChild(title);
                    
                        descrizione = document.createElement('div');
                        descrizione.classList.add('testo');
                        descrizione.innerHTML = json[i].descrizione;
                        text.appendChild(descrizione);
                    
                        preferiti = document.createElement('a');
                        preferiti.classList.add('button');
                        preferiti.classList.add('preferiti');
                        preferiti.innerHTML = 'Preferito';
                        text.appendChild(preferiti);
                    
                        post.appendChild(text);
                        posts.appendChild(post);
                    }
                    
                }
            }
        })
        
    })
}

function onResponse(response) {
    console.log('risposta');
    console.log(response);
    return response.json();
}

fetch("load_contenuti.php").then(onResponse).then(onJsonPreferiti);
