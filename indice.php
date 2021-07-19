<?php
require_once("archivos_php/conexion.php");

Definir los variables de los mensajes de errores
 $msgNombreError =  $msgApellidoError =  $msgCorreoError =  $msgTelefonoError = "";

if (isset($_POST['enviar'])) {
	 $nombre = trim($_POST['nombre']);
	 $apellido = trim($_POST['apellido']);
	 $correo = trim($_POST['correo']);
	 $telefono = trim($_POST['telefono']);
	 $expTelefono = "/^\+\d{3}\s\d{4}-\d{4}$/";
	
	Verificar los Correos Electrónicos ya existentes
	 $buscarCorreos = "SELECT * FROM datos_usuarios WHERE Correo='{$correo}'";
	 $consultaCorreos = mysqli_query($conexion,  $buscarCorreos);
	 $verificarCorreos = mysqli_num_rows($consultaCorreos);
	
	Verificar los Números Telefónicos ya existentes
	 $buscarTelefonos = "SELECT * FROM datos_usuarios WHERE Telefono='{$telefono}'";
	 $consultaTelefonos = mysqli_query($conexion,  $buscarTelefonos);
	 $verificarTelefonos = mysqli_num_rows($consultaTelefonos);
	
	Validaciones necesarias para los campos Nombre, Apellido, Correo y Teléfono.
	if (vacío($nombre)) {
		 $msgNombreError = "Su Nombre es Requerido!";
	} else if (is_numeric($nombre)) {
		 $msgNombreError = "No se permiten Numeros!";
	} else if (vacío($apellido)) {
		 $msgApellidoError = "Su Apellido es Requerido!";
	} else if (is_numeric($apellido)) {
		 $msgApellidoError = "No se permiten Numeros!";
	} else if (vacío($correo)) {
		 $msgCorreoError = "Su Correo Electrónico es Requerido!";
	} de lo contrario si (! filter_var($correo, FILTER_VALIDATE_EMAIL)) {
		 $msgCorreoError = "Su Correo Electrónico es Invalido!";
	} else if ($verificarCorreos > 0) {
		 $msgCorreoError = "¡El Correo Electrónico ya Existe!";
	} else if (vacío($telefono)) {
		 $msgTelefonoError = "Su Número Telefónico es Requerido!";
	} de lo contrario si (! preg_match($expTelefono,  $telefono)) {
		 $msgTelefonoError = "Su Número Telefónico es Invalido!";
	} else if ($verificarTelefonos > 0) {
		 $msgTelefonoError = "¡El Número Telefónico ya Existe!";
	} más {
		Registrar los datos de cada campo si TODOS fueron validados exitosamente
		 $registro = "INSERT INTO datos_usuarios(Nombre, Apellido, Correo, Telefono)
		VALUES('{$nombre}', '{$apellido}', '{$correo}', '{$telefono}')";
		 $resultado = mysqli_query($conexion,  $registro);
	}
}
?>
<! DOCTYPE html>
<html lang="es-HN">
<cabeza>
<?php include_once("archivos_php/meta_datos.php");
echo "<título>" .  $titulo_sitio . "</título>\n";
echo "<meta name='{$meta_nombre1}' content='{$author}' />\n";
echo "<meta name='{$meta_nombre2}' content='{$viewport}' />\n";
echo "<meta name='{$meta_nombre3}' content='{$keywords}' />\n";
echo "<meta name='{$meta_nombre4}' content='{$description}' />\n";
?>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<Link Rel="Hoja de estilos" Tipo="Texto/CSS" HREF="Estilo/Índice.css" Medios="Pantalla" />
</cabeza>
<cuerpo>
<div id="contenedor">
<?php
 $titulo_contenido = "Registro Simple de Usuarios";
echo "\t<h1>" .  $titulo_contenido . "</h1>\n";
?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<conjunto de campos>
		<leyenda>Ingrese sus Datos</leyenda>
			<label>Nombre:</label> 
			<?php echo "<span class='mensaje_error'>" .  $msgNombreError . "</span>\n"; ?>
			<input type="text" placeholder="Su Nombre" name="nombre" value="<?php if (isset($nombre)) echo  $nombre; ?>" />
			<etiqueta>Apellido:</etiqueta> 
			<?php echo "<span class='mensaje_error'>" .  $msgApellidoError . "</span>\n"; ?>
			<input type="text" placeholder="Su Apellido" name="apellido" value="<?php if (isset($apellido)) echo  $apellido; ?>" />
			<etiqueta>Correo Electrónico:</label> 
			<?php echo "<span class='mensaje_error'>" .  $msgCorreoError . "</span>\n"; ?>
			<input type="text" placeholder="usuario@dominio.com" name="correo" value="<?php if (isset($correo)) echo  $correo; ?>" />
			<etiqueta>Teléfono:</etiqueta> 
			<?php echo "<span class='mensaje_error'>" .  $msgTelefonoError . "</span>\n"; ?>
			<input type="text" placeholder="+XXX XXXX-XXXX" name="telefono" value="<?php if (isset($telefono)) echo  $telefono; ?>" />
			< Input Type="Submit" Name="Enviar" Value="Registrar" />
		</conjunto de campos>
	</forma>
	
<?php
include_once("archivos_php/mostrar_registros.php");

 $url_contenido = ".. /";
 $url_titulo_contenido = "Ir hacia atrás";
 $url_mensaje = "Ir Atrás";
echo "\t<a id='ir_atras' href='{$url_contenido}' title='{$url_titulo_contenido}'>{$url_mensaje}</a>\n";
?>
</Div>
</cuerpo>
</HTML>
