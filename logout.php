<!-- LOGOUT -->
<?php

// Garantimos que temos uma session
session_start();

// Destruímos essa session
session_destroy();

// Redirecionamos para a página inicial
header("Location: index.php");

?>