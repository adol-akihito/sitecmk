<?php echo $header; ?>
<main class="content">
    <div class="container" id="content">
        <?php if ($error) { ?>
        <div class="alert alert-danger alert-dismissible">
            <?php echo $error; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <h2><?php echo $title; ?></h2>
        <hr>

        <div class="jumbotron">
            <section class="content content-boxed">
                <!-- Section Content -->
                <div class="push-50-t push-50 nice-copy-story">
                    <?php echo $content; ?>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <hr>
        <form action="<?php echo $show_comments; ?>" method="post" id="show-comments-form">
            <button type="button" class="btn btn-primary btn-lg btn-block" id="comments_show">Show comments</button>
        </form>
        <div id="comments_container"></div>
        <?php if ($logged) { ?>
        <form action="<?php echo $action; ?>" method="post" class="form-horizontal" id="form-review"
              style="display: none">

            <div class="form-group required">
                <div class="col-sm-12">
                    <label class="control-label" for="input-review">Your comment</label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                    <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                </div>
            </div>
            <div class="buttons clearfix">
                <div class="pull-right">
                    <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">
                        Continue
                    </button>
                </div>
            </div>
        </form>
        <?php } ?>

    </div>
</main>
<?php echo $footer; ?>
