<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Template {
		var $setting = null;
		var $template = null;
		
    var $theme = '';
		var $theme_path = 'themes'; // change this if u want your apps to be in diffrent location
    var $css_theme = '';
		var $base_dir = '';
    var $directory = '';
		var $path = array();
		var $filename = 'index';
		var $main_title = '';
		var $sub_title = '';
		var $title = '', $header = '', $navigation = '', $content = '', $footer = '', $breadcrumb='';
		var $response = '';
		var $module = array();
		var $ci = NULL;
		var $type = 'html';
		var $enabled = TRUE;
		var $allowed = array(
			'header',
      'navigation', 
			'content', 
			'footer',
      'breadcrumb'
    );
		
		var $image ='';
		
		var $db = '';
		var $tpl = '';
		
		public function __construct() {
			//parent::__construct();
			$this->ci =& get_instance();
			$this->ci->ui = $this;
      $this->ci->template = $this;
      $this->db = $this->ci->db;
			
			/** Check if setting is from db or from file **/
			$this->ci->config->load('application', TRUE);
			$config = $this->ci->config->item('template', 'application');
			if($config['db']== TRUE) {
			/** get setting from db 1st **/
			$this->setting = $this->get_setting();
			$templates = $this->get_template();
			$this->template = $templates['template_name'];
			
				$this->main_title = $this->setting['site_name'];
				$this->base_dir = $this->setting['base_dir'];
				//$this->directory = $this->setting['asset_path'];
				
			} else {
				$this->setting = '';
				$this->main_title = $this->ci->config->item('site_name','application');
				$this->base_dir = $this->ci->config->item('base_dir','application');
				
			}
			
			// get setting from template config file
			$this->tpl =& $this->tpl_config();
			$this->theme = $this->tpl['theme_name'];
			$this->filename = $this->tpl['filename'];
			$this->image = $this->tpl['image_path'];
			
			/** Do NOT change unless you know what are you doing **/
			
			$addon = '';
			if($this->tpl['bootstrap']) {
				$addon = $this->tpl['bootstrap_path'];
			} else if($this->tpl['foundation']) {
				$addon = $this->tpl['foundation_path'];
			} else if($this->tpl['addon']) {
				$addon = $this->tpl['addon_path'];
			}
			
			$this->path = array(
										'STYLE' => $this->tpl['style_path'],
										'SCRIPT' => $this->tpl['script_path'],
										'ADDON' => $addon, // for bootstrap, foundation etc 3rd party css/js
										'IMG' => $this->tpl['image_path'],
										'LESS' => $this->tpl['less_path'] // less file enable;
										);
			
		}
		
		/** load config file for template **/
		function &tpl_config($replace = array()) {
			static $_tpl_config;
			
				if (isset($_tpl_config))
				{
					return $_tpl_config[0];
				}
			
				$cfg_path = FCPATH.'/'.$this->theme_path.'/'.$this->template.'/config.php';
				var_dump($cfg_path);
				if ( ! file_exists($cfg_path))
				{
					show_error('The <strong>TEMPLATE</strong> configuration file does not exist.');
				}
			
				require($cfg_path);
			
				if ( ! isset($config) OR ! is_array($config))
				{
					show_error('Your <strong>Template</strong>config file does not appear to be formatted correctly.');
				}
			
				if (count($replace) > 0)
				{
					foreach ($replace as $key => $val)
					{
						if (isset($config[$key]))
						{
							$config[$key] = $val;
						}
					}
				}
			
			return $tpl_config[0] =& $config;

		}
		
		/** get template name from db **/
		function get_template() {
			$sql = "SELECT template_id,template_name FROM template WHERE selected=1";
			$res = $this->db->query($sql);
			$data = array();
			foreach($res->result() as $row) {
				$data['template_name'] = $row->template_name;
			}
			return $data;
		}
		
		/** Get site setting from db **/
		function get_setting() {
			$sql = "SELECT setting_var,setting_name FROM settings";
			$res = $this->db->query($sql);
			$data = array();
			
			foreach($res->result() as $row) {
				$data[$row->setting_var] = $row->setting_name;
			}
			
			return $data;
		}
		
		function enable()
		{
			$this->enabled = TRUE;
		}
		function disable()
		{
			$this->enabled = FALSE;
		}
		function set_output($type = 'html') 
		{
			$allowed = array('xhr', 'text', 'html');
			
			if(in_array($type, $allowed)) :
				$this->type = $type;
			endif;
		}
		
		//for additional template
		function set_template($dir = '') 
		{
			if(is_dir(FCPATH.$this->theme_path.'/'.$dir)) :
				$this->theme = $dir;
			endif;
		}
		function set_file($file = '') 
		{
			if(is_dir(FCPATH.$this->theme_path.'/'.$this->theme.$file.'.html')) :
				$this->filename = $file.'.html';
			endif;
		}
		function view($file, $data = array(), $part = 'content') 
		{
			$part = (($part == NULL or $part == '') ? 'content' : $part);
			
			if(in_array($part, $this->allowed)) :
				$this->$part .= $this->ci->load->view($file, $data, TRUE);
			endif;
		}
		function parse($file, $data = array(), $part = 'content') 
		{
			$part = (($part == NULL or $part == '') ? 'content' : $part);
			
			if(in_array($part, $this->allowed)) :
				$this->$part .= $this->ci->parser->parse($file, $data, TRUE);
			endif;
		}
		function clear($part = '') 
		{
			$part = (($part == NULL or $part == '') ? 'content' : $part);
			
			if(in_array($part, $this->allowed)) :
				$this->$part = '';
			endif;
		}
		public function append($content = '', $part = 'content') 
		{
			$part = (($part == NULL or $part == '') ? 'content' : $part);
			
			if(in_array($part, $this->allowed)) :
				$this->$part .= $content;
			endif;
		}
		function prepend($content = '', $part = 'content') 
		{
			$part = (($part == NULL or $part == '') ? 'content' : $part);
			
			if(in_array($part, $this->allowed)) :
				$this->$part = $content.$this->$part;
			endif;
		}
		function output() 
		{
			$this->publish();
		}
		function publish() {
			if (!!$this->enabled) :
				if ($this->type == 'xhr') :
					$response = json_encode($this->response);
					print $response;
					die();
				elseif ($this->type == 'text') :
					$response = $this->response;
					print $response;
					die();
				else :
					$data = file_get_contents(dirname( FCPATH ) .'/'. $this->base_dir .'/'. $this->theme_path .'/'. $this->theme .'/'. $this->filename, FALSE);
					$search = array(
						'{{HEADER}}',
						'{{NAVIGATION}}',
						'{{CONTENT}}',
						'{{FOOTER}}',
            '{{BREADCRUMB}}',
          );
					
					$replace = array(
						$this->header,
            $this->navigation,
						$this->content,
						$this->footer,
            $this->breadcrumb,
          );
					
					$data = str_replace($search, $replace, $data);
					$data = $this->_standard($data);
					
					$this->ci->output->set_output($data);
				endif;
			endif;
		}
		
		function _standard($data) {
			$this->title = $this->main_title;
				
			if(trim($this->title) != '') :
				$this->title = $this->main_title.' &raquo; '.$this->sub_title;
			endif;
			
			$index = index_page();
			$index = ($index !== "" ? $index."/" : "");
			
			$search = array(
				'{{PAGE-NAME}}',
				'{{SUB-TITLE}}',
				'{{TITLE}}',
				'{{URI}}',
				'{{BASE-URI}}',
				'{{INDEX-URI}}',
        '{{STYLE-URI}}',
				'{{ADDON-URI}}',
				'{{SCRIPT-URI}}',
        '{{IMG-URI}}',
				'{{LESS-URI}}'
			);
			
			$replace = array(
				$this->title,
				$this->sub_title,
				$this->main_title,
				current_url(),
				base_url(),
				site_url(),
        $this->ci->config->config['base_url'].'/'.$this->theme_path.'/'.$this->theme.'/'.$this->path['STYLE'].'/',
				$this->ci->config->config['base_url'].'/'.$this->theme_path.'/'.$this->theme.'/'.$this->path['ADDON'].'/',
				$this->ci->config->config['base_url'].'/'.$this->theme_path.'/'.$this->theme.'/'.$this->path['SCRIPT'].'/',
				$this->ci->config->config['base_url'].'/'.$this->theme_path.'/'.$this->theme.'/'.$this->path['IMG'].'/',
				$this->ci->config->config['base_url'].'/'.$this->theme_path.'/'.$this->theme.'/'.$this->path['LESS'].'/',
				
			);
			
			if(count($this->module) > 0) :
				foreach($this->module as $key => $value) :
					array_push($search, '{{MODULE-'.strtoupper($key).'}}');
					array_push($replace, $value);
				endforeach;
			endif;
			
			return @str_replace($search, $replace, $data);
		}
	}
?>
