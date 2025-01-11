<?php 

mysql_connect("localhost","usuario","senha") or die (mysql_error());
mysql_select_db("banco") or die (mysql_error());

date_default_timezone_set("America/Sao_Paulo");

function pega_ext($nome_arq){
  $ext = explode('.',$nome_arq);
  $ext = array_reverse($ext);
  return $ext[0];
}

  function manipulacao_img($nome_fotos, $thumb, $foto){
	  
	  //Copia e deleta a thumb enviada acima.
	  copy("uploads/".$thumb."", "uploads/".$nome_fotos."_thumb.jpg");
	  unlink("uploads/".$thumb."");
	  
	  //Copia e deleta a foto enviada acima.
	  copy("uploads/".$foto."", "uploads/".$nome_fotos.".jpg");
	  unlink("uploads/".$foto."");
	  
 } 
 function truncate($str, $len, $etc='') {
	$end = array(' ', '.', ',', ';', ':', '!', '?');

	if (strlen($str) <= $len)
		return $str;

	if (!in_array($str{$len - 1}, $end) && !in_array($str{$len}, $end))
		while (--$len && !in_array($str{$len - 1}, $end));

	return rtrim(substr($str, 0, $len)).$etc;
}
function inverteData($data, $separar = '-', $juntar = '-'){
	return implode($juntar, array_reverse(explode($separar, $data)));
}
?>