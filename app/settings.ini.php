<?php
/**
 * cenozo.ini.php
 * 
 * Defines initialization settings for cenozo.
 * DO NOT edit this file, to override these settings use cenozo.local.ini.php instead.
 * When this file is loaded it only defines setting values if they are not already defined.
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo
 */

global $SETTINGS;

// create all setting categories if they don't already exist
if( !isset( $SETTINGS ) && !is_array( $SETTINGS ) ) $SETTINGS = array();
if( !array_key_exists( 'general', $SETTINGS ) ) $SETTINGS['general'] = array();
if( !array_key_exists( 'url', $SETTINGS ) ) $SETTINGS['url'] = array();
if( !array_key_exists( 'path', $SETTINGS ) ) $SETTINGS['path'] = array();
if( !array_key_exists( 'version', $SETTINGS ) ) $SETTINGS['version'] = array();
if( !array_key_exists( 'db', $SETTINGS ) ) $SETTINGS['db'] = array();
if( !array_key_exists( 'ldap', $SETTINGS ) ) $SETTINGS['ldap'] = array();
if( !array_key_exists( 'interface', $SETTINGS ) ) $SETTINGS['interface'] = array();

// Framework software version (is never overridded by the application's ini file)
$SETTINGS['general']['cenozo_version'] = '0.1.0';

// always leave as false when running as production server
if( !array_key_exists( 'development_mode', $SETTINGS['general'] ) )
  $SETTINGS['general']['development_mode'] = false;

if( !array_key_exists( 'COOKIE', $SETTINGS['path'] ) )
  $SETTINGS['path']['COOKIE'] = dirname( $_SERVER['SCRIPT_FILENAME'] );

// the location of cenozo internal path
if( !array_key_exists( 'CENOZO', $SETTINGS['path'] ) )
  $SETTINGS['path']['CENOZO'] = '/usr/local/lib/cenozo';

// the location of libraries
if( !array_key_exists( 'ADODB', $SETTINGS['path'] ) )
  $SETTINGS['path']['ADODB'] = '/usr/local/lib/adodb';

// javascript and css paths
if( !array_key_exists( 'JS', $SETTINGS['path'] ) )
  $SETTINGS['url']['JS'] = $SETTINGS['url']['CENOZO'].'/js';
if( !array_key_exists( 'CSS', $SETTINGS['path'] ) )
  $SETTINGS['url']['CSS'] = $SETTINGS['url']['CENOZO'].'/css';

// javascript libraries
if( !array_key_exists( 'JQUERY', $SETTINGS['version'] ) )
  $SETTINGS['version']['JQUERY'] = '1.4.4';
if( !array_key_exists( 'JQUERY_UI', $SETTINGS['version'] ) )
  $SETTINGS['version']['JQUERY_UI'] = '1.8.9';

