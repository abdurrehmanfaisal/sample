<?php
include('lawyer.header.inc.php');
$lawyerid = $_SESSION['userid'];
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['flag']) && isset($_GET['appointmentid'])) {
    $flag = test_input($_GET['flag']);
    $appointmentid = test_input($_GET['appointmentid']);
    $status_sql = "UPDATE `appointments` 
    SET `status` = '$flag' 
    WHERE `appointments`.`appointmentid` = '$appointmentid'";
    mysqli_query($conn,$status_sql);
}
$appointments_sql = "SELECT *,
       cus.name AS CustomerName,
       law.name AS LawyerName
FROM `appointments` AS app
JOIN `users` AS cus ON app.customerid = cus.userid
JOIN `users` AS law ON app.lawyerid = law.userid
WHERE app.lawyerid = '$lawyerid'";
$appointments = mysqli_query($conn, $appointments_sql);
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Appointments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="lawyer.dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Appointments</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All appointments</h5>
                        <!-- <p><a href="add.appointment.php" type="button" class="btn btn-primary"><i class="ri-add-box-line"></i> Add appointment</a></p> -->
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Appointment</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Lawyer ID</th>
                                    <th scope="col">Lawyer Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                while ($appointment = mysqli_fetch_assoc($appointments)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $srno; ?></th>
                                        <td><?php echo $appointment['appointmentid']; ?></td>
                                        <td><?php echo $appointment['date']; ?></td>
                                        <td><?php echo $appointment['time']; ?></td>
                                        <td><?php echo $appointment['customerid']; ?></td>
                                        <td><?php echo $appointment['CustomerName']; ?></td>
                                        <td><?php echo $appointment['lawyerid']; ?></td>
                                        <td><?php echo $appointment['LawyerName']; ?></td>
                                        <td>
                                            <?php
                                            if($appointment['status'] == 1) {
                                                echo "Approved";
                                            }else {
                                                echo "Pending";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">                                                
                                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?flag=1&appointmentid='.$appointment['appointmentid']?>" type="button" class="btn btn-success">Approve</a>
                                                <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?flag=0&appointmentid='.$appointment['appointmentid']?>" type="button" class="btn btn-danger">Reject</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $srno++;
                                } ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php include('lawyer.footer.inc.php'); ?>