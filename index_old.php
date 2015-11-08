<?php

//Criar algoritmo para criptografia Conforme item 8 do moodle 
// Link Moodle: http://graduacao.ftec.com.br/course/view.php?id=7118



/*
- Inverter palavra
- fazer um calculo com o codigo ascii com numero escondido
- No final converter para base64
*/

//constantes de auxilio a criptografia e decriptografia
define('FIX_NUMBER_HELP_CRYPT', 18245);

function strToBinaryCrypt($text, $key){

	$tm = strlen($text); 
	$x = 0;
	for($i = 1;$i <= $tm;$i++){
	    $letra[$i] = substr($text,$x,1); 
	    $cod[$i] = ord($letra[$i]); 
	    $bin[$i] = decbin($cod[$i]); 
	    $x++;
	}
	for($i = 1;$i <= $tm;$i++){
	    $retorno .= $bin[$i] + $key;
	}

	return $retorno;


}

function multiplicaEmAscii($char, $multipler){

	return ord(utf8_encode($char)) * $multipler;


}

function divideAscii($ascii, $divisor){

	return $ascii / $divisor;

}

function myCrypt($text){

	$randRepeat = rand(1, 8);
	$randCrypt = str_pad(rand(1,2048), 4, 0, STR_PAD_LEFT);
	echo $randCrypt.'<br/>';
	$keyExplode = strToBinaryCrypt($text, FIX_NUMBER_HELP_CRYPT);

	$texto = str_repeat($text, $randRepeat);

	for ($i=0; $i < strlen($text); $i++) { 
			
		$palavraEmAsciiCrypt .= multiplicaEmAscii($text[$i], $randCrypt).$keyExplode;

	}

	return $randRepeat.$palavraEmAsciiCrypt.$randCrypt;
}

function decrypt($text){

	$randRepeat = $text[0];
	$randCrypt = substr($text, strlen($text)-4, 4);


	echo $randRepeat.'<br />';
	echo $randCrypt.'<br />';

	//$keyExplode = strToBinaryCrypt($texto,18245);

}

if($_POST){


	echo myCrypt($_POST['palavra']). '<br />';	
	echo decrypt(myCrypt($_POST['palavra']));
}


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="#" method="post" >
	<label>Palavra:</label>
	<input type="text" name="palavra" id="palavra" />

	<br />

	<button type="submit" >Enviar</button>
</form>





</body>
</html>
