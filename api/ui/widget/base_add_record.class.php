<?php
/**
 * base_add_record.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\widget;
use cenozo\lib, cenozo\log;

/**
 * Base class for all "add record" to record widgets
 * 
 * @abstract
 * @package cenozo\ui
 */
abstract class base_add_record extends base_record
{
  /**
   * Constructor
   * 
   * Defines all variables which need to be set for the associated template.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param string $subject The subject being viewed.
   * @param string $child The the child item's subject.
   * @param array $args An associative array of arguments to be processed by th  widget
   * @throws exception\argument
   * @access public
   */
  public function __construct( $subject, $child, $args )
  {
    parent::__construct( $subject, 'add_'.$child, $args );
    $this->show_heading( false );
    
    // make sure we have an id (we don't actually need to use it since the parent does)
    $this->get_argument( 'id' );

    // build the child add widget
    $this->add_widget = lib::create( 'ui\widget\\'.$child.'_add', $args );
    $this->add_widget->set_parent( $this, 'edit' );

    $this->add_widget->set_heading(
      sprintf( 'Add a new %s to the %s',
               $child,
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
    $this->set_variable( 'record_subject', $this->add_widget->get_subject() );
    $this->set_variable( 'record_subjects',
                         $util_class_name::pluralize( $this->add_widget->get_subject() ) );
    $this->set_variable( 'add_widget_name', $this->add_widget->get_class_name() );

    $this->add_widget->finish();
    $this->set_variable( 'record', $this->add_widget->get_variables() );
  }

  /**
   * The child add widget.
   * @var widget
   * @access protected
   */
  protected $add_widget = NULL;
}
?>
