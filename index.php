<?php

/*
Constantes de auxilio a criptografia
*/

define('AUX_NUMBER_CRYPT_LIMIT', '654326532175041657942356743');
define('AUX_NUMBER_CALCULATE_CRYPT', rand(3,17));

/* General functions */

function dump($data){

	echo '<pre>';
	var_dump($data);
	echo '</pre>';

}

function stringKeyCryptToOriginArrayAscii($stringCrypt){

	$string = explode(AUX_NUMBER_CRYPT_LIMIT, $stringCrypt);
	return $string;

}

/* To Decrypt */

function convertArrayAsciiToString(array $arrayAscii){

	foreach($arrayAscii as $value) {
		
		$return .= chr($value);

	}

	return $return;

}

function convertArrayCalculatedAsciiToStringAscii(array $arrayCalculatedAscii){

	foreach ($arrayCalculatedAscii as $key => $value) {
		
		$return .= $value / AUX_NUMBER_CALCULATE_CRYPT . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

/* To Crypt */
function convertStringToAscii($string){

	for($i=0; $i < strlen($string); $i++) {
		
		$return .= ord($string[$i]).AUX_NUMBER_CRYPT_LIMIT . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

function convertArrayAsciiToStringCalculatedAscii(array $arrayAscii){

	foreach ($arrayAscii as $key => $value) {
		
		$return .= $value * AUX_NUMBER_CALCULATE_CRYPT . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

/* Aplication functions */

function myCrypt($text){

	$text = convertStringToAscii($text);
	$text = convertArrayAsciiToStringCalculatedAscii( stringKeyCryptToOriginArrayAscii($text) );
	$text = base64_encode($text);
	return $text;

}

function deCrypt($text){

	$text = base64_decode($text);
	$text = convertArrayCalculatedAsciiToStringAscii( stringKeyCryptToOriginArrayAscii($text) );
	$text = stringKeyCryptToOriginArrayAscii($text);
	$text = convertArrayAsciiToString($text);
	
	return $text;

}

if($_POST){

	if($_POST[palavra]){
		
		$stringCrypt = myCrypt($_POST[palavra]);
		dump($stringCrypt);
	}
	
	//$stringDeCrypt = deCrypt('MTQ3NjU0MzI2NTMyMTc1MDQxNjU3OTQyMzU2NzQzMDY1NDMyNjUzMjE3NTA0MTY1Nzk0MjM1Njc0MzA2NTQzMjY1MzIxNzUwNDE2NTc5NDIzNTY3NDM=');
	//	dump($stringDeCrypt);

	if($_POST[palavrac]){
		$stringDeCrypt = deCrypt($_POST[palavrac]);
		dump($stringDeCrypt);
	}
	//$stringCrypt = myCrypt($_POST[palavra]);
	//$stringDeCrypt = deCrypt($stringCrypt);

	//dump($stringCrypt);
	//dump($stringDeCrypt);

}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="#" method="post" accept-charset="ISO-8859-1" >
	<label>Palavra:</label>
	<input type="text" name="palavra" id="palavra" />

	<br />

	<button type="submit" >Enviar</button>
</form>





</body>
</html>


<!DOCTYPE html>
<html>
<head>
	<!--Import Google Icon Font-->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="./resources/css/materialize.min.css"  media="screen,projection"/>

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
	<div class="container">
		<div class="row">
			<form class="col s6" method="post">
				<div class="row">
					<div class="input-field col s6">
						<input placeholder="" id="palavra" name="palavra" type="text" class="validate" value="<?php echo $stringDeCrypt;?>">
						<label for="palavra">To Encrypt</label>
					</div>
				</div>			
				<button class="btn waves-effect waves-light" type="submit" name="action">Encrypt
					<i class="material-icons right">send</i>
				</button>
			</form>
			<form class="col s12" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="" id="palavrac" name="palavrac" type="text" class="validate" value="<?php echo $stringCrypt;?>">
						<label for="palavra">To Decrypt</label>
					</div>
				</div>			
				<button class="btn waves-effect waves-light" type="submit" name="action">Decrypt
					<i class="material-icons right">send</i>
				</button>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="./resources/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="./resources/js/materialize.min.js"></script>
</body>
</html>