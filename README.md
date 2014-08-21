Template-for-CI
===============

Template for codeigniter
 - Added LESS for front end developer to use with.
 - Main config under config/application.php
 
 $config['template'][];
  
 
 Config Detail: usage
 
 $config['db'] = false;
 
 read local config from themes/default/config.php

 $config['db] = true;

 read config from database by dump the table from sql file provided.
 
 $this->template->view('file',$data);
 $this->template->publish();
