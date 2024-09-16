<?php
require("admin.header.inc.php");
// $appointments = '';
// $appointmentErr = '';



// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
//     if (empty($_POST["appointment"])) {
//         $appointmentErr = "appointment is required";
//     } else {
//         $appointments = test_input($_POST["appointment"]);        
//         $appointments_sql = "SELECT appointmentid FROM `appointments`";
//         $appointments = mysqli_query($conn,$appointments_sql);
        
//         while($loc = mysqli_fetch_assoc($appointments)) {
//             if($loc['appointment'] == $appointments) {
//                 $appointmentErr = "appointment already exist";
//             }
//         }
//     }

//     if (empty($appointmentErr)) {
//         $insert_appointments_sql = "INSERT INTO `appointments`
//          (`appointment`)
//          VALUES
//          ('$appointments')";
//         if (mysqli_query($conn, $insert_appointments_sql)) {
            
//             header('LOCATION:appointments.php');
            
//         }
//     }
// }

// Initialize variables
$appointments = '';
$appointmentErr = '';

// Connect to database
$conn = mysqli_connect("appoinmentid", "date", "time", "customerid","lawyerid");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate appointment field
    if (empty($_POST["appointment"])) {
        $appointmentErr = "Appointment is required";
    } else {
        $appointments = test_input($_POST["appointment"]);

        // Check if appointment already exists
        $stmt = $conn->prepare("SELECT appointmentid FROM appointments WHERE appointment = ?");
        $appointment_param = $appointments; // Create a reference variable
        $stmt->bind_param("s", $appointment_param); // Bind the reference variable
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $appointmentErr = "Appointment already exists";
        } else {
            // Insert new appointment
            $stmt = $conn->prepare("INSERT INTO appointments (appointment) VALUES (?)");
            $appointment_param = $appointments; // Create a reference variable
            $stmt->bind_param("s", $appointment_param); // Bind the reference variable
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header('LOCATION: appointments.php');
                exit;
            }
        }
    }
}

// Function to sanitize user input
// function test_input($data) {
//     $data = trim($data);
//     $data = stripslashes($data);
//     $data = htmlspecialchars($data);
//     return $data;
// }
// ?>

?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="appointment.php">appointments</a></li>
                <li class="breadcrumb-item active">Add Appointments!</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Appointments!</h5>

                        <!-- ADD New Location -->

                        <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            
                            <div class="col-12">
                                <label for="yourName" class="form-label">appointment</label>
                                <input type="text" name="appointment" class="form-control" id="yourName" value="<?php echo $appointments; ?>" required>
                                <div class="invalid-feedback">Please, enter appointments!</div>
                                <div class="text-danger"><?php echo $appointmentErr ?></div>
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