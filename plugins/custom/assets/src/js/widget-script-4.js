console.log("hrehrhere");
class MyElementorHandler extends elementorModules.frontend.handlers.Base {
  getDefaultSettings() {
    console.log("4");
    return {
      selectors: {
        hours: ".working-hours",
      },
    };
  }

  getDefaultElements() {
    const selectors = this.getSettings("selectors");

    return {
      $hours: this.$element.find(selectors.hours),
    };
  }

  reverseRows(e) {
    console.log("In 20");
    // Get the hours jQuery
    var table = this.elements.$hours;
    // Get the tbody
    var tbody = table.find("tbody");
    // Create an array of available rows
    var arr = jQuery.makeArray(jQuery("tr", tbody[0]).detach());
    // Reverse the rows
    arr.reverse();
    // Empty the HTML
    tbody.html("");
    // Add the new array HTML
    tbody.append(arr);
  }

  // Bind the reverse Rows method on the thead .day column.
  bindEvents() {
    this.elements.$hours
      .find("th.day")
      .on("click", this.reverseRows.bind(this));
  }
}

// When the frontend of Elementor is created, add our handler
jQuery(window).on("elementor/frontend/init", () => {
  const addHandler = ($element) => {
    elementorFrontend.elementsHandler.addHandler(MyElementorHandler, {
      $element,
    });
  };
  // Add our handler to the my-elementor Widget (this is the slug we get from get_name() in PHP)
  elementorFrontend.hooks.addAction(
    "frontend/element_ready/widget4.default",
    addHandler
  );
});
