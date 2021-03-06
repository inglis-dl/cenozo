<?php
/**
 * base_calendar.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\widget;
use cenozo\lib, cenozo\log;

/**
 * base widget for all calendars
 * 
 * @package cenozo\ui
 */
abstract class base_calendar extends \cenozo\ui\widget
{
  /**
   * Constructor
   * 
   * Defines all variables required by the base calendar.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param string $subject The calendar's subject.
   * @param array $args An associative array of arguments to be processed by the widget
   * @access public
   */
  public function __construct( $subject, $args )
  {
    parent::__construct( $subject, 'calendar', $args );
  }

  /**
   * Finish setting the variables in a widget.
   * 
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @access public
   */
  public function finish()
  {
    parent::finish();
    $this->set_variable( 'editable', $this->editable );
  }

  /**
   * Set whether events can be edited.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param boolean $enable
   * @access public
   */
  public function set_editable( $enable )
  {
    $this->editable = $enable;
  }

  /**
   * Determines whether calendar events are editable.
   * @var boolean
   * @access protected
   */
  protected $editable = false;
}
?>
