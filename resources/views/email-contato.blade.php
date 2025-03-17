<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Envio de E-mail</title>
</head>
<body>

    <div class="container">
        <h2>Enviar E-mail</h2>

        <form action="send_email.php" method="POST">
            <div class="form-group">
                <label for="user_email">E-mail do Destinatário</label>
                <input type="email" id="user_email" name="user_email" required placeholder="Digite o e-mail do destinatário">
            </div>

            <div class="form-group">
                <label for="subject">Assunto</label>
                <input type="text" id="subject" name="subject" required placeholder="Digite o assunto do e-mail">
            </div>

            <div class="form-group">
                <label for="message">Mensagem</label>
                <textarea id="message" name="message" rows="5" required placeholder="Digite sua mensagem"></textarea>
            </div>

            <button type="submit">Enviar E-mail</button>
        </form>
    </div>

</body>
</html>
