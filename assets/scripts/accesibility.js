$(document).ready(function () {
  // --- Global reuse DOM components ---
  console.log("hoilaaa")
    // Widget Container
  let widget = $("#accessibility-widget");
    // Accesible Button
  let accButton = $("#btn_accesibility");

  // Pre load accesible settings

  const savedSettings = JSON.parse(localStorage.getItem("acc_settings")) || {};

  // Function preload settings on localstorage
  function applySettings (accSettings){
    // Iterate key (type) value (isActive)
    $.each(accSettings, function(type,isActive){
      // If we have presets from previus session
      if(isActive){
        // Aply Style to the body
        $("body").addClass("acc-"+type);
        // Get all components acc-option with the matching type and add th3e active class
        $(`acc-option[data-type="${type}"]`).addClass("is-active")
      }
    });
  };

  // Call savedSettings
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
  $(".acc-option").on("click", function () {
    const type = $(this).data("type");

    // Alternar clase en el body
    $("body").toggleClass("acc-" + type);

    // Guardar estado
    savedSettings[type] = $("body").hasClass("acc-" + type);
    localStorage.setItem("acc_settings", JSON.stringify(savedSettings));

    // Feedback visual en el botón (punto de calidad técnica)
    $(this).toggleClass("is-active");

    console.log("Activado");
  });

  // 3. Botón Reset (Restauració completa)
  $("#btn-reset-all").on("click", function () {
    $("body").removeClass(function (index, className) {
      return (className.match(/(^|\s)acc-\S+/g) || []).join(" ");
    });
    localStorage.removeItem("acc_settings");
    $(".acc-option").removeClass("is-active");
  });
  console.log("Reseteado");
});
