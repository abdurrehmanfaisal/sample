<?php
include('admin.header.inc.php');

// Check if role ID is provided
if (isset($_GET['roleid'])) {
    $roleid = $_GET['roleid'];
} else {
    echo "No role ID provided";
    exit;
}

// Handle the deletion after confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
    $roleid = $_POST['roleid'];

    // Prepare the SQL statement to prevent SQL injection
    $delete_sql = "DELETE FROM `roles` WHERE `roleid` = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);
    mysqli_stmt_bind_param($stmt, "i", $roleid);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: roles.php');
        exit;
    } else {
        echo "Error deleting role: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Delete Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Roles</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Delete Role</h5>
              <p>Are you sure you want to delete this role?</p>
              <p>Role ID: <?php echo htmlspecialchars($roleid); ?></p>

              <form method="POST" action="">
                  <input type="hidden" name="roleid" value="<?php echo htmlspecialchars($roleid); ?>">
                  <button type="submit" name="confirm" value="yes">Delete</button>
                  <button type="button" onclick="window.location.href='roles.php'">Cancel</button>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php');?>
