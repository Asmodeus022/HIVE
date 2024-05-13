<?php
    session_start();
    @include "../includes/database.php";
    @include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="row p-0 m-0" style="height: 100vh; overflow: hidden">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                    <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="addEmployeeForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name='employeeUsername' id="username" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name='password' id="password" placeholder="" required>
                        </div>
                        <select class="form-select" name="employeeRole" id="employeeRole" aria-label="Default select example" required>
                            <option selected>Select Role</option>
                            <option value="CASHIER">Cashier</option>
                            <option value="SALES_STAFF">Sales Staff</option>
                            <option value="MARKETING_STAFF">Marketing Staff</option>
                            <option value="SOCIAL_MEDIA_MANAGER">Social Media Manager</option>
                        </select>

                        <div class='d-flex justify-content-end mt-5'>
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
                    <button type="button" class="btn-close me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="updateEmployeeForm">
                        <div class="mb-3">
                            <label for="updateUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" name='updateEmployeeUsername' id="updateUsername" placeholder="" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name='updatePassword' id="updatePassword" placeholder="Set new password" required>
                        </div>
                        <select class="form-select" name="updateEmployeeRole" id="updateEmployeeRole" aria-label="Default select example" required>
                            <option selected>Select Role</option>
                            <option value="CASHIER">Cashier</option>
                            <option value="SALES_STAFF">Sales Staff</option>
                            <option value="MARKETING_STAFF">Marketing Staff</option>
                            <option value="SOCIAL_MEDIA_MANAGER">Social Media Manager</option>
                        </select>
                        <input type='hidden' name="selectedEmployeeId" id="selectedEmployeeId">
                        <div class='d-flex justify-content-end mt-5'>
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
        </div>
        <div class="col-1 h-100" style="min-width: 100px">
            <?php include '../components/sidebar.php'; ?>
        </div>
        <div class="col">
            <div class="row p-3">
                <h3 class=" mb-4">Profile</h3>
                <h4 class="">Details</h4>
                <Table class='table '>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Company Name</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ownerId = $_SESSION['ownerId'];
                            $query = "SELECT * FROM owners WHERE Id = '$ownerId'";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $owner = mysqli_fetch_assoc($result);
                                
                                echo "<tr>";
                                echo "<td>" . $owner['Username'] . "</td>";
                                echo "<td>" . $owner['Email'] . "</td>";
                                echo "<td>" . $owner['Company_Name'] . "</td>";
                                echo "<td>" . $owner['Location'] . "</td>";
                                echo "<td>" . $owner['Category'] . "</td>";
                                echo "<td>" . $owner['Business_Size'] . "</td>";
                                echo "</tr>";
                            } else {
                                echo "<tr><td colspan='6'>No data found</td></tr>";
                            }
                        ?>
                    </tbody>
                </Table>

                <div class='d-flex justify-content-end mt-4'>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Employe</button>
                </div>

                <h4 class="">Employee</h4>
                <Table class='table '>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Added Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ownerId = $_SESSION['ownerId'];
                            $query = "SELECT * FROM employees WHERE Owner_Id = '$ownerId'";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($employee = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $employee['Username'] . "</td>";
                                    echo "<td>" . $employee['Role'] . "</td>";
                                    echo "<td>" . $employee['Added_Date'] . "</td>";
                                    echo "<td>
                                            <div class='d-flex justify-content-center'>
                                                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#updateEmployee' data-employeeid='" . $employee['Id'] . "'  data-username='" . $employee['Username'] . "' data-role='" . $employee['Role'] . "'>Edit</button>
                                                <button type='button' class='btn btn-danger deleteEmployee' data-employeeid='" . $employee['Id'] . "'>Delete</button>
                                            </div>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='12' class='text-center'>No employees found</td></tr>";
                            }
?>
                    </tbody>
                </Table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../assets/js/profile.js"></script>
</body>
</html>