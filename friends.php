<?php
session_start();
$host = 'localhost';
$db = 'project-4';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}


if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    $stmt = $pdo->prepare("
        SELECT * 
        FROM users 
        WHERE username LIKE ? 
        AND id != ? 
        AND id NOT IN (
            SELECT friend_id 
            FROM friends 
            WHERE user_id = (SELECT id FROM users WHERE username = ?)
        )
    ");
    $stmt->execute(["%$searchTerm%", $_SESSION['user_id'], $_SESSION['username']]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Kevin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "assets/header.php" ?>
    <style>
        .friend {
            text-align: center;
            font-size: 32px;
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .search {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-box {
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 20px;
            width: 300px;
            font-size: 16px;
            margin-right: 10px;
        }

        .search-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-button:hover {
            background-color: #45a049;
        }

        .result-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .result {
            margin-bottom: 10px;
            padding: 10px 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
            font-size: 20px;
            text-align: center;
        }

        .add-friend-button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .add-friend-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="friend">
        Add a Friend
    </div>
    <div class="search">
        <form action="friends.php" method="GET">
            <input type="text" class="search-box" name="search" placeholder="Search for a friend">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <div class="result-container">
        <?php
        if (isset($results)) {
            if ($results) {
                foreach ($results as $user) {
                    echo '<div class="result">';
                    echo '<span style="font-size: 24px;">' . $user['username'] . '</span><br>';
                    echo '<form action="login.php" method="post">';
                    echo '<input type="hidden" name="friend_username" value="' . $user['username'] . '">';
                    echo '<button type="submit" class="add-friend-button" name="add_friend">Add Friend</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<div class="result">No users found.</div>';
            }
        }
        ?>
    </div>
</body>

</html>