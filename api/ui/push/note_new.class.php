<?php
/**
 * note_new.class.php
 * 
 * @author Patrick Emond <emondpd@mcmaster.ca>
 * @package cenozo\ui
 * @filesource
 */

namespace cenozo\ui\push;
use cenozo\lib, cenozo\log;

/**
 * push: note new
 * 
 * Add a new note to the provided category.
 * @package cenozo\ui
 */
class note_new extends \cenozo\ui\push
{
  /**
   * Constructor.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @param array $args Push arguments
   * @access public
   */
  public function __construct( $args )
  {
    parent::__construct( 'note', 'new', $args );
  }
  
  /**
   * Executes the push.
   * @author Patrick Emond <emondpd@mcmaster.ca>
   * @throws exception\runtime
   * @access public
   */
  public function finish()
  {
    // make sure there is a valid note category
    $category = $this->get_argument( 'category' );
    $category_id = $this->get_argument( 'category_id' );
    $note = $this->get_argument( 'note' );
    $db_record = lib::create( 'database\\'.$category, $category_id );
    if( !is_a( $db_record, lib::get_class_name( 'database\has_note' ) ) )
      throw lib::create( 'exception\runtime',
        sprintf( 'Tried to create new note to %s which cannot have notes.', $category ),
        __METHOD__ );

    $db_record->add_note( lib::create( 'business\session' )->get_user(), $note );
  }
}
?>
