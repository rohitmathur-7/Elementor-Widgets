<?php

use function PHPSTORM_META\type;

class Accordion1 extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'accordion1', plugins_url( '/assets/src/css/accordion1.css', BASE_DIR ) );
		wp_register_script( 'accordion1', plugins_url( '/assets/build/js/accordion1.min.js', BASE_DIR ), [ 'elementor-frontend', 'jquery' ], false, true );
	}

	public function get_name() {
		return 'accordion1';
	}

	public function get_title() {
		return 'My Accordion';
	}

	public function get_keywords() {
		return [ 'accordion1' ];
	}

	public function get_style_depends() {
		return [ 'accordion1' ];
	}

	public function get_script_depends() {
		return [ 'accordion1' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'accordion_content_section',
			[ 
				'label' => 'Accordion',
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'accordion_title_1',
			[ 
				'label'       => 'Title',
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Enter Title',
			]
		);

		$repeater->add_control(
			'accordion_content_1',
			[ 
				'label'   => 'Content',
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'default' => 'Enter content',
			]
		);

		$this->add_control(
			'repeater_list',
			[ 
				'label'       => 'Accordion Items',
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{accordion_title_1}}}',
			]
		);

		$this->add_control(
			'icon_accordion',
			[ 
				'label'       => 'Icon',
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => [ 
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [ 
					'fa-solid'   => [ 
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [ 
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'skin'        => 'inline',
			]
		);

		$this->add_control(
			'icon_accordion_active',
			[ 
				'label'       => 'Active Icon',
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => [ 
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [ 
					'fa-solid'   => [ 
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [ 
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'skin'        => 'inline',
				'condition'   => [ 
					'icon_accordion[value]!' => '',
				]
			]
		);

		$this->add_control(
			'tag_title_tag',
			[ 
				'label'     => 'Title HTML Tag',
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [ 
					'div' => 'div',
					'h1'  => 'H1',
					'h2'  => 'H2',
					'h3'  => 'H3',
					'h4'  => 'H4',
					'h5'  => 'H5',
					'h6'  => 'H6',
				],
				'default'   => 'div',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'faq_schema',
			[ 
				'label'        => 'FAQ Schema',
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => 'yES',
				'label_off'    => 'No',
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'accordion_styles',
			[ 
				'label' => 'Accordion',
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'border_style',
			[ 
				'label'     => 'Border',
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [ 
					'none'   => 'None',
					'solid'  => 'Solid',
					'dashed' => 'Dashed',
				],
				'default'   => 'none',
				'selectors' => [ 
					'{{WRAPPER}} .accordion-container-1' => 'border-style: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'accordion-border-width',
			[ 
				'label'      => 'Border Width',
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [ 
					'{{WRAPPER}} .accordion-container-1' => 'border-width: {{SIZE}}{{UNIT}}'
				],
				'condition'  => [ 
					'border_style!' => 'none',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .accordion-container-1',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'accordion_title',
			[ 
				'label' => 'Title',
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_bg',
			[ 
				'label'     => 'Background',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .accordion-title-1' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'title_color',
			[ 
				'label'     => 'Color',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .accordion-title-1' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'title_color',
			[ 
				'label'     => 'Active Color',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .accordion-title-1' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .accordion-title-1',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[ 
				'name'     => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .accordion-title-1',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .accordion-title-1',
			]
		);

		$this->add_control(
			'title_padding',
			[ 
				'label'     => 'Padding',
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [ 
					'{{WRAPPER}} .accordion-title-1' => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'accordion_content',
			[ 
				'label' => 'Content',
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_bg',
			[ 
				'label'     => 'Background',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .accordion-content-1' => 'background: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'content_color',
			[ 
				'label'     => 'Color',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .accordion-content-1' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .accordion-content-1',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'content_text_stroke',
				'selector' => '{{WRAPPER}} .accordion-content-1',
			]
		);

		$this->add_control(
			'content_padding',
			[ 
				'label'     => 'Padding',
				'type'      => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => [ 
					'{{WRAPPER}} .accordion-content-1' => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		// print_r( $settings['icon_accordion'] );
		?>
		<div class="accordion-container-1">
			<?php
			foreach ( $settings['repeater_list'] as $item ) {
				?>
				<div class="accordion-title-1">
					<?php
					echo '<' . $settings['tag_title_tag'] . ' class="accordion-title-tag">';
					if ( ! empty( $settings['icon_accordion'] ) ) {
						?>
						<?php
						if ( $settings['icon_accordion']['library'] == 'svg' ) {
							?>
							<object class="accordion-img-obj" width="50" height="50" type="image/svg+xml"
								data="<?php echo $settings['icon_accordion']['value']['url'] ?>"></object>
							<?php
						} else {
							?>
							<i class="<?php echo $settings['icon_accordion']['value'] . ' accordion-img-obj' ?>"></i>
							<?php
						}
						?>
						<?php
					}
					echo $item['accordion_title_1'] . '</br>';
					echo '</' . $settings['tag_title_tag'] . '>';
					?>
				</div>
				<div class="accordion-content-1">
					<?php
					echo $item['accordion_content_1'];
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	}


}
