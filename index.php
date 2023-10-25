<?php
require('api.php');
if (!EstaLogado()) {
    Redirecionar('login.php');
}

if(isset($_POST['html']))
{
    file_put_contents('codigos/'.$_SESSION['nicklive'].'/index.html',$_POST['html']);
    file_put_contents('codigos/'.$_SESSION['nicklive'].'/css.css',$_POST['css']);
    file_put_contents('codigos/'.$_SESSION['nicklive'].'/js.js',$_POST['js']);
    Redirecionar('index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<style>
    html {
        background-color: #666;
        color: aliceblue;
    }

    table {
        width: 50%;
    }
    textarea{
        min-width: 95%;
        width: 95%;
        background-color: #eee;
    }

    .celular{
        background-color:#000;
        width:40%;
        height:90%;
        position: fixed;
        top:10px;
        right:1%;
        border-radius:13px;
        padding:15px;
    }
    .tela{
        background-color:#fff;
        width:100%;
        height:100%;
        /*position: fixed;*/
        top:5%;
        right:2%;
        color:#000;
        
    }
    button{
        color: aliceblue;
        width: 100%;
        background-color: rgb(100, 180, 100);
        border: none;
        margin-top: 5px;
        padding: 5px;
        height: 100%;
    }
    input{
        width: 100%;
    }
</style>

<body>
    <table id="tabela">
        <center>
            <tr>
                <td><button id="livePreview">Live Preview</button></td>


                <td id="opcoes1" style='display:none'>X: <font id='Larguraid'>300px</font>
                </td>
                <td id="opcoes2" style='display:none'><input type="range" name="" id="telaLargura" min='0' max='1500' value='200'></td>
            </tr>
            <tr>
                <td><button id="Preview">Ocultar Preview</button></td>

                <td id="opcoes3" style='display:none'>Altura: <font id='Alturaid'>300px</font>
                </td>
                <td id="opcoes4" style='display:none'><input type="range" name="" id="telaAltura" min='0' max='1000' value='300'></td>
            </tr>
            <tr>
                <td><button id="exibircontroles">Exibir Controles</button></td>

                <td id="opcoes5" style='display:none'>PosicaoX: </td>
                <td id="opcoes6" style='display:none'><input type="range" name="" id="PosicaoX" min='0' max='1500' value='0'></td>
            </tr>
            <tr>
                <td><button id="executar">Executar</button></td>

                <td id="opcoes7" style='display:none'>PosicaoY: </td>
                <td id="opcoes8" style='display:none'><input type="range" name="" id="PosicaoY" min='0' max='2000' value='0'></td>
            </tr>

            <tr>
                <td>
                    <button id="copiarBtn" onclick="copiarLink()">Copiar link do seu site</button>
                </td>
            </tr>



            <form action="" method="post">
                <tr>
                    <td colspan="3">
                        <center><button type="submit">Salvar</button></center><br>
                        <textarea name="html" id="html" cols="30" rows="10"><?php
                        if (file_exists('codigos/'.$_SESSION['nicklive'].'/index.html'))
                            echo file_get_contents('codigos/'.$_SESSION['nicklive'].'/index.html');
                        else
                            echo file_get_contents('html.txt');
                        ?>
                </textarea>
                    </td>
                </tr>
                <tr>
                <td colspan="3">
                        <textarea name="css" id="css" cols="30" rows="10"><?php
                        if (file_exists('codigos/'.$_SESSION['nicklive'].'/css.css'))
                            echo file_get_contents('codigos/'.$_SESSION['nicklive'].'/css.css');
                        else
                            echo file_get_contents('css.txt');
                        ?></textarea>
                    </td>
                </tr>

                <tr>
                <td colspan="3">
                        <textarea name="js" id="js" cols="30" rows="10"><?php
                        if (file_exists('codigos/'.$_SESSION['nicklive'].'/js.js'))
                            echo file_get_contents('codigos/'.$_SESSION['nicklive'].'/js.js');
                        else
                            echo file_get_contents('js.txt');
                        ?></textarea>
                    </td>
                </tr>
            </form>



            <input type="text" id="link" style="position:fixed;top:-100px" value="<?php echo $_SERVER['DOCUMENT_ROOT'].'/codigos/'.$_SESSION['nicklive'].'/index.html';?>">





        </center>
    </table>


    <div id="celular" class="celular">
        <div id='tela' class="tela">
            <iframe class="tela" src="<?php echo 'codigos/'.$_SESSION['nicklive'].'/index.html'; ?>" frameborder="0" id='live'></iframe>
        </div>
    </div>

</body>
<script>
    var Previewexibindo = true;
    var exibircontrolesexibindo = false;
    var livepreview = false;


    function copiarLink()
    {
        <?php 
        echo '
        document.getElementById("link").select();
        document.getElementById("link").setSelectionRange(0,9999);
        document.execCommand("copy");
        document.getElementById("copiarBtn").textContent = "Link copiado com sucesso";
        document.getElementById("copiarBtn").style.backgroundColor = "orange";
        document.getElementById("copiarBtn").style.color = "black";
        ';
        ?>
    }


    setInterval(() => {
        if(livepreview)
        {
            document.getElementById('livePreview').style.backgroundColor = 'blue';
            document.getElementById('livePreview').textContent = 'Live Preview';
            setInterval(() => {
                document.getElementById('live').srcdoc = '<style>' +   document.getElementById('css').value +'</style>' + document.getElementById('html').value;
            }, 1);
        }
        else{
            document.getElementById('livePreview').style.backgroundColor = 'rgb(180 100 100)';
            document.getElementById('livePreview').textContent = 'Live Preview';
        }
    }, 1);
   

    document.getElementById('executar').addEventListener('click',()=>{
        document.getElementById('live').srcdoc = '<style>' +document.getElementById('css').value +'</style>' + document.getElementById('html').value;
    });

    document.getElementById('livePreview').addEventListener('click',()=>{
        livepreview = !livepreview;
    });
    document.getElementById('Preview').addEventListener('click',()=>{
        if(Previewexibindo)
        {
            document.getElementById('Preview').textContent = 'Exibir Preview';
            document.getElementById('celular').style.display = 'none';
            document.getElementById('tabela').style.width = '100%';
            Previewexibindo = false;
        }
        else
        {
            document.getElementById('Preview').textContent = 'Ocultar Preview';
            document.getElementById('celular').style.display = 'block';
            document.getElementById('tabela').style.width = '50%';
            Previewexibindo = true;
        }
    });


    document.getElementById('exibircontroles').addEventListener('click',()=>{
        if(exibircontrolesexibindo)
        {
            document.getElementById('exibircontroles').textContent = 'Exibir Controles';
            document.getElementById('opcoes1').style.display = 'none';
            document.getElementById('opcoes2').style.display = 'none';
            document.getElementById('opcoes3').style.display = 'none';
            document.getElementById('opcoes4').style.display = 'none';
            document.getElementById('opcoes5').style.display = 'none';
            document.getElementById('opcoes6').style.display = 'none';
            document.getElementById('opcoes7').style.display = 'none';
            document.getElementById('opcoes8').style.display = 'none';
            exibircontrolesexibindo = false;
        }
        else
        {
            document.getElementById('exibircontroles').textContent = 'Ocultar Controles';
            document.getElementById('opcoes1').style.display = 'block';
            document.getElementById('opcoes2').style.display = 'block';
            document.getElementById('opcoes3').style.display = 'block';
            document.getElementById('opcoes4').style.display = 'block';
            document.getElementById('opcoes5').style.display = 'block';
            document.getElementById('opcoes6').style.display = 'block';
            document.getElementById('opcoes7').style.display = 'block';
            document.getElementById('opcoes8').style.display = 'block';
            exibircontrolesexibindo = true;
        }
    });

    document.getElementById('telaLargura').addEventListener('input',()=>{

        document.getElementById('Larguraid').textContent = document.getElementById('telaLargura').value + 'px';
        document.getElementById('celular').style.width = document.getElementById('telaLargura').value + 'px';
    });
    
    document.getElementById('telaAltura').addEventListener('input',()=>{

        document.getElementById('Alturaid').textContent = document.getElementById('telaAltura').value + 'px';
        document.getElementById('celular').style.height = document.getElementById('telaAltura').value + 'px';
    });



    document.getElementById('PosicaoX').addEventListener('input',()=>{
        document.getElementById('celular').style.right = document.getElementById('PosicaoX').value + 'px';
    });
    
    document.getElementById('PosicaoY').addEventListener('input',()=>{
        document.getElementById('celular').style.top = document.getElementById('PosicaoY').value + 'px';
    });

</script>
</html>