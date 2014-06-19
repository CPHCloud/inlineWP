<?php

/**
*
*/
if(!class_exists('inlineWP')):
class inlineWP {

	protected $enqueued_css;
	protected $enqueued_js;

	function __construct($name){
		
		$this->name 	= (string)$name;
		$this->handle 	= self::sanitize_inlinewp_name($name);

		add_action('wp_footer', array($this, 'output_enqueued_css'), 9999);
		add_action('wp_footer', array($this, 'output_enqueued_js'), 9999);
		add_action('admin_footer-edit.php', array($this, 'output_enqueued_css'), 9999); 
		add_action('admin_footer-post.php', array($this, 'output_enqueued_css'), 9999);
		add_action('admin_footer-edit.php', array($this, 'output_enqueued_js'), 9999);
		add_action('admin_footer-post.php', array($this, 'output_enqueued_js'), 9999);

		$GLOBALS[inlineWP::get_object_name($name)] = $this;

	}

	static function sanitize_inlinewp_name($input){
		return str_ireplace('-', '_', sanitize_title($input));
	}

	static function get_object_name($input){
		return '__inline_wp_'.inlineWP::sanitize_inlinewp_name($input);
	}


	function enqueue_css($css){
		$this->enqueued_css .= $css."\n";		
	}

	function enqueue_js($js){
		$this->enqueued_js .= $js."\n";
	}

	function output_enqueued_css($admin = false){		
		$queue = $this->enqueued_css;
		if($queue){
			echo '<!-- '.$this->name.': Enqueued CSS -->';
			echo "<style>".$queue."</style>";
		}
	}

	function output_enqueued_js($admin = false){
		
		$queue = $this->enqueued_js;
		if($queue){
			echo '<!-- '.$this->name.': Enqueued JS -->';
			echo '<script type="text/javascript">'.$queue.'</script>';
		}
	}
}

/* Global inlineWP function */
function inlinewp($name){
	$handle = inlineWP::sanitize_inlinewp_name($name);
	$objnme = inlineWP::get_object_name($name);
	if(!isset($GLOBALS[$objnme]) or !$GLOBALS[$objnme] or !is_object($GLOBALS[$objnme])){
		$GLOBALS[$objname] = new inlineWP($name);
	}
	return $GLOBALS[$objnme];

}


endif;

?>