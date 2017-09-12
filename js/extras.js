
// //set hrs for events into form
//   jQuery(document).ready(function() {

//         if (document.getElementById('tribe-events') == true){

// //auto enter time value for event
//            var time = document.getElementsByClassName('tribe-meta-value')[0];
//            console.log(time);
//            var hrs = time.innerHTML;
//            console.log(hrs);
//            var field = document.getElementById('input_4_7');
//            field.value = hrs;

// //auto enter date value for event
//            var date = document.getElementsByClassName('tribe-events-start-date')[0].title;
//            console.log(date);          
//            var dateField = document.getElementById('input_4_11');
//            dateField.value = date;

//         }
//     });


//hide and show button for reflection 
jQuery( "#student-log-button" ).click(function() {
  jQuery( "#student-log" ).toggle( "slow", function() {
    // Animation complete.
  });
});




  //set hrs for events into form
  //This code get loaded on single-event.php
  jQuery(document).ready(function() {

        if (location.pathname.includes('/davinci-events/event/')){

//auto enter time value for event
           if(document.getElementsByClassName('tribe-meta-value')[0]){
           var time = document.getElementsByClassName('tribe-meta-value')[0];
           var hrs = time.innerHTML;

           if (document.querySelector('#input_4_7')){
            var field = document.querySelector('#input_4_7');
            field.value = hrs;
            }
            
         } else if (document.querySelector('.tribe-events-start-time')){
            var timeString = document.querySelector('.tribe-events-start-time').innerText;
            var numHours = parseHours(timeString); 

            if (document.querySelector('#input_4_7')){
            var field = document.querySelector('#input_4_7');
            field.value = numHours;
            }
         }

//auto enter date value for event
        if(document.getElementById('input_4_11')){
           var date = document.getElementsByClassName('tribe-events-start-date')[0].title;
           var dateField = document.getElementById('input_4_11');
           dateField.value = date;
         }

//auto enter event id for check-in form
        if(document.querySelector('#check-in-event-id')){   
           var eventId = document.querySelector('#check-in-event-id').value; 
           var eventIdField = document.querySelector('#input_7_4'); 
           eventIdField.value = eventId; 
         }  

        }
    });


  function parseHours(timeString){

    var numHours = 0; 
    var splitString = timeString.split('-'); 
    

    var startTime = splitString[0];
    var endTime = splitString[1];

    var startHour = formatAsMilitaryTime(startTime).split(':')[0];
    var endHour = formatAsMilitaryTime(endTime).split(':')[0]; 


    numHours = endHour - startHour; 
    return numHours; 


  }

  //This function formats as 24 hr time to make it easier to add/subtract
  function formatAsMilitaryTime(time){
    time = time.trim(); 
    var militaryTime; 
    var justTime = time.split(" ")[0]; 
    var amOrPm = time.split(" ")[1];

    var hrs = justTime.split(':')[0]; 
    var mins = justTime.split(':')[1];

    if (amOrPm.toLowerCase().trim() == 'pm'){

      hrs = parseInt(hrs) + 12; 

    } 

    return [hrs, mins].join(':'); 


  }




