<?php

//Criar algoritmo para criptografia Conforme item 8 do moodle 
// Link Moodle: http://graduacao.ftec.com.br/course/view.php?id=7118



/*
- Inverter palavra
- fazer um calculo com o c´odigo ascii com numero escondido
- No final converter para base64
*/


function strToBinaryCript($text, $key){

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

function divideEmAscii($ascii, $divisor){

	return $ascii / $divisor;

}

function cript($texto){

	$randRepeat = rand(1, 8);
	$randCript = str_pad(rand(1,2048), 4, 0, STR_PAD_LEFT);
	$keyExplode = strToBinaryCript($texto,18245);

	$palavra = str_repeat($texto, $randRepeat);

	//  testetestetestetestetestetestetesteteste

	for ($i=0; $i < strlen($palavra); $i++) { 
			
		$palavraEmAsciiCript .= multiplicaEmAscii($palavra[$i], $randCript).$keyExplode;

	}

	echo str_pad($randCript, 4, 0, STR_PAD_LEFT).'<br />';
	echo $randCript.'<br />';
	return $randRepeat.$palavraEmAsciiCript.str_pad($randCript, 4, 0);
}

function decript($texto){

	for ($i=0; $i < strlen($palavra); $i++) { 
			
		$palavraEmAsciiCript .= multiplicaEmAscii($palavra[$i], $randCript).$keyExplode;

	}


	$randRepeat = rand(1, 8);
	$randCript = rand(1,1024);
	$palavra = $texto;
	$keyExplode = strToBinaryCript($texto,18245);

	$palavra = str_repeat($palavra, $randRepeat);

}

if($_POST){


	echo cript($_POST['palavra']). '<br />';

	//Decript

	//echo base64_encode('teste').'<br />';
	//echo base64_decode('teste');
	echo ord(utf8_decode('£')).'<br />';
	echo ord(utf8_encode('£')).'<br />';
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
