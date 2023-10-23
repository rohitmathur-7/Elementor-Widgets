// console.log("New Accordion");

class AccordionHandler extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        title: ".accordion-title-1",
        content: ".accordion-content-1",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      $title: this.$element.find(selectors.title),
      $content: this.$element.find(selectors.content),
    };
  }

  // Bind the reverse Rows method on the thead .day column.
  bindEvents() {
    this.elements.$title.on("click", this.handleClick.bind(this));
  }

  handleClick(event) {
    event.preventDefault();
    console.log(event.code);
    const $title = this.elements.$title;
    const $content = event.target.next();

    if ($content.css("max-height") == "0px") {
      $content.css("max-height", $content.prop("scrollHeight"));
    } else {
      $content.css("max-height", 0);
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
