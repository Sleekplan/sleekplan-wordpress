<?php if( isset( $_GET['notice'] ) && isset( $_GET['message'] ) ) : ?>
    <div class="notice notice-<?php echo $_GET['notice']; ?> is-dismissible">
        <p><?php echo urldecode( $_GET['message'] ); ?></p>
    </div>
<?php endif; ?>