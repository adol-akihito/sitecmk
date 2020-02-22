<?php
echo $header;
?>
<div class="content">

    <div class="homePanel">
        <h1>Homepage</h1>
        <div class="homeMenu">
            <h4>Menu</h4>
            <p>Hello, <?php echo $username; ?>!</p>
            <?php if ($logged) { ?>
            <div><a class="btn btn-primary btn-lg btn-block" href="<?php echo $add_posts; ?>" role="button">Add new
                    post</a></div>
            <br>
            <div><a class="btn btn-primary btn-lg btn-block" href="<?php echo $logout; ?>" role="button">Logout</a>
            </div>
            <?php } else { ?>
            <div><a class="btn btn-primary btn-lg btn-block" href="<?php echo $login; ?>" role="button">Login</a>
            </div>
            <br>
            <div><a class="btn btn-primary btn-lg btn-block" href="<?php echo $register; ?>"
                    role="button">Register</a></div>
            <?php } ?>
        </div>
    </div>


    <div class="container">
        <h1 class="mb-5">Posts</h1>
        <br>
        <div class="card-columns">
            <?php foreach ($posts as $post) { ?>
            <div class="card">
                <div class="card-body text-dark">
                    <h5 class="card-title"><a
                                href="content/post?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h5>
                    <p class="card-text"><?php echo substr($post['content'], 0, 125); ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted font-italic"><?php echo $post['date_added']; ?></small>
                </div>
                <hr class="line">
            </div>

            <?php } ?>
        </div>

    </div>

</div>
<?php echo $footer; ?>
