<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['theme_name'] = 'default';
$config['style_path'] = 'css';
$config['image_path'] = 'images';
$config['script_path'] = 'scripts';
$config['filename'] = 'index.html';
$config['fonts_path'] = 'fonts';
$config['bootstrap_path'] = 'bootstrap';
$config['foundation_path'] = '';

$config['less'] = TRUE;
$config['less_path'] = 'less';

/** Chose either one **/
/** options avaliable
 * $config['addon'] - provide $config['addon_path'] if addon set to true
 */

$config['bootstrap'] = TRUE;
$config['foundation'] = FALSE;