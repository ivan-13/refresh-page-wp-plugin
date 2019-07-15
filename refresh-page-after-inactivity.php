<?php
/**
* Plugin Name: Refresh Page After Inactivity
* Description: This plugin will refresh page after 60 seconds of inactivity
* Version: 2019.07
* Author: BJ
**/

function dev_auto_refresh_page_after_inactivity(){

	echo '<script>

	     var time = new Date().getTime();
	     jQuery(document.body).bind("mousemove keypress", function(e) {
	         time = new Date().getTime();
	     });

	     function refresh() {
	         if(new Date().getTime() - time >= 60000)
	             window.location.reload(true);
	         else
	             setTimeout(refresh, 10000);
	     }

	     setTimeout(refresh, 10000);

	</script>';

}
add_action('wp_footer','dev_auto_refresh_page_after_inactivity', 99);