$(document).ready(function () {
  $("input[name=date_expected_picker]").datepicker({
    dateFormat: "yy-mm-dd",
  });
  $("input[name=date_expected_picker]").datepicker(
    "setDate",
    $("input[name=date_expected_picker]").data("default-date")
  );
  $("#toggle-date-format").on("click", function () {
    if ($(this).val() == "US") {
      $(this).val("EU");
      $(this).text("EU");
      $("input[name=date_expected_picker]").datepicker(
        "option",
        "dateFormat",
        "yy-mm-dd"
      );
    } else {
      $(this).val("US");
      $(this).text("US");
      $("input[name=date_expected_picker]").datepicker(
        "option",
        "dateFormat",
        "mm/dd/yy"
      );
    }
  });
  $("input[name=date_expected_picker]").datepicker(
    "option",
    "onSelect",
    function (dateText, inst) {
      let date = $(this).datepicker("getDate");
      $("input[name=date_expected]").val(dayjs(date).format("YYYY-MM-DD"));
      let leadTime = Math.floor(
        (date.getTime() - new Date().getTime()) / 1000 / 60 / 60 / 24
      );
      $("#lead-time-label").text(leadTime + " days");
    }
  );
});
