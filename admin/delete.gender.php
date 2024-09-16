<?php
include('admin.header.inc.php');

// Check if role ID is provided
if (isset($_GET['genderid'])) {
    $genderid = $_GET['genderid'];
} else {
    echo "No role ID provided";
    exit;
}

// Handle the deletion after confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $genderid = $_POST['genderid'];

    // Prepare the SQL statement to prevent SQL injection
    $delete_sql = "DELETE FROM `genders` WHERE `genderid` = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $genderid);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: gender.php');
        exit;
    } else {
        echo "Error deleting gender: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Delete Gender</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="gender.php">Genders</a></li>
          <li class="breadcrumb-item active">Deleter Gender</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Delete Gender</h5>
              <p>Are you sure you want to delete this gender?</p>
              <p>Gender ID: <?php echo htmlspecialchars($genderid); ?></p>

              <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
                  <input type="hidden" name="genderid" value="<?php echo htmlspecialchars($genderid); ?>">
                  <button type="submit" name="confirm" value="yes">Delete</button>
                  <button type="button" onclick="window.location.href='gender.php'">Cancel</button>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php');?>
