<?php
include('admin.header.inc.php');

// Check if role ID is provided
if (isset($_GET['appointmentid'])) {
    $appointmentid = $_GET['appointmentid'];
} else {
    echo "No role ID provided";
    exit;
}

// Handle the deletion after confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $appointmentid = $_POST['appointmentid'];

    // Prepare the SQL statement to prevent SQL injection
    $delete_sql = "DELETE FROM `appointments` WHERE `appointmentid` = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $appointmentid);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: appointments.php');
        exit;
    } else {
        echo "Error deleting appointment: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Delete appointment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="appointments.php">appointments</a></li>
          <li class="breadcrumb-item active">Deleter appointment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Delete appointment</h5>
              <p>Are you sure you want to delete this appointment?</p>
              <p>appointment ID: <?php echo htmlspecialchars($appointmentid); ?></p>

              <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
                  <input type="hidden" name="appointmentid" value="<?php echo htmlspecialchars($appointmentid); ?>">
                  <button type="submit" name="confirm" value="yes">Delete</button>
                  <button type="button" onclick="window.location.href='appointments.php'">Cancel</button>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php');?>