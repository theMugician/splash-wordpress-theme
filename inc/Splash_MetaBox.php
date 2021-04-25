<?php
//Example
//id
//title
//context
//priority
//screens
//template

//nonce
//fields[]

class Splash_MetaBox
{

  /**
   * The ID of the meta box.
   *
   * @var string
   */
  private $id;

  /**
   * The title of the meta box.
   *
   * @var string
   */
  private $title;

  /**
   * Screen context where the meta box should display.
   *
   * @var string
   */
  private $context;

  /**
   * The display priority of the meta box.
   *
   * @var string
   */
  private $priority;

  /**
   * Screens where this meta box will appear.
   *
   * @var string[]
   */
  private $screens;

  /**
   * Path to the template used to display the content of the meta box.
   *
   * @var string
   */
  private $template;

  /**
   * Constructor.
   *
   * @param string   $id
   * @param string   $title
   * @param string   $template
   * @param string   $context
   * @param string   $priority
   * @param string[] $screens
   */
  public function __construct($id, $title, $template, $screens = array(), $context = 'advanced', $priority = 'default' )
  {
    if (is_string($screens)) {
      $screens = (array) $screens;
    }

    $this->context = $context;
    $this->id = $id;
    $this->priority = $priority;
    $this->screens = $screens;
    $this->template = rtrim($template, '/');
    $this->title = $title;
  }

  /**
   * Get the callable that will the content of the meta box.
   *
   * @return callable
   */
  public function get_callback()
  {

    return array($this, 'render');
  }

  /**
   * Get the screen context where the meta box should display.
   *
   * @return string
   */
  public function get_context()
  {
    return $this->context;
  }

  /**
   * Get the ID of the meta box.
   *
   * @return string
   */
  public function get_id()
  {
    return $this->id;
  }

  /**
   * Get the display priority of the meta box.
   *
   * @return string
   */
  public function get_priority()
  {
    return $this->priority;
  }

  /**
   * Get the screen(s) where the meta box will appear.
   *
   * @return array|string|WP_Screen
   */
  public function get_screens()
  {
    return $this->screens;
  }

  /**
   * Get the title of the meta box.
   *
   * @return string
   */
  public function get_title()
  {
    return $this->title;
  }

  /**
   * Render the content of the meta box using a PHP template.
   *
   * @param WP_Post $post
   */
  public function render(WP_Post $post)
  {
    if (!is_readable($this->template)) {
      //echo 'This template is not readable';
      //die();
      return;
    }

    include $this->template;
  }
}


class Splash_SaveMetaBox
{

	/**
   * Nonce.
   *
   * @var string
   */
  private $nonce;

	/**
   * Fields to update.
   *
   * @var array
   */
  private $fields;

  /**
   * Constructor.
   *
   * @param string   $nonce
   * @param string   $fields
   */

  public function __construct($nonce, $fields)
  {
    $this->nonce = $nonce;
    $this->fields = $fields;
    $this->validate();
    $this->save_fields();
  }

  public function validate() 
  {
    global $post_id;
    if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                    // Check Autosave
    || ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )   // Check Revision
    || ( ! isset( $_POST[$this->nonce] ) )    																// Check nonce - Security
    || ( ! wp_verify_nonce( $_POST[$this->nonce], basename(__FILE__) ) )				// Check that the nonce is valid.
    || ( ! current_user_can( 'edit_post', $post_id ) ) )  									// Check permission
    {
    	return;
    }
  }

  public function save_fields() 

  {

    global $post_id;
    foreach ( $this->fields as $field_key ) {
      //var_dump($field_key);
      //die();
      if ( array_key_exists( $field_key, $_POST ) ) {
        // echo('Found array_key');
        // die();
        update_post_meta( $post_id, $field_key, sanitize_text_field( $_POST[$field_key] ) );
      }
   	}
  }

}

class Splash_MetaBoxTemplate
{

  // *
  //  * Requires Wordpress Global $post.
  //  *
  //  * @var object
   
  // private $post;

	/**
   * Nonce.
   *
   * @var string
   */
  private $nonce;

	/**
   * Array of fields
   * 
   * @var array
   */
  private $fields;

  /**
   * Constructor.
   *
   * @param string   $nonce
   * @param array    $fields
   */

  public function __construct($nonce, $fields )
  {
    $this->nonce = $nonce;
    $this->fields = $fields;
    $this->render_template();
  }

  public function validate_form_request()
  {
  	// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), $this->nonce );
  }

  /**
   * Get metafield values.
   * @see output_field() function 
   * @param string   $post_meta_key
   * @return string  $field_value return value based on metakey
   */
  public function get_meta_field_value($post_meta_key)
  {
    global $post;
		// Get the field value if it's already been entered
		return $field_value = get_post_meta( $post->ID, $post_meta_key, true );

	}

  /**
   * Output single field with value if exists.
   * @see   render_template() 
   * @param string   $field_key
   * @param string   $field_type
   */
	public function output_field($field_key, $field_label = null, $field_type = 'text' )
  {
  //if($field_label == null ) { $field_label == $field_key };
 	$field_value = $this->get_meta_field_value($field_key);

	echo
	  '
    <div>
      <label 
      for="' . esc_textarea( $field_key )  . '">' . $field_label . '</label>
      <input 
  		type="' . esc_textarea( $field_type )  . '" 
  		name="'  . esc_textarea( $field_key )  . '"
  		value="' . esc_textarea( $field_value )  . '" 
  		class="widefat">
    </div>';
	}

  /**
   * Render template of all fields.
   * @see   __construct()  
   */
	public function render_template()
	{
    $html = '';
  	$this->validate_form_request();
  	foreach ( $this->fields as $field ) {
      $field_meta = $field['field_meta'];
      $field_label = $field['field_label'];
  		$html .= $this->output_field($field_meta, $field_label);
   	}
    return $html;
	}
}
