<?php

/** This file is part of KCFinder project
  *
  *      @desc Base configuration file
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

// IMPORTANT!!! Do not remove uncommented settings in this file even if
// you are using session configuration.
// See http://kcfinder.sunhater.com/install for setting descriptions
$url = explode("=",$_SERVER["REQUEST_URI"]);
$url = substr($url[2], 0, 1); // assuming the full path is "/home/username/tmp"

switch ($_SERVER['SERVER_NAME'])
{
	case 'www.gesticadiz.es':
		$uploadURL = 'http://openrs.es/demo/uploads';
		$uploadDIR = 'http://openrs.es/demo/uploads';
		break;
	case 'www.openrs.es':
		$uploadURL = 'http://openrs.es/demo/uploads';
		$uploadDIR = 'http://openrs.es/demo/uploads';
		break;
	default:
		$uploadURL = 'http://127.0.0.1/openrs/uploads';
		$uploadDIR = '../../../../uploads';
		break;
}   

$_CONFIG = array(

    'disabled' => false,
    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,

    'theme' => "oxygen",
	'uploadURL' => $uploadURL,
	'uploadDir' => $uploadDIR,

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy' => true,
            'move' => true,
            'rename' => true
        ),
        
        'general' => array(
            'upload' => true,
            'delete' => true,
            'copy' => true,
            'move' => true,
            'rename' => true
        ),
        
        'inmuebles' => array(
            'upload' => false,
            'delete' => false,
            'copy' => false,
            'move' => false,
            'rename' => false
        ),
        
        'clientes' => array(
            'upload' => false,
            'delete' => false,
            'copy' => false,
            'move' => false,
            'rename' => false
        ),
        
        'demandas' => array(
            'upload' => false,
            'delete' => false,
            'copy' => false,
            'move' => false,
            'rename' => false
        ),

        'dirs' => array(
            'create' => true,
            'delete' => true,
            'rename' => true
        )
    ),

    'deniedExts' => "exe com msi bat php phps phtml php3 php4 cgi pl",

    'types' => array(

        // CKEditor & FCKEditor types
        'files'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",
        'inmuebles'   =>  "*img",
        'clientes'   =>  "*img",
        'demandas'   =>  "*img",
        'general'   =>  "*img",

        // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
        'inmuebles'   =>  "*img",
        'clientes'   =>  "*img",
        'demandas'   =>  "*img",
        'general'   =>  "*img",
    ),

    'filenameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'mime_magic' => "",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'thumbsDir' => ".thumbs",

    'jpegQuality' => 90,

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',

    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
    '_check4htaccess' => true,
    //'_tinyMCEPath' => "/tiny_mce",

    '_sessionVar' => &$_SESSION['KCFINDER'],
    //'_sessionLifetime' => 30,
    //'_sessionDir' => "/full/directory/path",

    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
);

?>