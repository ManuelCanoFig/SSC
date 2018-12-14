<?php
$conex = new mysqli("127.0.0.1", "root", "", "SSC");
/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Falló la conexión: %s\n", mysqli_connect_error());
    exit();
}

/* cambiar el conjunto de caracteres a utf8 */
if (!$conex->set_charset("utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", $conex->error);
    exit();
} else {

}
?>