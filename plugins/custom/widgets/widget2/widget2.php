<?php

class Widget_2 extends \Elementor\Widget_Base {
	public function get_name() {
		return 'widget2';
	}

	public function get_title() {
		return esc_html__( 'Widget 2', 'elementor-list-widget' );
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
		return [ 'widget2' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'list_content',
			[ 
				'label' => esc_html__( 'List Content', 'elementor-list-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// $repeater->add_control(
		// 	'list_title',
		// 	[ 
		// 		'label'   => esc_html__( 'Title', 'elementor-list-widget' ),
		// 		'type'    => \Elementor\Controls_Manager::TEXT,
		// 		'default' => esc_html__( 'List Title', 'textdomain' ),
		// 	],
		// );

		// $repeater->add_control(
		// 	'list_content',
		// 	[ 
		// 		'label' => esc_html__( 'Text', 'elementor-list-widget' ),
		// 		'type'  => \Elementor\Controls_Manager::TEXT,
		// 	]
		// );

		// $repeater->add_control(
		// 	'list_url',
		// 	[ 
		// 		'label' => esc_html__( 'Link', 'elementor-list-widget' ),
		// 		'type'  => \Elementor\Controls_Manager::URL,
		// 	]
		// );

		$this->add_control(
			'list_items',
			[ 
				'label'       => esc_html__( 'List Items', 'elementor-list-widget' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => [ 
					[ 
						'name'    => 'list_title',
						'label'   => esc_html__( 'Title', 'elementor-list-widget' ),
						'type'    => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'List Title', 'elementor-list-widget' ),
					],
					[ 
						'name'  => 'list_link',
						'label' => esc_html__( 'Link', 'elementor-list-widget' ),
						'type'  => \Elementor\Controls_Manager::URL,
					]
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list-marker',
			[ 
				'label' => esc_html__( 'List Marker', 'elementor-list-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'marker_type',
			[ 
				'label'   => esc_html__( 'Select Marker', 'elementor-list-widget' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [ 
					'ordered-list'   => [ 
						'title' => esc_html__( 'Ordered List', 'elementor-list-widget' ),
						'icon'  => 'eicon-editor-list-ol'
					],
					'unordered-list' => [ 
						'title' => esc_html__( 'Un-Ordered List', 'elementor-list-widget' ),
						'icon'  => 'eicon-editor-list-ul'
					],
					'custom-list'    => [ 
						'title' => esc_html__( 'Custom List', 'elementor-list-widget' ),
						'icon'  => 'eicon-edit'
					],
				],
				'default' => 'ordered-list',
			]
		);

		$this->add_control(
			'custom-marker',
			[ 
				'label'     => esc_html__( 'Custom Marker: ', 'elementor-list-widget' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [ 
					'marker_type' => 'custom-list'
				],
				'default'   => '❤️',
				'selectors' => [ 
					'{{WRAPPER}} .ind-item::marker' => 'content: "{{VALUE}}";'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styles_section',
			[ 
				'label' => esc_html__( 'List Style', 'elementor-list-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'title-color',
			[ 
				'label'     => esc_html__( 'Color', 'elementor-list-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' =>
				[ 
					'{{WRAPPER}} .ind-item'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-item-a' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .ind-item'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .ind-item'
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'marker_style',
			[ 
				'label' => esc_html__( 'Marker Style', 'elementor-list-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'list-color',
			[ 
				'label'     => esc_html__( 'Color', 'elementor-list-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .ind-item::marker' => 'color: {{VALUE}}'
				]
			]
		);

		$this->add_control(
			'marker-spacing',
			[ 
				'label'      => esc_html__( 'Spacing', 'elementor-list-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', 'em', '%', 'custom' ],
				'range'      => [ 
					'px' => [ 
						'min'  => 0,
						'max'  => 100,
						'step' => 5
					],
					'%'  => [ 
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors'  =>
				[ 
					'{{WRAPPER}} .items-list' => 'margin-left: {{SIZE}}{{UNIT}}'
				]
			]
		);


		$this->end_controls_section();


	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="widget-list">
			<?php

			$this->add_render_attribute( 'list_attr', 'class', 'items-list' );

			$marker_type = $settings['marker_type'];
			echo $marker_type === 'ordered-list' ? '<ol ' . $this->get_render_attribute_string( 'list_attr' ) . '>' : '<ul ' . $this->get_render_attribute_string( 'list_attr' ) . '>';

			foreach ( $settings['list_items'] as $index => $item ) {

				$repeater_setting_key = $this->get_repeater_setting_key( 'list_title', 'list_items', $index );
				$this->add_render_attribute( $repeater_setting_key, 'class', 'ind-item' );
				$this->add_inline_editing_attributes( $repeater_setting_key );
				?>
				<li <?php $this->print_render_attribute_string( $repeater_setting_key ); ?>>
					<?php
					if ( ! empty( $item['list_link']['url'] ) ) {
						$this->add_render_attribute( 'list_item_link', [ 'href' => $item['list_link']['url'], 'class' => 'list-item-a' ] );
						?>
						<a <?php $this->print_render_attribute_string( 'list_item_link' ); ?>>
							<?php esc_html_e( $item['list_title'], 'elementor-list-widget' ); ?>
						</a>
						<?php
					} else {
						esc_html_e( $item['list_title'], 'elementor-list-widget' );
					}
					?>
				</li>
				<?php
			}

			echo $marker_type === 'ordered-list' ? '</ol>' : '</ul>';

			?>
		</div>
		<?php
	}


}
