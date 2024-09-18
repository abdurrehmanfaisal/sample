<?php
require('connection.inc.php');
$userid = $_SESSION['userid'];
$appointmentError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = test_input($_POST["date"]);
  $time = test_input($_POST["time"]);
  $lawyerid = test_input($_POST["lawyerid"]);

  // Validate input
  if (empty($date) || empty($time) || empty($lawyerid)) {
    $appointmentError = "Please fill in all fields";
  } else {
    // Check if lawyerid exists in users table
    $user_sql = "SELECT userid FROM users WHERE userid = '$lawyerid'";
    $user_result = mysqli_query($conn, $user_sql);
    if (mysqli_num_rows($user_result) == 1) {
      // Insert into appointments table
      $insert_appointment_sql = "INSERT INTO appointments (date, time, customerid, lawyerid) VALUES ('$date', '$time', '$userid', '$lawyerid')";
      if (mysqli_query($conn, $insert_appointment_sql)) {
        $appointmentid = mysqli_insert_id($conn);
        header('LOCATION: ../customer.dashboard.php');
      } else {
        $appointmentError = "Error inserting into database";
      }
    } else {
      $appointmentError = "Invalid lawyerid";
    }
  }
}

// Get list of users for dropdowns
$users_sql = "SELECT * FROM users";
$users = mysqli_query($conn, $users_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Book an Appointment - Lawyer Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="#" alt="">
                  <span class="d-none d-lg-block">Lawyer Management System</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Book an Appointment</h5>
                    <p class="text-center small">Please fill in the form below to book an appointment</p>
                  </div>

                  <form accept="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="date" class="form-label">Date</label>
                      <input type="date" name="date" class="form-control" id="date" required>
                      <div class="invalid-feedback">Please enter a valid date</div>
                    </div>

                    <div class="col-12">
                      <label for="time" class="form-label">Time</label>
                      <input type="time" name="time" class="form-control" id="time" required>
                      <div class="invalid-feedback">Please enter a valid time</div>
                    </div>

                    <div class="col-12">
                      <label for="lawyerid" class="form-label">Lawyer</label>
                      <select name="lawyerid" id="lawyerid" class="form-control" required>
                        <?php while ($user = mysqli_fetch_assoc($users)) { ?>
                          <option value="<?php echo $user['userid']; ?>"><?php echo $user['name']; ?></option>
                        <?php } ?>
                      </select>
                      <div class="invalid-feedback">Please select a lawyer</div>
                    </div>

                    <div class="col-12">
                      <span class="text-danger"><?php echo $appointmentError;?></span>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Book Appointment</button>
                    </div>

                  </form>

                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by @LMS
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>