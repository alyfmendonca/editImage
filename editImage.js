

//Variáveis retiradas do array da imagem
var imagem = "";
var dimX = "";
var dimY = "";

var imagemFinal = [];
var dadosFinal = [];
//Background
var background = new Image();

//Fiz no load para pegar a url, do local storage, que é muito grande
window.onload = () => {
    
    imagem = dadosImage[0]['image'];
    dimX = dadosImage[0]['larg'];
    dimY = dadosImage[0]['alt'];

    console.log(dadosImage);

    //transforma a URL em imagem
    background.src = imagem;

    //Infos canvas
    let canvas = document.getElementById('canvasFinal');
    let ctx = canvas.getContext("2d");

    //Seta tamanho do canvas
    canvas.width = this.dimX;
    canvas.height = this.dimY;

    //Desenha o canvas
    ctx.drawImage(this.background, 0, 0, this.dimX, this.dimY);

    //Desenha cada campo
    listCampos.forEach(campo => {

        //Pega as informações
        let fontSize = campo['fontSize'];
        let fontName = campo['fontName'];
        let fontColor = campo['fontColor'];
        let campoNome = campo['nome'];
        //Informações de dimensão
        let campoDimX = campo['cordX'];
        let campoDimY = campo['cordY'];

        //aplica fonte
        ctx.font = `${fontSize}px ${fontName}`;
        //Aplica Cor
        ctx.fillStyle = `${fontColor}`;
        //Escreve essa porra
        ctx.fillText(campoNome, campoDimX, campoDimY);
    });
    carregaInputs();
}

function carregaInputs() {
    //----- carregamento dos inputs
    let divPai = document.getElementById('campos');

    //Limpa se já existir
    while (divPai.firstChild){
        divPai.removeChild(divPai.firstChild);
    }

    listCampos.forEach(campo => {
        //Cria uma div
        var div = document.createElement("div");
        //Cria o label
        var label = document.createElement("label");
        label.setAttribute("for", campo['nome'])
        label.innerHTML = campo['nome'] + ": ";
        //Cria o input
        var input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("onchange", "alteraCampo(this);")
        input.setAttribute("id", campo['nome']);
        //Dá append
        div.appendChild(label);
        div.appendChild(input);
        divPai.appendChild(div);
    });
}



//Função do onchange
function alteraCampo(event) {
    //Armezena o que foi escrito
    var textoNovo = event.value;

    //Armazena qual campo foi escrito
    var id = event.id

    //Altera a lista
    this.listCampos.forEach(campo => {
        if(campo['nome'] == id){
            campo.nome = textoNovo;
        }
    });

    //Desenha novamente
    desenha();
}

//Essa função será recursiva, diferentemente da função do onload, que só acontecerá uma vez.
function desenha(){
    //Infos canvas
    let canvas = document.getElementById('canvasFinal');
    let ctx = canvas.getContext("2d");

    //A ordem será:
        // 1 - Limpa a imagem
        // 2 - Redesenha a imagem
        // 3 - Redesenha os campos
        // 4 - Redesenha os inputs com os IDs corretos, já que depois de alterar o valor, o ID deveria mudar também

    
        // 1 - Limpa
    ctx.clearRect(0, 0, this.dimX, this.dimY);
    
        // 2 - Redesenha Canvas
    //Desenha o canvas
    ctx.drawImage(this.background, 0, 0, this.dimX, this.dimY);

        // 3 - Insere Campos
        listCampos.forEach(campo => {

            //Pega as informações
            let fontSize = campo['fontSize'];
            let fontName = campo['fontName'];
            let fontColor = campo['fontColor'];
            let campoNome = campo['nome'];
            //Informações de dimensão
            let campoDimX = campo['cordX'];
            let campoDimY = campo['cordY'];
    
            //aplica fonte
            ctx.font = `${fontSize}px ${fontName}`;
            //Aplica Cor
            ctx.fillStyle = `${fontColor}`;
            //Escreve essa porra
            ctx.fillText(campoNome, campoDimX, campoDimY);
        });

        // 4 - Refaz inputs
        carregaInputs();
}
    

//Baixar o canvas
function downloadCanvas() {
    //Pega o canvas
    let canvas = document.getElementById('canvasFinal');
    
    let ImgURL = canvas.toDataURL("image/png");
    
    //Salva
    var link = document.createElement("a");
    link.download = 'imageName.png';
    link.href = ImgURL;
    link.click();

}

function finalizar(){
    //Pega o canvas
    let canvas = document.getElementById('canvasFinal');
    //URL imagem finalizada
    let ImgURL = canvas.toDataURL("image/png");

    this.imagemFinal.push({
        'image': ImgURL,
        'alt': dadosImage[0]['alt'],
        'larg': dadosImage[0]['larg'],
        'nome': dadosImage[0]['nome'],
        'user': user
    });
    $.post("teste.php", { dados: listCampos, photo: this.imagemFinal, operacao: 'A'  }).done(function(data) {
        if(data){
            //alert(data);
            window.location.replace("firstPage.php");
        } else {
            alert('Ocorreu um erro');
        }
        
        //window.location.replace("teste.php");
    }).fail(function() {
        alert("error");
    });
}