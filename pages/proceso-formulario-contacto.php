<?php
if (isset($_GET['email-usuario'])) {

    // EDIT THE FOLLOWING TWO LINES:
    $email_to = "bdgconsulting4.0@gmail.com";
    $email_subject = "Nuevo contacto de formulario";

    function problem($error)
    {
        echo "Se encontraron errores, por lo que el formulario no puedo ser enviado. ";
        echo "Estos errores aparecen debajo.<br><br>";
        echo $error . "<br><br>";
        echo "Por favor, vuelve a atrás y corrige los errores.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_GET['nombre-usuario']) ||
        !isset($_GET['email-usuario']) ||
        !isset($_GET['mensaje-usuario'])
    ) {
        problem(" Disculpas, pero parece que hay un error con tu mensaje.");
    }

    $name = $_GET['nombre-usuario']; // required
    $email = $_GET['email-usuario']; // required
    $message = $_GET['mensaje-usuario']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'La dirección de correo escrita no parece ser válida.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'El nombre y/o apellido no parece ser válida.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'El mensaje ingresado no parece ser válida.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Detalles del formulario.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "nombre-usuario: " . clean_string($name) . "\n";
    $email_message .= "email-usuario: " . clean_string($email) . "\n";
    $email_message .= "mensaje-usuario: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- INCLUDE YOUR SUCCESS MESSAGE BELOW -->

    "Muchas gracias por ponerse en contacto. Le estaremos respondiendo a la brevedad"

<?php
}
?>