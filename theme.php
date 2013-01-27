<?php if ( !defined( 'HABARI_PATH' ) ) { die('No direct access'); } 

/**
 * Msikivu is a custom Theme class for the msikivu theme.
 *
 * @package Habari
 */

/**
 * @todo This stuff needs to move into the custom theme class:
 */


/**
 * A custom theme for msikivu output
 */
class Msikivu extends Theme
{

	public function action_init_theme()
	{
		// Apply Format::autop() to comment content...
		Format::apply( 'autop', 'comment_content_out' );
		// Apply Format::tag_and_list() to post tags...
		Format::apply( 'tag_and_list', 'post_tags_out' );
		// Only uses the <!--more--> tag, with the 'more' as the link to full post
		Format::apply_with_hook_params( 'more', 'post_content_out', 'more' );
		// Creates an excerpt option. echo $post->content_excerpt;
		Format::apply( 'autop', 'post_content_excerpt' );
		Format::apply_with_hook_params( 'more', 'post_content_excerpt', 'more',60, 1 );
		// Format the calendar like date for home, entry.single and entry.multiple templates
		Format::apply( 'format_date', 'post_pubdate_out','{Y}-{m}-{j}' );
	}

    var $defaults = array(
		'theme_color' => 'custom',
		'banner_one_style' => 'sixteen',
		'banner_two_style' => 'eight',
		'banner_three_style' => 'eight',
		'sidebar_one_style' => 'four',
		'content_style' => 'eight',
		'sidebar_two_style' => 'four',
		'footer_one_style' => 'eight',
		'footer_two_style' => 'eight',
		'footer_three_style' => 'sixteen',
		);

	/**
	 * On theme activation, set the default options
	 */
	public function action_theme_activated()
	{
		$opts = Options::get_group( strtolower( get_class( $this ) ) );
		if ( empty( $opts ) ) {
			Options::set_group( strtolower( get_class( $this ) ), $this->defaults );
		}
    }
    
	/**
	 * Add additional template variables to the template output.
	 *
	 *  You can assign additional output values in the template here, instead of
	 *  having the PHP execute directly in the template.  The advantage is that
	 *  you would easily be able to switch between template types (RawPHP/Smarty)
	 *  without having to port code from one to the other.
	 *
	 *  You could use this area to provide "recent comments" data to the template,
	 *  for instance.
	 *
	 *  Note that the variables added here should possibly *always* be added,
	 *  especially 'user'.
	 *
	 *  Also, this function gets executed *after* regular data is assigned to the
	 *  template.  So the values here, unless checked, will overwrite any existing
	 *  values.
	 */
	public function add_template_vars()
	{
		if ( !$this->template_engine->assigned( 'pages' ) ) {
			$this->assign('pages', Posts::get( array( 'content_type' => 'page', 'status' => Post::status('published') ) ) );
		}
		//For Asides loop in sidebar.php
		$this->assign( 'asides', Posts::get( array( 'vocabulary' => array( 'tags:term' => 'aside' ), 'limit' => 5 ) ) );	

		if ( isset($this->request) && $this->request->display_entries_by_tag ) {
			if ( count($this->include_tag) && count($this->exclude_tag) == 0 ) {
				$this->tags_msg = _t('Posts tagged with %s', array(Format::tag_and_list($this->include_tag)));
			}
			else if ( count($this->exclude_tag) && count($this->include_tag) == 0 ) {
				$this->tags_msg = _t('Posts not tagged with %s', array(Format::tag_and_list($this->exclude_tag)));
			}
			else {
				$this->tags_msg = _t('Posts tagged with %s and not with %s', array(Format::tag_and_list($this->include_tag), Format::tag_and_list($this->exclude_tag)));
			}
		}
        
		// Use theme options to set values that can be used directly in the templates
		$opts = Options::get_group( strtolower( get_class( $this ) ) );
		$this->assign( 'theme_color', $opts['theme_color'] );
		$this->assign( 'banner_one_style', $opts['banner_one_style'] );
		$this->assign( 'banner_two_style', $opts['banner_two_style'] );
		$this->assign( 'banner_three_style', $opts['banner_three_style'] );
		$this->assign( 'sidebar_one_style', $opts['sidebar_one_style'] );
		$this->assign( 'content_style', $opts['content_style'] );
		$this->assign( 'sidebar_two_style', $opts['sidebar_two_style'] );
		$this->assign( 'footer_one_style', $opts['footer_one_style'] );
		$this->assign( 'footer_two_style', $opts['footer_two_style'] );
		$this->assign( 'footer_three_style', $opts['footer_three_style'] );			
        
		parent::add_template_vars();
		
	}

	public function act_display_home( $user_filters = array() )
	{
		//To exclude aside tag from main content loop
		parent::act_display_home( array( 'vocabulary' => array( 'tags:not:term' => 'aside' ) ) );
	}

