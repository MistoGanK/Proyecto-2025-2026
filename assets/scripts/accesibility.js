$(document).ready(function () {
  // --- Global reuse DOM components ---

  // Widget Container
  const widget = $("#accessibility-widget");

  // Accesible Button
  const accButton = $("#btn_accesibility");

  // Body
  const $body = $("body");

  // Pre load accesible settings
  let savedSettings = JSON.parse(localStorage.getItem("acc_settings")) || {};

  // Function preload settings on localstorage
  function applySettings(accSettings) {
    // Iterate key (type) value (isActive) of the Object accSettings
    $.each(accSettings, function (type, isActive) {
      // If we have presets from previus session
      if (isActive) {
        // Aply Style to the body
        $body.addClass("acc-" + type);
        // Get all components acc-option (buttons) with the matching type and add the active class
        $(`acc-option[data-type="${type}"]`).addClass("is-active");
      }
    });
  }

  // Call savedSettings to preload the previus user Accesibility Settings
  applySettings(savedSettings);

  // --- Buttons events handlers ---

  // -- Button accesibility
  accButton.click(function (e) {
    e.preventDefault();

    widget.toggleClass("showAccesibility");

    // Accesibility Attr Update
    let isVisible = widget.hasClass("showAccesibility"); // true

    widget.attr("aria-hidden", !isVisible); // false
    $(this).attr("aria-expanded", isVisible);
  });

  // -- Button close widget
  $("#close-widget").on("click", function (e) {
    e.preventDefault();

    widget.removeClass("showAccesibility");

    // Accesibility Attr Update
    let isVisible = widget.hasClass("showAccesibility"); // false

    widget.attr("aria-hidden", !isVisible); // true
    $(this).attr("aria-expanded", isVisible);

    // Button Accesibility Update
    accButton.attr("aria-expanded", false);

    // Bring back focus
    accButton.focus();
  });

  // -- Button Accion Option
  // Global acc listener, add the data-type as a class to the body
  $(".acc-option").on("click", function () {
    // Font-Size...Line-height...Contrast...
    const type = $(this).data("type");
    // Increa or Decrease
    const action = $(this).data("action");

    // Actual level
    let oldLevel = savedSettings[type] || 0;
    console.log(oldLevel)

    let currentLevel = oldLevel;
    // Calculate new level between -3 and +3
    if (action === "increase") {
      // Limits to 3
      currentLevel = Math.min(3, currentLevel + 1);
    } else if (action === "decrease") {
      // Limits to -3
      currentLevel = Math.max(-3, currentLevel - 1);
    }

    // Clean the previus level of the type clicked
    $body.removeClass(`acc-${type}-${oldLevel}`);

    // Update the current level
    if (currentLevel !== 0) {
        $body.addClass(`acc-${type}-${currentLevel}`);
    }

    // Fedback
    $(this).addClass("is-active");

    // Save State to the Local Storage
    savedSettings[type] = currentLevel;
    localStorage.setItem("acc_settings", JSON.stringify(savedSettings));
  });

  // -- Button Reset Accesibility
  $("#btn-reset-all").on("click", function () {
    // Reset all appended classes
    $body.attr("class", "");

    // Cleans Accesibility Settings
    localStorage.removeItem("acc_settings");
    $(".acc-option").removeClass("is-active");
    
    // Restart vatiabel savedSettings or its going to save the previus level types
    savedSettings = {};

  });
});
