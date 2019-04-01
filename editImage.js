var dimLarg = localStorage.getItem("dimLarg");
var dimAlt = localStorage.getItem("dimAlt");



function getDados(campos, imagem){
    console.log(campos);
    console.log(imagem);
}

//Canvas pai
let canvas = document.getElementById('canvasss');
let ctx = canvas.getContext("2d");


//Proporções
var propAlt = dimAlt / 150;
var propLarg = dimLarg / 200;

//Tamanho do canvas
canvas.width = dimLarg;
canvas.height = dimAlt;

//Pega imagem do local storage
let background = new Image();
background.src = localStorage.getItem("formImage");

background.onload = function () {
    ctx.drawImage(background, 0, 0, dimLarg, dimAlt);
}
