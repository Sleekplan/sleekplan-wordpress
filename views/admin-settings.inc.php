<?php 
    // load required data
    $websites           = sp_data_load_websites();
    $website_settings   = sp_data_load_settings();
    $settings           = $website_settings['settings']; 
    $sso                = $website_settings['sso']; 
    $plan               = sp_data_load_subscription();
?>

<div class='wrap sp-admin'>

    <h1>
        Sleekplan 
        <span><?php _e( 'Settings', 'sleekplan-wp' ); ?></span>
    </h1>

    <hr>

    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="sp_website_form" >

        <h2>Current website</h2>

        <table class="form-table" role="presentation">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for=""><?php _e( 'Select website', 'sleekplan-wp' ); ?></label>
                    </th>
                    <td>
                        <select name="selected_website">
                            <?php foreach( $websites as $website ) : ?>
                                <option value="<?php echo $website['ID']; ?>" <?php if( $website['ID'] == $data['product'] ) echo 'selected disabled'; ?>>
                                    <?php echo $website['product_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="action" value="sp_website_form_response">
        <input type="hidden" name="sp_website_nonce" value="<?php echo wp_create_nonce( 'sp_website_nonce' ); ?>" />

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Switch website', 'sleekplan-wp' ); ?>">
        </p>

    </form>

    <hr>

    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="sp_settings_form" >

        <div>

            <h2>Widget preferences</h2>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Widget position', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <select name="setting[widget][position][widget]">
                                <option value="left" <?php if($settings['widget']['position']['widget'] == 'left') echo 'selected'; ?>>left</option>
                                <option value="right" <?php if($settings['widget']['position']['widget'] == 'right') echo 'selected'; ?>>right</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Button position', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <select name="setting[widget][position][button]">
                                <option value="top" <?php if($settings['widget']['position']['button'] == 'top') echo 'selected'; ?>>top</option>
                                <option value="middle" <?php if($settings['widget']['position']['button'] == 'middle') echo 'selected'; ?>>middle</option>
                                <option value="bottom" <?php if($settings['widget']['position']['button'] == 'bottom') echo 'selected'; ?>>bottom</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Theme', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <select name="setting[widget][theme]">
                                <option value="light" <?php if($settings['widget']['theme'] == 'light') echo 'selected'; ?>>light theme</option>
                                <option value="dark" <?php if($settings['widget']['theme'] == 'dark') echo 'selected'; ?>>dark theme</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Brand color', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input type="text" class="sp-color-picker" name="setting[widget][brand_color]" value="<?php echo $settings['widget']['brand_color']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            
                        </th>
                        <td>
                            <fieldset>
                                <label for="branding">
                                    <input type="checkbox" name="branding" id="branding" value="1" <?php if( $settings['widget']['branding'] == true ) echo 'checked="checked"'; ?> <?php if( $plan['subscribed'] == false ) echo 'disabled'; ?>> 
                                    <input type="hidden" name="setting[widget][branding]" value="<?php echo $settings['widget']['branding'] ?>" />
                                    <?php _e( 'Show Sleekplan branding', 'sleekplan-wp' ); ?> <?php if( $plan['subscribed'] == false ) echo '<i>(min. basic plan required)</i>'; ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <hr>

        <div>

            <h2>Widget settings</h2>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Widget', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label for="enable_button">
                                    <input type="checkbox" name="enable_button" id="enable_button" value="1" <?php if( $settings['widget']['enable_button'] == true ) echo 'checked="checked"'; ?>> 
                                    <input type="hidden" name="setting[widget][enable_button]" value="<?php echo $settings['widget']['enable_button'] ?>" />
                                    <?php _e( 'Display feedback button', 'sleekplan-wp' ); ?>
                                </label>
                                <br>
                                <label for="enable_changelog">
                                    <input type="checkbox" name="enable_changelog" id="enable_changelog" value="1" <?php if( $settings['widget']['enable_changelog'] == true ) echo 'checked="checked"'; ?>> 
                                    <input type="hidden" name="setting[widget][enable_changelog]" value="<?php echo $settings['widget']['enable_changelog'] ?>" />
                                    <?php _e( 'Enable changelog', 'sleekplan-wp' ); ?>
                                </label>
                                <br>
                                <label for="enable_submit">
                                    <input type="checkbox" name="enable_submit" id="enable_submit" value="1" <?php if( $settings['widget']['enable_submit'] == true ) echo 'checked="checked"'; ?>> 
                                    <input type="hidden" name="setting[widget][enable_submit]" value="<?php echo $settings['widget']['enable_submit'] ?>" />
                                    <?php _e( 'Enable "Add Feedback" icon', 'sleekplan-wp' ); ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'User', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label for="anonymous">
                                    <input type="checkbox" name="anonymous" id="anonymous" value="1" <?php if( $settings['general']['anonymous'] == true ) echo 'checked="checked"'; ?>> 
                                    <input type="hidden" name="setting[general][anonymous]" value="<?php echo $settings['general']['anonymous'] ?>" />
                                    <?php _e( 'Anonymous voting and posting', 'sleekplan-wp' ); ?>
                                </label>
                                <br>
                                <label for="confirm_signup">
                                    <input type="checkbox" name="confirm_signup" id="confirm_signup" value="1" <?php if( $settings['general']['confirm_signup'] == true ) echo 'checked="checked"'; ?>> 
                                    <input type="hidden" name="setting[general][confirm_signup]" value="<?php echo $settings['general']['confirm_signup'] ?>" />
                                    <?php _e( 'Registration requires email verification', 'sleekplan-wp' ); ?>
                                </label>
                                <br>
                                <label for="sso">
                                    <input type="checkbox" name="sso" id="sso" value="1" <?php if( $sso == true && $plan['subscribed'] !== false ) echo 'checked="checked"'; ?> <?php if( $plan['subscribed'] == false ) echo 'disabled'; ?>> 
                                    <input type="hidden" name="sso" value="<?php $sso ?>" />
                                    <?php _e( 'Enable single sign-on (SSO) for loggedin Wordpress user', 'sleekplan-wp' ); ?> <?php if( $plan['subscribed'] == false ) echo '<i>(min. basic plan required)</i>'; ?>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <hr>

        <div>

            <h2>User engagement</h2>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Ask user for feedback', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label for="popup_feedback">
                                    <input type="checkbox" name="popup_feedback" id="popup_feedback" value="1" <?php if( $settings['widget']['popup_feedback']['active'] == true ) echo 'checked="checked"'; ?>> 
                                    <input type="hidden" name="setting[widget][popup_feedback][active]" value="<?php echo $settings['widget']['popup_feedback']['active'] ?>" />
                                </label>
                                <span class="details popup_feedback <?php if( ! $settings['widget']['popup_feedback']['active'] == true ) echo 'hidden'; ?>">
                                    <br><br>
                                    <input required name="setting[widget][popup_feedback][message]" type="text" id="" value="<?php echo $settings['widget']['popup_feedback']['message']; ?>" class="regular-text ltr">
                                    <br><br>
                                    Display popup after 
                                    <input name="setting[widget][popup_feedback][m]" type="number" min="0" step="1" id="close_comments_days_old" value="<?php echo $settings['widget']['popup_feedback']['m']; ?>" class="small-text"> minutes
                                    <input name="setting[widget][popup_feedback][h]" type="number" min="0" step="1" id="close_comments_days_old" value="<?php echo $settings['widget']['popup_feedback']['h']; ?>" class="small-text"> hours
                                    and <input name="setting[widget][popup_feedback][d]" type="number" min="0" step="1" id="close_comments_days_old" value="<?php echo $settings['widget']['popup_feedback']['d']; ?>" class="small-text"> days
                                </span>
                            </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Ask user for feedback', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <fieldset>
                                <label for="popup_satisfaction">
                                    <input type="checkbox" name="popup_satisfaction" id="popup_satisfaction" value="1" <?php if( $settings['widget']['popup_satisfaction']['active'] == true ) echo 'checked="checked"'; ?>> 
                                    <input type="hidden" name="setting[widget][popup_satisfaction][active]" value="<?php echo $settings['widget']['popup_satisfaction']['active'] ?>" />
                                </label>
                                <span class="details popup_satisfaction <?php if( ! $settings['widget']['popup_satisfaction']['active'] == true ) echo 'hidden'; ?>">
                                    <br><br>
                                    <input required name="setting[widget][popup_satisfaction][message]" type="text" id="" value="<?php echo $settings['widget']['popup_satisfaction']['message']; ?>" class="regular-text ltr">
                                    <br><br>
                                    Display popup after 
                                    <input name="setting[widget][popup_satisfaction][m]" type="number" min="0" step="1" id="close_comments_days_old" value="<?php echo $settings['widget']['popup_satisfaction']['m']; ?>" class="small-text"> minutes
                                    <input name="setting[widget][popup_satisfaction][h]" type="number" min="0" step="1" id="close_comments_days_old" value="<?php echo $settings['widget']['popup_satisfaction']['h']; ?>" class="small-text"> hours
                                    and <input name="setting[widget][popup_satisfaction][d]" type="number" min="0" step="1" id="close_comments_days_old" value="<?php echo $settings['widget']['popup_satisfaction']['d']; ?>" class="small-text"> days
                                </span>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <hr>

        <div>

            <h2>Custom strings</h2>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Widget title', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][title]" type="text" id="" value="<?php echo $settings['widget']['text']['title'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Widget description', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][description]" type="text" id="" value="<?php echo $settings['widget']['text']['description'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Satisfaction title', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][satisfaction_title]" type="text" id="" value="<?php echo $settings['widget']['text']['satisfaction_title'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Satisfaction voted message', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][satisfaction_voted]" type="text" id="" value="<?php echo $settings['widget']['text']['satisfaction_voted'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Login title', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][login_title]" type="text" id="" value="<?php echo $settings['widget']['text']['login_title'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Login text', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][login_description]" type="text" id="" value="<?php echo $settings['widget']['text']['login_description'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Email confirmation title', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][login_title_con]" type="text" id="" value="<?php echo $settings['widget']['text']['login_title_con'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for=""><?php _e( 'Email confirmation text', 'sleekplan-wp' ); ?></label>
                        </th>
                        <td>
                            <input required name="setting[widget][text][login_description_con]" type="text" id="" value="<?php echo $settings['widget']['text']['login_description_con'] ?>" class="regular-text ltr">
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <input type="hidden" name="action" value="sp_settings_form_response">
        <input type="hidden" name="sp_settings_nonce" value="<?php echo wp_create_nonce( 'sp_settings_nonce' ); ?>" />

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save settings', 'sleekplan-wp' ); ?>">
        </p>

    </form>

    <hr>

    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="sp_logout_form" >

        <input type="hidden" name="action" value="sp_logout_form_response">
        <input type="hidden" name="sp_logout_nonce" value="<?php echo wp_create_nonce( 'sp_logout_nonce' ); ?>" />

        <p class="submit">
            <a href="https://app.sleekplan.com/settings/plan?pid=<?php echo $data['product']; ?>" class="button button-danger"><?php _e( 'My subscription', 'sleekplan-wp' ); ?></a>
            <input type="submit" name="submit" id="submit" class="button button-danger" value="<?php _e( 'Log out', 'sleekplan-wp' ); ?>">
        </p>

    </form>

</div>