<?php
include('admin.header.inc.php');

if (!isset($_GET['genderid']) || !is_numeric($_GET['genderid'])) {
    echo "Invalid gender ID provided";
    exit;
}

$genderid = $_GET['genderid'];
$gender_sql = "SELECT * FROM `genders` WHERE `genderid` = ?";
$gender_stmt = $conn->prepare($gender_sql);
$gender_stmt->bind_param("i", $genderid);
$gender_stmt->execute();
$gender_result = $gender_stmt->get_result();
$gender = $gender_result->fetch_assoc();

if ($gender === null) {
    echo "Gender not found";
    exit;
}

if (isset($_POST['submit'])) {
    $gender = $_POST['gender'];

    $update_sql = "UPDATE `genders` SET `gender` = ? WHERE `genderid` = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("si", $gender, $genderid);
    $update_stmt->execute();

    if ($update_stmt->affected_rows > 0) {
        header('Location: gender.php');
        exit;
    } else {
        echo "Error updating gender: " . $conn->error;
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle">
      <h1>Edit gender</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">genders</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit gender</h5>
              <p>Edit gender details:</p>

              <form action="<?php echo $_SERVER['PHP_SELF'] . '?genderid=' . $genderid; ?>" method="post">
                  <input type="hidden" name="genderid" value="<?php echo $genderid; ?>">

                  <div class="form-group">
                      <label for="gender">Gender:</label>
                      <input type="text" class="form-control" id="gender" name="gender" value="<?php echo htmlspecialchars($gender['gender']); ?>">
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary">Update gender</button>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


<?php include('admin.footer.inc.php');?>