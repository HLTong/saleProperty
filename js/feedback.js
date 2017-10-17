
            $(document).ready(function() {
                
               var availableConsoles = [
                 "Woodland",
                 "Punggol",
                 "Ang Mo Kio",
                 "SengKang",
                 "Jurong East"
             ];
             $("#id_area").autocomplete({
                   source: availableConsoles
             });
             
             
              $("#id_last_visit").datepicker({minDate: "-3M -10D",  maxDate: "-1"});
              
              
              
              
                 $.fn.raty.defaults.path = 'js/img';

                $('#target-text-demo').raty({
                    cancel: false,
                    scoreName: 'rate_us',
                    number: 5,  //change to 5
                    score: 2
                });
                           });  
