// Flatpickr
if($("#basicFlatpickr").length != 0) {
    var f1 = flatpickr(document.getElementById('basicFlatpickr'));
  }
  if($("#dateTimeFlatpickr").length != 0) {
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
  }
  if($("#rangeCalendarFlatpickr").length != 0) {
      var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
          mode: "range",
          minDate : new Date() 
      });
  }
  if($("#rangeCalendarFlatpickr1").length != 0) {
    var f7 = flatpickr(document.getElementById('rangeCalendarFlatpickr1'), {
        mode: "range",
    });
}
  if($("#timeFlatpickr").length != 0) {
      var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
          defaultDate: "13:45"
      });
  }
  if($("#basicFlatpickr1").length != 0) {
      var f5 = flatpickr(document.getElementById('basicFlatpickr1'));
  }/*
var f1 = flatpickr(document.getElementById('basicFlatpickr'));
var f5 = flatpickr(document.getElementById('basicFlatpickr1'));
var f6 = flatpickr(document.getElementById('basicFlatpickr2'));
var f7 = flatpickr(document.getElementById('basicFlatpickr3'));
var f7 = flatpickr(document.getElementById('basicFlatpickr4'));
var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});
var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
});
var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45"
});*/