	/**
	 * Customize comment form layout with fieldsets. Needs thorough commenting.
	 */
	public function action_form_comment( $form ) { 
		$form->append( 'fieldset', 'cf_commenterinfo', _t( 'About You' ) );
		$form->move_before( $form->cf_commenterinfo, $form->cf_commenter );

		$form->cf_commenter->move_into($form->cf_commenterinfo);
		$form->cf_commenter->caption = _t('Name:') . '<span class="required">' . ( Options::get('comments_require_id') == 1 ? ' *' . _t('Required') : '' ) . '</span></label>';

		$form->cf_email->move_into( $form->cf_commenterinfo );
		$form->cf_email->caption = _t( 'Email Address:' ) . '<span class="required">' . ( Options::get('comments_require_id') == 1 ? ' *' . _t('Required') : '' ) . '</span></label>'; 

		$form->cf_url->move_into( $form->cf_commenterinfo );
		$form->cf_url->caption = _t( 'Web Address:' );

		$form->append('static','cf_disclaimer', _t( '<p><em><small>Email address is not published</small></em></p>') );
		$form->cf_disclaimer->move_into( $form->cf_commenterinfo );

		$form->append('fieldset', 'cf_contentbox', _t( 'Add to the Discussion' ) );
		$form->move_before($form->cf_contentbox, $form->cf_content);

		$form->cf_content->move_into($form->cf_contentbox);
	        $form->cf_content->caption = _t( 'Message: '. '<span class="required">' . _t('*Required') . '</span></label>' );

		$form->cf_submit->caption = _t( 'Submit' );
	}
	
	public function filter_theme_config($configurable){
	    $configurable = true;
	    return $configurable;
    }
    
    public function action_theme_ui()
    {
        $ui = new FormUI( strtolower( get_class( $this ) ) );
        
        // Widths for the width class options (these are from the Skeleton base).
        $widths = array ( 'zero'=>'zero', 
                          'one'=>'one', 
                          'two'=>'two', 
                          'three'=>'three', 
                          'four'=>'four', 
                          'five'=>'five', 
                          'six'=>'six', 
                          'seven'=>'seven', 
                          'eight'=>'eight', 
                          'nine'=>'nine', 
                          'ten'=>'ten', 
                          'eleven'=>'eleven', 
                          'twelve'=>'twelve', 
                          'thirteen'=>'thirteen', 
                          'fourteen'=>'fourteen', 
                          'fifteen'=>'fifteen', 
                          'sixteen'=>'sixteen');
        $ui->append( 'fieldset', 'color_fs', _t( 'Color' ) );
        $ui->color_fs->append( 'select', 'theme_color', 
                                strtolower( get_class( $this ) ) . '__theme_color', 
                                _t( 'Color scheme:' ), 
                                array(  'custom.css' => 'custom',
                                        'gray.css' => 'gray',
                                        'blue.css' => 'blue',
			                          ),
			                    'formcontrol_select' );
		$ui->append( 'fieldset', 'column_widths', _t( 'Column widths' ) );
		$ui->column_widths->append('static','info', _t( '<p>Set column widths for theme areas.  These use the 16 column scheme from skeleton.</p><br />') );
		$ui->column_widths->append( 'select', 
		                            'banner_one_style', 
		                            strtolower( get_class( $this ) ) . '__banner_one_style', 
		                            _t( 'Banner One width class:' ), 
		                            $widths );
		$ui->column_widths->append( 'select', 
		                            'banner_two_style', 
		                            strtolower( get_class( $this ) ) . '__banner_two_style', 
		                            _t( 'Banner Two width class:' ), 
		                            $widths );
        $ui->column_widths->append( 'select', 
		                            'banner_three_style', 
		                            strtolower( get_class( $this ) ) . '__banner_three_style', 
		                            _t( 'Banner Three width class:' ), 
		                            $widths );		                            
		$ui->column_widths->append( 'select', 
		                            'sidebar_one_style', 
		                            strtolower( get_class( $this ) ) . '__sidebar_one_style', 
		                            _t( 'Sidebar One width class:' ), 
		                            $widths );
		$ui->column_widths->append( 'select', 
		                            'content_style', 
		                            strtolower( get_class( $this ) ) . '__content_style', 
		                            _t( 'Content width class:' ), 
		                            $widths );			
		$ui->column_widths->append( 'select', 
		                            'sidebar_two_style', 
		                            strtolower( get_class( $this ) ) . '__sidebar_two_style', 
		                            _t( 'Sidebar Two width class:' ), 
		                            $widths );
        $ui->column_widths->append( 'select', 
		                            'footer_one_style', 
		                            strtolower( get_class( $this ) ) . '__footer_one_style', 
		                            _t( 'Footer One width class:' ), 
		                            $widths );		                            
        $ui->column_widths->append( 'select', 
		                            'footer_two_style', 
		                            strtolower( get_class( $this ) ) . '__footer_two_style', 
		                            _t( 'Footer Two width class:' ), 
		                            $widths );
        $ui->column_widths->append( 'select', 
		                            'footer_three_style', 
		                            strtolower( get_class( $this ) ) . '__footer_three_style', 
		                            _t( 'Footer Three width class:' ), 
		                            $widths );		                            
		// Save
		$ui->append( 'submit', 'save', _t( 'Save' ) );
		$ui->set_option( 'success_message', _t( 'Options saved' ) );
		$ui->out();
    }

    public function get_config_option($key){
        return Options::get( strtolower( get_class( $this ) ) . '__' . $key);
    }

}

?>
