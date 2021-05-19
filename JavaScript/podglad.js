var text = document.querySelector(".tresc"); // tresci ogloszenia
if(text.innerHTML.length >= 435){ // innerHTML = tekst
    let textCut = text.innerHTML.substring(0,435); // redukcja tekstu
    const lastSpace = textCut.lastIndexOf(" "); //indeks ostatniej spacji - aby nie urywac polowy wyrazu
    text.innerHTML = textCut.substring(0,lastSpace); // utnij zadlugie ogloszenie
    text.innerHTML+= "...";
    document.querySelector(".ogloszenie").innerHTML+="<a href='./ogloszenia.php'>Czytaj Wiecej</a>";
}