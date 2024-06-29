<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #2d2d2d;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #444;
        }
        .header img {
            width: 100px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.6;
            color: #ffffff;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #e3342f;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #cc1f1a;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #444;
            font-size: 0.8em;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <p>Olá,</p>
            <p>Você foi convidado a se registrar. Clique no botão abaixo para completar seu cadastro:</p>
            <p><a href="{{ $url }}" class="btn">Completar Cadastro</a></p>
            <p>Este link expirará em 7 dias.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Laravel. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
