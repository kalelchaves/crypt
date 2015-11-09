<?php

/*
Constantes de auxilio a criptografia
*/

define('AUX_NUMBER_CRYPT_LIMIT', '$');
define('AUX_NUMBER_CALCULATE_CRYPT', rand(3,17));

/* General functions */

function dump($data){

	echo '<pre>';
	var_dump($data);
	echo '</pre>';

}

function stringKeyCryptToOriginArrayAscii($stringCrypt){

	$string = explode(AUX_NUMBER_CRYPT_LIMIT, $stringCrypt);
	array_pop($string);

	return $string;

}

function getAuxNumberCalculateCrypt(){

	return rand(2,9);

}

/* To Decrypt */

function convertArrayAsciiToString(array $arrayAscii){

	foreach($arrayAscii as $value) {
		
		$return .= chr($value);

	}

	return $return;

}

function convertArrayCalculatedAsciiToStringAscii(array $arrayCalculatedAscii, array $numberCalculate){

	foreach ($arrayCalculatedAscii as $key => $value) {
		
		$return .= ($value / (int) $numberCalculate[$key]) . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

function getNumberCalculateToCryptString($text){

	$number = substr($text, strlen($text) - 2, 2);
	return $number;

}

function removeNumberCalculateToCryptString($text){

	$text = substr($text, 0, strlen($text) - 2 );
	return $text;

}

/* To Crypt */
function convertStringToAscii($string){

	for($i=0; $i < strlen($string); $i++) {
		
		$return .= ord($string[$i]).AUX_NUMBER_CRYPT_LIMIT;

	}

	return $return;

}

function convertArrayAsciiToStringCalculatedAscii(array $arrayAscii){

	foreach ($arrayAscii as $key => $value) {
		
		$numberAuxCalculate = getAuxNumberCalculateCrypt();

		$return .= ($value * (int)$numberAuxCalculate) . str_pad($numberAuxCalculate, 2, '0', STR_PAD_LEFT) .AUX_NUMBER_CRYPT_LIMIT;		
	}

	return $return;

}

function extractNumberToCalculateAsciiString(array $arrayAscii){

	foreach ($arrayAscii as $key => $value) {
		
		$numberArrayCalculate[] = substr($value, strlen($value)-2, 2);

	}

	return $numberArrayCalculate;

}

function removeNumberToCalculateAsciiString(array $arrayAscii){

	foreach ($arrayAscii as $key => $value) {
		
		$string .= substr($value, 0, strlen($value)-2) . AUX_NUMBER_CRYPT_LIMIT;

	}

	return $string;

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
	$numbersCalculate = extractNumberToCalculateAsciiString( stringKeyCryptToOriginArrayAscii( $text ) );
	$text = removeNumberToCalculateAsciiString( stringKeyCryptToOriginArrayAscii($text) );
	$text = convertArrayCalculatedAsciiToStringAscii( stringKeyCryptToOriginArrayAscii($text), $numbersCalculate );
	$text = stringKeyCryptToOriginArrayAscii($text);
	$text = convertArrayAsciiToString($text);

	
	return $text;

}

if($_POST){

	if($_POST[palavra]){		
		$stringCrypt = myCrypt($_POST[palavra]);
	}
	
	if($_POST[palavrac]){
		$stringDeCrypt = deCrypt($_POST[palavrac]);
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="./resources/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
	<div class="container">
		<div class="card-panel hoverable">
			<h3>Random Numbers</h3>
			<div class="row">
				<form class="col s12" method="post"  accept-charset="ISO-8859-1">
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="" id="palavra" name="palavra" type="text" class="validate" value="<?php echo $stringDeCrypt;?>">
							<label for="palavra">To Encrypt</label>
						</div>
					</div>			
					<button class="btn waves-effect waves-light" type="submit" name="action">Encrypt
						<i class="material-icons right">visibility_off</i>
					</button>
				</form>
				<form class="col s12" method="post" accept-charset="ISO-8859-1">
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="" id="palavrac" name="palavrac" type="text" class="validate" value="<?php echo $stringCrypt;?>">
							<label for="palavra">To Decrypt</label>
						</div>
					</div>			
					<button class="btn waves-effect waves-light" type="submit" name="action">Decrypt
						<i class="material-icons right">visibility</i>
					</button>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="./resources/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="./resources/js/materialize.min.js"></script>
</body>
</html>

