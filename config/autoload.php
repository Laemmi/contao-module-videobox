<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Laemmi',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Laemmi\Videobox\ContentVideoBox'      => 'system/modules/videobox/classes/ContentVideoBox.php',
	'Laemmi\Videobox\ModuleVideoBoxList'   => 'system/modules/videobox/classes/ModuleVideoBoxList.php',
	'Laemmi\Videobox\ModuleVideoBoxReader' => 'system/modules/videobox/classes/ModuleVideoBoxReader.php',
	'Laemmi\Videobox\VideoBoxElement'      => 'system/modules/videobox/classes/VideoBoxElement.php',
	'Laemmi\Videobox\VideoBoxHelpers'      => 'system/modules/videobox/classes/VideoBoxHelpers.php',
	'Laemmi\Videobox\VimeoFrontend'        => 'system/modules/videobox/classes/VimeoFrontend.php',
	'Laemmi\Videobox\YouTubeFrontend'      => 'system/modules/videobox/classes/YouTubeFrontend.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_videobox'         => 'system/modules/videobox/templates',
	'mod_videobox_list'   => 'system/modules/videobox/templates',
	'mod_videobox_reader' => 'system/modules/videobox/templates',
	'videobox_vimeo'      => 'system/modules/videobox/templates',
	'videobox_youtube'    => 'system/modules/videobox/templates',
));
