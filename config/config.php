<?php
/**
 * Configuration Variables
 *
 * @category  Config
 * @package   Config
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

date_default_timezone_set('Asia/Seoul');

define ('DEVELOPMENT_ENVIRONMENT',true);

define('DB_NAME', 'project_manager');
define('DB_USER', 'tendency');
define('DB_PASSWORD', 'ekffu9292');
define('DB_HOST', 'localhost');

define('UPLOAD_PATH',"/public/upload");
/*
 * SALT KEY
 * http://online-code-generator.com/generate-salt-random-string.php
 */
define('SALT', "oeA51m|D*szeqhgd2Mx|n5gkinvkeU0emCN9FA=*_jX%aj3at7EdC9%n*Ke5");