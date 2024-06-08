

// sign up as patient function 
$(document).ready(function() {
  $("#signup-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
      url: "php/signup_process.php",
      method: "POST",
      data: $(this).serialize(),
      success: function(data) {
        console.log(data); // Log the returned data
         // Show success message with SweetAlert2
         Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Successfully registered.',
            timer: 5000, // Close alert after 5 seconds
            showConfirmButton: false
        }).then((result) => {
            // Redirect to another page after 2 seconds
            if (result.dismiss === Swal.DismissReason.timer) {
                window.location.href = "login.php";
            }
        });
    }   
    });
  });
});

