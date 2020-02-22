<?php echo $header ?>
<main class="content">
    <div class="container" id="content">
        <?php if ($error) { ?>
        <div class="alert alert-danger alert-dismissible">
            <?php echo $error; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <h3 class="mb-3">New Post</h3>
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control input-lg" id="title" name="title"
                       placeholder="Enter your post.." required>
            </div>
            <div class="form-group">
                <label for="content">Post</label>
                <textarea class="summernote" id="content" name="content" rows="10"
                          placeholder="Enter your text.." required></textarea>
            </div>
            <div class="pull-right">
                <button id="button" class="btn btn-primary" title="Save">Save</button>
            </div>
        </form>
    </div>
</main>

<?php echo $footer ?>