if( !array_key_exists( 'JQUERY', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY'] = '/jquery';
if( !array_key_exists( 'JQUERY_UI', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_UI'] = $SETTINGS['url']['JQUERY'].'/ui';
if( !array_key_exists( 'JQUERY_PLUGINS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_PLUGINS'] = $SETTINGS['url']['JQUERY'].'/plugins';
if( !array_key_exists( 'JQUERY_UI_THEMES', $SETTINGS['path'] ) )
  $SETTINGS['path']['JQUERY_UI_THEMES'] = '/var/www/jquery/ui/css';

if( !array_key_exists( 'JQUERY_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_JS'] = 
    $SETTINGS['url']['JQUERY'].'/jquery-'.$SETTINGS['version']['JQUERY'].'.min.js';
if( !array_key_exists( 'JQUERY_UI_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_UI_JS'] =
    $SETTINGS['url']['JQUERY_UI'].'/js/jquery-ui-'.
    $SETTINGS['version']['JQUERY_UI'].'.custom.min.js';

if( !array_key_exists( 'JQUERY_LAYOUT_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_LAYOUT_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/layout.js';
if( !array_key_exists( 'JQUERY_COOKIE_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_COOKIE_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/cookie.js';
if( !array_key_exists( 'JQUERY_HOVERINTENT_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_HOVERINTENT_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/hoverIntent.js';
if( !array_key_exists( 'JQUERY_METADATA_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_METADATA_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/metadata.js';
if( !array_key_exists( 'JQUERY_FLIPTEXT_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_FLIPTEXT_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/flipText.js';
if( !array_key_exists( 'JQUERY_EXTRUDER_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_EXTRUDER_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/extruder.js';
if( !array_key_exists( 'JQUERY_LOADING_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_LOADING_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/loading.js';
if( !array_key_exists( 'JQUERY_LOADING_OVERFLOW_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_LOADING_OVERFLOW_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/loading.overflow.js';
if( !array_key_exists( 'JQUERY_JEDITABLE_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_JEDITABLE_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/jeditable.js';
if( !array_key_exists( 'JQUERY_TIMEPICKER_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_TIMEPICKER_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/timepicker.js';
if( !array_key_exists( 'JQUERY_RIGHTCLICK_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_RIGHTCLICK_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/rightClick.js';
if( !array_key_exists( 'JQUERY_TOOLTIP_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_TOOLTIP_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/tooltip.js';
if( !array_key_exists( 'JQUERY_FULLCALENDAR_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_FULLCALENDAR_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/fullcalendar.js';
if( !array_key_exists( 'JQUERY_FONTSCALE_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_FONTSCALE_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/fontscale.js';
if( !array_key_exists( 'JQUERY_TIMERS_JS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_TIMERS_JS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/timers.js';

// css files
if( !array_key_exists( 'JQUERY_UI', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_UI_THEMES'] = $SETTINGS['url']['JQUERY_UI'].'/css';
if( !array_key_exists( 'JQUERY_FULLCALENDAR_CSS', $SETTINGS['url'] ) )
  $SETTINGS['url']['JQUERY_FULLCALENDAR_CSS'] =
    $SETTINGS['url']['JQUERY_PLUGINS'].'/fullcalendar.css';

// the location of log files
if( !array_key_exists( 'LOG_FILE', $SETTINGS['path'] ) )
  $SETTINGS['path']['LOG_FILE'] = '/var/local/cenozo/log';

// the location of the compiled template cache
if( !array_key_exists( 'TEMPLATE_CACHE', $SETTINGS['path'] ) )
  $SETTINGS['path']['TEMPLATE_CACHE'] = '/tmp/cenozo'.$SETTINGS['path']['APPLICATION'];

// database settings
if( !array_key_exists( 'driver', $SETTINGS['db'] ) )
  $SETTINGS['db']['driver'] = 'mysql';
if( !array_key_exists( 'server', $SETTINGS['db'] ) )
  $SETTINGS['db']['server'] = 'localhost';
if( !array_key_exists( 'username', $SETTINGS['db'] ) )
  $SETTINGS['db']['username'] = 'cenozo';
if( !array_key_exists( 'password', $SETTINGS['db'] ) )
  $SETTINGS['db']['password'] = '';
if( !array_key_exists( 'database', $SETTINGS['db'] ) )
  $SETTINGS['db']['database'] = 'cenozo';
if( !array_key_exists( 'prefix', $SETTINGS['db'] ) )
  $SETTINGS['db']['prefix'] = '';

// ldap settings
if( !array_key_exists( 'server', $SETTINGS['ldap'] ) )
  $SETTINGS['ldap']['server'] = 'localhost';
if( !array_key_exists( 'port', $SETTINGS['ldap'] ) )
  $SETTINGS['ldap']['port'] = 389;
if( !array_key_exists( 'base', $SETTINGS['ldap'] ) )
  $SETTINGS['ldap']['base'] = '';
if( !array_key_exists( 'username', $SETTINGS['ldap'] ) )
  $SETTINGS['ldap']['username'] = '';
if( !array_key_exists( 'password', $SETTINGS['ldap'] ) )
  $SETTINGS['ldap']['password'] = '';
if( !array_key_exists( 'active_directory', $SETTINGS['ldap'] ) )
  $SETTINGS['ldap']['active_directory'] = true;

// themes
if( !array_key_exists( 'default_theme', $SETTINGS['interface'] ) )
  $SETTINGS['interface']['default_theme'] = 'smoothness';
?>