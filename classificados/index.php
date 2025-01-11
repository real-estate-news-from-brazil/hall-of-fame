<?php 
include_once("config/conexao.php");

/*
Script Desenvolvido por RENAN VINICIUS

renanvin@live.com
renan@megaperes.com.br

FAVOR MANTER OS CRÉDITOS

*/

?>
<!-- Desenvolvido por RENAN VINICIUS renanvin@live.com -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Listar An&uacute;ncios</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function ver_anuncio(ID){
		window.open('ver_anuncio.php?ID='+ ID +'','page','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=800,height=320'); 
}
function enviar_anuncio(){
		window.open('cadastrar_anuncio.php','page','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=350,height=370'); 
}
</script>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#F8F8F8">
  <tr>
    <td width="210" height="28" align="left" valign="middle" bgcolor="#666" style="color:#ccc;">Categorias</td>
    <td width="569" align="left" valign="middle" bgcolor="#666" style="color:#ccc;">An&uacute;ncios</td>
  </tr>
  <tr>
    <td height="29" align="left" valign="top">
    <?php 
	$categorias = mysql_query("SELECT * FROM categorias ORDER BY nome ASC");
	while($lnc = mysql_fetch_object($categorias)):
	?>
    <div id="menu_categorias"><a href="?categoria=<?php echo $lnc->ID; ?>"><?php echo $lnc->nome; ?></a></div>
    <?php 
	endwhile;
	?>
    <br />
    <div align="center"><a href="javascript: enviar_anuncio();" class="botao" style="text-decoration:none;">Cadastre seu anúncio (<strong>GRÁTIS</strong>)</a></div>
    <br />
    </td>
    <td align="left" valign="top">
    <br />
    <table width="100%" border="0">
      <tr>
        <td width="20%"><div align="right">Faça sua busca: </div></td>
        <td width="80%" align="left">
        <form name="busca" method="post" action="">
          <input name="query" type="text" class="form" id="query" />
          <input name="buscar" type="submit" class="botao" id="buscar" value="Buscar" />
        </form>
        </td>
      </tr>
    </table>
    <br />
 <?php 
 
 	if(@$_POST){
			$sql = mysql_query("SELECT * FROM anuncios WHERE descricao LIKE '%".$_POST["query"]."%' ORDER BY ID DESC");
	}else{
 
		if(empty($_GET["categoria"])){
			$sql = mysql_query("SELECT * FROM anuncios WHERE status = 'Ativo' AND ID ORDER BY RAND() LIMIT 10");
		}else{
			$sql = mysql_query("SELECT * FROM anuncios WHERE categoria = '".strip_tags($_GET["categoria"])."' AND status = 'Ativo' ORDER BY nome ASC");
		}
	}
	
			if(mysql_num_rows($sql) == false){
				echo '<div align="center"><br /><strong>Nenhum anúncio encontrado.</strong><br /></div>';
			}else{
				while($ln = mysql_fetch_object($sql)){
	?>
       <table width="100%" border="0">
         <tr>
           <td width="2%" height="110" align="center" valign="middle"><img src="uploads/<?php echo $ln->thumb; ?>" width="140" height="90" /></td>
           <td width="98%" align="left" valign="top">
           <div align="left" style="margin:5px; font-size:11px;"><?php echo truncate(strip_tags($ln->descricao), 150); ?>...</div>
           <div align="left" style="margin:5px; font-size:11px;">Data: <strong><?php echo str_replace("-", "/", inverteData($ln->data)); ?></strong></div>
           <div align="left" style="margin:5px; font-size:11px;">Enviado por: <strong><?php echo $ln->nome; ?></strong></div>
           <div align="left" style="margin-left:5px; margin-top:10px;"><a href="javascript: ver_anuncio(<?php echo $ln->ID; ?>);" class="botao" style="text-decoration:none;">Ver anúncio</a></div>
           </td>
         </tr>
       </table>
       <?php 
				}
	   ?>
<?php 
			}
	?>
    </td>
  </tr>
</table>
</body>
</html>
