<?php
/**
 * system_message.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @filesource
 */

namespace cenozo\database;
use cenozo\lib, cenozo\log;

/**
 * system_message: record
 */
class system_message extends record
{ 
  /**
   * Extend parent method by restricting selection to records belonging to this service only
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param database\modifier $modifier Modifications to the selection.
   * @param boolean $count If true the total number of records instead of a list
   * @param boolean $distinct Whether to use the DISTINCT sql keyword
   * @param boolean $full If true then records will not be restricted by service
   * @access public
   * @static
   */
  public static function select( $modifier = NULL, $count = false, $distinct = true )
  {
    // make sure to only include system_messages belonging to this application
    if( is_null( $modifier ) ) $modifier = lib::create( 'database\modifier' );
    $modifier->where_bracket( true );
    $modifier->where( 'service_id', '=', lib::create( 'business\session' )->get_service()->id );
    $modifier->or_where( 'service_id', '=', NULL );
    $modifier->where_bracket( false );

    return parent::select( $modifier, $count, $distinct );
  }
}
