$(document).ready(function(){
    //focus the .focus input of any madal upon modal open
    $('.modal').on('shown.bs.modal', function () {
        $('.focus').focus()
    });

    $('.welcome').fadeIn(2500).fadeOut(20000);

    //disable all btn-addon
    $(".btn-addon").attr('disabled', 'disabled');

    //initialize all popovers
	  $('[data-toggle="popover"]').popover()

	  //hide input group btn on mobile
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
      // tasks to do if it is a Mobile Device
      $(".input-group").removeClass('input-group');
      $(".input-group-btn").addClass('collapse');
    }
});