<?php

class Widget_4 extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		wp_register_script( 'widget-script-4', plugins_url( '/assets/build/js/widget4.min.js', BASE_DIR ), [ 'elementor-frontend' ], false, true );

	}

	public function get_script_depends() {
		return [ 'widget-script-4' ];
	}

	public function get_name() {
		return 'widget4';
	}

	public function get_title() {
		return 'Widget 4';
	}

	protected function get_days() {
		return [ 
			'monday'    => 'Monday',
			'tuesday'   => 'Tuesday',
			'wednesday' => 'Wednesday',
			'thursday'  => 'Thursday',
			'friday'    => 'Friday',
			'saturday'  => 'Saturday',
			'sunday'    => 'Sunday',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[ 
				'label' => 'Working Hours',
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Creating a repeater control
		$repeater = new \Elementor\Repeater();

		// Add Day dropdown
		$repeater->add_control(
			'day',
			[ 
				'label'   => 'Day',
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_days(),
			]
		);
		// Adding Hours option
		$options = array();

		for ( $i = 0; $i < 24; $i++ ) {
			$hour = $i;

			if ( $hour < 10 ) {
				$hour = '0' . $hour;
			}
			$options[ $hour . ':00' ] = $hour . ':00';
		}

		// Add Start Hour
		$repeater->add_control(
			'start',
			[ 
				'label'   => 'Start',
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $options
			]
		);

		// Add End hours
		$repeater->add_control(
			'end',
			[ 
				'label'   => 'End',
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $options
			]
		);

		// Adding the repeater control with all its controls
		$this->add_control(
			'hours',
			[ 
				'label'       => 'Hours',
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [],
				'title_field' => '{{{ day }}}',
			]
		);

		$this->add_control(
			'price_currency',
			[ 
				'label' => 'Currency',
				'type'  => 'currency',
			]
		);

		$this->add_control(
			'dynamic-cntrl',
			[ 
				'label'   => 'Dynamic',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [ 
					'active' => true,
				]
			]
		);

		$this->add_control(
			'heading',
			[ 
				'label'       => esc_html__( 'Heading', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your heading', 'textdomain' ),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[ 
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'label'           => 'Spacing',
				'range'           => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [ 
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default'  => [ 
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default'  => [ 
					'size' => 10,
					'unit' => 'px',
				],
				'selectors'       => [ 
					'{{WRAPPER}} .widget-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img',
			[ 
				'label'   => 'Image',
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [ 
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[ 
				'label' => esc_html__( 'Style Section', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'popover-toggle',
			[ 
				'label'        => esc_html__( 'Box', 'textdomain' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => esc_html__( 'Default', 'textdomain' ),
				'label_on'     => esc_html__( 'Custom', 'textdomain' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_control(
			'one',
			[ 
				'label' => 'one',
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'two',
			[ 
				'label' => 'two',
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);


		$this->end_popover();

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[ 
				'label' => 'Normal',
			]
		);

		$this->add_control(
			'txt',
			[ 
				'label' => 'Normal Text',
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[ 
				'label' => 'Hover',
			]
		);

		$this->add_control(
			'txt_hover',
			[ 
				'label' => 'Hover Text',
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_animation_tab',
			[ 
				'label' => 'Animation',
			]
		);

		$this->end_controls_tab();


		$this->end_controls_tabs();

		$this->end_controls_section();


	}


	protected function render() {
		$settings = $this->get_settings();
		echo '<pre>';
		print_r( $settings['space_between'] );
		echo '</pre>';
		?>

		<div>
			<img class="widget-image" src="<?php echo $settings['img']['url'] ?>" alt="" />
		</div>


		<?php
	}



}

// protected function render() {

// 	$settings = $this->get_settings();
// 	echo '<pre>';
// 	print_r( $settings['space_between'] );
// 	echo '</pre>';
// 	// echo $settings['test'] . '</br>';

// 	if ( $settings['hours'] ) {
// 		$days = $this->get_days();
// 		echo '<table class="working-hours">';
// 		echo '<thead>';
// 		echo '<tr>';
// 		echo '<th class="day">';
// 		esc_html_e( 'Day', 'plugin-name' );
// 		echo '</th>';
// 		echo '<th>';
// 		esc_html_e( 'Start', 'plugin-name' );
// 		echo '</th>';
// 		echo '<th>';
// 		esc_html_e( 'End', 'plugin-name' );
// 		echo '</th>';
// 		echo '</tr>';
// 		echo '</thead>';
// 		echo '<tbody>';
// 		foreach ( $settings['hours'] as $hour ) {
// 			if ( ! isset( $hour['day'] ) ) {
// 				continue;
// 			}

// 			if ( ! $hour['day'] ) {
// 				continue;
// 			}

// 			echo '<tr>';
// 			echo '<td class="day" data-day="' . esc_attr( $hour['day'] ) . '">';
// 			echo esc_html( $days[ $hour['day'] ] );
// 			echo '</td>';
// 			echo '<td>';
// 			echo isset( $hour['start'] ) && $hour['start'] ? esc_html( $hour['start'] ) : '-';
// 			echo '</td>';
// 			echo '<td>';
// 			echo isset( $hour['end'] ) && $hour['end'] ? esc_html( $hour['end'] ) : '-';
// 			echo '</td>';
// 			echo '</tr>';
// 		}
// 		echo '</tbody>';
// 		echo '</table>';
// 	}


// }

