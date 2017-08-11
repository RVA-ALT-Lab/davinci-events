
//set hrs for events into form
  jQuery(document).ready(function() {

        if (document.getElementById('tribe-events')){

//auto enter time value for event
           var time = document.getElementsByClassName('tribe-meta-value')[0];
           console.log(time);
           var hrs = time.innerHTML;
           console.log(hrs);
           var field = document.getElementById('input_4_7');
           field.value = hrs;

//auto enter date value for event
           var date = document.getElementsByClassName('tribe-events-start-date')[0].title;
           console.log(date);          
           var dateField = document.getElementById('input_4_11');
           dateField.value = date;

        }
    });


//hide and show button for reflection 
jQuery( "#student-log-button" ).click(function() {
  jQuery( "#student-log" ).toggle( "slow", function() {
    // Animation complete.
  });
});



//adds up the hours for the individual student view
  jQuery(document).ready(function() {
    var theHrs = 0;
    if (document.getElementById('totalHours')){
      var getHrs = document.getElementsByClassName('hours-data');
      console.log(getHrs);
      for(var i = 0; i < getHrs.length; i++){
        theHrs += parseInt(getHrs[i].innerHTML, 10);        
      }
      document.getElementById('totalHours').innerHTML = theHrs;
    }
  });
