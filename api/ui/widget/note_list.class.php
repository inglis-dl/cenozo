<?php
/**
 * note_list.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\widget;
use cenozo\lib, cenozo\log;

/**
 * widget note list
 * 
 * @package cenozo\ui
 */
class note_list extends \cenozo\ui\widget
{
  /**
   * Constructor
   * 
   * Defines all variables which need to be set for the associated template.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args An associative array of arguments to be processed by the widget
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'note', 'list', $args );
  }

  /**
   * Finish setting the variables in a widget.
   * 
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @throws exception\runtime
   * @access public
   */
  public function finish()
  {
    parent::finish();
    
    $util_class_name = lib::get_class_name( 'util' );

    // make sure there is a valid note category
    $category = $this->get_argument( 'category' );
    $category_id = $this->get_argument( 'category_id' );
    $db_record = lib::create( 'database\\'.$category, $category_id );
    if( !is_a( $db_record, lib::get_class_name( 'database\has_note' ) ) )
      throw lib::create( 'exception\runtime',
        sprintf( 'Tried to list notes for %s which cannot have notes.', $category ),
        __METHOD__ );
    
    // get the record's note list
    $note_list = array();
    foreach( $db_record->get_note_list() as $db_note )
    {
      $datetime = 7 > $util_class_name::get_interval( $db_note->datetime )->days
                ? $util_class_name::get_fuzzy_period_ago( $db_note->datetime )
                : $util_class_name::get_formatted_date( $db_note->datetime );
      $note_list[] = array( 'id' => $db_note->id,
                            'sticky' => $db_note->sticky,
                            'user' => $db_note->get_user()->name,
                            'datetime' => $datetime,
                            'note' => $db_note->note );
    }

    $this->set_variable( 'category', $category );
    $this->set_variable( 'category_id', $category_id );
    $this->set_variable( 'note_list', $note_list );

    // allow upper tier roles to modify notes
    if( 1 < lib::create( 'business\session' )->get_role()->tier )
    {
      $this->set_variable( 'stickable', true );
      $this->set_variable( 'removable', true );
      $this->set_variable( 'editable', true );
    }
    else
    {
      $this->set_variable( 'stickable', false );
      $this->set_variable( 'removable', false );
      $this->set_variable( 'editable', false );
    }
  }
}
?>
