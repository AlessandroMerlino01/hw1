function onJsonMain(json){
    console.log("json");
    console.log(json);
    requests = document.querySelector("section");
    for (let i = 0; i < json.length; i++){
        request = document.createElement('div');
        request.classList.add('post');//uso lo stesso stile della home


        text = document.createElement('div');
        text.classList.add('contenuti_main');

        id = document.createElement('div');
        id.classList.add('id');
        id.innerHTML = json[i].id;
        text.appendChild(id);

        email = document.createElement('div');
        email.classList.add('email');
        email.innerHTML = json[i].email;
        text.appendChild(email);
      
        descrizione = document.createElement('div');
        descrizione.classList.add('contactus');
        descrizione.innerHTML = json[i].testo;
        text.appendChild(descrizione);

        elimina = document.createElement('a');
        elimina.classList.add('button');
        elimina.classList.add('non_preferiti');//uso la stessa classe per il css
        elimina.innerHTML = 'Elimina';
        text.appendChild(elimina);


        request.appendChild(text);
        requests.appendChild(request);

    }
}

function onResponse(response) {
    console.log('risposta');
    return response.json();
}

fetch("load_main.php").then(onResponse).then(onJsonMain);