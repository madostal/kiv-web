
var pocet=0;
var elem = document.getElementsByTagName("h2")[0]; // prvni H2 element
elem.innerHTML = " "; // obsah elementu

// funkce pro zmenu nadpisu
function pridej(){
    pocet++;
    if(pocet==10){
        elem.innerHTML = " ";
        pocet = 0;
    }
    elem.innerHTML += "+";
}

// periodicke spousteni funkce 'pridej' po 0.5s
setInterval(pridej,500);
