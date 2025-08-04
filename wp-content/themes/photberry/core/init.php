<?php
/*
 * Created by Pixel-Mafia
 * www.pixel-mafia.com
*/

require_once(get_template_directory() . "/core/classes.php");
require_once(get_template_directory() . "/core/metabox.php");
require_once(get_template_directory() . "/core/tgm/class-tgm-plugin-activation.php");
require_once(get_template_directory() . "/core/tgm/init.php");
require_once(get_template_directory() . "/core/aq_resizer.php");
require_once(get_template_directory() . "/core/customizer.php");
require_once(get_template_directory() . "/core/fonts.php");
require_once(get_template_directory() . "/css/custom.php");
require_once(get_template_directory() . "/core/ajax.php");
require_once(get_template_directory() . "/core/import/import.php");

/* Elementor Plugin Custom Elements */
if (function_exists('elementor_load_plugin_textdomain')) {
    require_once(get_template_directory() . "/core/elementor/init.php");
}