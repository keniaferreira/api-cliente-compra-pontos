<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Você tem pontos suficientes!</title>
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
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        Olá {{ $nome }},
    </div>
    <div class="content">
        <p>Parabéns! Você tem pontos suficientes para resgatar prêmio(s) em nosso programa de fidelidade.</p>
        <p>Venha nos fazer uma visita assim que possível para ralizar o resgate!</p>
    </div>
</body>
</html>
