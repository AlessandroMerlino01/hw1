function remove_favourite(event){
    button = event.currentTarget;
    //console.log(button);
    button.classList.remove('preferiti');
    //console.log(button);
    const post_id=button.parentNode.parentNode.firstChild.innerHTML;
    console.log(post_id);
    const formData = new FormData();
    formData.append('postid', post_id);
    console.log(formData);
    fetch("remove_preferiti.php", {method: 'post', body: formData});
  
    // Cambio la classe del bottone per farlo sparire
    const rimuovi = button.parentNode.parentNode;
    rimuovi.classList.add('hidden');
    const check = document.querySelectorAll('.preferiti');
    
    console.log(check);
    if(check.length === 0){
        const zero_preferiti = document.querySelector('h1');
        zero_preferiti.innerHTML = 'Non hai post preferiti';
    }
  }

setTimeout(function (){    
    const remove_preferito = document.querySelectorAll('.preferiti');
    for (let i = 0; i < remove_preferito.length; i++){
      const current = remove_preferito[i];
      current.addEventListener('click', remove_favourite);
    } 
}, 500)