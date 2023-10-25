<?php
require('api.php');
if(EstaLogado())
{
    Redirecionar('index.php');
}
else
{
    if(isset($_GET['Nickname']))
    {
        if(Login($_GET['Nickname'],$_GET['password']))
        {
            $_SESSION['nicklive'] = encryptString($_GET['Nickname']);
            Redirecionar('index.php');

        }
        else
        {
            alert('Erro','Usuario ou senha inválida',3,5,true,'rgb(180, 100, 100)');
        }
    }
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
        background-color: #333;
        color: aliceblue;
    }
    a{
        text-decoration: none;
        color: aliceblue;
    }
    .login{
        background-color: #666;
        border-radius: 5px;
        width: 60%;
        margin-top: 70px;
        padding: 10px;
    }
    input{
        width: 75%;
        background-color: #333;
        border: none;
        margin-top: 5px;
        padding: 5px;
        color: aliceblue;
    }
    h3{
        color: aliceblue;
        font-family: Arial, Helvetica, sans-serif;
        font-stretch: expanded;
    }
    button{
        color: aliceblue;
        width: 75%;
        background-color: rgb(100, 180, 100);
        border: none;
        margin-top: 5px;
        padding: 5px;
    }
</style>
<body>
    <center>
    <div class="login">
        <form action="" method="get">
            <h3>Login</h3>
            <input type="text" name="Nickname" placeholder="Nickname"><br>
            <input type="password" name="password" id="" placeholder="Senha"><br>
            <button type="submit">Entrar</button>
        </form><br><br>
        Não tem cadastro?<br><a href="cadastro.php"><button>Cadastrar</button></a>
    </div>
    </center>
</body>
</html>