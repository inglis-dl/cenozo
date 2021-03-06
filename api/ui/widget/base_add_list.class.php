<?php
/**
 * base_add_list.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\widget;
use cenozo\lib, cenozo\log;

/**
 * Base class for all "add list" to record widgets
 * 
 * @abstract
 * @package cenozo\ui
 */
abstract class base_add_list extends base_record
{
  /**
   * Constructor
   * 
   * Defines all variables which need to be set for the associated template.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param string $subject The subject being viewed.
   * @param string $child The the list item's subject.
   * @param array $args An associative array of arguments to be processed by th  widget
   * @throws exception\argument
   * @access public
   */
  public function __construct( $subject, $child, $args )
  {
    parent::__construct( $subject, 'add_'.$child, $args );
    
    $util_class_name = lib::get_class_name( 'util' );

    // make sure we have an id (we don't actually need to use it since the parent does)
    $this->get_argument( 'id' );

    // build the list widget
    $this->list_widget = lib::create( 'ui\widget\\'.$child.'_list', $args );
    $this->list_widget->set_parent( $this, 'edit' );

    $this->list_widget->set_heading(
      sprintf( 'Choose %s to add to the %s',
               $util_class_name::pluralize( $child ),
               $subject ) );
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

    $util_class_name = lib::get_class_name( 'util' );

    // define all template variables for this widget
    $this->set_variable( 'list_subject', $this->list_widget->get_subject() );
    $this->set_variable( 'list_subjects',
                         $util_class_name::pluralize( $this->list_widget->get_subject() ) );
    $this->set_variable( 'list_widget_name', $this->list_widget->get_class_name() );

    $this->list_widget->finish();
    $this->set_variable( 'list', $this->list_widget->get_variables() );
  }
  
  /**
   * The list widget from which to add to the record.
   * @var list_widget
   * @access protected
   */
  protected $list_widget = NULL;
}
?>
