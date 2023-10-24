console.log("New Accordion1111");

class AccordionHandler extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        title: ".accordion-title-1",
        content: ".accordion-content-1",
        titleTag: ".accordion-title-tag",
        imgObj: ".accordion-img-obj",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      $title: this.$element.find(selectors.title),
      $content: this.$element.find(selectors.content),
      $titleTag: this.$element.find(selectors.titleTag),
      $imgObj: this.$element.find(selectors.imgObj),
    };
  }

  // Bind the reverse Rows method on the thead .day column.
  bindEvents() {
    this.elements.$title.on("click", this.handleClick1.bind(this));
  }

  handleClick1(event) {
    event.preventDefault();

    const $content_ele1 = event.currentTarget.nextElementSibling;
    if (jQuery($content_ele1).css("max-height") == "0px") {
      jQuery($content_ele1).css(
        "max-height",
        jQuery($content_ele1).prop("scrollHeight")
      );
    } else {
      jQuery($content_ele1).css("max-height", 0);
    }
  }
}

// When the frontend of Elementor is created, add our handler
jQuery(window).on("elementor/frontend/init", () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(AccordionHandler, {
      $element,
    });
  };
  // Add our handler to the my-elementor Widget (this is the slug we get from get_name() in PHP)
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/accordion1.default",
    addHandler
  );
});
