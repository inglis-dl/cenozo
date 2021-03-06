<?php
/**
 * self_settings.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\widget;
use cenozo\lib, cenozo\log;

/**
 * widget self settings
 * 
 * @package cenozo\ui
 */
class self_settings extends \cenozo\ui\widget
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Operation arguments
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'self', 'settings', $args );
    $this->show_heading( false );
  }

  /**
   * Finish setting the variables in a widget.
   * 
   * Defines all variables which need to be set for the associated template.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   */
  public function finish()
  {
    parent::finish();

    $session = lib::create( 'business\session' );

    // create and setup the widget
    $db_user = $session->get_user();
    $db_current_site = $session->get_site();
    $db_current_role = $session->get_role();
    
    $sites = array();
    foreach( $db_user->get_site_list() as $db_site )
      $sites[ $db_site->id ] = $db_site->name;

    $roles = array();
    $modifier = lib::create( 'database\modifier' );
    $modifier->where( 'site_id', '=', $db_current_site->id );
    foreach( $db_user->get_role_list( $modifier ) as $db_role )
      $roles[ $db_role->id ] = $db_role->name;
    
    // themes are found in the jquery-ui 
    $themes = array();
    foreach( new \DirectoryIterator( JQUERY_UI_THEMES_PATH ) as $file )
      if( !$file->isDot() && $file->isDir() ) $themes[] = $file->getFilename();

    $this->set_variable( 'user', $db_user->first_name.' '.$db_user->last_name );
    $this->set_variable( 'version',
      lib::create( 'business\setting_manager' )->get_setting( 'general', 'version' ) );
    $this->set_variable( 'development', lib::in_development_mode() );
    $this->set_variable( 'current_site_id', $db_current_site->id );
    $this->set_variable( 'current_site_name', $db_current_site->name );
    $this->set_variable( 'current_role_id', $db_current_role->id );
    $this->set_variable( 'current_role_name', $db_current_role->name );
    $this->set_variable( 'current_theme_name', $session->get_theme() );
    $this->set_variable( 'roles', $roles );
    $this->set_variable( 'sites', $sites );
    $this->set_variable( 'themes', $themes );
    $this->set_variable( 'logo', false );
  }
}
?>
