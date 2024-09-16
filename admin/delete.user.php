<?php
include('admin.header.inc.php');

// Check if user ID is provided
if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
} else {
    echo "No user ID provided";
    exit;
}

// Handle the deletion after confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $userid = $_POST['userid'];

    // Prepare the SQL statement to prevent SQL injection
    $delete_sql = "DELETE FROM `users` WHERE `userid` = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $userid);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: users.php');
        exit;
    } else {
        echo "Error deleting user: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Delete User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Delete User</h5>
              <p>Are you sure you want to delete this user?</p>
              <p>User ID: <?php echo htmlspecialchars($userid); ?></p>

              <form method="POST" action="">
                  <input type="hidden" name="userid" value="<?php echo htmlspecialchars($userid); ?>">
                  <button type="submit" name="confirm" value="yes">Delete</button>
                  <button type="button" onclick="window.location.href='users.php'">Cancel</button>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php');?>