<?php
/**
 * setting_edit.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\push;
use cenozo\lib, cenozo\log;

/**
 * push: setting edit
 *
 * Edit a setting.
 * @package cenozo\ui
 */
class setting_edit extends base_edit
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'setting', $args );
  }

  /**
   * Executes the push.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @throws exception\runtime
   * @access public
   */
  public function finish()
  {
    // check to see if site_value is in the column list
    $columns = $this->get_argument( 'columns', array() );
    if( array_key_exists( 'site_value', $columns ) )
    {
      $value = $columns['site_value'];
      $modifier = lib::create( 'database\modifier' );
      $modifier->where( 'site_id', '=', lib::create( 'business\session' )->get_site()->id );
      $setting_value_list = $this->get_record()->get_setting_value_list( $modifier );

      if( 1 == count( $setting_value_list ) )
      {
        if( 0 == strlen( $value ) )
        {
          $setting_value_list[0]->delete();
        }
        else
        {
          $setting_value_list[0]->value = $value;
          $setting_value_list[0]->save();
        }
      }
      else // create a new setting value
      {
        $db_setting_value = lib::create( 'database\setting_value' );
        $db_setting_value->setting_id = $this->get_argument( 'id' );
        $db_setting_value->site_id = lib::create( 'business\session' )->get_site()->id;
        $db_setting_value->value = $value;
        $db_setting_value->save();
      }
    }
    else parent::finish();
  }
}
?>
