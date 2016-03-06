<?php
if(!empty($_POST['php_code'])){
	$php = $_POST['php_code'];
	$deobfCode = htmlspecialchars(deobf($php));
}
function deobf($phpcode){
	$phpcode = formatPHP($phpcode);
	$phpcode = base64_decode(getTextInsideQuotes(getEvalCode($phpcode)));
	@$phpcode = gzinflate(base64_decode(str_rot13(getTextInsideQuotes(end(explode(':', $phpcode))))));
	while(strlen(strstr($phpcode, '@eval($')) > 0)
		$phpcode = gzinflate(base64_decode(str_rot13(getTextInsideQuotes(getEvalCode($phpcode)))));
	
	return substr($phpcode, 2);
}
function getEvalCode($string){
	preg_match("/eval\((.*?)\);/", $string, $matches);
	return (empty($matches)) ? '' : end($matches);
}
function getTextInsideQuotes($string){
	preg_match('/("(.*?)")/', $string, $matches);
	return (empty($matches)) ? '' : end($matches);
}
function formatPHP($string){
	$string = str_replace('<?php', '', $string);
	$string = str_replace('?>', '', $string);
	$string = str_replace(PHP_EOL, "", $string);
	$string = str_replace(";", ";\n", $string);
	return $string;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>fopo.com.ar Deobfuscator</title>
</head>
<body>
<form action="" method="POST">
	<textarea name="php_code" style="width: 430px;height: 300px;"><?=isset($deobfCode) ? $deobfCode : ''?></textarea><br><br>
	<input type="submit" value="Deobfuscate">
</form>
</body>
</html>