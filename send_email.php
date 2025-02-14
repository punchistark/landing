<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanear los datos
    $nombre = htmlspecialchars($_POST["nombre"]);
    $apellido = htmlspecialchars($_POST["apellido"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $telefono = htmlspecialchars($_POST["telefono"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);
    $boletin = isset($_POST["boletin"]) ? "Sí" : "No";

    // Validar los campos requeridos
    if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono) || empty($mensaje)) {
        die("Por favor, complete todos los campos.");
    }

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico inválido.");
    }

    // Destinatario
    $destinatario = "tucorreo@ejemplo.com";
    $asunto = "Respuesta a consulta";

    // Contenido del mensaje
    $contenido = "<strong>Nombre:</strong> $nombre<br>";
    $contenido .= "<strong>Apellido:</strong> $apellido<br>";
    $contenido .= "<strong>Email:</strong> $email<br>";
    $contenido .= "<strong>Teléfono:</strong> $telefono<br>";
    $contenido .= "<strong>Mensaje:</strong> $mensaje<br>";
    $contenido .= "<strong>¿Desea recibir boletines?:</strong> $boletin<br>";

    // Cabeceras
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";  // Cabecera para contenido HTML

    // Enviar email
    if (mail($destinatario, $asunto, $contenido, $headers)) {
        // Redirigir a una página de gracias o confirmar el envío
        header("Location: gracias.html");  // Asegúrate de tener esta página
        exit();
    } else {
        echo "Error al enviar el mensaje. Por favor intente más tarde.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>

