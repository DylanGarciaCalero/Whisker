<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style.css">
</head>
<body>
    <?php 
        $cookie = $_COOKIE["usercookie"] ?? "0";
        console_log($cookie);
        if ($cookie) {
            ?>
            <div class="whisker_info">
                <h2>What is Whisker?</h2>
                <p>Whisker is a platform where you can make a post to find a lost pet, or find the owner of a found pet</p>
            </div>
            <div class="view_posts">
                <h2><a href="/posts"> View posts </a></h2>
                <p>Or make a post below</p>
            </div>
                <form method="POST">
                    <h1>Make a post</h1>
                    <label>
                        <p>Type of post?</p>
                        <select name="type">
                            <option value="1">Lost</option>
                            <option value="2">Found</option>
                        </select>
                    </label>
                    <label>
                        <p>Type of animal?</p>
                        <select name="animal">
                            <option value="1">Cat</option>
                            <option value="2">Dog</option>
                        </select>
                    </label>
                    <label>
                        <p>Title</p>
                        <input type="text" name="title" required>
                    </label>
                    <label>
                        <p>Description</p>
                        <textarea type="textarea" rows="15" cols="50" name="description" required></textarea>
                    </label>
                    <label>
                        <p>Zipcode</p>
                        <input type="text" name="zipcode" required>
                    </label>
                    <label>
                        <p>City</p>
                        <input type="text" name="city" required>
                    </label>
                    <label>
                        <p>Street</p>
                        <input type="text" name="street">
                    </label>
                    <label>
                        <p>Number</p>
                        <input type="text" name="nr">
                    </label>
                    <button type="submit" name="post">Post!</button>
                </form>
            <?php 
        } else {
        ?>
        <div class="whisker_info">
            <h2>What is Whisker?</h2>
            <p>Whisker is a platform where you can make a post to find a lost pet, or find the owner of a found pet</p>
            <div class="whisker_info-flex">
                <p><a href="/register"> Register here</a></p>
                <p><a href="/login">log in here</a></p>
            </div>
        </div>
        <?php
        }
    ?>
</body>
</html>