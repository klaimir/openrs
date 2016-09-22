<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$template['active_template'] = 'plantilla';

/*
|--------------------------------------------------------------------------
| Explaination of template group variables
|--------------------------------------------------------------------------
|
| ['template'] The filename of your master template file in the Views folder.
|   Typically this file will contain a full XHTML skeleton that outputs your
|   full template or region per region. Include the file extension if other
|   than ".php"
| ['regions'] Places within the template where your content may land. 
|   You may also include default markup, wrappers and attributes here 
|   (though not recommended). Region keys must be translatable into variables 
|   (no spaces or dashes, etc)
| ['parser'] The parser class/library to use for the parse_view() method
|   NOTE: See http://codeigniter.com/forums/viewthread/60050/P0/ for a good
|   Smarty Parser that works perfectly with Template
| ['parse_template'] FALSE (default) to treat master template as a View. TRUE
|   to user parser (see above) on the master template
|
| Region information can be extended by setting the following variables:
| ['content'] Must be an array! Use to set default region content
| ['name'] A string to identify the region beyond what it is defined by its key.
| ['wrapper'] An HTML element to wrap the region contents in. (We 
|   recommend doing this in your template file.)
| ['attributes'] Multidimensional array defining HTML attributes of the 
|   wrapper. (We recommend doing this in your template file.)
|
| Example:
| $template['default']['regions'] = array(
|    'header' => array(
|       'content' => array('<h1>Welcome</h1>','<p>Hello World</p>'),
|       'name' => 'Page Header',
|       'wrapper' => '<div>',
|       'attributes' => array('id' => 'header', 'class' => 'clearfix')
|    )
| );
|
*/

/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['default']['template'] = 'template_default';
$template['default']['regions'] = array(
   'header',
   'content',
   'footer',
);
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;

/*
|--------------------------------------------------------------------------
| header+content+sticky footer template
|--------------------------------------------------------------------------
*/

$template['plantilla']['template'] = 'header_content_sticky_footer';
$template['plantilla']['regions'] = array(
   'header',
   'content_left',
   'content_center',
   'content_right',
   'footer',
);
$template['plantilla']['parser'] = 'parser';
$template['plantilla']['parser_method'] = 'parse';
$template['plantilla']['parse_template'] = FALSE;

/*
|--------------------------------------------------------------------------
| content+sticky footer template
|--------------------------------------------------------------------------
*/

$template['content_and_footer']['template'] = 'content_and_footer';
$template['content_and_footer']['regions'] = array(
   'content',
   'footer',
);
$template['content_and_footer']['parser'] = 'parser';
$template['content_and_footer']['parser_method'] = 'parse';
$template['content_and_footer']['parse_template'] = FALSE;

/*
|--------------------------------------------------------------------------
| header and content template
|--------------------------------------------------------------------------
*/

$template['header_and_content']['template'] = 'header_content';
$template['header_and_content']['regions'] = array(
	'header',
	'content',
);
$template['header_and_content']['parser'] = 'parser';
$template['header_and_content']['parser_method'] = 'parse';
$template['header_and_content']['parse_template'] = FALSE;

/*
|--------------------------------------------------------------------------
| content template
|--------------------------------------------------------------------------
*/

$template['only_content']['template'] = 'only_content';
$template['only_content']['regions'] = array(
   'content',
);
$template['only_content']['parser'] = 'parser';
$template['only_content']['parser_method'] = 'parse';
$template['only_content']['parse_template'] = FALSE;

/* End of file template.php */
/* Location: ./system/application/config/template.php */
