<?php
/**
 * Display Portfolio Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Class for Portfoilo widget
 */
class Prtfl_Widget extends WP_Widget {
	/**
	 * Constructor of class
	 */
	public function __construct() {
		parent::__construct(
			'prtfl_widget',
			__( 'Latest Portfolio Items', 'portfolio' ),
			array( 'description' => __( 'Displays the latest Portfolio projects.', 'portfolio' ) )
		);
	}

	/**
	 * Function to displaying widget in front end
	 *
	 * @param array $args     Array with sidebar settings.
	 * @param array $instance Array with widget settings.
	 */
	public function widget( $args, $instance ) {

		$widget_title        = ( ! empty( $instance['widget_title'] ) ) ? apply_filters( 'widget_title', $instance['widget_title'], $instance, $this->id_base ) : '';
		$widget_count_posts  = ( ! empty( $instance['widget_count_posts'] ) ) ? $instance['widget_count_posts'] : '';
		$widget_count_colums = ( ! empty( $instance['widget_count_colums'] ) ) ? $instance['widget_count_colums'] : '';

		$atts['count'] = $widget_count_posts;
		$content       = prtfl_latest_items( $atts, $widget_count_colums );
		echo wp_kses_post( $args['before_widget'] . $args['before_title'] . $widget_title . $args['after_title'] . $content );
	}

	/**
	 * Function to displaying form
	 *
	 * @param array $instance Array with widget settings.
	 */
	public function form( $instance ) {
		global $sbscrbr_options;

		$widget_title        = isset( $instance['widget_title'] ) ? stripslashes( sanitize_text_field( $instance['widget_title'] ) ) : '';
		$widget_count_posts  = isset( $instance['widget_count_posts'] ) ? stripslashes( sanitize_text_field( $instance['widget_count_posts'] ) ) : 5;
		$widget_count_colums = isset( $instance['widget_count_colums'] ) ? stripslashes( sanitize_text_field( $instance['widget_count_colums'] ) ) : 3;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>">
				<?php esc_html_e( 'Title', 'portfolio' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" value="<?php echo esc_html( $widget_title ); ?>"/>
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_count_posts' ) ); ?>">
				<?php esc_html_e( 'Number of Projects:', 'portfolio' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_count_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_count_posts' ) ); ?>" type="number" min="1" max="100" value="<?php echo esc_attr( $widget_count_posts ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_count_colums' ) ); ?>">
				<?php esc_html_e( 'Number of Colums:', 'portfolio' ); ?>:
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_count_colums' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_count_colums' ) ); ?>" type="number" min="1" max="100" value="<?php echo esc_attr( $widget_count_colums ); ?>" />
			</label>
		</p>
		<?php
	}

	/**
	 * Function to update widget data
	 *
	 * @param array $new_instance New data with widget settings.
	 * @param array $old_instance New data with widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                        = array();
		$instance['widget_title']        = ( ! empty( $new_instance['widget_title'] ) ) ? wp_strip_all_tags( $new_instance['widget_title'] ) : null;
		$instance['widget_count_posts']  = ( ! empty( $new_instance['widget_count_posts'] ) ) ? wp_strip_all_tags( $new_instance['widget_count_posts'] ) : null;
		$instance['widget_count_colums'] = ( ! empty( $new_instance['widget_count_colums'] ) ) ? wp_strip_all_tags( $new_instance['widget_count_colums'] ) : null;
		return $instance;
	}
}
