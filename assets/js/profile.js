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
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error occurred. Please try again.');
            }
        });
    });

    $('#updateEmployee').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var employeeId = button.data('employeeid');
        var username = button.data('username');
        var role = button.data('role');

        $('#updateUsername').val(username);
        $('#updateEmployeeRole').val(role);
        $('#selectedEmployeeId').val(employeeId);
    });

    $('#updateEmployeeForm').submit(function(e) {
        e.preventDefault(); 

        var formData = $(this).serialize();

        $.ajax({
            url: '../API/updateEmployee.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error occurred. Please try again.');
            }
        });
    });

    $(document).on('click', '.deleteEmployee', function() {
        var employeeId = $(this).data('employeeid');

        if (confirm("Are you sure you want to delete this employee?")) {
            $.ajax({
                url: '../API/deleteEmployee.php',
                type: 'POST',
                data: { employeeId: employeeId },
                success: function(response) {
                    alert(response);
                    location.reload();
                    // if (response == "success") {
                    //     $(this).closest('tr').remove();
                    // } else {
                    //     alert("Failed to delete employee.");
                    // }
                },
                error: function() {
                    // Show error message
                    alert("An error occurred while processing your request.");
                }
            });
        }
    });
});