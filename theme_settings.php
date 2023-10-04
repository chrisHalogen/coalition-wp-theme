<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function ct_custom_theme_options(){

    if (isset( $_POST['submit'] )){
        // write_log($_POST);
        try {
            if (isset( $_POST['phone'] )){
                $phone = sanitize_text_field($_POST['phone']) ;
                ct_theme_update_wp_option( 'ct-theme-phone', $phone );
            } 

            if (isset( $_POST['address'] )){
                $address = sanitize_textarea_field($_POST['address']);
                ct_theme_update_wp_option( 'ct-theme-address', $address );
            } 

            if (isset( $_POST['fax'] )){
                $fax = sanitize_text_field($_POST['fax']);
                ct_theme_update_wp_option( 'ct-theme-fax', $fax );
            } 

            if (isset( $_POST['facebook'] )){
                $fb = sanitize_url($_POST['facebook']);
                ct_theme_update_wp_option( 'ct-theme-facebook-url', $fb );
            } 

            if (isset( $_POST['twitter'] )){
                $twitter = sanitize_url($_POST['twitter']);
                ct_theme_update_wp_option( 'ct-theme-twitter-url', $twitter );
            } 

            if (isset( $_POST['linkedin'] )){
                $ln = sanitize_url($_POST['linkedin']);
                ct_theme_update_wp_option( 'ct-theme-linkedin-url', $ln );
            } 

            if (isset( $_POST['pinterest'] )){
                $pin = sanitize_url($_POST['pinterest']);
                ct_theme_update_wp_option( 'ct-theme-pinterest-url', $pin );
            } 

            if (isset( $_POST['icon-media-id'] )){
                $icon = sanitize_text_field($_POST['icon-media-id']);
                ct_theme_update_wp_option( 'ct-theme-logo-id', $icon );
            } 

            if (isset( $_POST['page-content'] )){
                $content = sanitize_textarea_field($_POST['page-content']);
                ct_theme_update_wp_option( 'ct-theme-page-content', $content );
            } 

            echo "<script>location.replace('admin.php?page=ct-theme-options&result=1');</script>";

        } catch (\Throwable $th) {
            echo "<script>location.replace('admin.php?page=ct-theme-options&result=0');</script>";
        }
    }

    if (isset( $_GET['result'] ) && $_GET['result'] == 0){
        $class = 'notice notice-error';
        $message = __( 'An error Occured', 'ct-custom' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    } else if (isset( $_GET['result'] ) && $_GET['result'] == 1){
        $class = 'notice notice-success is-dismissible';
        $message = __( 'The Options Updated Successfully', 'ct-custom' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
    }

    $image = "";
    $image_id = 0;
    // write_log("Ready");

    if (wp_get_attachment_url( get_option('ct-theme-logo-id') )){
        $image = wp_get_attachment_url( get_option('ct-theme-logo-id') );
        $image_id = get_option('ct-theme-logo-id');
    }

    ?>
    
        <div class="wrap" id="ct-theme-options">
            <h2>Theme Options</h2>
            <p>Welcome to the General Theme Options</p>
            
            <form action="" method="post">
                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                <label for="phone">Phone Number</label>
                            </th>

                            <td>
                            <input name="phone" type="tel" id="phone"  class="regular-text" value="<?php if (get_option('ct-theme-phone')) echo get_option('ct-theme-phone') ?>">

                            <p class="description">Enter your Phone number</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="address">Address Information</label>
                            </th>

                            <td>
                            <textarea name="address" class="regular-text" id="address" cols="40" rows="5"><?php if (get_option('ct-theme-address')) echo get_option('ct-theme-address') ?></textarea>

                            <p class="description">Where is the business located?</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="fax">Fax Number</label>
                            </th>

                            <td>
                            <input name="fax" type="text" id="fax"  class="regular-text" value="<?php if (get_option('ct-theme-fax')) echo get_option('ct-theme-fax') ?>">

                            <p class="description">What is your Fax number?</p>
                            </td>
                        </tr>
                        
                        <tr>
                            <th scope="row">
                                <label for="facebook">Facebook URL</label>
                            </th>

                            <td>
                            <input name="facebook" type="url" id="facebook"  class="regular-text" value="<?php if (get_option('ct-theme-facebook-url')) echo get_option('ct-theme-facebook-url') ?>">

                            <p class="description">The link to your Facebook Page</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="twitter">Twitter URL</label>
                            </th>

                            <td>
                            <input name="twitter" type="url" id="twitter"  class="regular-text" value="<?php if (get_option('ct-theme-twitter-url')) echo get_option('ct-theme-twitter-url') ?>">

                            <p class="description">The link to your Twitter Page</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="linkedin">Linkedin URL</label>
                            </th>

                            <td>
                            <input name="linkedin" type="url" id="linkedin"  class="regular-text" value="<?php if (get_option('ct-theme-linkedin-url')) echo get_option('ct-theme-linkedin-url') ?>">

                            <p class="description">The link to your Linkedin Page</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="pinterest">Pinterest URL</label>
                            </th>

                            <td>
                            <input name="pinterest" type="url" id="pinterest"  class="regular-text" value="<?php if (get_option('ct-theme-pinterest-url')) echo get_option('ct-theme-pinterest-url') ?>">

                            <p class="description">The link to your Pinterest Page</p>
                            </td>
                        </tr>

                        <tr>
                        <th scope="row">
                            <label for="logo">Logo</label>
                        </th>
                        <td>
                            
                            <img id="asset-image-tag" style="display: block;max-width: 200px;max-height:200px" src="<?php if ($image) echo $image ?>">
                            <br>
                            <input type="hidden" id="icon-media-id" name="icon-media-id" value="<?php if ($image_id) echo $image_id ?>">
                            <input type="button" id="image-select-button" class="button" name="custom_image_data" value="Select Image">
                            <input type="button" id="image-delete-button" class="button" name="custom_image_data" value="Delete Image">

                            <p class="description">Upload Your Business Logo</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="page-content">Page Content</label>
                        </th>
                        <td>
                            <textarea name="page-content" class="regular-text" id="page-content" cols="40" rows="5"><?php if (get_option('ct-theme-page-content')) echo get_option('ct-theme-page-content') ?></textarea>

                            <p class="description">The text under the Contact Headline</p>
                        </td>
                    </tr>
                        
                    </tbody>
                </table>
                <p class="submit">
                    
                    <button type="submit" name="submit" id="submit" class="button button-primary">Save Changes &#10003;</button>
                    
                </p>
            </form>
        </div>
        <script>
            // Change the current URL in case it has the result get parameter
            const nextURL = "<?php echo admin_url("admin.php?page=ct-theme-options") ?>";
            const nextTitle = 'Theme Options Page';
            const nextState = { additionalInformation: 'Updated the URL with JS' };

            window.history.pushState(nextState, nextTitle, nextURL);
        </script>
    <?php

}