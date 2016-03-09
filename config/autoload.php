<?php




/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    'VideoBoxElement'       => 'system/modules/videobox/VideoBoxElement.php',
	'YouTube'               => 'system/modules/videobox/YouTube.php',
	'VideoBox_Helpers'      => 'system/modules/videobox/VideoBox_Helpers.php',
	'ContentVideoBox'       => 'system/modules/videobox/ContentVideoBox.php',

    'Vimeo'               => 'system/modules/videobox/Vimeo.php',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'videobox_youtube'    => 'system/modules/videobox/templates',
    'ce_videobox'         => 'system/modules/videobox/templates',

    'videobox_vimeo'    => 'system/modules/videobox/templates',
));

