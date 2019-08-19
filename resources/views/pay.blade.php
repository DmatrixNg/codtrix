<?php
/**
 * @package Vogue Pay BN Button
 */
/*
Plugin Name: Vogue Pay BN Button
Plugin URI: https://voguepay.com/wordpress
Description: The Vogue Pay BN Button plugin provides you with an easy PayPal payment solution. Simply add a Vogue Pay BN Button shortcode to your post or page and a PayPal Buy Now button will be published in place of the shortcode. To change the plugin's settings visit the <a href="./options-general.php?page=VoguePayButton.php" target="_self" >settings page.</a>
Version: 1.0
Author: Afrisoft Interactive
Author URI: http://afrisoft.net
License: GPLv3 or later
http://www.gnu.org/licenses/gpl-3.0.txt
*/


if (!class_exists("VoguePayButton")) {

  class VoguePayButton {

    var $Butt_Settings = "VoguePayButtonSettings";

    function VoguePayButton1() { //constructor

    }

    function init() { $this->getButtSettings(); }

    function getButtSettings() {
      $VoguePay_ButtonSettings = array(
          'button_color'      => 'blue',
          'alternate_button'      => '_self',
          'merchant_id' => ''
        );
      $v_Options = get_option( $this->Butt_Settings );
      if ( !empty( $v_Options ) ) {
          foreach ( $v_Options as $k => $v )  $VoguePay_ButtonSettings[$k] = $v;
      }
      update_option($this->Butt_Settings, $VoguePay_ButtonSettings);
      return $VoguePay_ButtonSettings;
    }

    function echoSettingPage() {
      $v_Options = $this->getButtSettings();
      if (isset($_POST['save_settings_now'])) {
        if (isset($_POST['button_color'])) $v_Options['button_color'] = $_POST['button_color'];
		if (isset($_POST['alternate_button'])) $v_Options['alternate_button'] = $_POST['alternate_button'];
        if (isset($_POST['merchant_id'])) $v_Options['merchant_id'] = $_POST['merchant_id'];
        update_option($this->Butt_Settings, $v_Options);
       echo '<div class="updated"><p><strong>';
	   _e("Settings Updated.", "VoguePayButton");
	   echo '</strong></p></div>';
      }
	  ?>
      <div class=wrap>
        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
          <h2>Vogue Pay "Buy Now" Button</h2>
          <h3>Your VoguePay Merchant ID</h3>
          <p>Enter your VoguePay Merchant ID, find it on the top right hand corner when you login to voguepay.com.</p>
          <input type="text" size="50" name="merchant_id" id="merchant_id" value="<?php _e(apply_filters('format_to_edit',$v_Options['merchant_id']), 'VoguePayButton'); ?>" />
          <h3>Button Colour</h3>
          <div>Select the button colour.</div>
          <div><select name="button_color" id="button_color">
			<option value="red" <?php if ($v_Options['button_color'] == "red") { _e('selected="selected"', "VoguePayButton"); }?> >Red</option>
			<option value="blue" <?php if ($v_Options['button_color'] == "blue") { _e('selected="selected"', "VoguePayButton"); }?> >Blue</option>
			<option value="green" <?php if ($v_Options['button_color'] == "green") { _e('selected="selected"', "VoguePayButton"); }?> >Green</option>
			<option value="grey"  <?php if ($v_Options['button_color'] == "grey") { _e('selected="selected"', "VoguePayButton"); }?>>Grey</option>
		  </select>
		  </div>
          <div>Or enter the url of your image to use as  "Buy Now" button.</div>
          <div> <input type="text" size="50" name="alternate_button" id="alternate_button" value="<?php _e(apply_filters('format_to_edit',$v_Options['alternate_button']), 'VoguePayButton'); ?>" />
          </div>
          <div class="submit">
          <input type="submit" name="save_settings_now" value="<?php _e('Update Settings', 'VoguePayButton') ?>" /></div>
        </form>
      </div>

    <?php
    }


    function getVoguePayButton ($p=''){
      extract( shortcode_atts( array( 'price' => '', 'item' => '' ), $p ));
      $x = $this->getButtSettings();
      $p['merchant_id']  = $x['merchant_id'];
      $p['alternate_button'] = empty($x['alternate_button']) ? 'http://voguepay.com/images/buttons/buynow_'.$x['button_color'].'.png' : $x['alternate_button'];
      return $this->makeButtShow( $p );
    }

    function makeButtShow( $param )
    {
      if ( $param['merchant_id'] != '' ) return '<form action="https://voguepay.com/pay/" method="post">
		<input type="hidden" name="v_merchant_id" value="'.$param['merchant_id'].'" />
		<input type="hidden" name="item_1" value="'.$param['item'].'" />
		<input type="hidden" name="price_1" value="'.$param['price'].'" />
		<input type="hidden" name="total" value="'.$param['price'].'" />
		<input type="hidden" name="description_1" value="'.$param['item'].' at '.$param['price'].'" />
		<input type="hidden" name="memo" value="Payment for '.$param['item'].'" />
		<input type="image" style="border: 0;" name="submit" src="'.$param['alternate_button'].'" alt="Pay with VoguePay" />
		</form>';
      else return'<div style="color: red;" >Please specify voguePay Merchant ID on plugin settings page for this plugin!</div>';
    }
  }
}

if (class_exists("VoguePayButton")) $v_VoguePayButton = new VoguePayButton();

if ( !function_exists("VoguePayButton_ap") ) {
    function VoguePayButton_ap() {
        global $v_VoguePayButton;
        if ( !isset($v_VoguePayButton) )return;
        if ( function_exists('add_options_page') )  add_options_page('Vogue Pay BN Button', 'Vogue Pay BN Button', 9, basename(__FILE__), array(&$v_VoguePayButton, 'echoSettingPage'));
    }
}
/*
//Actions and Filters
if (isset($v_VoguePayButton)) {
    add_action('admin_menu', 'VoguePayButton_ap');
    add_action('activate_VoguePayButton/VoguePayButton.php',  array(&$v_VoguePayButton, 'init'));
    add_shortcode('voguepay', array(&$v_VoguePayButton, 'getVoguePayButton'), 1);
}*/
?>
