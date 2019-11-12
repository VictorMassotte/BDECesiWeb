function searchFunction() {
    var input, filter, ul, li, a, i; // Declaration des variables
    input = document.getElementById('myinput'); // input qui va chercher ID dans ma barre de recherche
    filter = input.value.toUpperCase();
    ul = document.getElementById('wrapper'); // Mon bloc wrapper qui reunit tous les li
    li = ul.getElementsByTagName('li'); // Mes artciles avec li

    for(i=0 ; i< li.length; i++){
        a = li[i].getElementsByTagName('p')[0]; // Il regarde mes articles qui commence par p
        if(a.innerHTML.toUpperCase().indexOf(filter) > -1){ //Un if qui compare les articles avec la barre de recherche
            li[i].style.display = ""; //Affiche les articles 
        }

        else{
            li[i].style.display = 'none'; //N'affiche rien
        }
    }
}
