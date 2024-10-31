<?php 
/**
 * Contents array with demo-data for 
 * Portfolio Plugin by Bestwebsoft
 */

if ( ! function_exists( 'bws_demo_data_array' ) ) {
	function bws_demo_data_array() {
		$posts = array(
			/* Page Template Portfolio */
			array( 
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'post_title'     => 'DEMO Portfolios',
				'post_content'   => '',
				'save_to_options' => 'page_id_portfolio_template'
			),
			/* Portfolio */
			array( 
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Infographic Elements Template - Vector Pack',
				'post_content'		=> 'Infographic Elements Template is a vector pack which contains various types of elements such as graphs, icons, diagrams, etc. Buy it to create your own infographics, presentations, reports or advertisement.',
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> 'Create amazing infographics & presentations!',
						'_prtfl_date_compl' 	=> '06.11.2015',
						'_prtfl_link'			=> 'http://graphicriver.net/item/infographic-elements-template-vector-pack/11735971?ref=bestwebsoft',
						'_prtfl_svn'			=> ''
					)
				),
				/*	'attachments_folder' => '', */
				'distant_attachments' => array(
					'01-banner.jpg',
					'02-infographics-pack-colorscheme.jpg',
					'03-infographics-pack-colorscheme-2.jpg'
				)
			),			
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Medical Care - Responsive Medical HTML5 Template',
				'post_content'		=> 'Medical Care is a responsive Bootstrap-based HTML5 template. It is built with business and personal users in mind. We packed this template with common reusable widgets and elements.
										Health is a key factor of normal life of any person. We cannot perform wholesome physical and mental activity without good health. Each separate medical institution is a treatment oasis of many diseases. Our team decided to create a modern clinic UI, where people could easily find the right specialist to get an online consultation or to make an appointment using website built-in tools.
										Simplicity of the interface is a key to a comfortable end-user interaction with your system. We tried to implement the main controls of any website in terms of medical subjects and basic needs of patients.
										File structure is fully organized to make the editing process more easy for end-users. Template is designed based on 960 grid system. It is also ready for retina screens.',
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> 'Responsive Bootstrap-based HTML5 template.',
						'_prtfl_date_compl' 	=> '02.05.2015',
						'_prtfl_link'			=> 'http://themeforest.net/item/medical-care-responsive-medical-html5-template/10042392?ref=bestwebsoft',
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array(
					'00-banner-html.jpg',
					'01-home-book.jpg',
					'02-home-search-specialist.jpg',
					'03-home-ask-a-question.jpg'
				)
			),
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Book Your Tour - Excursion Community PSD Template', 
				'post_content'		=> 'Book Your Tour is a premium PSD template designed for commercial purposes. 
										Build a stunning excursion booking online website using the pre-build layout and elements. Customize existing graphic to create your own unique interface.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> '#1 Excursion Community PSD Website Template', 
						'_prtfl_date_compl' 	=> '03.11.2015', 
						'_prtfl_link'			=> 'http://themeforest.net/item/book-your-tour-excursion-community-psd-template/12956478?ref=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-book-banner.jpg',
					'01-book-home-1200.jpg',
					'02-all-tours-and-excursions-line-view-1200.jpg',
					'04-single-tour-page-1200-v1.jpg'
				)
			),			
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Coursea - Online Tutorials & Courses Template', 
				'post_content'		=> 'Coursea is an online tutorials & courses PSD template designed for commercial purposes. 
										Create an amazing learning website using the pre-build layout and elements. Customize existing graphics to create your own unique interface.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> '#1 Online Tutorials & Courses PSD Template', 
						'_prtfl_date_compl' 	=> '15.07.2015', 
						'_prtfl_link'			=> 'http://themeforest.net/item/coursea-online-tutorials-courses-template/11867087?ref=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-courses-banner.jpg',
					'01-home-1200-v1.jpg',
					'05-all-courses-1200-v1.jpg',
					'06-all-courses-1200-v2.jpg'
				)
			),			
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Concerto - Music Events & Tickets', 
				'post_content'		=> 'Concerto is a premium PSD template designed for commercial purposes. 
										Create an amazing tickets booking website for various concerts, events and artists using the pre-build layout and elements. Customize the existing graphics to create your own unique interface.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> 'Music Events & Online Tickets Search Website Template', 
						'_prtfl_date_compl' 	=> '26.06.2015', 
						'_prtfl_link'			=> 'https://creativemarket.com/bestwebsoft/305092-Concerto-Music-Events-Tickets?u=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-concerto-banner.jpg',
					'01-concerto-home-1200.jpg',
					'06-event-information-1200.jpg',
					'07-results-1200.jpg'
				)
			),
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Love Ceremony - Wedding PSD Template', 
				'post_content'		=> 'Love Ceremony is an elegant PSD template designed to share wedding details with your guests. 
										Create personal website for any kind of wedding activities. Make it simple for guests to RSVP and to find the perfect gift on your registry.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> 'Create Your Wedding Website!', 
						'_prtfl_date_compl' 	=> '12.08.2015', 
						'_prtfl_link'			=> 'http://themeforest.net/item/love-ceremony-wedding-psd-template/12013355?ref=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-ceremony-banner.jpg',
					'01-ceremony-home-1200.jpg',
					'02-our-story-1200.jpg',
					'03-guestbook-1200.jpg'
				)
			),
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Style of Food - Restaurant & Cafe PSD Template', 
				'post_content'		=> 'Style of Food is an online restaurant & cafe PSD template designed for commercial purposes. 
										Create an amazing website using the pre-build layout and elements. Customize existing graphics to create your own unique interface.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> '#1 Restaurant & Cafe PSD Template', 
						'_prtfl_date_compl' 	=> '10.09.2015', 
						'_prtfl_link'			=> 'http://themeforest.net/item/style-of-food-restaurant-cafe-psd-template/12272944?ref=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-food-banner.jpg',
					'01-food-home-1200.jpg',
					'03-menu-1200.jpg',
					'04-reservation-1200.jpg'
				)
			),
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Order a Taxi - Website Design UI', 
				'post_content'		=> 'Order Taxi is a premium PSD template designed for commercial purposes. 
										Build a stunning taxi booking online website using the pre-build layout and elements. Customize existing graphic to create your own unique interface.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> 'Build Your Online Taxi Business Website', 
						'_prtfl_date_compl' 	=> '10.12.2015', 
						'_prtfl_link'			=> 'https://creativemarket.com/bestwebsoft/467422-Order-a-Taxi-Website-Design-UI?u=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-taxi-banner.jpg',
					'01-taxi-home-1200.jpg',
					'02-booking-1200.jpg',
					'05-booking-details-1200.jpg'
				)
			),
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Hotel Finder - Online Booking PSD Template', 
				'post_content'		=> 'Hotel Finder is a premium PSD template designed for commercial purposes. 
										Create an amazing hotel booking website using the pre-build layout and elements. Customize the existing graphics to create your own unique interface.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> '#1 Hotel Booking Template', 
						'_prtfl_date_compl' 	=> '08.05.2015', 
						'_prtfl_link'			=> 'http://themeforest.net/item/hotel-finder-online-booking-psd-template/11374923?ref=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-hotel-banner.jpg',
					'01-hotel-home-1200.jpg',
					'02-search-result-1200-grid-view-v1.jpg',
					'06-hotel-page-1200-gallery-and-description-view-v1.jpg',
					'07-hotel-page-1200-map-and-availability-view-v1.jpg',
					'12-room-page-1200.jpg',
					'13-search-rooms-1200.jpg',
					'14-payment-1200.jpg',
					'16-blog-index-1200.jpg',
					'28-about-us-1200.jpg'
				)
			),
			array( 
				'comment_status' 	=> 'closed',
				'ping_status'   	=> 'closed',
				'post_status'    	=> 'publish',
				'post_type'      	=> 'bws-portfolio',
				'post_title'     	=> 'DEMO Rent a Bike - Rental & Booking PSD Template', 
				'post_content'		=> 'Rent a Bike is an online directory & booking PSD template designed for commercial purposes. 
										Create an amazing bicycle store or a brand website using the pre-build layout and elements. Customize the existing graphics to create your own unique interface.', 
				'post_meta'      	=> array(
					'prtfl_information' => array(
						'_prtfl_short_descr' 	=> 'Bike Directory & Booking PSD Template', 
						'_prtfl_date_compl' 	=> '20.10.2015', 
						'_prtfl_link'			=> 'http://themeforest.net/item/rent-a-bike-rental-booking-psd-template/12911269?ref=bestwebsoft', 
						'_prtfl_svn'			=> ''
					)
				),
				'distant_attachments' => array( 
					'00-bike-banner.jpg',
					'01-bike-home-v1-1200.jpg',
					'05-activity-select-1200.jpg',
					'10-bike-extras-1200.jpg',
					'13-tour-select-1200.jpg',
					'17-cart-1200.jpg',
					'20-about-us-1200.jpg',
					'26-gallery-3-col-1200.jpg',
					'40-header-menu-called-1200.jpg',
					'48-header-cart-called-1200.jpg'
				)
			),
			/* Post with Portfolio shortcodes */
			array( 
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_status'	 => 'publish',
				'post_type'      => 'post',
				'post_title'     => 'Portfolio DEMO',
				'post_content'   => '<p>This is a demonstration of a Portfolio plugin for Wordpress websites.</p><h2>Create excellent portfolios in the easiest way!</h2><p>This plugin helps you to display your works in an elegant style. It also allows you to add images and all the necessary information such as description, URL, date of completion, etc. Another great thing - you can use it without any programming knowledge.</p><h2>Get premium features</h2><p>Go Pro and use extra features: Categories, Sorting, Lightbox helper (Button or Thumbnail), Slider with featured portfolios, Single portfolio pagination, Network settings, and many more! <a href="https://bestwebsoft.com/products/wordpress/plugins/portfolio/" target="_blank">Learn More</a></p><h2><span id="result_box" class="short_text" lang="en"><span class="hps">Help &amp; Support</span></span></h2><p>If you have any questions, our friendly Support Team is happy to help. <a href="https://support.bestwebsoft.com/" target="_blank">Visit our Help Center</a></a><h2>Shortcodes</h2><p>Use <code><strong>&#91;latest_portfolio_items count=*]</strong></code> ( where * is a number of portfolio to display ) shortcode for displaying the Latest Portfolio Items.</p> <div>{template_page} | <a href="https://drive.google.com/drive/u/0/folders/0B5l8lO-CaKt9LUtoRXh6X3czUDQ" target="_blank">Instructions</a> | <a href="https://bestwebsoft.com/products/wordpress/plugins/portfolio/" target="_blank">Buy Now</a></div>',
			)
		);

		$terms = array(
			'portfolio_technologies' => array(
				'adobe-photoshop' 	=> 'Adobe Photoshop',
				'adobe-illustrator' => 'Adobe Illustrator'
			),
			'portfolio_executor_profile' => array(
				'bestwebsoft' 	=> 'BestWebSoft'
			)
		);
		/* info */
		$distant_attachments_metadata = array(
			'01-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9d0lMYkp0MGNCV1k',
			),
			'02-infographics-pack-colorscheme.jpg' => array(
				'mime_type' 		=> 'image/jpg', 
				'title'     		=> '02-infographics-pack-colorscheme.jpg',
				'url'     			=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9NFVQaEl4TUV0YWc',
			),
			'03-infographics-pack-colorscheme-2.jpg' => array(
				'mime_type' 		=> 'image/jpg', 
				'title'     		=> '03-infographics-pack-colorscheme-2.jpg',
				'url'     			=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9TEdERU1iSG1ERVU',
			),
			/*  med care */
			'00-banner-html.jpg' => array(
				'mime_type' 		=> 'image/jpg', 
				'title'     		=> '00-banner-html.jpg',
				'url'     			=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9R0ZpbW1Hbk5qVjQ',
			),
			'01-home-book.jpg' => array(
				'mime_type' 		=> 'image/jpg', 
				'title'     		=> '01-home-book.jpg',
				'url'     			=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9VWEzTExLNXlfS2s',
			),
			'02-home-search-specialist.jpg' => array(
				'mime_type' 		=> 'image/jpg', 
				'title'     		=> '02-home-search-specialist.jpg',
				'url'     			=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9NTdmSjZ2NldZc00',
			),
			'03-home-ask-a-question.jpg' => array(
				'mime_type' 		=> 'image/jpg', 
				'title'     		=> '03-home-ask-a-question.jpg',
				'url'     			=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9NFNzRGJyTmVVMXM',
			),
			/* book your tour */
			'00-book-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-book-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9bDVPc0ZicURyaW8',
			),
			'01-book-home-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-book-home-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9SW40QUkwUHgxdXM',
			),
			'02-all-tours-and-excursions-line-view-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '02-all-tours-and-excursions-line-view-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9aFhScFNkSGlsZFU',
			),
			'04-single-tour-page-1200-v1.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '04-single-tour-page-1200-v1.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9VDVNUURpeENjTm8',
			),
			/* coursea */
			'00-courses-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-courses-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9NEo2VXMwTkFsdUU',
			),
			'01-home-1200-v1.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-home-1200-v1.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9RDZsYV9Fck5hV28',
			),
			'05-all-courses-1200-v1.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '05-all-courses-1200-v1.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9aWVMWVU3ZE9ReTQ',
			),
			'06-all-courses-1200-v2.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '06-all-courses-1200-v2.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9NW1TckpYWXU0ZWM',
			),
			/* concerto */
			'00-concerto-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-concerto-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9ejhIbEt6aWlKUU0',
			),
			'01-concerto-home-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-concerto-home-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9LWxsTW9udXJyLWc',
			),
			'06-event-information-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '06-event-information-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9cXpuRnJWMXRlWm8',
			),
			/* love */
			'00-ceremony-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-ceremony-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9elNTamYwSmdza2M',
			),
			'01-ceremony-home-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-ceremony-home-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9SDY5MnE2VVNJR0U',
			),
			'02-our-story-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '02-our-story-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9WHhWNzlmVXlieHc',
			),
			'03-guestbook-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '03-guestbook-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9bzUzNktjNDAyVTA',
			),
			/* food */
			'00-food-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-food-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9VUJiY04xWC1HeXc',
			),
			'01-food-home-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-food-home-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9d3FBZlF6ME0zd1U',
			),
			'03-menu-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '03-menu-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9a0N4dmo4OFBEN2s',
			),
			'04-reservation-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '04-reservation-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9aUlRVWhqc2IwcWs',
			),
			/* taxi */
			'00-taxi-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-taxi-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9dWNfMHppM2dHTWM',
			),
			'01-taxi-home-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-taxi-home-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9Rnc1NDBxRy1aYXc',
			),
			'02-booking-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '02-booking-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9NVlKVVZ6S3l0cUE',
			),
			'05-booking-details-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '05-booking-details-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9MkJXRnIxZnFNYzA',
			),
			/* hotel */
			'00-hotel-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-hotel-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9Ti12cFlORUxoOGs',
			),
			'01-hotel-home-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-hotel-home-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9eW5GZUZwTFNOdlk',
			),
			'02-search-result-1200-grid-view-v1.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '02-search-result-1200-grid-view-v1.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9dXlrNW5zT0hWMzg',
			),
			'06-hotel-page-1200-gallery-and-description-view-v1.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '06-hotel-page-1200-gallery-and-description-view-v1.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9TkFKZHdWUnhVajg',
			),
			/* bike */
			'00-bike-banner.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '00-bike-banner.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9MUU5REc0Y3FSVVE',
			),
			'01-bike-home-v1-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '01-bike-home-v1-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9TEE3NlBrWnBzREE',
			),
			'05-activity-select-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '05-activity-select-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9emJjN05fR1g4X00',
			),
			'10-bike-extras-1200.jpg' => array(
				'mime_type' 	=> 'image/jpg',
				'title'     	=> '10-bike-extras-1200.jpg',
				'url'     		=> 'https://drive.google.com/uc?id=0B5l8lO-CaKt9cXUta184SnlNaFk',
			)
		);

		return array( 
			'posts'							=> $posts, 
			'terms'  						=> $terms,
			'distant_attachments_metadata'	=> $distant_attachments_metadata
		);
	}
}