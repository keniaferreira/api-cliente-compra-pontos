<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Você ganhou pontos!</title>
    <style>
        body {
            background-color: #7d05be;
            color: #fff;
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        h1 {
            background-color: #7d05be;
            color: #fff;
            padding: 20px;
            font-size: 24px;
            margin: 0;
            border-bottom: 2px solid #fff;
        }
        p {
            font-size: 16px;
            margin: 20px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Parabéns!</h1>
    <p>Você ganhou {{ $pontosGanhos }} pontos!</p>
    <p>Continue comprando para ganhar ainda mais pontos e resgatar prêmios.</p>
</body>
</html>
