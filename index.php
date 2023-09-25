<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiveServer</title>
</head>
<style>
    table {
        width: 100%;
        border: 1px solid black;
        padding: 0px;
        text-align: left;
        align-items: left;
    }

    html {
        background-color: #2a2a2a;
    }

    textarea {
        background-color: #666;
        color: white;
        text-align: left;
        min-width: 100%;
        max-width: 100%;
        height: 100px;
        font-size: 80%;
    }

    span {
        color: white;
        font-size: smaller;
    }

    .celular {
        background-color: #000;
        width: 80%;
        height: 800px;
        border-radius: 20px;
        padding: 5% 5% 5% 5%;
    }

    .tela {
        background-color: #fff;
        width: 100%;
        height: 90%;


    }

    .botao {
        background-color: #fff;
        width: 2px;
        height: 5px;
        border-radius: 15px
    }
</style>

<body>
    <table cols="2" rows="1">
        <tr>
            <th> </th>
            <th> </th>
        </tr>
        <tr>
            <th>
                <span>HTML:</span><br>
                <textarea id='codigo'><!--Example of real-time code running-->
                <html>
                   <body>
                   <div class="top"></div>
                   </body>
                </html>
                <!----------->



                </textarea>

                <br><span>CSS:</span><br>
                <textarea id='codigocss'>/*class ".tela" is the same of HTML tag*/
                    .tela{
                       background-color:green;
                    }
                    .top{
                        width:100%;
                        height:10px;
                        background-color:red;
                    }

                    </textarea>



                <hr>
                <center>
                    <div class="celular">
                        <div class="tela">

                            <div id='live'></div>

                            <!--<div class="botao"> </div>-->
                        </div>

                    </div>
                </center>
            </th>



        </tr>
    </table>
</body>
<script>
    function att() {
        document.getElementById('live').innerHTML = '<style>' + document.getElementById('codigocss').value + '</style>' + document.getElementById('codigo').value;
    }
    setInterval(att, 1);
</script>

</html>