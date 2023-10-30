<?php
class ProgressBar extends \Elementor\Widget_Base {
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'progress-bar', plugins_url( '/assets/src/css/progress-bar.css', BASE_DIR ) );
		wp_register_script( 'progress-bar', plugins_url( '/assets/build/js/progressBar.min.js', BASE_DIR ), [ 'elementor-frontend', 'jquery' ], false, true );
	}

	public function get_name() {
		return 'progress-bar';
	}

	public function get_title() {
		return 'Progress Bar';
	}

	public function get_keywords() {
		return [ 'progress', 'bar' ];
	}

	public function get_style_depends() {
		return [ 'progress-bar' ];
	}

	public function get_script_depends() {
		return [ 'progress-bar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content-progress-bar',
			[ 
				'label' => 'Progress Bar',
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[ 
				'label'       => 'Title',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_html_tag',
			[ 
				'label'   => 'Title HTML tags',
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [ 
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'span' => 'span',
					'p'    => 'p',
					'div'  => 'div',
				],
				'default' => 'span',
			]
		);

		$this->add_control(
			'type',
			[ 
				'label'   => 'Type',
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [ 
					''        => 'Default',
					'info'    => 'Info',
					'success' => 'Success',
					'warning' => 'Warning',
					'danger'  => 'Danger',
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'percentage',
			[ 
				'label'              => 'Percentage',
				'type'               => \Elementor\Controls_Manager::SLIDER,
				'frontend_available' => true,
				// 'size_units'         => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default'            => [ 
					'unit' => '%',
					'size' => 50,
				],
			],
		);

		$this->add_control(
			'display_percentage',
			[ 
				'label' => 'Display Percentage',
				'type'  => \Elementor\Controls_Manager::SWITCHER,
			],
		);

		$this->add_control(
			'inner_text',
			[ 
				'label'       => 'Inner Text',
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::TEXT,
			],
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="progress-bar">
			<?php echo '<' . $settings['title_html_tag'] . ' class="title-progress">' ?>
			<?php echo $settings['title']; ?>
			<?php echo '</' . $settings['title_html_tag'] . '>' ?>
			<div class="progress-bar-inner-text-container">
				<div class="progress-bar-inner-text <?php echo $settings['type'] ?>"
					data-max="<?php echo $settings['percentage']['size'] ?>">
					<span class="inner-text-content">
						<?php echo $settings['inner_text']; ?>
					</span>
					<?php
					if ( $settings['display_percentage'] ) {
						?>
						<span>
							<?php echo $settings['percentage']['size'] . '%'; ?>
						</span>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php
	}


}
