<?php include "Assets/header.php"; ?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games</title>
    <style>
    
        .games-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .game-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
        }

        .game-container img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .game-container img:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .game-container p {
            margin-top: 10px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="games-container">
        <div class="game-container">
            <a href="galgje.php">
                <img src="img/galgje.jpg" alt="Galgje">
                <p>Galgje: Probeer het woord te raden door letters te kiezen.</p>
            </a>
        </div>
        <div class="game-container">
            <a href="boterkaaseneieren.html">
                <img src="img/boterkaaseneierenspel.jpg" alt="Boter Kaas en Eieren">
                <p>Boter Kaas en Eieren: Krijg drie op een rij om te winnen.</p>
            </a>
        </div>
        <div class="game-container">
            <a href="vieropeneenrij.html">
                <img src="img/vieropeenrij.jpg" alt="Vier op een Rij">
                <p>Vier op een Rij: Krijg vier schijven op een rij om te winnen.</p>
            </a>
        </div>
        <div class="game-container">
            <a href="wordle.html">
                <img src="img/wordle.png" alt="Wordle">
                <p>Wordle: Raad het woord in zes pogingen.</p>
            </a>
        </div>
    </div>
</body>
</html>

<?php include "Assets/footer.php"; ?>     
