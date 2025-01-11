<link href="../estilo.css" rel="stylesheet" type="text/css" />

<?php 
if(@$_GET["acao"] == "lista"):
?>
<div align="left"><a href="index.php?pg=categorias&acao=cadastrar">Cadastrar categoria</a></div>
<?php 
$sql = mysql_query("SELECT * FROM categorias ORDER BY nome ASC");
if(mysql_num_rows($sql) == false){
	echo '<br /><div align="center">Nenhuma categoria cadastrada.</div>';
	exit;
}
?>
<br />
<table width="100%" border="0" align="center" cellpadding="0" id="table">
  <tr>
    <td width="83%" height="26" align="left" valign="middle">&nbsp;Nome</td>
    <td width="8%" align="center" valign="middle">&nbsp;</td>
    <td width="9%" align="center" valign="middle">&nbsp;</td>
  </tr>
<?php 
while($ln = mysql_fetch_object($sql)):
?>
  <tr id="tr">
    <td height="27" align="left" valign="middle">&nbsp;<?php echo $ln->nome; ?></td>
    <td align="center" valign="middle"><a href="index.php?pg=categorias&acao=editar&ID=<?php echo $ln->ID; ?>">Editar</a></td>
    <td align="center" valign="middle"><a href="index.php?pg=categorias&acao=deletar&ID=<?php echo $ln->ID; ?>" onclick="return confirm('Deseja realmente deletar?'); return false;">Deletar</a></td>
  </tr>
<?php 
endwhile
?>
</table>
<?php 
endif;
?>

<?php 
if(@$_GET["acao"] == "cadastrar"):
?>
<form name="cadastrar" method="post" action="">
<table width="378" border="0" align="center">
  <tr>
    <td width="48" align="right" valign="middle">Nome:</td>
    <td width="320" align="left" valign="middle"><input name="nome" type="text" class="form" id="nome" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input name="cadastrar" type="submit" class="botao" id="cadastrar" value="Cadastrar" /></td>
  </tr>
</table>
</form>
<br />
<div align="center"><a href="javascript: history.back(0);">Cancelar</a></div>
<?php 
if(@$_POST["cadastrar"]){

	if(@$_POST["nome"] == false){
		echo '<br /><strong>Preencha o nome da categoria.</strong>';
		header("Refresh: 2; index.php?pg=categorias&acao=cadastrar");
		exit;
	}
	
	$nome = $_POST["nome"];
	
	mysql_query("INSERT INTO categorias (nome) VALUES ('$nome')");
	
	echo '<br /><strong>Categoria cadastrada com sucesso.</strong>';
	
	header("Refresh: 2; index.php?pg=categorias&acao=lista");
	
}
?>
<?php 
endif;
?>

<?php 
if(@$_GET["acao"] == "editar"):
$ln = mysql_fetch_object(mysql_query("SELECT * FROM categorias WHERE ID = '".$_GET["ID"]."'"));
?>
<form name="editar" method="post" action="">
<table width="378" border="0" align="center">
  <tr>
    <td width="48" align="right" valign="middle">Nome:</td>
    <td width="320" align="left" valign="middle"><input name="nome" type="text" class="form" id="nome" value="<?php echo $ln->nome; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">&nbsp;</td>
    <td align="left" valign="middle"><input name="salvar" type="submit" class="botao" id="salvar" value="Salvar" /></td>
  </tr>
</table>
<br />
<div align="center"><a href="javascript: history.back(0);">Cancelar</a></div>
</form>
<?php 
if(@$_POST["salvar"]){

	if(@$_POST["nome"] == false){
		echo '<br /><strong>Preencha o nome da categoria.</strong>';
		header("Refresh: 2; index.php?pg=categorias&acao=editar&ID=".$_GET["ID"]."");
		exit;
	}
	
	$nome = $_POST["nome"];
	
	mysql_query("UPDATE categorias SET nome = '$nome' WHERE ID = '".$_GET["ID"]."'");
	
	echo '<br /><strong>Categoria atualizada com sucesso.</strong>';
	
	header("Refresh: 2; index.php?pg=categorias&acao=lista");
	
}
?>
<?php 
endif;
?>

<?php 
if(@$_GET["acao"] == 'deletar'){
	mysql_query("DELETE FROM categorias WHERE ID = '".$_GET["ID"]."'");
	header("Location: index.php?pg=categorias&acao=lista");
}
?>
