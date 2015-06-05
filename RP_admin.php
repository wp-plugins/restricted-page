<?php
if (isset($_POST['submit'])){
	update_option( 'RP_text_before', wp_kses_post($_POST['RP_text_before'] ));
	update_option( 'RP_text_after', wp_kses_post($_POST['RP_text_after'] ));
	update_option( 'RP_text_beforeS', wp_kses_post($_POST['RP_text_beforeS'] ));
	update_option( 'RP_text_afterS', wp_kses_post($_POST['RP_text_afterS'] ));
	update_option( 'RP_signin_Text', sanitize_text_field($_POST['RP_signin_Text'] ));
	update_option( 'RP_disconnect_Text', sanitize_text_field($_POST['RP_disconnect_Text'] ));
	if (isset($_POST['RP_signin'])) update_option( 'RP_signin', sanitize_text_field($_POST['RP_signin'] ));
	else update_option( 'RP_signin', "off" );
	if (isset($_POST['RP_disconnect'])) update_option( 'RP_disconnect', sanitize_text_field($_POST['RP_disconnect'] ));
	else update_option( 'RP_disconnect', "off" );
	if ($_POST['RP_signin_Text']=="") update_option( 'RP_signin_Text', sanitize_text_field("Sign In" ));
	if ($_POST['RP_disconnect_Text']=="") update_option( 'RP_disconnect_Text', sanitize_text_field("Sign Off" ));
}
?><div class="wrap">
<h2>Restricted Page content</h2>
<form method="post" action="">
    <?php settings_fields( 'RP-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Text to publish before login form</th>
        <td><textarea col=80 name="RP_text_before"  ><?php echo wp_kses_post(get_option('RP_text_before')); ?></textarea></td>
        </tr>         
        <tr valign="top">
        <th scope="row">Text to publish after login form</th>
        <td><textarea col=80 name="RP_text_after"  ><?php echo wp_kses_post(get_option('RP_text_after')); ?></textarea></td>
        </tr>        
        <tr valign="top">
        <th scope="row">Show "Sign In" button?</th>
        <td><input type="checkbox" name="RP_signin" <?php if (wp_kses_post(get_option('RP_signin'))=="on") echo 'checked="checked>"';?> /></td>
        </tr>       
        <th scope="row">Sign In Button text</th>
        <td><input type="text" name="RP_signin_Text" value="<?php echo wp_kses_post(get_option('RP_signin_Text')); ?>" /></td>
        </tr>          
        <th scope="row">Text to publish before Sign in form</th>
        <td><textarea col=80 name="RP_text_beforeS"  ><?php echo wp_kses_post(get_option('RP_text_beforeS')); ?></textarea></td>
        </tr>          
        <tr valign="top">
        <th scope="row">Text to publish after Sign in form</th>
        <td><textarea col=80 name="RP_text_afterS"  ><?php echo wp_kses_post(get_option('RP_text_afterS')); ?></textarea></td>
        </tr>  
        <tr valign="top">
        <th scope="row">Show "Disconnect" button?</th>
        <td><input type="checkbox" name="RP_disconnect" <?php if (wp_kses_post(get_option('RP_disconnect'))=="on") echo 'checked="checked>"';?> /></td>
        </tr>       
        <th scope="row">Disconnect Button text</th>
        <td><input type="text" name="RP_disconnect_Text" value="<?php echo wp_kses_post(get_option('RP_disconnect_Text')); ?>" /></td>
        </tr>         
        </tr>     
    </table>
    
    <p class="submit">
    <input type="submit" name = "submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>
</div>