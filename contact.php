<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $honeypot = $_POST['website'];
    if (!empty($honeypot)) {
        // Campo escondido foi preenchido → SPAM
        die("Acesso negado.");
    }

    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = trim($_POST["mensagem"]);

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        $to = "r.lemesdemorais@gmail.com";
        $subject = "Nova mensagem do site de $nome";
        $body = "Nome: $nome\nE-mail: $email\n\nMensagem:\n$mensagem";
        $headers = "From: $nome <$email>";

        if (mail($to, $subject, $body, $headers)) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar. Tente novamente mais tarde.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>