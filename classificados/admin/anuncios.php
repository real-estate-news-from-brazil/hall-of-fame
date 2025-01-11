<link href="../estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ver_anuncio(ID){
		window.open('../ver_anuncio.php?ID='+ ID +'&tabadmin=true','page','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=800,height=320'); 
}
</script>
<?php 
if(@$_GET["acao"] == "lista"):
?>

<?php 
$sql = mysql_query("SELECT * FROM anuncios ORDER BY nome ASC");
if(mysql_num_rows($sql) == false){
	echo '<br /><div align="center">Nenhuma anuncio cadastrado.</div>';
	exit;
}
?>
<br />
<table width="100%" border="0" align="center" cellpadding="0" id="table">
  <tr>
    <td width="12%" height="26" align="left" valign="middle">&nbsp;</td>
    <td width="51%" height="26" align="left" valign="middle">&nbsp;Nome</td>
    <td width="12%" align="center" valign="middle">Status</td>
    <td width="11%" align="center" valign="middle">&nbsp;</td>
    <td width="14%" align="center" valign="middle">&nbsp;</td>
  </tr>
<?php 
while($ln = mysql_fetch_object($sql)):
?>
  <tr id="tr">
    <td height="27" align="center" valign="middle">&nbsp;<a href="javascript: ver_anuncio(<?php echo $ln->ID; ?>);">Ver An&uacute;ncio</a></td>
    <td height="27" align="left" valign="middle">&nbsp;<?php echo $ln->nome; ?></td>
    <td align="center" valign="middle"><strong><?php echo $ln->status; ?></strong></td>
    <td align="center" valign="middle">
    <?php 
	if($ln->status == "Ativo"){
		echo '<a href="index.php?pg=anuncios&acao=alterar_status&ID='.$ln->ID.'&status=Inativo">Desativar</a>';
	}elseif($ln->status == "Inativo"){
		echo '<a href="index.php?pg=anuncios&acao=alterar_status&ID='.$ln->ID.'&status=Ativo">Ativar</a>';
	}
	?>
    </td>
    <td width="14%" align="center" valign="middle"><a href="index.php?pg=anuncios&acao=deletar&ID=<?php echo $ln->ID; ?>" onclick="return confirm('Deseja realmente deletar?'); return false;">Deletar</a></td>
  </tr>
<?php 
endwhile
?>
</table>
<?php 
endif;
?>

<?php 
if(@$_GET["acao"] == 'alterar_status'){
	
	$ID = $_GET["ID"];
	$status = $_GET["status"];
	
	mysql_query("UPDATE anuncios SET status = '$status' WHERE ID = '$ID'");
	
	header("Location: index.php?pg=anuncios&acao=lista");
}
?>

<?php 
if(@$_GET["acao"] == 'deletar'){
	
	$del = mysql_fetch_object(mysql_query("SELECT * FROM anuncios WHERE ID = '".$_GET["ID"]."'"));
	
	@unlink("../uploads/".$del->foto."");
	@unlink("../uploads/".$del->thumb."");
	
	mysql_query("DELETE FROM anuncios WHERE ID = '".$_GET["ID"]."'");
	header("Location: index.php?pg=anuncios&acao=lista");
}
?>
