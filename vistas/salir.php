<html>
<head>
<title>Prueba de abandono de página</title>
<script language="JavaScript" type="text/javascript">
     
    var bPreguntar = true;
     
    window.onbeforeunload = preguntarAntesDeSalir;
     
    function preguntarAntesDeSalir()
    {
      if (bPreguntar)
        return "¿Seguro que quieres salir?";
    }
</script>
</head>
<body>
<h1>Ejemplo de abandono de página</h1>
<p>Por defecto preguntará hasta que pulses el botón de "No preguntar"</p>
<input type="button" value="Preguntar" onclick="bPreguntar = true;" >
&nbsp;&nbsp;
<input type="button" value="No preguntar" onclick="bPreguntar = false;" >
<br/><br/>
<a href="http://www.jasoft.org">Ir a otra página</a>
</body>
</html>