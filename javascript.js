/* 
 * All rights reserved. Copyright Robert Roy 2016.
 */
$(document).ready(function () {
    $('.crispbutton').hover(function () {
        $(this).css("background", "#0055ee");
    }, function(){
        $(this).css("background", "");
    });
});

if (!String.prototype.includes) {
    //because ie/opera/safari don't have .includes
    String.prototype.includes = function () {
        'use strict';
        return String.prototype.indexOf.apply(this, arguments) !== -1;
    };
}
;