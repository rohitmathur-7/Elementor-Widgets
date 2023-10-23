<?php

use function PHPSTORM_META\type;

class Testimonial_Widget extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'testimonial', plugins_url( '/assets/src/css/testimonial.css', BASE_DIR ) );
		wp_register_script( 'testimonial', plugins_url( '/assets/build/js/testimonial.min.js', BASE_DIR ), [ 'elementor-frontend', 'jquery' ], false, true );
	}

	public function get_name() {
		return 'testimonial1';
	}

	public function get_title() {
		return 'Testimonial Widget';
	}

	public function get_keywords() {
		return [ 'testimonial' ];
	}

	public function get_style_depends() {
		return [ 'testimonial' ];
	}

	public function get_script_depends() {
		return [ 'testimonial' ];
	}

	protected function register_controls() {

		$repeater = new \Elementor\Repeater();

		$this->start_controls_section(
			'testimonial-content',
			[ 
				'label' => 'Testimonial',
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);


		$repeater->add_control(
			'content',
			[ 
				'label'       => 'Content',
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic'     => [ 
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'image',
			[ 
				'label'       => 'Choose Image',
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[ 
				'name'    => 'imgs', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [],
				'include' => [],
				'default' => 'large',
			]
		);

		$repeater->add_control(
			'name',
			[ 
				'label' => 'Name',
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'title',
			[ 
				'label' => 'Title',
				'type'  => \Elementor\Controls_Manager::TEXT,
			]
		);


		$repeater->add_control(
			'link',
			[ 
				'label'       => 'Link',
				'type'        => \Elementor\Controls_Manager::URL,
				'label-block' => true,
			]
		);

		$repeater->add_control(
			'image-position',
			[ 
				'label'     => 'Image Position',
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [ 
					'row'    => 'Aside',
					'column' => 'Top',
				],
				'default'   => 'row',
				'selectors' => [ 
					'{{WRAPPER}} .testimonial-author-info' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'alignment',
			[ 
				'label'           => 'Alignment',
				'type'            => \Elementor\Controls_Manager::CHOOSE,
				'options'         => [ 
					'flex-start' => [ 
						'title' => 'Left',
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [ 
						'title' => 'Center',
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [ 
						'title' => 'Right',
						'icon'  => 'eicon-text-align-right',
					],
				],
				'devices'         => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => 'center',
				'tablet_default'  => 'center',
				'mobile_default'  => 'center',
				'selectors'       => [ 
					'{{WRAPPER}} .testimonial-container' => 'align-items: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'repeater-list',
			[ 
				'label'       => 'Repeater List',
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ content }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styles_content',
			[ 
				'label' => 'Content',
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'txt-color',
			[ 
				'label'     => 'Text Color',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .testimonial-content' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[ 
				'name'     => 'txt-typo',
				'label'    => 'Typography',
				'selector' => '{{WRAPPER}} .testimonial-content',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'txt-shadow',
				'label'    => 'Text Shadow',
				'selector' => '{{WRAPPER}} .testimonial-content',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'styles_image',
			[ 
				'name'  => 'imz',
				'label' => 'Image',
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				''
			]
		);

		$this->add_control(
			'img_sze',
			[ 
				'label'      => 'Image Size',
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', '%', 'vw', 'custom' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [ 
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors'  => [ 
					'{{WRAPPER}} .testimonial-author-info img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'img_border_type',
			[ 
				'label'     => 'Border Type',
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [ 
					''       => 'Default',
					'none'   => 'None',
					'solid'  => 'Solid',
					'dashed' => 'Dashed',
				],
				'default'   => 'none',
				'selectors' => [ 
					'{{WRAPPER}} .testimonial-author-info img' => 'border-style: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'img_border_width',
			[ 
				'label'      => 'Width',
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'condition'  => [ 
					'img_border_type' => [ 'solid', 'dashed' ],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .testimonial-author-info img' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_border_color',
			[ 
				'label'     => 'Color',
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [ 
					'img_border_type' => [ 'solid', 'dashed' ],
				],
				'selectors' => [ 
					'{{WRAPPER}} .testimonial-author-info img' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label'      => 'Border Radius',
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'condition'  => [ 
					'img_border_type' => [ 'solid', 'dashed' ],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .testimonial-author-info img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		// foreach ( $settings['repeater-list'] as $item ) {
		// 	echo '<pre>';
		// 	print_r( $item['content'] );
		// 	echo '</pre>';
		// }
		?>
		<div class="testimonial-container">
			<?php
			if ( $settings['repeater-list'] ) {
				foreach ( $settings['repeater-list'] as $item ) {
					?>
					<div class="ind-item">
						<p class="testimonial-content">
							<?php echo $item['content']; ?>
						</p>
						<div class="testimonial-author">
							<div class="testimonial-author-info">
								<?php
								if ( ! empty( $item['link']['url'] ) ) {
									?>
									<a href="<?php $item['link']['url'] ?>">
										<?php
										if ( ! is_null( $item['imgs_custom_dimension'] ) ) {
											$img_size_arr = [ $item['imgs_custom_dimension']['width'], $item['imgs_custom_dimension']['height']
											];
											echo wp_get_attachment_image( $item['image']['id'], $img_size_arr );
										} else {
											echo wp_get_attachment_image( $item['image']['id'], $item['imgs_size'] );
										}
										?>
									</a>
									<a href="<?php $item['link']['url'] ?>">
										<div class="testimonial-author-content">
											<p>
												<?php echo $item['name'] ?>
											</p>
											<p>
												<?php echo $item['title'] ?>
											</p>
										</div>
									</a>
									<?php
								} else {
									?>
									<?php
									if ( ! is_null( $item['imgs_custom_dimension'] ) ) {
										$img_size_arr = [ $item['imgs_custom_dimension']['width'], $item['imgs_custom_dimension']['height']
										];
										echo wp_get_attachment_image( $item['image']['id'], $img_size_arr );
									} else {
										echo wp_get_attachment_image( $item['image']['id'], $item['imgs_size'] );
									}
									?>
									<div class="testimonial-author-content">
										<p>
											<?php echo $item['name'] ?>
										</p>
										<p>
											<?php echo $item['title'] ?>
										</p>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}


}
