<?php
/* "Copyright 2012 a3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */

namespace A3Rev\Portfolio\FrameWork\Tabs {

use A3Rev\Portfolio\FrameWork;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------
Portfolio Styles Tab

TABLE OF CONTENTS

- var parent_page
- var position
- var tab_data

- __construct()
- tab_init()
- tab_data()
- add_tab()
- settings_include()
- tab_manager()

-----------------------------------------------------------------------------------*/

class Item_Expander extends FrameWork\Admin_UI
{
	/**
	 * @var string
	 */
	private $parent_page = 'a3-portfolios-settings';

	/**
	 * @var string
	 * You can change the order show of this tab in list tabs
	 */
	private $position = 2;

	/**
	 * @var array
	 */
	private $tab_data;

	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {

		$this->settings_include();
		$this->tab_init();
	}

	/*-----------------------------------------------------------------------------------*/
	/* tab_init() */
	/* Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function tab_init() {

		add_filter( $this->plugin_name . '-' . $this->parent_page . '_settings_tabs_array', array( $this, 'add_tab' ), $this->position );

	}

	/**
	 * tab_data()
	 * Get Tab Data
	 * =============================================
	 * array (
	 *		'name'				=> 'my_tab_name'				: (required) Enter your tab name that you want to set for this tab
	 *		'label'				=> 'My Tab Name' 				: (required) Enter the tab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this tab
	 * )
	 *
	 */
	public function tab_data() {

		$tab_data = array(
			'name'				=> 'global-item-expander',
			'label'				=> __( 'Item Expander', 'a3-portfolio' ),
			'callback_function'	=> 'a3_portfolio_global_item_expander_tab_manager',
		);

		if ( $this->tab_data ) return $this->tab_data;
		return $this->tab_data = $tab_data;

	}

	/*-----------------------------------------------------------------------------------*/
	/* add_tab() */
	/* Add tab to Admin Init and Parent Page
	/*-----------------------------------------------------------------------------------*/
	public function add_tab( $tabs_array ) {

		if ( ! is_array( $tabs_array ) ) $tabs_array = array();
		$tabs_array[] = $this->tab_data();

		return $tabs_array;
	}

	/*-----------------------------------------------------------------------------------*/
	/* panels_include() */
	/* Include form settings panels
	/*-----------------------------------------------------------------------------------*/
	public function settings_include() {

		// Includes Settings file
		global $a3_portfolio_global_item_expander_settings_panel;
		$a3_portfolio_global_item_expander_settings_panel = new FrameWork\Settings\Item_Expander();

	}

	/*-----------------------------------------------------------------------------------*/
	/* tab_manager() */
	/* Call tab layout from Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function tab_manager() {
		global $a3_portfolio_global_item_expander_settings_panel;

		$this->plugin_extension_start();
		$a3_portfolio_global_item_expander_settings_panel->settings_form();
		$this->plugin_extension_end();

		//$GLOBALS[$this->plugin_prefix.'admin_init']->admin_settings_tab( $this->parent_page, $this->tab_data() );

	}
}

}

namespace {

/**
 * a3_portfolio_global_item_expander_tab_manager()
 * Define the callback function to show tab content
 */
function a3_portfolio_global_item_expander_tab_manager() {
	global $a3_portfolio_global_item_expander_tab;
	$a3_portfolio_global_item_expander_tab->tab_manager();
}

}
