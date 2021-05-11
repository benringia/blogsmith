

   
  $(document).ready(function () {
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );

    //check all checkbox
    $('#selectAllBoxes').click(function() {
      if(this.checked) {
        $('.checkBoxes').each(function() {
           this.checked = true;
        });
      } else {
        $('.checkBoxes').each(function() {
          this.checked = false;
       });
      }
    })

    //loader
    // const divBox = "<div id='load-screen'><div id='loading'></div</div>";

    // $("body").prepend(divBox);
    // $('#load-screen').delay(700).fadeOut(600, function() {
    //   $(this).remove();
    // })

  
  })
  function loadUsersOnline() {
 
 
    $.get("includes/functions.php?onlineusers=result", function (data) {
      
      $(".usersonline").text(data);
   
   
    });
   
   
   
  }
  setInterval ( () => {
    loadUsersOnline();
  }, 500)
  