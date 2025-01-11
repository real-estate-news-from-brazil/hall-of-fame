<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php 
include_once("config/conexao.php");

if(@$_GET["tabadmin"] == true){
$sql = mysql_query("SELECT * FROM anuncios WHERE ID = '".strip_tags($_GET["ID"])."'") or die (mysql_error());
}else{
$sql = mysql_query("SELECT * FROM anuncios WHERE ID = '".strip_tags($_GET["ID"])."' AND status = 'Ativo'") or die (mysql_error());
}



if(mysql_num_rows($sql) == false){
	echo '<script type="text/javascript">alert("Anúncio não encontrado.");</script>';
	echo '<script type="text/javascript">window.close();</script>';
	exit;
}
$ln = mysql_fetch_object($sql);
?>
<title>Anúncio: <?php echo $ln->nome; ?></title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellpadding="5" cellspacing="5">
         <tr>
           <td width="2%" align="center" valign="middle"><img src="uploads/<?php echo $ln->foto; ?>" width="360" height="280" /></td>
           <td width="98%" align="left" valign="top">
           <div align="left" style="margin:5px;"><?php echo truncate(strip_tags($ln->descricao), 200); ?></div>
           <br />
           <div align="left" style="margin:5px; font-size:11px;">Data: <strong><?php echo str_replace("-", "/", inverteData($ln->data)); ?></strong></div>
           <div align="left" style="margin:5px; font-size:11px;">Enviado por: <strong><?php echo $ln->nome; ?></strong></div>
           <br />
           <div align="left" style="margin-left:5px; margin-top:10px;"><a href="javascript: window.close();" class="botao" style="text-decoration:none;">Fechar anúncio</a></div>
           </td>
         </tr>
       </table>
</body>
</html>
