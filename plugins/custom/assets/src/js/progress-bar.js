console.log("Progress bar");

class ProgressBar extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    // console.log("Here in settings");
    return {
      selectors: {
        innerText: ".progress-bar-inner-text",
      },
    };
  }

  getDefaultElements() {
    // console.log("Here in elements");
    const selectors = this.getSettings("selectors");
    // console.log(this);
    return {
      $innerText: this.$element.find(selectors.innerText),
    };
  }

  //   addPercentage() {
  //     const percentage = this.getElementSettings("percentage");
  //     const innerText = this.elements.$innerText;
  //     const newWidth = percentage.size + percentage.unit;
  //     // console.log("new width " + newWidth);
  //     // jQuery(innerText).css("background-color", "red");
  //     jQuery(innerText).css("width", newWidth);
  //     // jQuery(innerText).css("width", percentage + "%");
  //   }

  //   onElementChange(propertyName) {
  //     console.log("in on element change");
  //     if ("percentage" === propertyName) {
  //       this.addPercentage();
  //     }
  //   }
}

// When the frontend of Elementor is created, add our handler
jQuery(window).on("elementor/frontend/init", () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(ProgressBar, {
      $element,
    });
  };
  // Add our handler to the my-elementor Widget (this is the slug we get from get_name() in PHP)
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/progress-bar.default",
    addHandler
  );
});
