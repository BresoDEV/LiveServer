<?php
session_start();
function Cadastrar($nick, $senha)
{
	if (!is_dir('codigos')) {
		mkdir('codigos');
		file_put_contents('codigos/index.php','<?php require("../api.php");Redirecionar("../index.php");?>');
	}
	if (!is_dir('codigos/'.encryptString($nick))) 
	{
		mkdir('codigos/'.encryptString($nick));
		file_put_contents('codigos/'.encryptString($nick).'/index.html',file_get_contents('html.txt'));
		file_put_contents('codigos/'.encryptString($nick).'/css.css',file_get_contents('css.txt'));
		file_put_contents('codigos/'.encryptString($nick).'/js.js',file_get_contents('js.txt'));
		file_put_contents('codigos/'.encryptString($nick).'/pass.bin',encryptString($senha));
		$_SESSION['nicklive'] = encryptString($nick);
		Redirecionar('index.php');
	}
	else
		return false;
}
function Login($nick, $senha)
{
	if (!is_dir('codigos')) {
		mkdir('codigos');
	}
	if (is_dir('codigos/'.encryptString($nick))) 
	{
		if(encryptString($senha) === file_get_contents('codigos/'.encryptString($nick).'/pass.bin'))
			return true;
		else
			return false;
	}
	else
		return false;
}

function EstaLogado()
{
	if (isset($_SESSION['nicklive']))
		return true;
	else
		return false;
}

function Redirecionar($link)
{
	echo '<script>window.location.href = "' . $link . '";</script>';
}

function alert($tit, $msg, $tempo = 3, $layout = 5, $bordasredondas = true, $corfundo = 'rgb(50 140 50)', $corfonte = 'white')
{
	$c = 'abcdefghijklmnopqrstuvwxyz';
	$s = '';
	for ($i = 0; $i < 10; $i++) {
		$ca = $c[rand(0, strlen($c) - 1)];
		$s .= $ca;
	}
	$id = $s;
	echo '<style>.not{justify-content: center;flex-wrap: wrap;
	background-color:' . $corfundo . ';color:' . $corfonte . ';display: flex;
    flex-wrap: wrap;flex: 1;padding:5px 15px 5px 15px;transition: all 1s linear;</style>
	<center><div style="opacity:0;flex: 1;';
	if ($bordasredondas)
		echo 'border-radius:25px;';
	switch ($layout) {
		//esq baixo
		case 1: {
				echo 'left:10px;bottom:10px;width:50%;';
			}
			break;
		//dir baixo
		case 2: {
				echo 'right:10px;bottom:10px;width:50%;';
			}
			break;
		//direita cima
		case 3: {
				echo 'right:10px;width:50%;top:10px;';
			}
			break;
		//esquerda cima
		case 4: {
				echo 'left:10px;width:50%;top:10px;';
			}
			break;
		//topo centro
		case 5: {
				echo 'left:25%;width:50%;top:10px;';
			}
			break;
		//baixo centro
		case 6: {
				echo 'left:25%;width:50%;bottom:10px;';
			}
			break;
		default: {
				echo 'left:25%;width:50%;top:10px;';
			}
			break;
	}


	echo 'position: fixed;font-size:150%;background-color:transparent;"
	id="' . $id . '"><div ';
	if ($bordasredondas)
		echo 'style="border-radius:15px 15px 0 0"';
	echo '	class="not">' . $tit . '<br></div>
	<div ';
	if ($bordasredondas)
		echo 'style="border-radius:0px 0px 15px 15px"';
	echo '	class="not">' . $msg . '</div>
	</div></center><script>var boleta = true;var boleta2 = false;var contador = 0.1;
	var pt =0;setInterval(()=>{if(boleta==true){if(contador >= 1.0)
	{boleta = false;boleta2 = true;}else{contador += 0.005;document.getElementById("' . $id . '").style.opacity = contador;
	}}if(boleta2==true){if(pt == ' . (166 * $tempo) . '){if(contador <= 0.0)
	{boleta = false;boleta2 = false;document.getElementById("' . $id . '").style.display = "none";
	}else{contador -= 0.002;document.getElementById("' . $id . '").style.opacity = contador;
	}}else{pt++;}}},5);</script>';
}

function encryptString($string) {
    $encrypted = openssl_encrypt($string, "aes-256-cbc", "chave_secreta", 0, 'chave_secretaaaa');
    return base64_encode($encrypted);
}

function decryptString($string) {
    $decrypted = openssl_decrypt(base64_decode($string),"aes-256-cbc", "chave_secreta", 0, 'chave_secretaaaa');
    return $decrypted;
}
?>