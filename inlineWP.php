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
		$this->handle 	= sanitize_title($this->name);

		add_action('wp_footer', array($this, 'output_enqueued_css'), 9999);
		add_action('wp_footer', array($this, 'output_enqueued_js'), 9999);
		add_action('admin_footer-edit.php', array($this, 'output_enqueued_css'), 9999); 
		add_action('admin_footer-post.php', array($this, 'output_enqueued_css'), 9999);
		add_action('admin_footer-edit.php', array($this, 'output_enqueued_js'), 9999);
		add_action('admin_footer-post.php', array($this, 'output_enqueued_js'), 9999);

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
			echo '<!--'.$this->name.': Enqueued CSS -->';
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


endif;

?>