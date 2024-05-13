$(document).ready(function(){
    $('#addEmployeeForm').submit(function(e) {
        e.preventDefault(); 

        var formData = $(this).serialize();

        $.ajax({
            url: '../API/addEmployee.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error occurred. Please try again.');
            }
        });
    });








    $('#updateEmployee').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var username = button.data('username'); // Extract username from data-username attribute
        var role = button.data('role'); // Extract role from data-role attribute

        // Update modal fields with employee's current data
        $('#updateUsername').val(username);
        $('#updateEmployeeRole').val(role);
    });
});
