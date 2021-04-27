var showMore = document.getElementById("show-more");
var container = document.getElementById("movie-container");

showMore.addEventListener('click', function(){
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            container.innerHTML = xhr.responseText;
        }
    };

    xhr.open('GET', 'film.php', true);
    xhr.send();
});