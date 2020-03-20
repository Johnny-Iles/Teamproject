<header>
    <div class="main-container">
        <a href="/" id="websiteName">DeliverYou</a>
        <ul>
            <?php if(isset($_SESSION["loggedin"])){ ?>
                <li><a href="/account.php" class="btn btn-primary">Account</a></li>
                <li><a href="/logout.php" class="btn btn-primary">Log out</a></li>
            <?php } else { ?>
                <li><a href="/login.php" class="btn btn-primary">Log in</a></li>
            <?php } ?>
        </ul>
    </div>
</header>