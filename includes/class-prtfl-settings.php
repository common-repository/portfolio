<?php
/**
 * Displays the content on the plugin settings page
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

if ( ! class_exists( 'Prtfl_Settings_Tabs' ) ) {
	/**
	 * Class for display Settings Tabs
	 */
	class Prtfl_Settings_Tabs extends Bws_Settings_Tabs {

		/**
		 * Image sizes array
		 *
		 * @var array
		 */
		public $wp_image_sizes = array();

		/**
		 * Options for Custom Search plugin
		 *
		 * @var array
		 */
		public $cstmsrch_options;

		/**
		 * Fields for portfolio
		 *
		 * @var array
		 */
		public $fields;

		/**
		 * Constructor.
		 *
		 * @access public
		 *
		 * @see Bws_Settings_Tabs::__construct() for more information on default arguments.
		 *
		 * @param string $plugin_basename Plugin basename.
		 */
		public function __construct( $plugin_basename ) {
			global $prtfl_options, $prtfl_plugin_info, $prtfl_bws_demo_data;

			$tabs = array(
				'settings'      => array( 'label' => __( 'Settings', 'portfolio' ) ),
				'project'       => array( 'label' => __( 'Project', 'portfolio' ) ),
				'misc'          => array( 'label' => __( 'Misc', 'portfolio' ) ),
				'custom_code'   => array( 'label' => __( 'Custom Code', 'portfolio' ) ),
				'import-export' => array( 'label' => __( 'Import / Export', 'portfolio' ) ),
				'license'       => array( 'label' => __( 'License Key', 'portfolio' ) ),
			);

			parent::__construct(
				array(
					'plugin_basename' => $plugin_basename,
					'plugins_info'    => $prtfl_plugin_info,
					'prefix'          => 'prtfl',
					'default_options' => prtfl_get_options_default(),
					'options'         => $prtfl_options,
					'tabs'            => $tabs,
					'wp_slug'         => 'portfolio',
					'demo_data'       => $prtfl_bws_demo_data,
					'link_key'        => 'f047e20c92c972c398187a4f70240285',
					'link_pn'         => '74',
					'doc_link'        => 'https://bestwebsoft.com/documentation/portfolio/portfolio-user-guide/',
				)
			);

			$this->all_plugins = get_plugins();

			$wp_sizes = get_intermediate_image_sizes();

			foreach ( (array) $wp_sizes as $size ) {
				if ( ! array_key_exists( $size, $prtfl_options['custom_size_px'] ) ) {
					if ( isset( $_wp_additional_image_sizes[ $size ] ) ) {
						$width  = absint( $_wp_additional_image_sizes[ $size ]['width'] );
						$height = absint( $_wp_additional_image_sizes[ $size ]['height'] );
					} else {
						$width  = absint( get_option( $size . '_size_w' ) );
						$height = absint( get_option( $size . '_size_h' ) );
					}

					if ( ! $width && ! $height ) {
						$this->wp_image_sizes[] = array(
							'value' => $size,
							'name'  => ucwords( str_replace( array( '-', '_' ), ' ', $size ) ),
						);
					} else {
						$this->wp_image_sizes[] = array(
							'value'  => $size,
							'name'   => ucwords( str_replace( array( '-', '_' ), ' ', $size ) ) . ' (' . $width . ' &#215; ' . $height . ')',
							'width'  => $width,
							'height' => $height,
						);
					}
				}
			}

			$this->cstmsrch_options = get_option( 'cstmsrch_options' );

			$this->fields = array(
				'executor'       => __( 'Executors', 'portfolio' ),
				'technologies'   => __( 'Technologies', 'portfolio' ),
				'date'           => __( 'Date of completion', 'portfolio' ),
				'link'           => __( 'Link', 'portfolio' ),
				'shrdescription' => __( 'Short Description', 'portfolio' ),
				'description'    => __( 'Description', 'portfolio' ),

			);

			add_action( get_parent_class( $this ) . '_display_custom_messages', array( $this, 'display_custom_messages' ) );
			add_action( get_parent_class( $this ) . '_additional_misc_options_affected', array( $this, 'additional_misc_options_affected' ) );
			add_action( get_parent_class( $this ) . '_additional_import_export_options', array( $this, 'additional_import_export_options' ) );
			add_action( get_parent_class( $this ) . '_display_metabox', array( $this, 'display_metabox' ) );
		}

		/**
		 * Save plugin options to the database
		 *
		 * @access public
		 * @return array The action results
		 */
		public function save_options() {

			$message = '';
			$notice  = '';
			$error   = '';

			if ( isset( $_POST['prtfl_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['prtfl_settings_nonce'] ) ), 'prtfl_settings' ) ) {

				$this->options['custom_image_row_count']     = isset( $_POST['prtfl_custom_image_row_count'] ) ? absint( $_POST['prtfl_custom_image_row_count'] ) : 3;
				$this->options['custom_portfolio_row_count'] = isset( $_POST['prtfl_portfolio_custom_row_count'] ) ? absint( $_POST['prtfl_portfolio_custom_row_count'] ) : 1;

				$new_image_size_photo      = isset( $_POST['prtfl_image_size_photo'] ) ? sanitize_text_field( wp_unslash( $_POST['prtfl_image_size_photo'] ) ) : 'thumbnail';
				$custom_image_size_w_photo = isset( $_POST['prtfl_custom_image_size_w_photo'] ) ? absint( $_POST['prtfl_custom_image_size_w_photo'] ) : 240;
				$custom_image_size_h_photo = isset( $_POST['prtfl_custom_image_size_h_photo'] ) ? absint( $_POST['prtfl_custom_image_size_h_photo'] ) : 260;
				$custom_size_px_photo      = array( $custom_image_size_w_photo, $custom_image_size_h_photo );
				if ( 'portfolio-photo-thumb' === $new_image_size_photo ) {
					if ( $new_image_size_photo !== $this->options['image_size_photo'] ) {
						$need_image_update = true;
					} else {
						foreach ( $custom_size_px_photo as $key => $value ) {
							if ( absint( $value ) !== absint( $this->options['custom_size_px']['portfolio-photo-thumb'][ $key ] ) ) {
								$need_image_update = true;
								break;
							}
						}
					}
				}
				$this->options['custom_size_px']['portfolio-photo-thumb'] = $custom_size_px_photo;
				$this->options['image_size_photo']                        = $new_image_size_photo;

				$new_image_size_album      = isset( $_POST['prtfl_image_size_album'] ) ? sanitize_text_field( wp_unslash( $_POST['prtfl_image_size_album'] ) ) : 'medium';
				$custom_image_size_w_album = isset( $_POST['prtfl_custom_image_size_w_album'] ) ? absint( $_POST['prtfl_custom_image_size_w_album'] ) : 280;
				$custom_image_size_h_album = isset( $_POST['prtfl_custom_image_size_h_album'] ) ? absint( $_POST['prtfl_custom_image_size_h_album'] ) : 300;
				$custom_size_px_album      = array( $custom_image_size_w_album, $custom_image_size_h_album );
				if ( 'portfolio-thumb' === $new_image_size_album ) {
					if ( $new_image_size_album !== $this->options['image_size_album'] ) {
						$need_image_update = true;
					} else {
						foreach ( $custom_size_px_album as $key => $value ) {
							if ( absint( $value ) !== absint( $this->options['custom_size_px']['portfolio-thumb'][ $key ] ) ) {
								$need_image_update = true;
								break;
							}
						}
					}
				}

				$this->options['custom_size_px']['portfolio-thumb'] = $custom_size_px_album;
				$this->options['image_size_album']                  = $new_image_size_album;

				if ( ! empty( $_POST['prtfl_page_id_portfolio_template'] ) && absint( $this->options['page_id_portfolio_template'] ) !== absint( $_POST['prtfl_page_id_portfolio_template'] ) ) {
					/* for rewrite */
					$this->options['flush_rewrite_rules']        = 1;
					$this->options['page_id_portfolio_template'] = absint( $_POST['prtfl_page_id_portfolio_template'] );
				}

				$this->options['order_by'] = isset( $_POST['prtfl_order_by'] ) ? sanitize_text_field( wp_unslash( $_POST['prtfl_order_by'] ) ) : 'date';
				$this->options['order']    = isset( $_POST['prtfl_order'] ) ? sanitize_text_field( wp_unslash( $_POST['prtfl_order'] ) ) : 'DESC';

				if ( ! empty( $need_image_update ) ) {
					$this->options['need_image_update'] = __( 'Custom image size was changed. You need to update project images.', 'portfolio' );
				}

				$this->options['link_additional_field_for_non_registered'] = isset( $_POST['prtfl_link_additional_field_for_non_registered'] ) ? 1 : 0;
				$this->options['svn_text_field']                           = isset( $_POST['prtfl_svn_text_field'] ) ? sanitize_text_field( wp_unslash( $_POST['prtfl_svn_text_field'] ) ) : '';
				$this->options['svn_additional_field_for_non_logged']      = isset( $_POST['prtfl_svn_additional_field_for_non_logged'] ) ? 1 : 0;
				$this->options['svn_additional_field']                     = isset( $_POST['prtfl_svn_additional_field'] ) ? 1 : 0;

				foreach ( $this->fields as $field_key => $field_title ) {
					$this->options[ $field_key . '_additional_field' ] = isset( $_POST[ 'prtfl_' . $field_key . '_additional_field' ] ) ? 1 : 0;
					$this->options[ $field_key . '_text_field' ]       = isset( $_POST[ 'prtfl_' . $field_key . '_text_field' ] ) ? sanitize_text_field( wp_unslash( $_POST[ 'prtfl_' . $field_key . '_text_field' ] ) ) : '';

				}

				$this->options['screenshot_text_field'] = isset( $_POST['prtfl_screenshot_text_field'] ) ? sanitize_text_field( wp_unslash( $_POST['prtfl_screenshot_text_field'] ) ) : '';

				if ( isset( $_POST['prtfl_slug'] ) && sanitize_text_field( wp_unslash( $_POST['prtfl_slug'] ) ) !== $this->options['slug'] ) {
					$this->options['flush_rewrite_rules'] = 1;
				}
				$this->options['slug'] = sanitize_text_field( wp_unslash( $_POST['prtfl_slug'] ) );

				if ( is_plugin_active( 'sender-pro/sender-pro.php' ) ) {
					$sndr_options = get_option( 'sndr_options' );
					/* mailout when publishing quote */
					if ( ! empty( $_POST['sndr_distribution_select'] ) && ! empty( $_POST['sndr_templates_select'] ) && ! empty( $_POST['sndr_priority'] ) ) {
						if ( isset( $_POST['prtfl_sndr_mailout'] ) ) {
							$key = array_search( 'bws-portfolio', $sndr_options['automailout_new_post'] );
							if ( false === $key ) {
								$sndr_options['automailout_new_post'][]                     = 'bws-portfolio';
								$sndr_options['group_for_post']['bws-portfolio']            = isset( $_POST['sndr_distribution_select']['bws-portfolio'] ) ? absint( $_POST['sndr_distribution_select']['bws-portfolio'] ) : 0;
								$sndr_options['letter_for_post']['bws-portfolio']           = isset( $_POST['sndr_templates_select']['bws-portfolio'] ) ? absint( $_POST['sndr_templates_select']['bws-portfolio'] ) : 0;
								$sndr_options['priority_for_post_letters']['bws-portfolio'] = isset( $_POST['sndr_priority']['bws-portfolio'] ) ? absint( $_POST['sndr_priority']['bws-portfolio'] ) : 0;
							}
						} else {
							$key = array_search( 'bws-portfolio', $sndr_options['automailout_new_post'] );
							if ( false !== $key ) {
								unset( $sndr_options['automailout_new_post'][ $key ] );
								unset( $sndr_options['priority_for_post_letters']['bws-portfolio'] );
								unset( $sndr_options['letter_for_post']['bws-portfolio'] );
								unset( $sndr_options['group_for_post']['bws-portfolio'] );
							}
						}
					}
					update_option( 'sndr_options', $sndr_options );
				}

				/**
				 * Rewriting post types name with unique one from default options
				 */
				if ( ! empty( $_POST['prtfl_rename_post_type'] ) ) {
					global $wpdb;
					$wpdb->update(
						$wpdb->prefix . 'posts',
						array( 'post_type' => $this->default_options['post_type_name'] ),
						array( 'post_type' => $this->options['post_type_name'] )
					);
					$this->options['post_type_name'] = $this->default_options['post_type_name'];
				}

				if ( ! empty( $this->cstmsrch_options ) ) {
					if ( isset( $this->cstmsrch_options['output_order'] ) ) {
						$is_enabled      = isset( $_POST['prtfl_add_to_search'] ) ? 1 : 0;
						$post_type_exist = false;
						foreach ( $this->cstmsrch_options['output_order'] as $key => $item ) {
							if ( $item['name'] === $this->options['post_type_name'] && 'post_type' === $item['type'] ) {
								$post_type_exist = true;
								if ( absint( $item['enabled'] ) !== absint( $is_enabled ) ) {
									$this->cstmsrch_options['output_order'][ $key ]['enabled'] = $is_enabled;
									$cstmsrch_options_update                                   = true;
								}
								break;
							}
						}
						if ( ! $post_type_exist ) {
							$this->cstmsrch_options['output_order'][] = array(
								'name'    => $this->options['post_type_name'],
								'type'    => 'post_type',
								'enabled' => $is_enabled,
							);
							$cstmsrch_options_update                  = true;
						}
					} elseif ( isset( $this->cstmsrch_options['post_types'] ) ) {
						if ( isset( $_POST['prtfl_add_to_search'] ) && ! in_array( $this->options['post_type_name'], $this->cstmsrch_options['post_types'] ) ) {
							array_push( $this->cstmsrch_options['post_types'], $this->options['post_type_name'] );
							$cstmsrch_options_update = true;
						} elseif ( ! isset( $_POST['prtfl_add_to_search'] ) && in_array( $this->options['post_type_name'], $this->cstmsrch_options['post_types'] ) ) {
							unset( $this->cstmsrch_options['post_types'][ array_search( $this->options['post_type_name'], $this->cstmsrch_options['post_types'] ) ] );
							$cstmsrch_options_update = true;
						}
					}
					if ( isset( $cstmsrch_options_update ) ) {
						update_option( 'cstmsrch_options', $this->cstmsrch_options );
					}
				}

				update_option( 'prtfl_options', $this->options );
				$message = __( 'Settings saved.', 'portfolio' );
			}

			return compact( 'message', 'notice', 'error' );
		}

		/**
		 * Display custom error\message\notice
		 *
		 * @access public
		 * @param array $save_results Array with error\message\notice.
		 */
		public function display_custom_messages( $save_results ) { ?>
			<noscript><div class="error below-h2"><p><strong><?php esc_html_e( 'Please enable JavaScript in Your browser.', 'portfolio' ); ?></strong></p></div></noscript>
			<?php if ( ! empty( $this->options['need_image_update'] ) ) { ?>
				<div class="updated bws-notice inline prtfl_image_update_message">
					<p>
						<?php echo esc_html( $this->options['need_image_update'] ); ?>
						<input type="button" value="<?php esc_html_e( 'Update Images', 'portfolio' ); ?>" id="prtfl_ajax_update_images" name="ajax_update_images" class="button" />
					</p>
				</div>
				<?php
			}
		}

		/**
		 * Display 'Settings'
		 */
		public function tab_settings() {
			if ( is_plugin_active( 'sender-pro/sender-pro.php' ) ) {
				$sndr_options = get_option( 'sndr_options' );
			}
			?>
			<h3 class="bws_tab_label"><?php esc_html_e( 'Portfolio Settings', 'portfolio' ); ?></h3>
			<?php $this->help_phrase(); ?>
			<hr>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Portfolio Page', 'portfolio' ); ?></th>
					<td>
						<?php
						wp_dropdown_pages(
							array(
								'depth'            => 0,
								'selected'         => esc_attr( $this->options['page_id_portfolio_template'] ),
								'name'             => 'prtfl_page_id_portfolio_template',
								'show_option_none' => '...',
							)
						);
						?>
						<div class="bws_info"><?php esc_html_e( 'Base page where all existing projects will be displayed.', 'portfolio' ); ?></div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Number of Columns', 'portfolio' ); ?> </th>
					<td>
						<input<?php echo esc_html( $this->change_permission_attr ); ?> type="number" name="prtfl_portfolio_custom_row_count" min="1" max="10000" value="<?php echo esc_attr( $this->options['custom_portfolio_row_count'] ); ?>" /> <?php esc_html_e( 'columns', 'portfolio' ); ?>
						<div class="bws_info"><?php printf( esc_html__( 'Number of portfolio columns (default is %s).', 'portfolio' ), '1' ); ?></div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Number of Image Columns', 'portfolio' ); ?> </th>
					<td>
						<input type="number" name="prtfl_custom_image_row_count" min="1" max="10000" value="<?php echo esc_attr( $this->options['custom_image_row_count'] ); ?>" /> <?php esc_html_e( 'columns', 'portfolio' ); ?>
						<div class="bws_info"><?php printf( esc_html__( 'Number of image columns (default is %s).', 'portfolio' ), '3' ); ?></div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Image Size', 'portfolio' ); ?></th>
					<td>
						<select name="prtfl_image_size_photo">
							<?php foreach ( $this->wp_image_sizes as $data ) { ?>
								<option value="<?php echo esc_attr( $data['value'] ); ?>" <?php selected( $data['value'], $this->options['image_size_photo'] ); ?>><?php echo esc_html( $data['name'] ); ?></option>
							<?php } ?>
							<option value="portfolio-photo-thumb" <?php selected( 'portfolio-photo-thumb', $this->options['image_size_photo'] ); ?> class="bws_option_affect" data-affect-show=".prtfl_for_custom_image_size"><?php esc_html_e( 'Custom', 'portfolio' ); ?></option>
						</select>
						<div class="bws_info"><?php esc_html_e( 'Maximum portfolio image size. "Custom" uses the Image Dimensions values.', 'portfolio' ); ?></div>
					</td>
				</tr>
				<tr valign="top" class="prtfl_for_custom_image_size">
					<th scope="row"><?php esc_html_e( 'Custom Image Size', 'portfolio' ); ?> </th>
					<td>
						<input type="number" name="prtfl_custom_image_size_w_photo" min="1" max="10000" value="<?php echo esc_attr( $this->options['custom_size_px']['portfolio-photo-thumb'][0] ); ?>" /> x <input type="number" name="prtfl_custom_image_size_h_photo" min="1" max="10000" value="<?php echo esc_attr( $this->options['custom_size_px']['portfolio-photo-thumb'][1] ); ?>" /> px <div class="bws_info"><?php esc_html_e( "Adjust these values based on the number of columns in your project. This won't affect the full size of your images in the lightbox.", 'portfolio' ); ?></div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Cover Image Size', 'portfolio' ); ?> </th>
					<td>
						<select name="prtfl_image_size_album">
							<?php foreach ( $this->wp_image_sizes as $data ) { ?>
								<option value="<?php echo esc_attr( $data['value'] ); ?>" <?php selected( $data['value'], $this->options['image_size_album'] ); ?>><?php echo esc_html( $data['name'] ); ?></option>
							<?php } ?>
							<option value="portfolio-thumb" <?php selected( 'portfolio-thumb', $this->options['image_size_album'] ); ?> class="bws_option_affect" data-affect-show=".prtfl_for_custom_image_size_album"><?php esc_html_e( 'Custom', 'portfolio' ); ?></option>
						</select>
						<div class="bws_info"><?php esc_html_e( 'Maximum cover image size. "Custom" uses the Image Dimensions values.', 'portfolio' ); ?></div>
					</td>
				</tr>
				<tr valign="top" class="prtfl_for_custom_image_size_album">
					<th scope="row"><?php esc_html_e( 'Custom Cover Image Size', 'portfolio' ); ?> </th>
					<td>
						<input type="number" name="prtfl_custom_image_size_w_album" min="1" max="10000" value="<?php echo esc_attr( $this->options['custom_size_px']['portfolio-thumb'][0] ); ?>" /> x <input type="number" name="prtfl_custom_image_size_h_album" min="1" max="10000" value="<?php echo esc_attr( $this->options['custom_size_px']['portfolio-thumb'][1] ); ?>" /> px
					</td>
				</tr>
			</table>
			<?php if ( ! $this->hide_pro_tabs ) { ?>
				<div class="bws_pro_version_bloc">
					<div class="bws_pro_version_table_bloc">
						<button type="submit" name="bws_hide_premium_options" class="notice-dismiss bws_hide_premium_options" title="<?php esc_html_e( 'Close', 'portfolio' ); ?>"></button>
						<div class="bws_table_bg"></div>
						<table class="form-table bws_pro_version">
							<tr valign="top">
								<th scope="row"><?php esc_html_e( 'Slider Image Size', 'portfolio' ); ?> </th>
								<td>
									<select disabled="disabled" name="prtfl_image_size_slider">
										<option value="large">Large (1024 × 1024)</option>
									</select>
									<div class="bws_info"><?php esc_html_e( 'Maximum slider image size. "Custom" uses the Image Dimensions values.', 'portfolio' ); ?></div>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php esc_html_e( 'Sort Projects Option', 'portfolio' ); ?></th>
								<td>
									<label>
										<input type="checkbox" name="prtfl_sorting_selectbox" value="1" disabled="disabled" /> <span class="bws_info"><?php esc_html_e( 'Enable to display sort projects manually by date or title.', 'portfolio' ); ?></span>
									</label>
								</td>
							</tr>
						</table>
					</div>
					<?php $this->bws_pro_block_links(); ?>
				</div>
			<?php } ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Sort Projects by', 'portfolio' ); ?></th>
					<td>
						<select name="prtfl_order_by">
							<option value="ID" <?php selected( 'ID', $this->options['order_by'] ); ?>><?php esc_html_e( 'Project ID', 'portfolio' ); ?></option>
							<option value="title" <?php selected( 'title', $this->options['order_by'] ); ?>><?php esc_html_e( 'Title', 'portfolio' ); ?></option>
							<option value="date" <?php selected( 'date', $this->options['order_by'] ); ?>><?php esc_html_e( 'Date', 'portfolio' ); ?></option>
							<option value="modified" <?php selected( 'modified', $this->options['order_by'] ); ?>><?php esc_html_e( 'Last modified date', 'portfolio' ); ?></option>
							<option value="comment_count" <?php selected( 'comment_count', $this->options['order_by'] ); ?>><?php esc_html_e( 'Comment count', 'portfolio' ); ?></option>	
							<option value="menu_order" <?php selected( 'menu_order', $this->options['order_by'] ); ?>><?php esc_html_e( 'Sorting order (the input field for sorting order)', 'portfolio' ); ?></option>
							<option value="author" <?php selected( 'author', $this->options['order_by'] ); ?>><?php esc_html_e( 'Author', 'portfolio' ); ?></option>	
							<option value="rand" <?php selected( 'rand', $this->options['order_by'] ); ?>><?php esc_html_e( 'Random', 'portfolio' ); ?></option>							
						</select>
						<div class="bws_info"><?php esc_html_e( 'Select projects sorting order in your portfolio page.', 'portfolio' ); ?></div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Arrange Projects by', 'portfolio' ); ?></th>
					<td>
						<fieldset>
							<label><input type="radio" name="prtfl_order" value="ASC" <?php checked( 'ASC', $this->options['order'] ); ?> /> <?php esc_html_e( 'Ascending (e.g. 1, 2, 3; a, b, c)', 'portfolio' ); ?></label>
							<br />
							<label><input type="radio" name="prtfl_order" value="DESC" <?php checked( 'DESC', $this->options['order'] ); ?> /> <?php esc_html_e( 'Descending (e.g. 3, 2, 1; c, b, a)', 'portfolio' ); ?></label>
						</fieldset>
					</td>
				</tr>
			</table>
			<?php if ( ! $this->hide_pro_tabs ) { ?>
				<div class="bws_pro_version_bloc">
					<div class="bws_pro_version_table_bloc">
						<button type="submit" name="bws_hide_premium_options" class="notice-dismiss bws_hide_premium_options" title="<?php esc_html_e( 'Close', 'portfolio' ); ?>"></button>
						<div class="bws_table_bg"></div>
						<table class="form-table bws_pro_version">
							<tr valign="top">
								<th scope="row"><?php esc_html_e( 'Lightbox Helper', 'portfolio' ); ?></th>
								<td>
									<input disabled type="checkbox" name="" /> <span class="bws_info"><?php esc_html_e( 'Enable to use a lightbox helper navigation between images.', 'portfolio' ); ?></span>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row"><?php esc_html_e( 'Lightbox Helper Type', 'portfolio' ); ?></th>
								<td>
									<select disabled name="">
										<option><?php esc_html_e( 'Thumbnails', 'portfolio' ); ?></option>
										<option><?php esc_html_e( 'Buttons', 'portfolio' ); ?></option>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<?php $this->bws_pro_block_links(); ?>
				</div>
			<?php } ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Text Link', 'portfolio' ); ?></th>
					<td>
						<label>
							<input type="checkbox" name="prtfl_link_additional_field_for_non_registered" value="1" id="prtfl_link_additional_field_for_non_registered" <?php checked( 1, $this->options['link_additional_field_for_non_registered'] ); ?> /> <span class="bws_info"><?php esc_html_e( 'Enable to display link field as a text for non-registered users.', 'portfolio' ); ?></span>
						</label>
					</td>
				</tr>
				<tr>
					<th scope="row"><?php esc_html_e( 'Automatic Mailout when Publishing a New:', 'portfolio' ); ?></th>
					<td>
						<?php
						if ( array_key_exists( 'sender-pro/sender-pro.php', $this->all_plugins ) ) {
							if ( is_plugin_active( 'sender-pro/sender-pro.php' ) ) {
								?>
								<fieldset>
									<label>
										<input type="checkbox" name="prtfl_sndr_mailout" value="1" class="bws_option_affect" data-affect-show="[data-post-type=bws-portfolio]" <?php checked( in_array( 'bws-portfolio', $sndr_options['automailout_new_post'] ) ); ?> />&nbsp<?php esc_html_e( 'Projects', 'portfolio' ); ?>
									</label><br />
									<div data-post-type="bws-portfolio">
										<p><?php sndr_distribution_list_select( $sndr_options['group_for_post'], 'bws-portfolio' ); ?></p>
										<p><?php sndr_letters_list_select( $sndr_options['letter_for_post'], 'bws-portfolio' ); ?></p>
										<p>
											<?php
											sndr_priorities_list( $sndr_options['priority_for_post_letters'], '', 'bws-portfolio' );
											esc_html_e( 'Select mailout priority', 'portfolio' );
											?>
											<br /><span class="bws_info"><?php esc_html_e( 'Less number - higher priority', 'portfolio' ); ?></span>
										</p><br/>
									</div>
								</fieldset>
							<?php } else { ?>
								<input disabled="disabled" type="checkbox" name="prtfl_sndr_mailout" />&nbsp
								<span class="bws_info"><?php esc_html_e( 'Enable to automatic mailout when publishing a new bws-portfolios and tips. Sender Pro plugin is required.', 'portfolio' ); ?> <a href="https://bestwebsoft.com/products/wordpress/plugins/sender/"><?php esc_html_e( 'Activate Now', 'portfolio' ); ?></a></span><br />
								<?php
							}
						} else {
							?>
							<input disabled="disabled" type="checkbox" name="prtfl_sndr_mailout" />&nbsp
							<span class="bws_info"><?php esc_html_e( 'Enable to automatic mailout when publishing a new bws-portfolios and tips. Sender Pro plugin is required.', 'portfolio' ); ?> <a href="https://bestwebsoft.com/products/wordpress/plugins/sender/"><?php esc_html_e( 'Install Now', 'portfolio' ); ?></a></span><br />
						<?php } ?>

					</td>
				</tr>
			</table>
			<?php wp_nonce_field( 'prtfl_settings', 'prtfl_settings_nonce' ); ?>
			<?php
		}

		/**
		 * Display tab Project
		 */
		public function tab_project() {
			?>
			<h3 class="bws_tab_label"><?php esc_html_e( 'Single Project Settings', 'portfolio' ); ?></h3>
			<?php $this->help_phrase(); ?>
			<hr>
			<table class="form-table">
				<tr valign="top">
					<th scope="row" class="prtfl_table_project"><?php esc_html_e( 'Projects Fields', 'portfolio' ); ?> </th>
					<td>
						<fieldset>
							<?php foreach ( $this->fields as $field_key => $field_title ) { ?>
								<label class="prtfl_label_project">
									<input<?php echo esc_html( $this->change_permission_attr ); ?> type="checkbox" name="prtfl_<?php echo esc_attr( $field_key ); ?>_additional_field" value="1" <?php checked( 1, $this->options[ $field_key . '_additional_field' ] ); ?> /> <?php echo esc_html( $field_title ); ?>
									<br>
									<input<?php echo esc_html( $this->change_permission_attr ); ?> class="prtfl_input_project" type="text" name="prtfl_<?php echo esc_attr( $field_key ); ?>_text_field" maxlength="250" value="<?php echo esc_html( $this->options[ $field_key . '_text_field' ] ); ?>" />
								</label>
								<br />
							<?php } ?>
							<label class="prtfl_label_project">
								<input<?php echo esc_html( $this->change_permission_attr ); ?> type="checkbox" name="prtfl_svn_additional_field" value="1" <?php checked( 1, $this->options['svn_additional_field'] ); ?> /> <?php esc_html_e( 'Source Files, URL', 'portfolio' ); ?>
							</label>
							<label class="prtfl_label_project" id="prtfl_non_logged">
								<input<?php echo esc_html( $this->change_permission_attr ); ?> type="checkbox" name="prtfl_svn_additional_field_for_non_logged" value="1" <?php checked( 1, $this->options['svn_additional_field_for_non_logged'] ); ?> /> <?php esc_html_e( 'Display only for logged-in users', 'portfolio' ); ?>
							</label> 
							<label class="prtfl_label_project">
								<input<?php echo esc_html( $this->change_permission_attr ); ?> class="prtfl_input_project" type="text" name="prtfl_svn_text_field" maxlength="250" value= "<?php echo esc_html( $this->options['svn_text_field'] ); ?>" />
							</label>
							<label class="prtfl_label_project">
								<?php esc_html_e( '"More screenshots" block', 'portfolio' ); ?>
								<br>
								<input class="prtfl_input_project" type="text" name="prtfl_screenshot_text_field" maxlength="250" value="<?php echo esc_html( $this->options['screenshot_text_field'] ); ?>" />
							</label>
						</fieldset>
					</td>
				</tr>
			</table>
			<?php if ( ! $this->hide_pro_tabs ) { ?>
				<div class="bws_pro_version_bloc">
					<div class="bws_pro_version_table_bloc">
						<button type="submit" name="bws_hide_premium_options" class="notice-dismiss bws_hide_premium_options" title="<?php esc_html_e( 'Close', 'portfolio' ); ?>"></button>
						<div class="bws_table_bg"></div>
						<table class="form-table bws_pro_version">
							<tr>
								<th scope="row" class="prtfl_table_project"><?php esc_html_e( 'Projects Fields', 'portfolio' ); ?></th>
								<td>
									<fieldset>
										<label class="prtfl_label_project">
											<input type="checkbox" name="prtfl_categories_additional_field" value="1" disabled="disabled" /> <?php esc_html_e( 'Categories', 'portfolio' ); ?><br />
											<input class="prtfl_input_project" type="text" name="prtfl_categories_text_field" value="<?php esc_html_e( 'Categories', 'portfolio' ); ?>:" disabled="disabled" />
										</label><br />
										<label class="prtfl_label_project">
											<input type="checkbox" name="prtfl_sectors_additional_field" value="1" disabled="disabled" /> <?php esc_html_e( 'Sectors', 'portfolio' ); ?><br />
											<input class="prtfl_input_project" type="text" name="prtfl_sectors_text_field" value="<?php esc_html_e( 'Sectors', 'portfolio' ); ?>:" disabled="disabled" />
										</label><br />
										<label class="prtfl_label_project">
											<input type="checkbox" name="prtfl_services_additional_field" value="1" disabled="disabled" /> <?php esc_html_e( 'Services', 'portfolio' ); ?><br />
											<input class="prtfl_input_project" type="text" name="prtfl_services_text_field" value="<?php esc_html_e( 'Services', 'portfolio' ); ?>:" disabled="disabled" />
										</label><br />
										<label class="prtfl_label_project">
											<input type="checkbox" name="prtfl_client_additional_field" value="1" disabled="disabled" /> <?php esc_html_e( 'Client', 'portfolio' ); ?><br />
											<input class="prtfl_input_project" type="text" name="prtfl_client_text_field" value="<?php esc_html_e( 'Client', 'portfolio' ); ?>:" disabled="disabled" />
										</label><br />
										<label><input type="checkbox" name="prtfl_disbable_screenshot_block" value="1" disabled="disabled" /> <?php esc_html_e( '"More screenshots" block', 'portfolio' ); ?></label><br />
									</fieldset>
								</td>
							</tr>
						</table>
					</div>
					<?php $this->bws_pro_block_links(); ?>
				</div>
				<?php
			}
		}

		/**
		 * Add Demo data
		 */
		public function additional_import_export_options() {
			?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Demo Data', 'portfolio' ); ?></th>
					<td>
						<?php $this->demo_data->bws_show_demo_button( __( 'Install demo data to create portfolio projects with images, post with shortcodes and page with a list of all portfolio projects.', 'portfolio' ) ); ?>
					</td>
				</tr>
			</table>
			<?php
		}

		/**
		 * Display custom options on the 'misc' tab
		 *
		 * @access public
		 */
		public function additional_misc_options_affected() {
			global $wp_version;
			if ( ! $this->all_plugins ) {
				if ( ! function_exists( 'get_plugins' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}
				$this->all_plugins = get_plugins();
			}
			if ( $this->options['post_type_name'] !== $this->default_options['post_type_name'] ) {
				?>
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Portfolio Post Type', 'portfolio' ); ?></th>
					<td>
						<input type="checkbox" name="prtfl_rename_post_type" value="1" />
						<span class="bws_info">
							<?php esc_html_e( 'Enable to avoid conflicts with other portfolio plugins installed. All portfolio created earlier will stay unchanged. However, after enabling we recommend to check settings of other plugins where "portfolio" post type is used.', 'portfolio' ); ?>
						</span>
					</td>
				</tr>
			<?php } ?>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Portfolio Slug', 'portfolio' ); ?></th>
				<td>
					<input type="text" name="prtfl_slug" maxlength="100" value="<?php echo esc_attr( $this->options['slug'] ); ?>" />
					<div class="bws_info"><?php esc_html_e( 'Enter the unique portfolio slug.', 'portfolio' ); ?></div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><?php esc_html_e( 'Search Portfolio Projects', 'portfolio' ); ?></th>
				<td>
					<?php
					$disabled = '';
					$checked  = '';
					$link     = '';
					if ( array_key_exists( 'custom-search-plugin/custom-search-plugin.php', $this->all_plugins ) || array_key_exists( 'custom-search-pro/custom-search-pro.php', $this->all_plugins ) ) {
						if ( ! is_plugin_active( 'custom-search-plugin/custom-search-plugin.php' ) && ! is_plugin_active( 'custom-search-pro/custom-search-pro.php' ) ) {
							$disabled = ' disabled="disabled"';
							$link     = '<a href="' . admin_url( 'plugins.php' ) . '">' . __( 'Activate Now', 'portfolio' ) . '</a>';
						}
						if ( isset( $this->cstmsrch_options['output_order'] ) ) {
							foreach ( $this->cstmsrch_options['output_order'] as $key => $item ) {
								if ( $item['name'] === $this->options['post_type_name'] && 'post_type' === $item['type'] ) {
									if ( $item['enabled'] ) {
										$checked = ' checked="checked"';
									}
									break;
								}
							}
						} elseif ( ! empty( $this->cstmsrch_options['post_types'] ) && in_array( $this->options['post_type_name'], $this->cstmsrch_options['post_types'] ) ) {
							$checked = ' checked="checked"';
						}
					} else {
						$disabled = ' disabled="disabled"';
						$link     = '<a href="https://bestwebsoft.com/products/wordpress/plugins/custom-search/?k=75e20470c8716645cf65febf9d30f269&amp;pn=' . $this->link_pn . '&amp;v=' . $this->plugins_info['Version'] . '&amp;wp_v=' . $wp_version . '" target="_blank">' . __( 'Install Now', 'portfolio' ) . '</a>';
					}
					?>
					<input type="checkbox" name="prtfl_add_to_search" value="1"<?php echo esc_html( $disabled . $checked ); ?> />
					<span class="bws_info"><?php esc_html_e( 'Enable to include portfolio projects to your website search.', 'portfolio' ); ?> <?php printf( esc_html__( '%s plugin is required.', 'portfolio' ), 'Custom Search' ); ?> <?php echo esc_url( $link ); ?></span>					
				</td>
			</tr>
			<?php
		}

		/**
		 * Display custom metabox
		 *
		 * @access public
		 */
		public function display_metabox() {
			?>
			<div class="postbox">
				<h3 class="hndle">
					<?php esc_html_e( 'Portfolio Shortcode', 'portfolio' ); ?>
				</h3>
				<div class="inside">
					<?php esc_html_e( 'Add the latest portfolio projects using the following shortcode (where * is a number of projects to display):', 'portfolio' ); ?>
					<?php bws_shortcode_output( '[latest_portfolio_items count=*]' ); ?>
				</div>
			</div>
			<?php
		}
	}
}
