<h1>Reset Password</h1>
<form id="reset-password-form" method="POST">
    <input type="" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
    <div>
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" required>
    </div>
    <div>
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
    </div>
    <button type="submit">Reset Password</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#reset-password-form').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'reset_password_process.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', 'Your password has been reset.', 'success');
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });
});
</script>
