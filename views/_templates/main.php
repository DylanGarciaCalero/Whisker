<?php
$page = $_SERVER['REQUEST_URI'];
$details = "/posts/detail/";
$detailString = $details . $params[0];

switch($page) {
    case '/':
        $title = 'Whisker - Homepage';
        break;
    case '/login':
        $title = 'Whisker - Login';
        break;
    case '/register':
        $title = 'Whisker - Register';
        break;
    case '/posts':
        $title = 'Whisker - Posts';
        break;
    case '/profile':
        $title = 'Whisker - Profile';
        break;
    case $detailString:
        $title = 'Whisker - Detail';
        break;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Default title' ?></title>
    <link rel="stylesheet" href="/css/main.css?v=<?= time(); ?>">
</head>
<body>
    <header>
        <?php 
            $imagePath = "../images/Whisker_Logo.png";
            if($detailString == $_SERVER['REQUEST_URI']) {
                $imagePath = "../../images/Whisker_Logo.png";
            }
        ?>
        <img class="logo" src=<?= $imagePath; ?> alt="Whisker logo">
        <?php include_once  BASE_DIR . '/views/_templates/_partials/nav.php'; ?>
    </header>

    <main>
        <?= $content; ?>
    </main>
    
    <?php include_once BASE_DIR . '/views/_templates/_partials/footer.php'; ?>

</body>
</html>