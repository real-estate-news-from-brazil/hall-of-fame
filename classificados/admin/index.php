<?php 
include_once("../config/conexao.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Admin</title>
<link href="../estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<table width="700" border="0" align="center">
  <tr>
    <td align="left" valign="middle">
	<a href="index.php?pg=anuncios&acao=lista" class="botao" style="text-decoration:none;">Listar an&uacute;ncios</a>
	<a href="index.php?pg=categorias&acao=lista" class="botao" style="text-decoration:none;">Listar categorias</a>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top">
    <?php 
	@include_once(@$_GET["pg"].".php");
	?>
    </td>
  </tr>
</table>
</body>
</html>