<div class='wrap sp-admin'>
    
    <h1>
        Sleekplan 
        <span><?php _e( '(Auth)', 'sleekplan-wp' ); ?></span>
    </h1>
    <h2 class="title"> 
        <?php _e( 'Connect to a Sleekplan account', 'sleekplan-wp' ); ?> 
    </h2>
    <p>
        <?php echo sprintf( __( '<b>👋 Hey %s,</b><br><br> thanks for installing the <a target="_blank" href="https://sleekplan.com">Sleekplan</a> plugin for Wordpress. Sleekplan is an all-in-one feedback widget that enables you to build a community of collaborators straight on your website. If you do not have a Sleekplan account yet, you can create one right here. Your feedback widget will be available on your website directly. <br><br>PS: There is no need for a paid plan. Check out our plans and pricing <a target="_blank" href="https://sleekplan.com/pricing/">here</a>.', 'sleekplan-wp' ), wp_get_current_user()->display_name ); ?>
    </p>

    <?php if( ! isset( $_GET['sign-in'] ) ) : ?>

        <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="sp_auth_form" >

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="user_product"><?php _e( 'Website name', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="user_product" type="text" id="user_product" value="<?php echo get_bloginfo('name'); ?>" class="regular-text ltr" placeholder="<?php _e( 'Website name', 'sleekplan-wp' ); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="user_mail"><?php _e( 'E-Mail address', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="user_mail" type="text" id="user_mail" value="<?php echo get_bloginfo('admin_email'); ?>" class="regular-text ltr" placeholder="<?php _e( 'john@email.com', 'sleekplan-wp' ); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="user_name"><?php _e( 'Full name', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="user_name" type="text" id="user_name" value="" class="regular-text ltr" placeholder="<?php _e( 'John Doe', 'sleekplan-wp' ); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="user_pass"><?php _e( 'Password', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="user_pass" type="password" id="user_pass" value="" class="regular-text ltr" placeholder="<?php _e( 'Password', 'sleekplan-wp' ); ?>">
                        </td>
                    </tr>
                </tbody>
            </table>

            <p>
                <?php _e( 'By setting up an account, you agree to our <a href="https://sleekplan.com/terms/" target="_blank">Terms of Use</a> and <a href="https://sleekplan.com/terms/" target="_blank">Privacy Policy</a>.', 'sleekplan-wp' ); ?> 
            </p>

            <input type="hidden" name="type" value="register">
            <input type="hidden" name="action" value="sp_auth_form_response">
		    <input type="hidden" name="sp_auth_nonce" value="<?php echo wp_create_nonce( 'sp_auth_nonce' ); ?>" />

            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Register for free', 'sleekplan-wp' ); ?>">
                <span> <?php _e( 'or', 'sleekplan-wp' ); ?> </span>
                <a href="<?php echo SP_PLUGIN_FILE; ?>&sign-in=true"><?php _e( 'Sign in', 'sleekplan-wp' ); ?></a>
            </p>

        </form>

    <?php else : ?>
        
        <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="sp_auth_form" >

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="user_mail"><?php _e( 'E-Mail address', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="user_mail" type="text" id="user_mail" value="<?php echo get_bloginfo('admin_email'); ?>" class="regular-text ltr" placeholder="<?php _e( 'john@email.com', 'sleekplan-wp' ); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="user_pass"><?php _e( 'Password', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="user_pass" type="password" id="user_pass" value="" class="regular-text ltr" placeholder="<?php _e( 'Password', 'sleekplan-wp' ); ?>">
                        </td>
                    </tr>
                </tbody>
            </table>

            <input type="hidden" name="type" value="signin">
            <input type="hidden" name="action" value="sp_auth_form_response">
            <input type="hidden" name="sp_auth_nonce" value="<?php echo wp_create_nonce( 'sp_auth_nonce' ); ?>" />

            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Sign in', 'sleekplan-wp' ); ?>">
                <span> <?php _e( 'or', 'sleekplan-wp' ); ?> </span>
                <a href="<?php echo SP_PLUGIN_FILE; ?>"><?php _e( 'Create an account', 'sleekplan-wp' ); ?></a>
            </p>

        </form>

    <?php endif; ?>

</div>