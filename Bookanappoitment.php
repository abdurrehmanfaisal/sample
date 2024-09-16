<?php
require("connection.inc.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = test_input($_POST["date"]);
  $time = test_input($_POST["time"]);
  $customerid = test_input($_POST["customerid"]);
  $lawyerid = test_input($_POST["lawyerid"]);

  // Validate input
  if (empty($date) || empty($time) || empty($customerid) || empty($lawyerid)) {
    $error = "Please fill in all fields";
  } else {
    // Check if customerid and lawyerid exist in users table
    $user_sql = "SELECT userid FROM users WHERE userid IN ($customerid, $lawyerid)";
    $user_result = mysqli_query($conn, $user_sql);
    if (mysqli_num_rows($user_result) == 2) {
      // Insert into appointments table
      $insert_appointment_sql = "INSERT INTO appointments (date, time, customerid, lawyerid) VALUES ('$date', '$time', '$customerid', '$lawyerid')";
      if (mysqli_query($conn, $insert_appointment_sql)) {
        $appointmentid = mysqli_insert_id($conn);
        header('LOCATION:appointment_success.php');
      } else {
        $error = "Error inserting into database";
      }
    } else {
      $error = "Invalid customerid or lawyerid";
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book an Appointment</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <h5 class="card-title text-center pb-0 fs-4">Book an Appointment</h5>
                  <p class="text-center small">Please fill in the form below to book an appointment</p>
                  <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $error; ?>
                    </div>
                  <?php } ?>
                  <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" novalidate>
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
                      <label for="customerid" class="form-label">Customer</label>
                      <select name="customerid" id="customerid" class="form-control" required>
                        <?php while ($user = mysqli_fetch_assoc($users)) { ?>
                          <option value="<?php echo $user['userid']; ?>"><?php echo $user['name']; ?></option>
                        <?php } ?>
                      </select>
                      <div class="invalid-feedback">Please select a customer</div>
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
                      <button class="btn btn-primary w-100" type="submit">Book Appointment</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</body>
</html>