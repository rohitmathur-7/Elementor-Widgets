<?php


class Widget_3 extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script( 'widget-script-1', plugins_url( '/assets/build/js/bundle.min.js', BASE_DIR ), [ 'elementor-frontend' ], false, true );
		wp_register_style( 'widget-style-1', plugins_url( '/assets/src/css/widget-style-1.css', BASE_DIR ) );
	}
	public function get_name() {
		return 'widget3';
	}

	public function get_title() {
		return esc_html__( 'Widget 3', 'elementor-list-widget' );
	}

	public function get_icon() {
		return 'eicon-bullet-list';
	}

	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_keywords() {
		return [ 'widget3' ];
	}

	public function get_script_depends() {
		return [ 'widget-script-1' ];
	}

	public function get_style_depends() {
		return [ 'widget-style-1' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content-sec',
			[ 
				'label' => 'Content',
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title',
			[ 
				'label'   => 'Title',
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => 'Default List Title one',
			]
		);

		$this->add_control(
			'repeater-list',
			[ 
				'label'       => 'Repeater List',
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     =>
				[ 
					'list_title' => 'Default title two'
				],
				'title_field' => '{{{list_title}}}'
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'marker-sec',
			[ 
				'label' => 'Marker',
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'marker_type',
			[ 
				'label'   => 'Select marker type',
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [ 
					'ordered-list'   => [ 
						'title' => 'Ordered List',
						'icon'  => 'eicon-editor-list-ul',
					],
					'unordered-list' => [ 
						'title' => 'Unordered List',
						'icon'  => 'eicon-editor-list-ol',
					],
					'custom-list'    => [ 
						'title' => 'Custom list',
						'icon'  => 'eicon-edit',
					]
				],
				'default' => 'ordered-list',
			]
		);

		$this->add_control(
			'custom_marker',
			[ 
				'label'     => 'Custom marker',
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 
					'marker_type' => 'custom-list'
				],
				'selectors' => [ 
					'{{WRAPPER}} li::marker' => 'content: "{{VALUE}}"'
				],
				'default'   => '❤️',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$lists = [ 
			'ordered-list'   => 'ol',
			'unordered-list' => 'ul',
			'custom-list'    => 'ul',
		];

		?>
		<<?php echo $lists[ $settings['marker_type'] ] ?>>
			<?php
			foreach ( $settings['repeater-list'] as $index => $item ) {
				?>
				<li>
					<?php
					echo $item['list_title'] . '</br>';
					?>
				</li>
				<?php
			}
			?>
		</<?php echo $lists[ $settings['marker_type'] ]; ?>>
		<div>
			<button class="firstSelectorClass">
				Hello
			</button>
		</div>
		<div>
			<button class="secondSelectorClass">
				hii
			</button>
		</div>
		<?php
	}

}
