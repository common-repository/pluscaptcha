<?php

if (!function_exists('tags')) {
	# Clean data
	function tags($tags){
		$tags = strip_tags($tags);
		$tags = stripslashes($tags);
		$tags = htmlentities($tags);
		$tags = addslashes($tags);
		return trim($tags);
	}
}

      if (getenv('HTTPS') == 'on') {
		$status = @fgets(@fopen("https://www.pluscaptcha.com/status/", 'r'), 4096);
      } else {
        $status = @fgets(@fopen("http://www.pluscaptcha.com/status/", 'r'), 4096);
      }

/**
* Save blog data to improve the experience
**/

if( get_option('PlusCaptcha_feedback_quemejoraria', '') != get_option('actual_PlusCaptcha_feedback_quemejoraria', '') )
{
	// Submit feedback
      if (getenv('HTTPS') == 'on') {
		$url = 'https://www.pluscaptcha.com/api/wp_log/feedback?'
		.'quemejorar='.substr(str_replace(".","[dot]",urlencode(tags($_POST["PlusCaptcha_feedback_quemejoraria"]))),0,299).
		'&uuid='.get_option( 'uuid_api_wp_feedback' ).'';
		@fgets(@fopen($url, 'r'), 4096);
      } else {
		$url = 'http://www.pluscaptcha.com/api/wp_log/feedback?'
		.'quemejorar='.substr(str_replace(".","[dot]",urlencode(tags($_POST["PlusCaptcha_feedback_quemejoraria"]))),0,299).
		'&uuid='.get_option( 'uuid_api_wp_feedback' ).'';
		@fgets(@fopen($url, 'r'), 4096);
      }

	// Save feedback locally
	update_option('actual_PlusCaptcha_feedback_quemejoraria', get_option('PlusCaptcha_feedback_quemejoraria', ''));

}

?>

<?php
if( $message != "" && $status || strlen(get_option('uuid_key_speci_to_generate_captchas', '')) < 9 && $status )
{
?>
	<script  type="text/javascript">
	  jQuery(document).ready(function($) {
		$('#ShortData').hide('fast');
	  });
	</script>
<?php
}else{
?>
	<script  type="text/javascript">
	  jQuery(document).ready(function($) {
		$('#Advance').hide();
	  });
	</script>
<?php
}
?>

