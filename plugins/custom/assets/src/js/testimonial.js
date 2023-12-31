console.log("New Testimonial js");
// import "slick-carousel";

class TestimonialHandler extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        container: ".testimonial-container",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      $container: this.$element.find(selectors.container),
    };
  }

  // Bind the reverse Rows method on the thead .day column.
  bindEvents() {
    this.handleSlider();
  }

  onElementChange() {
    this.elements.$container.slick("unslick");
  }

  handleSlider() {
    const slider = this.elements.$container;
    slider.slick({
      arrows: false,
      dots: true,
      vertical: false,
      fade: true,
      accessibility: true,
      dots: true,
    });
  }
}

// When the frontend of Elementor is created, add our handler
jQuery(window).on("elementor/frontend/init", () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(TestimonialHandler, {
      $element,
    });
  };
  // Add our handler to the my-elementor Widget (this is the slug we get from get_name() in PHP)
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/testimonial1.default",
    addHandler
  );
});
