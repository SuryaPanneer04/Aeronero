"use strict";

//console.log('JS Page Working')

$('.chkAll').click(function() {  //Select All / Deselect All Checkbox.
 
    if (this.checked) {
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
       $(':checkbox').each(function() {
            this.checked = false;                        
        });
    } 

 });
