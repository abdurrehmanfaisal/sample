<?php
include('admin.header.inc.php');

if (isset($_GET['roleid'])) {
    $roleid = $_GET['roleid'];
    $role_sql = "SELECT * FROM `roles` WHERE `roleid` = '$roleid'";
    $role_query = mysqli_query($conn, $role_sql);
    $role = mysqli_fetch_assoc($role_query);
} else {
    echo "No role ID provided";
    exit;
}

if (isset($_POST['submit'])) {
    $roleid = $_POST['roleid'];
    $role = $_POST['role'];

    $update_sql = "UPDATE `roles` SET `role` = '$role' WHERE `roleid` = '$roleid'";
    $update_query = mysqli_query($conn, $update_sql);

    if ($update_query) {
        header('Location: roles.php');
        exit;
    } else {
        echo "Error updating role: " . mysqli_error($conn);
    }
}

?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit Role</h1>
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
              <h5 class="card-title">Edit Role</h5>
              <p>Edit role details:</p>

              <form action="" method="post">
                  <input type="hidden" name="roleid" value="<?php echo $roleid; ?>">

                  <div class="form-group">
                      <label for="role">Role:</label>
                      <input type="text" class="form-control" id="role" name="role" value="<?php echo $role['role']; ?>">
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary">Update Role</button>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


<?php include('admin.footer.inc.php');?>