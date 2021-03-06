<?php
/**
 * setting_list.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\widget;
use cenozo\lib, cenozo\log;

/**
 * widget setting list
 * 
 * @package cenozo\ui
 */
class setting_list extends base_list
{
  /**
   * Constructor
   * 
   * Defines all variables required by the setting list.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args An associative array of arguments to be processed by the widget
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'setting', $args );
    
    $is_mid_tier = 2 == lib::create( 'business\session' )->get_role()->tier;

    $this->add_column( 'category', 'string', 'Category', true );
    $this->add_column( 'name', 'string', 'Name', true );
    $this->add_column( 'value', 'string', 'Default', false );
    if( $is_mid_tier ) $this->add_column( 'site_value', 'string', 'Value', false );
    $this->add_column( 'description', 'text', 'Description', true, true, 'left' );
  }

  /**
   * Set the rows array needed by the template.
   * 
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   */
  public function finish()
  {
    parent::finish();
    
    $session = lib::create( 'business\session' );
    $is_mid_tier = 2 == $session->get_role()->tier;

    foreach( $this->get_record_list() as $record )
    {
      if( $is_mid_tier )
      { // include the site's value
        $modifier = lib::create( 'database\modifier' );
        $modifier->where( 'site_id', '=', $session->get_site()->id );
        $setting_value_list = $record->get_setting_value_list( $modifier );
        $value = 1 == count( $setting_value_list ) ? $setting_value_list[0]->value : '';

        $this->add_row( $record->id,
          array( 'category' => $record->category,
                 'name' => $record->name,
                 'value' => $record->value,
                 'site_value' => $value,
                 'description' => $record->description ) );
      }
      else
      {
        $this->add_row( $record->id,
          array( 'category' => $record->category,
                 'name' => $record->name,
                 'value' => $record->value,
                 'description' => $record->description ) );
      }
    }

    $this->finish_setting_rows();
  }
}
?>
