$(document).ready(function(){
    function showAlertModal(message, type) {
        var alertModal = $('#alertModal');
        alertModal.html(message);
        alertModal.addClass('alert-modal ' + type).show();

        setTimeout(function(){
            location.reload();
        }, 3000);
    }
    

    $('#addEmployeeForm').submit(function(e) {
        e.preventDefault(); 

        var formData = $(this).serialize();

        $.ajax({
            url: '../API/addEmployee.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                showAlertModal(response, "success");
                $('#exampleModal').hide();
            },
            error: function(xhr, status, error) {
                showAlertModal(xhr.responseText, "failed");
                console.error(xhr.responseText);
                // alert('Error occurred. Please try again.');
            }
        });
    });

    $('#updateEmployee').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var employeeId = button.data('employeeid');
        var fullName = button.data('fullname');
        var email = button.data('email');
        var role = button.data('role');

        $('#updateEmployeeFullname').val(fullName);
        $('#updateEmployeeEmail').val(email);
        $('#updateEmployeeRole').val(role);
        $('#selectedEmployeeId').val(employeeId);
    });

    $('#updateEmployeeForm').submit(function(e) {
        e.preventDefault(); 

        var formData = $(this).serialize();
        $('#updateEmployee').show();

        $.ajax({
            url: '../API/updateEmployee.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                showAlertModal(response, "success");
                $('#updateEmployee').hide();
            },
            error: function(xhr, status, error) {
                showAlertModal(error, 'failed');
            }
        });
    });

    $('.deleteEmployee').click(function() {
        var employeeId = $(this).data('employeeid');
        var fullName = $(this).data('fullname');
        var email = $(this).data('email');
        var role = $(this).data('role');

        $('#employeeId').text(employeeId);
        $('#fullName').text(fullName);
        $('#delEmail').text(email);
        $('#role').text(role);

        $('#deleteEmployeeModal').modal('show');

        $('#confirmDeleteEmployee').click(function() {
            $.ajax({
                url: '../API/deleteEmployee.php',
                type: 'POST',
                data: { employeeId: employeeId },
                success: function(response) {
                    showAlertModal(response, 'success');
                    $('#deleteEmployeeModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    showAlertModal(error, 'failed');
                }
            });
        });
    });
});
