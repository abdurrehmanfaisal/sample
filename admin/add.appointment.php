<?php
require("admin.header.inc.php");
$appointment = $date = $time =$customerid = $lawyerid = '';
$appointmentErr = $dateErr = $timeErr = $customeridErr = $lawyeridErr = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["appointmentid"])) {
        $appointmentErr = "appointment is required";
    } else {
        $appointment = test_input($_POST["appointmentid"]);        
        $appointments_sql = "SELECT appointment FROM appointments";
        $appointments = mysqli_query($conn,$appointments_sql);
        
        // while($loc = mysqli_fetch_assoc($appointments)) {
        //     if($loc['appointment'] == $appointment) {
        //         $appointmentErr = "appointment already exist";
        //     }
        // }
    }

    if (empty($appointmentErr) && empty($dateErr) && empty($timeErr) && empty($customeridErr) && empty($lawyeridErr)) {
        $insert_apppointment_sql = "INSERT INTO `appointments`
         (`appointmentid`, `date`, `time`, `customerid`, `lawyerid`)
         VALUES
         ('$appointment', '$date', '$time', '$customerid', '$lawyerid')";
         
         if (mysqli_query($conn, $insert_apppointment_sql)) {
                header('LOCATION: appointments.php');
            }
        }
    }

?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="appointments.php">appointments</a></li>
                <li class="breadcrumb-item active">Add appointment</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADD appointment</h5>

                        <!-- ADD New Location -->

                        <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            
                            <div class="col-12">
                                <label for="yourName" class="form-label">Appointment ID</label>
                                <input type="text" name="appointment" class="form-control" id="yourName" value="<?php echo $appointment; ?>" required>
                                <div class="invalid-feedback">Please, enter appointment!</div>
                                <div class="text-danger"><?php echo $appointmentErr ?></div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Date</label>
                                <input type="text" name="appointment" class="form-control" id="yourName" value="<?php echo $date; ?>" required>
                                <div class="invalid-feedback">Please, enter Date!</div>
                                <div class="text-danger"><?php echo $dateErr ?></div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Time</label>
                                <input type="text" name="appointment" class="form-control" id="yourName" value="<?php echo $time; ?>" required>
                                <div class="invalid-feedback">Please, enter Time!</div>
                                <div class="text-danger"><?php echo $timeErr ?></div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Customer ID</label>
                                <input type="text" name="appointment" class="form-control" id="yourName" value="<?php echo $customerid; ?>" required>
                                <div class="invalid-feedback">Please, enter Customer ID!</div>
                                <div class="text-danger"><?php echo $customeridErr ?></div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Lawyer ID</label>
                                <input type="text" name="appointment" class="form-control" id="yourName" value="<?php echo $appointment; ?>" required>
                                <div class="invalid-feedback">Please, enter Lawyer ID!</div>
                                <div class="text-danger"><?php echo $lawyeridErr ?></div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </div>
                           
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php'); ?>