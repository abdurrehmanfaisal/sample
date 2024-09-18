<?php
include('customer.header.inc.php');

// Get the customer ID from the session
$customerid = $_SESSION['userid'];

// Prepare the SQL query to retrieve appointments
$appointments_sql = "
    SELECT 
        app.appointmentid,
        app.date,
        app.time,
        app.status,
        cus.name AS CustomerName
    FROM 
        appointments AS app
    JOIN 
        users AS cus ON app.customerid = cus.userid
    WHERE 
        app.customerid = ?
";

// Prepare the statement
$stmt = $conn->prepare($appointments_sql);

// Bind the customer ID parameter
$stmt->bind_param("i", $customerid);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if there are any appointments
if ($result->num_rows > 0) {
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
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Appointment</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $srno = 1;
                                    while ($appointment = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $srno; ?></th>
                                            <td><?php echo $appointment['appointmentid']; ?></td>
                                            <td><?php echo $appointment['date']; ?></td>
                                            <td><?php echo $appointment['time']; ?></td>
                                            <td><?php echo $appointment['CustomerName']; ?></td>                                            
                                            <td>
                                                <?php
                                                if ($appointment['status'] == 1) {
                                                    echo "Approved";
                                                } else {
                                                    echo "Pending";
                                                }
                                                ?>
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
<?php
} else {
    echo "No appointments found.";
}

include('customer.footer.inc.php');
?>