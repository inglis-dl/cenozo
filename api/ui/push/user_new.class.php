<?php
/**
 * user_new.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\push;
use cenozo\log, cenozo\util;
use cenozo\business as bus;
use cenozo\database as db;
use cenozo\exception as exc;

/**
 * push: user new
 *
 * Create a new user.
 * @package cenozo\ui
 */
class user_new extends base_new
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $args )
  {
    // remove the role id from the columns and use it to create the user's initial role
    if( isset( $args['columns'] ) &&
        isset( $args['columns']['role_id'] ) && isset( $args['columns']['site_id'] ) )
    {
      $this->role_id = $args['columns']['role_id'];
      $this->site_id = $args['columns']['site_id'];
      unset( $args['columns']['role_id'] );
      unset( $args['columns']['site_id'] );
    }

    parent::__construct( 'user', $args );
  }

  /**
   * Executes the push.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   * @throws exception\notice
   */
  public function finish()
  {
    $columns = $this->get_argument( 'columns' );
    
    // make sure the name, first name and last name are not blank
    if( !array_key_exists( 'name', $columns ) || 0 == strlen( $columns['name'] ) )
      throw new exc\notice( 'The user\'s user name cannot be left blank.', __METHOD__ );
    if( !array_key_exists( 'first_name', $columns ) || 0 == strlen( $columns['first_name'] ) )
      throw new exc\notice( 'The user\'s first name cannot be left blank.', __METHOD__ );
    if( !array_key_exists( 'last_name', $columns ) || 0 == strlen( $columns['last_name'] ) )
      throw new exc\notice( 'The user\'s last name cannot be left blank.', __METHOD__ );

    // add the user to ldap
    $ldap_manager = bus\ldap_manager::self();
    try
    {
      $ldap_manager->new_user(
        $columns['name'], $columns['first_name'], $columns['last_name'], 'password' );
    }
    catch( exc\ldap $e )
    {
      // catch already exists exceptions, no need to report them
      if( !$e->is_already_exists() ) throw $e;
    }

    parent::finish();
  }

  /**
   * The initial site to give the new user access to
   * @var int
   * @access protected
   */
  protected $site_id = NULL;

  /**
   * The initial role to give the new user
   * @var int
   * @access protected
   */
  protected $role_id = NULL;
}
?>