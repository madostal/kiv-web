<!--
var pocet=0;
var elem = document.getElementsByTagName("div")[0];
function pridej(){
    pocet++;
    if(pocet==10){
        elem.innerHTML = " ";
        pocet=0
    }
    elem.innerHTML+="+";
}

elem.innerHTML=" ";
setInterval(pridej,500);
-->