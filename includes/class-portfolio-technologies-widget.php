<?php
/**
 * Widget for portfolio Technologies
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Class for portfolio technologies widget
 */
class Portfolio_Technologies_Widget extends WP_Widget {
	/**
	 * Constructor of class
	 */
	public function __construct() {
		parent::__construct(
			'portfolio_technologies_widget',
			__( 'Technologies', 'portfolio' ),
			array( 'description' => __( 'The tag cloud with your most used portfolio technologies.', 'portfolio' ) )
		);
	}

	/**
	 * Function to displaying widget in front end
	 *
	 * @param array $args     Widget args.
	 * @param array $instance Widget data.
	 */
	public function widget( $args, $instance ) {
		$widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : null;
		$widget_title = apply_filters( 'widget_title', $widget_title, $instance, $this->id_base );
		echo wp_kses_post( $args['before_widget'] );
		if ( $widget_title ) {
			echo wp_kses_post( $args['before_title'] . $widget_title . $args['after_title'] );
		}
		echo '<div class="tagcloud">';
		wp_tag_cloud(
			apply_filters(
				'widget_tag_cloud_args',
				array(
					'taxonomy' => 'portfolio_technologies',
					'number'   => 0,
				)
			)
		);
		echo "</div>\n";
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Function to save widget settings
	 *
	 * @param array $new_instance New widget data.
	 * @param array $old_instance Old widget data.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance['widget_title'] = ( ! empty( $new_instance['widget_title'] ) ) ? wp_strip_all_tags( $new_instance['widget_title'] ) : null;
		return $instance;
	}

	/**
	 * Function to displaying widget settings in back end
	 *
	 * @param array $instance Widget data.
	 */
	public function form( $instance ) {
		$widget_title = isset( $instance['widget_title'] ) ? stripslashes( esc_html( $instance['widget_title'] ) ) : null;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>"><?php esc_html_e( 'Title', 'portfolio' ); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $widget_title ); ?>"/>
		</p>
		<?php
	}
}
