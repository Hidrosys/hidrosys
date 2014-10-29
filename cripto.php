<?php
	//http://www.linhadecodigo.com.br/artigo/1749/tutorial-criptografando-senhas-em-php.aspx
	// Variável com a senha guardada
	$senha = "renan36534676";
	$criptografada = base64_encode($senha);
	echo "Cripto " . $criptografada . "<br>";
?>
<?php 
	// Variável com a senha guardada 
	$senha = "renan36534676"; 
	$criptografada = base64_encode($senha); 
	echo "Decripto " . base64_decode($criptografada) . "<br>"; 
?>

