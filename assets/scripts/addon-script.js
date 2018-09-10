$(document).ready(function(){
    $(".future_datepicker").datepicker({ 
        minDate: 0,
        // showOn: "button",
        buttonImage: IMAGES_PATH+'calendar.png',
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+20'
        
      });
    $('.future_timepicker').timepicker({
        // showOn: "button",
        buttonImage: IMAGES_PATH+'time.png',
        buttonImageOnly: true,
        hourGrid: 4,
        minuteGrid: 10,
        timeFormat: 'hh:mm tt',
        minDateTime: new Date()
    });
    $('.timepicker').timepicker({
        // showOn: "button",
        buttonImage: IMAGES_PATH+'time.png',
        buttonImageOnly: true,
        hourGrid: 4,
        minuteGrid: 10,
        timeFormat: 'hh:mm tt'
    });
});

$('.prevent-input').change(function(e){
    return false;
});