<?php 
include_once("config/conexao.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Cadastrar An&uacute;ncio</title>
<link href="estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<script type="text/javascript">
function valida_form(){
		var x = document.forms["cadastrar_anuncio"]["nome"].value
		if(x == null || x == ""){
			alert("Por favor, preencha o seu nome.");
			document.cadastrar_anuncio.nome.focus();
			return false;
		}
		var x = document.forms["cadastrar_anuncio"]["email"].value
		if(x == null || x == ""){
			alert("Por favor, preencha o seu e-mail.");
			document.cadastrar_anuncio.email.focus();
			return false;
		}
		var x = document.forms["cadastrar_anuncio"]["categoria"].value
		if(x == null || x == ""){
			alert("Por favor, selecione a categoria.");
			document.cadastrar_anuncio.categoria.focus();
			return false;
		}
		var x = document.forms["cadastrar_anuncio"]["descricao"].value
		if(x == null || x == ""){
			alert("Por favor, preencha a descrição do anúncio.");
			document.cadastrar_anuncio.descricao.focus();
			return false;
		}
}
</script>
<form onsubmit="return valida_form();" name="cadastrar_anuncio" id="name" method="post" action="" enctype="multipart/form-data">
  <table width="317" border="0" align="center">
    <tr>
      <td width="311" align="left" valign="middle">Seu nome:</td>
    </tr>
    <tr>
      <td align="left" valign="middle"><input style="width:300px;" name="nome" type="text" class="form" id="nome" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Seu e-mail:</td>
    </tr>
    <tr>
      <td align="left" valign="middle"><input style="width:300px;" name="email" type="text" class="form" id="email" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Categoria:</td>
    </tr>
    <tr>
      <td align="left" valign="middle">
      <select style="width:314px;" name="categoria" class="form" id="categoria">
      <option value="" selected="selected">Selecione...</option>
      <?php 
	  $sql = mysql_query("SELECT * FROM categorias ORDER BY nome ASC");
	  while($ln = mysql_fetch_object($sql)):
      	echo '<option value="'.$ln->ID.'">'.$ln->nome.'</option>'."\n";
	   endwhile;
	   ?>
      </select>
      </td>
    </tr>
    <tr>
      <td align="left" valign="middle">Foto:</td>
    </tr>
    <tr>
      <td align="left" valign="middle"><input name="foto" type="file" class="form" id="foto" /></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Descri&ccedil;&atilde;o do an&uacute;ncio:</td>
    </tr>
    <tr>
      <td align="left" valign="middle"><textarea style="width:300px; overflow:auto;" name="descricao" cols="45" rows="5" class="form" id="descricao"></textarea></td>
    </tr>
    <tr>
      <td align="left" valign="middle"><input name="enviar" type="submit" class="botao" id="enviar" value="Enviar" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php 
if(@$_POST["enviar"]){
	
	if(pega_ext($_FILES["foto"]["name"]) != "jpg" and pega_ext($_FILES["foto"]["name"]) != "png" and pega_ext($_FILES["foto"]["name"]) != "gif"){
		echo '<script type="text/javascript">alert("Sua foto deve ser no formato JPG, PNG ou GIF.");</script>';
		echo '<script type="text/javascript">location.href="javascript: history.back(0);";</script>';
		exit;
	}
	
	if(@$_FILES["foto"]["name"] == true){
		$foto_form = $_FILES["foto"];
		include_once ("config/upload.php");
    	$foto_old = upload_xy ($foto_form, $foto_form, 360, 280);
    	$thumb_old = upload_xy ($foto_form, $foto_form, 140, 90);
    	$nome_foto = md5(uniqid(time()));
    	manipulacao_img($nome_foto, $thumb_old, $foto_old);
    	$foto = $nome_foto . '.jpg';
    	$thumb = $nome_foto . '_thumb.jpg';
	}
	
	$nome = strip_tags($_POST["nome"]);
	$email = strip_tags($_POST["email"]);
	$categoria = strip_tags($_POST["categoria"]);
	$descricao = str_replace("\r\n", "<br/>", strip_tags($_POST["descricao"]));
	$data = date("Y-m-d");
	
	@mysql_query("INSERT INTO anuncios (nome, email, categoria, descricao, data, foto, thumb, status) VALUES ('$nome', '$email', '$categoria', '$descricao', '$data', '$foto', '$thumb', 'Inativo')");
	
	echo '<script type="text/javascript">alert("Anúncio cadastrado com sucesso, aguarde moderação.");</script>';
	echo '<script type="text/javascript">window.close();</script>';
	
}
?>
</body>
</html>