<div class="w_private">
	<div class="wrap_private" style="padding-top: 30px; margin-top: 20px;">

		<style type="text/css">
		.ShortData .Data {
			width: 100%;
			height: 431px;
			/**/
			overflow: display;
		}
		.ShortData .Data h1 {
			font-family: Arial;
			font-size: 44px;
			font-weight: bold;
			/**/
			width: 100%;
			text-align: center;
			/**/
			height: 50px;
			line-height: 50px;
			/**/
			color: white;
			/**/
			margin: 0px;
			margin-top: 10px; /*rewrite*/
		}
		.ShortData .Data h3 {
			font-family: Arial;
			font-size: 14px;
			font-weight: bold;
			/**/
			width: 100%;
			text-align: center;
			/**/
			height: 20px;
			line-height: 20px;
			/**/
			color: white;
			/**/
			margin: 0px;
		}
		.ShortData .BoxSites{
			width: 90%;
			margin-left: 5%;
			margin-right: 5%;
			/**/
			height: 200px;
			/**/
			margin-top: 40px;
			margin-bottom: 20px;
			/**/
			border-top: 1px solid white;
			border-bottom: 1px solid white;
			/**/
			overflow: display;
		}
		.ShortData .BoxSites a{
			color: #5AD1F3;

		}
		.ShortData .BoxSites a:hover{
			text-decoration: underline;
			color: #0f9ec7;
		}
		.300 {
			width: 300px;
			margin: auto;
		}
		.ShortData .BoxMore{
			width: 90%;
			margin-left: 5%;
			margin-right: 5%;
			/**/
			height: 110px;
			/**/
			margin-top: 20px;
			margin-bottom: 20px;
			/**/
		}
		.ShortData .BoxMore .BoxBtn{
			width: 50%;
			height: 110px;
			/**/
			float: left;
		}
		.ShortData .BoxMore .BoxBtn a{
			width: 80%;
			margin: 30px 10% 30px 10%;
			/**/
			height: 60px;
			line-height: 60px;
			/**/
			background: #009cff;
			/**/
			font-family: Arial;
			font-size: 18px;
			font-weight: bold;
			color: white;
			text-decoration: none;
			/**/
			text-align: center;
			/**/
			display: block;
			/**/
			cursor: pointer;
		}
		.ShortData .BoxMore .BoxBtn a:hover{
			background: #008ce5;
		}
		</style>

		<div id="ShortData" class="ShortData">
			<?php
			if($status) {
			?>
				<div class="LogoRun"></div>
			<?php }else{ ?>
				<div class="LogoPaused"></div>
			<?php } ?>
			<div class="Data">
				<h1><?php echo ($status) ? 'SERVICE: Started and Online' : 'SERVICE: Offline For Maintenance'; ?></h1>
				<h3><?php echo ($status) ? 'Check your comments or "contact us" form.' : 'Please come back in 30 minutes.'; ?></h3>
				<div class="BoxSites" style="text-align: center;">
					<h3 class="300" style="width: 370px; margin: auto; margin-top: -10px; background: #00609b; display: table;">WHO TRUSTS PLUSCAPTCHA? (RANDOM SAMPLING)</h3>
					<?php

						  if (getenv('HTTPS') == 'on') {
								echo @fgets(@fopen("https://www.pluscaptcha.com/api/wp_log/who_use_plugin.php", 'r'), 4096);
						  } else {
								echo @fgets(@fopen("http://www.pluscaptcha.com/api/wp_log/who_use_plugin.php", 'r'), 4096);
						  }

					?>
				</div>
				<div class="BoxMore">
					<div class="BoxBtn">
						<?php if($status) { ?>
							<a onclick="jQuery(document).ready(function($) {
								$('#ShortData').hide('fast');
								$('#Advance').show('slow');
							});">Advanced Options</a>
						<?php }else{ ?>
							<a style="background-color:#999999; cursor: auto;">In Maintenance Mode</a>
						<?php } ?>
					</div>
					<div class="BoxBtn" style="text-align: right;">
						<p>
							<strong>Information</strong> - info@pluscaptcha.com<br />
							<strong>Support</strong> - support@pluscaptcha.com<br />
						</p>
					</div>
				</div>
			</div>
		</div>

		<div id="Advance">

		  <?php if (!empty($message)): ?>
			<div class="updated" style="width:91%; float: left; background-color: #FFFF99; padding-top: 30px; padding-bottom: 30px; color: #393939; border: none; padding-left: 10%; margin-left: 0px; margin-bottom: 20px; display: table;">
			  <p><strong><?php echo $message; ?></strong></p>
			</div>
			<br />
		  <?php endif; ?>

			<div class="informacion">
				<p style="margin-top: 5px; "><?php _e('Congratulations on your new <b>PlusCaptcha!</b>', 'PlusCaptcha'); ?> Hint: you can deploy your PlusCaptcha "contact us" form with the shortcode [pluscaptcha_contact_form].</p>
			</div>


		<?php
		if(
			get_option( 'uuid_api_wp_feedback' ) != "" &&
			get_option( 'registered_account_from_api' ) == true &&
			get_option( 'pluscaptcha_account_user' ) != "" &&
			get_option( 'pluscaptcha_account_password' ) != ""
		)
		{
		?>
		  <!-- Box Personalize -->
		  <div id="personalizacion">
			<div id="right-content-pers">
				<span>
					Personalize your account by logging in at
					<br />
					<a href="http://pluscaptcha.com/login" target="_blank"><strong style="border: 0px;">http://pluscaptcha.com/login</strong></a> username:
					<br />
					<strong><?php echo get_option( 'pluscaptcha_account_user' ); ?></strong>
					<br />
					and this *password:
					<br />
					<strong><?php echo get_option( 'pluscaptcha_account_password' ); ?></strong>
				</span>
				<br />
				<span style="font-size: 12px; line-height: normal; margin-top: 10px; display: table;">
					Account created automatically. Copy your 9-character ID from PlusCaptcha.com and paste it below. Then hit SAVE CHANGES. If you've changed your password at PlusCaptcha.com, ignore the above password. <br><br>
				</span>
			</div>
		  </div>
		  <!-- --->

		  <?php }elseif( get_option( 'registered_account_from_api' ) != true && get_option('uuid_key_speci_to_generate_captchas', '') == "" ){ ?>

		  <!-- Box Instructions -->
		  <div id="boxinstructions">
			<div style="width: 960px; height: 115px; display: table;">
				<div style="float: left; font-family: Arial; color: #666666; font-size: 14px; margin-left: 238px; margin-top: 47px;">
					En
				</div>
				<div style="float: left; font-family: Arial; color: white; font-size: 14px; margin-left: 435px; margin-top: 45px;">
					New Account
				</div>
			</div>
			<style type="text/css">
				.ecoplus {
					color: #82c7ff;
					text-decoration: none;
				}
				.ecoplus:hover {
					color: #249dff;
				}
			</style>
		  </div>

		  <?php } ?>

		  <form name="form1" method="post" action="">
			<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
			<table class="form-table">
			  <tbody>
				<?php
				if (!empty($PlusCaptcha_options) && is_array($PlusCaptcha_options)):
				  foreach ($PlusCaptcha_options as $opt_name => $opt):
				?>
				<tr valign="top">
				  <th scope="row" style="min-width: 15%"><label style="color: white;" for="<?php echo $opt_name ?>"><?php echo $opt['title'] . ':'; ?></label></th>
				  <?php
					if (!substr_count($opt_name, '_form_')) {
					  $type = 'text';
					  $checked = null;
					  $class = ' class="regular-text"';
					  $value = isset($options_values[$opt_name]) ? $options_values[$opt_name] : null;
					} else {
					  $type = 'checkbox';
					  $checked = isset($options_values[$opt_name]) && !empty($options_values[$opt_name]) ? ' checked="checked"' : null;
					  $class = null;
					  $value = 1;
					}
				  ?>
				  <td>
					<input<?php echo $class ?> id="<?php echo $opt_name ?>" type="<?php echo $type ?>" name="<?php echo $opt_name ?>" value="<?php echo $value ?>" size="50"<?php echo $checked ?>
					<?php echo $opt['maxchars']; ?> <?
					if($opt['disabled']){
						echo 'checked="checked" disabled';
					}else{
						echo '/'; // Noquitar
					}
					?>>
					<?php if (isset($PlusCaptcha_options[$opt_name]['description'])): ?>
					<span class="description">
					<?php echo $PlusCaptcha_options[$opt_name]['description']; ?>
					</span>
					<?php endif; ?>
				  </td>
				</tr>

				<?php if ($opt_name == 'PlusCaptcha_form_contact') { ?>
				<tr>
				  <td colspan="2" style="padding-top: 0px; padding-left: 20px;">
				  <?php
				  $display_cfoptions = ''; //( $checked ) ? '' : 'display:none;';
				  include 'admin-options-contactform.php';
				  ?>
				  </td>
				</tr>
				<?php } ?>

				<?php
				  endforeach;
				endif;
				?>
			  </tbody>
			</table>

			<style type="text/css">
				a {
					text-decoration: none;
				}
				a:focus {
					text-decoration: none;
					color: #2980c7;
				}
				a:hover, a:active {
					text-decoration: none;
					color: #005da8;
				}
			</style>

			<p class="submit" style="margin-top: 10px;">
			  <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
			</p>
		  </form>
		  <p><b>HEY... do you want to donate to the PlusCaptcha project?</b> We welcome that!<br>
		  As you know, PlusCaptcha is a free service. But the tools we use to bring PlusCaptcha<br>
		  to you are not. Simply use the form below to contribute! </p>
		  <p>*Please be advised that since PlusCaptcha is organized as a for-profit entity, that<br>
		  contributions to PlusCaptcha are not tax-deductible as a charitable donation.
		  </p>
		  <p>
		    <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
               <input type="hidden" name="business" value="support@pluscaptcha.com">
               <input type="hidden" name="cmd" value="_donations">
               <input type="hidden" name="item_name" value="Donate to PlusCaptcha!">
               <input type="hidden" name="item_number" value="PC-001">
               <input type="hidden" name="currency_code" value="USD">
               <input type="submit" name="Submit" class="button-primary" value="Donate!" alt="Donate">
               <img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
            </form>
         </p>
		  </div>
	</div>
</div>