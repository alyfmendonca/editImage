<!DOCTYPE html>
<html>

<head>
<?php 
    /* esse bloco de código em php verifica se existe a sessão, pois o usuário pode
    simplesmente não fazer o login e digitar na barra de endereço do seu navegador 
    o caminho para a página principal do site (sistema), burlando assim a obrigação de 
    fazer um login, com isso se ele não estiver feito o login não será criado a session, 
    então ao verificar que a session não existe a página redireciona o mesmo
    para a index.php.*/
    session_start();
    if($_SESSION['admin'] == "0" or (!isset ($_SESSION['usuario']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
    
    $logado = $_SESSION['usuario'];
    
?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="lz-string.min.js"></script> 
    <script src="base64-string.js"></script>
    <link rel="stylesheet" href="imageProcess.css">
</head>


<body>
    <div class="cont-pai">
        <canvas onclick="buildImage(event);" id="canvasss"></canvas>
        <div class="cont-baixo-botao">
            <button class="btn" onclick="limpaPai();">Limpar Salvos</button>
            <div>
                <button class="btn" onclick="limpaUm();">Remover</button>
                <input type="text" id="nomeRemov">
            </div>
            <div>
                <button class="btn" onclick="finalizar();">Finalizar</button>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Preview</h4>
                </div>
                <div class="modal-body">
                    <div class="cont-principal">
                        <div class="cont-cima">
                            <div>
                                <canvas onclick="modalClick(event);" id="canvasModal"></canvas>
                            </div>
                        </div>
                        <div class="cont-baixo">
                            <div>
                                <label>Valor:
                                    <input class="form-control" type="text" id="textVal" />
                                </label>
                                <div>
                                    <input type="checkbox" id="fontStandard" onclick="selectedFontType(event);" />
                                    <label>Fonte:
                                        <select disabled class="form-control" id="selectFont"
                                            onchange="setFont(event);">
                                            <option style="font-family: Arial, Helvetica, sans-serif;" value="Arial">
                                                Arial</option>
                                            <option style="font-family: Verdana, Geneva, Tahoma, sans-serif;"
                                                value="Verdana">Verdana</option>
                                            <option
                                                style="font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif"
                                                value="Cambria">Cambria</option>
                                            <option style="font-family: Georgia, 'Times New Roman', Times, serif"
                                                value="Georgia">Georgia</option>
                                            <option
                                                style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif"
                                                value="Impact">Impact</option>
                                            <option style="font-family: 'Courier New', Courier, monospace"
                                                value="Courier">Courier</option>
                                        </select>
                                    </label>
                                    <input type="checkbox" id="fontUpload" onclick="selectedFontType(event);" />
                                    <label>GoogleFonts
                                        <select disabled id="fontUploadFile" onchange="fontFileChange(event);">
                                        </select>
                                    </label>
                                </div>
                                <label>Tamanho da fonte:
                                    <select class=" form-control" id="selectTamFont" onchange="setSize(event);">
                                        <option value=12>12px</option>
                                        <option value=14>14px</option>
                                        <option value=20>20px</option>
                                        <option value=24>24px</option>
                                        <option value=30>30px</option>
                                        <option value=42>42px</option>
                                        <option value=58>58px</option>
                                        <option value=64>64px</option>
                                        <option value=72>72px</option>
                                    </select>
                                </label>
                                <label>Cor:
                                    <input style="display: hidden" type="color" id="selectColor"
                                        onchange="setColor(event);" />
                                </label>
                            </div>
                            <div>
                                <button class="btn btn-secondary" onclick="cancelarModal();">Cancelar</button>
                                <button class="btn btn-primary" onclick="salvarModal();">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>

        </div>
    </div>

    <script src="imageProcess.js"></script>
</body>

</html>