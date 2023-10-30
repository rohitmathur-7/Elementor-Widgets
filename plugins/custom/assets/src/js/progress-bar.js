console.log("Progress bar");

class ProgressBar extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    return {
      selectors: {
        innerText: ".progress-bar-inner-text",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");
    return {
      $innerText: this.$element.find(selectors.innerText),
    };
  }

  onInit() {
    super.onInit();
    const $progressBar = this.elements.$innerText;
    $progressBar.css("width", $progressBar.data("max") + "%");
  }
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
