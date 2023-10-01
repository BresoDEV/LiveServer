<?php
$mac = str_replace("-","",explode(" ",exec('getmac'))[0]);

if(!is_dir('codigos'))
{
    mkdir('codigos');
}

if(isset($_POST['html']))
{
    file_put_contents('codigos/'.$mac.'.html',$_POST['html']);
    file_put_contents('codigos/'.$mac.'.css',$_POST['css']);
    echo '<script>window.location.href = "index.php";</script>';
}

?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    html{
        background-color:#444;
        color:white;
    }
    table{
        border:1px solid white;
        width:40%;
    }
    
    textarea{
        width:98%;
        text-align:left;
        background-color:#ddd;
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
        width:50%;
        margin-top:5px;
        border:none;
    }
    input{
        width:100%;
        color:red;
    }
</style>
<body>
    <table>
        <tr>
            <td>
                <center>
                <button id="livePreview" >Live Preview - Desativado</button>
                <button id="Preview" >Ocultar Preview</button>
                <button id="exibircontroles">Exibir Controles</button>
                <hr>
                </center>
                
            </td>
            <td >
                <div  id="opcoes" style='display:none'>
                Largura: <font id='Larguraid'>300px</font><input type="range" name="" id="telaLargura" min='0' max='1500' value='500'><br>
                Altura: <font id='Alturaid'>300px</font><input type="range" name="" id="telaAltura" min='0' max='2000' value='800'><br>
                <hr>
                PosicaoX: <input type="range" name="" id="PosicaoX" min='0' max='1500' value='0'><br>
                PosicaoY: <input type="range" name="" id="PosicaoY" min='0' max='2000' value='0'><br>
               
            
            
            </div>
            </td>
        </tr>
        <form action="" method="post">
        <tr>
            <td>
                <center><button type="submit">Salvar</button></center><br>
                <textarea name="html" id="html" cols="30" rows="10"><?php
                    if(file_exists('codigos/'.$mac.'.html'))
                        echo file_get_contents('codigos/'.$mac.'.html');
                    else
                        echo file_get_contents('html.txt');
                ?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td>
                <textarea name="css" id="css" cols="30" rows="10"><?php
                     if(file_exists('codigos/'.$mac.'.css'))
                     echo file_get_contents('codigos/'.$mac.'.css');
                 else
                     echo file_get_contents('css.txt');
                ?></textarea>
            </td>
        </tr>
        </form>
        
    </table>

    <div id="celular" class="celular">
        <div id='tela' class="tela">
            <div id='live'>
            </div>
        </div>
    </div>


</body>
<script>
    var Previewexibindo = true;
    var exibircontrolesexibindo = false;
    var livepreview = false;


    setInterval(() => {
        if(livepreview)
        {
            document.getElementById('livePreview').style.backgroundColor = 'rgb(100 180 100)';
            document.getElementById('livePreview').textContent = 'Live Preview - Ativado';
            setInterval(() => {
                document.getElementById('live').innerHTML = '<style>' +document.getElementById('css').value +'</style>' + document.getElementById('html').value;
            }, 1);
        }
        else{
            document.getElementById('livePreview').style.backgroundColor = 'rgb(180 100 100)';
            document.getElementById('livePreview').textContent = 'Live Preview - Desativado';
        }
        }, 1);
   

    document.getElementById('livePreview').addEventListener('click',()=>{
        livepreview = !livepreview;
    });
    document.getElementById('Preview').addEventListener('click',()=>{
        if(Previewexibindo)
        {
            document.getElementById('Preview').textContent = 'Exibir Preview';
            document.getElementById('celular').style.display = 'none';
            Previewexibindo = false;
        }
        else
        {
            document.getElementById('Preview').textContent = 'Ocultar Preview';
            document.getElementById('celular').style.display = 'block';
            Previewexibindo = true;
        }
    });


    document.getElementById('exibircontroles').addEventListener('click',()=>{
        if(exibircontrolesexibindo)
        {
            document.getElementById('exibircontroles').textContent = 'Exibir Controles';
            document.getElementById('opcoes').style.display = 'none';
            exibircontrolesexibindo = false;
        }
        else
        {
            document.getElementById('exibircontroles').textContent = 'Ocultar Controles';
            document.getElementById('opcoes').style.display = 'block';
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