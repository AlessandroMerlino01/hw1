const numResults = 5;

//key e endpoint per apikey
const key_img = '26886999-3eeb596fa2114d652ceaeb501';
const img_api_endpoint = 'https://pixabay.com/api/';

//uso sempre questa funzione
function onResponse(response) {
  console.log(response);
    return response.json();
}

function show_img(event){
  const episode = document.querySelector('#album-view');
  episode.classList.remove('hidden');
  button_i.removeEventListener('click', show_img);
  button_i.addEventListener('click', hide_img);
  button_i.innerHTML = 'Nascondi';
}

function hide_img(event){
  const episode = document.querySelector('#album-view');
  episode.classList.add('hidden');
  button_i.removeEventListener('click', hide_img);
  button_i.addEventListener('click', show_img);
  button_i.innerHTML = 'Vedi foto di orologi';
}

function onJson_img(json) {
    // Stampiamo il JSON per capire come è fatto
    console.log(json);
    const library = document.querySelector('#album-view');
    const results = json.hits
    for(result of results){
      const album = document.createElement('div');
      album.classList.add('album');
      const img = document.createElement('img');
      img.src = result.webformatURL;
      album.appendChild(img);
      library.appendChild(album);
    }
    form.removeEventListener('click', search_img);
    button_i.addEventListener('click', hide_img);
    button_i.innerHTML = 'Nascondi';
}

function search_img(event){
  
	const content = 'rolex'; //scelgo rolex come stringa da cercare perché è 
  //l' unico marchio che ho trovato nel database di questa API
	
	const encodedtext = encodeURIComponent(content);

	img_request = img_api_endpoint + '?key='  + key_img + '&q=' + encodedtext + '&per_page=' + numResults;
	fetch(img_request).then(onResponse).then(onJson_img); 
}

function show_spotify(event){
  const episode = document.querySelector('#playlist-view');
  episode.classList.remove('hidden');
  button_s.removeEventListener('click', show_spotify);
  button_s.addEventListener('click', hide_spotify);
  button_s.innerHTML = 'Nascondi';
}

function hide_spotify(event){
  const episode = document.querySelector('#playlist-view');
  episode.classList.add('hidden');
  button_s.removeEventListener('click', hide_spotify);
  button_s.addEventListener('click', show_spotify);
  button_s.innerHTML = 'Vedi Podcast di orologi';
}


function onJson_spotify(json){
  //rimuovo l'event listener perchè se non lo facessi e cliccassi sul link rifaccio la fetch
  spotify.removeEventListener('click', search_spotify);
  console.log(json);
  const library = document.querySelector('#playlist-view');
  library.innerHTML = '';
  //salvo le informazioni che mi interessano
  const result = json.playlists.items;
  const playlist_data = result[0];
  const title = playlist_data.name;
  const playlist_image = playlist_data.images[0].url;
  const link = playlist_data.external_urls.spotify;
  console.log(link);

  const link_spotify = document.createElement('a');
  link_spotify.classList.add('link')
  link_spotify.href=link;

  const playlist = document.createElement('div');
  playlist.classList.add('playlist');

  const caption = document.createElement('span');
  caption.textContent = title;

  const img_spotify = document.createElement('img');
  img_spotify.src = playlist_image;

  playlist.appendChild(img_spotify);
  playlist.appendChild(caption);
  link_spotify.appendChild(playlist);
  library.appendChild(link_spotify);
  //console.log(button_s);
  button_s.addEventListener('click', hide_spotify);
  button_s.innerHTML = 'Nascondi';
}


function search_spotify(event){
  fetch("search_on_spotify.php").then(onResponse).then(onJson_spotify);

}

const form = document.querySelector('#search_img');
const button_i = document.querySelector('#search_img .button');
form.addEventListener('click', search_img);

const spotify = document.querySelector('#spotify');
const button_s = document.querySelector('#spotify .button');
spotify.addEventListener('click', search_spotify);


function add_favourite(event){
  button = event.currentTarget;
  const post_id=button.parentNode.parentNode.firstChild.innerHTML;
  console.log(post_id);
  const formData = new FormData();
  //prendo id
  formData.append('postid', post_id);
  console.log(formData);
  fetch("add_preferiti.php", {method: 'post', body: formData});

    // Cambio la classe del bottone
  button.classList.remove('non_preferiti');
  button.classList.add('preferiti');

  // Aggiorno i listener
  button.removeEventListener('click', add_favourite);
  button.addEventListener('click', remove_favourite);
  

}

function remove_favourite(event){
  button = event.currentTarget;
   //prendo id
  const post_id=button.parentNode.parentNode.firstChild.innerHTML;
  console.log(post_id);
  const formData = new FormData();
  formData.append('postid', post_id);
  console.log(formData);
  fetch("remove_preferiti.php", {method: 'post', body: formData});

  // Cambio la classe del bottone
  button.classList.remove('preferiti');
  button.classList.add('non_preferiti');

  // Aggiorno i listener
  button.removeEventListener('click', remove_favourite);
  button.addEventListener('click', add_favourite);
}

setTimeout(function (){
    const add_preferito = document.querySelectorAll('.non_preferiti');
    //console.log(add_preferito);
    for (let i = 0; i < add_preferito.length; i++){
      const current = add_preferito[i];
      current.addEventListener('click', add_favourite);
    } 
    
    const remove_preferito = document.querySelectorAll('.preferiti');
    //console.log(add_preferito);
    for (let i = 0; i < remove_preferito.length; i++){
      const current = remove_preferito[i];
      current.addEventListener('click', remove_favourite);
    } 
}, 500);//dato che gli elementi li carico dinamicamente la queryselector restituisce null, perciò aspetto 500 millisecondi
