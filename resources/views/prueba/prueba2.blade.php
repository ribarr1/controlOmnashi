<!DOCTYPE html>
<html>
<head>
	<title>Formulario</title>
</head>
<body>
	<form id="formulario" action="enviado.php" method="post">
	<fieldset>
	        <legend>Formulario de inscritos</legend>
	            <label>Fecha</label>
	                <input id="campo1" name="fecha" type="text" /><br><br>
	            <label>Documento</label>
	                <input id="campo2" name="documento" type="text" /><br><br>
	            <label>Nombre</label>
	                <input id="campo3" name="nombre" type="text" /><br><br>
	            <label>Correo</label>
	                <input id="campo4" name="correo" type="text" /><br><br>
	            <label>Telefono</label>
	                <input id="campo5" name="telefono" type="text" /><br><br>
	            <input id="campo3" name="enviar" type="submit" value="Enviar" />
    </fieldset>
</form>
</body>
</html>