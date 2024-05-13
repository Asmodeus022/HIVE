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
});