//////////// Prvni nadpis H2 bude nahrazen minimalistickou animaci ///////////

//// globalni promenne
// aktualni pocet znaku animace
var pocet=0;
// ziskam vsechny elementy H2 a beru z nich prvni
var elem = document.getElementsByTagName("h2")[0];
// vymazu elementu obsah
elem.innerHTML = " ";

/**
 * Funkce pro zmenu nadpisu
 */
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
