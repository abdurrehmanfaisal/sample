<?php
include('admin.header.inc.php');
$appointments_sql = "SELECT * FROM `appointments`";
$appointments = mysqli_query($conn, $appointments_sql);
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Appointments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
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
                        <p><a href="add.appointment.php" type="button" class="btn btn-primary"><i class="ri-add-box-line"></i> Add appointment</a></p>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Appointment</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Lawyer ID</th>
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
                                        <td><?php echo $appointment['lawyerid']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="" type="button" class="btn btn-info">View</a>
                                                <a href="update.appointment.php?appointmentid=<?php echo $appointment['appointmentid']; ?>" type="button" class="btn btn-warning">Edit</a>
                                                <a href="delete.appointment.php?appointmentid=<?php echo $appointment['appointmentid']; ?>" type="button" class="btn btn-danger">Delete</a>
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

<?php include('admin.footer.inc.php'); ?>