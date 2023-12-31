console.log("New Accordion1111");

class AccordionHandler extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        title: ".accordion-title-1",
        imgObj: ".accordion-img-obj",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      $title: this.$element.find(selectors.title),
      $imgObj: this.$element.find(selectors.imgObj),
    };
  }

  // Bind the reverse Rows method on the thead .day column.
  bindEvents() {
    this.elements.$title.on("click", this.handleClick.bind(this));
  }

  handleClick(event) {
    event.preventDefault();
    // console.log(this);
    const $content_ele1 = event.currentTarget.nextElementSibling;
    // console.log(this.elements.$imgObj[0].tagName);
    // console.log(this.elements.$imgObj);
    if (jQuery($content_ele1).css("max-height") == "0px") {
      // $imgObj.setAttribute("data", settings.icon_accordion_active);
      // $imgObj.setAttribute("data", settings.icon_accordion);
      jQuery($content_ele1).css(
        "max-height",
        jQuery($content_ele1).prop("scrollHeight")
      );
    } else {
      // $imgObj.setAttribute("data", settings.icon_accordion_active);
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
