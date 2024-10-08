<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prêmio Resgatado</title>
    <style>
        body {
            background-color: #7d05be;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .header {
            background-color: #7d05be;
            color: #fff;
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 2px solid #fff;
            margin: 0;
        }
        .content {
            padding: 20px;
            font-size: 16px;
        }
        strong {
            color: #fff;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        Parabéns!
    </div>
    <div class="content">
        <p>Você resgatou um prêmio com sucesso.</p>
        <p><strong>Prêmio:</strong> {{ $premio }}</p>
        <p><strong>Pontos Utilizados:</strong> {{ $pontosNecessarios }}</p>
        <p>Obrigado por participar do nosso programa de fidelidade!</p>
    </div>
</body>
</html>
