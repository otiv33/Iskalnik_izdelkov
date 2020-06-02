/*function mouseInFunc(element){
  //element.css('cursor','pointer');
  element.style.color = "blue";
}

function mouseOutFunc(element){
  element.style.color = "black";
}*/

$(document).ready(function() {

  $( ".card" ).hover(
    function() {
      $(this).addClass('shadow-lg').css('cursor', 'pointer'); 
    }, function() {
      $(this).removeClass('shadow-lg');
    }
  );

   
 // document ready  
 });