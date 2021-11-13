<?php 
    $cookie = $_COOKIE["usercookie"] ?? 0;
    if ($cookie) {
        if ($cookie == "admin") {
            ?>
            <nav>
                <a href="/dashboard">Adminpanel</a>
                <a href="/logout">Logout</a>
            </nav>
            <?php 
        } else {
            ?>
            <nav>
                <a href="/">Home</a>
                <a href="/profile">Profile</a>
                <a href="/posts">Posts</a>
                <a href="/logout">Logout</a>
            </nav>
            <?php 
        }
    } else {
        ?>
        <nav>
            <a href="/">Home</a>
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </nav>
        <?php 
    }
?>