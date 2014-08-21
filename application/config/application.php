<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site Name
|--------------------------------------------------------------------------
|
| Name of your site/application, e.g:
|
|    My First Website
|
*/
$config['site_name'] = 'CI Template';
$config['site_tagline'] = ''; //currently not being use

/*
|--------------------------------------------------------------------------
| Template Option
|--------------------------------------------------------------------------
|
| Enable you to configure template option
| Default template: <your-site>/themes/<theme_name>/<filename>.html
*/
$config['template']['db'] = false; //dump the schema.
$config['template']['base_dir'] = 'ci_template'; //directory of the root application
$config['template']['filename'] = 'index.html';
$config['template']['enable_flash_message'] = FALSE;
$config['template']['class_flash_message'] = '%s';

