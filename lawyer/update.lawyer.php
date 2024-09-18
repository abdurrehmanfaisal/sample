<?php
include('lawyer.header.inc.php');

// Initialize variables
$userid = $name = $email = $dob = $photo = $phone = $address = $username = $password = '';

// Assume the user is logged in, and we have their session ID (Replace this with actual session handling)
// session_start();
$userid = $_SESSION['userid'];  // Assuming session stores the logged-in lawyer's user ID

// Fetch genders from the database
$genders_sql = "SELECT * FROM genders";
$genders_result = mysqli_query($conn, $genders_sql);
$genders = array();
while ($gender = mysqli_fetch_assoc($genders_result)) {
    $genders[] = $gender;
}

// If the request is GET, retrieve lawyer data for editing
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $users_sql = "SELECT *,usr.userid AS usrid,usr.genderid AS gdrid FROM `users` AS `usr`
    LEFT JOIN `genders` AS `gdr` ON usr.genderid = gdr.genderid
    WHERE usr.userid = $userid";
    
    $user = mysqli_fetch_assoc(mysqli_query($conn, $users_sql));
    if($user) {
        $name = mysqli_real_escape_string($conn, $user['name']);
        $email = mysqli_real_escape_string($conn, $user['email']);
        $genderid = mysqli_real_escape_string($conn, $user['gdrid']);
        $dob = mysqli_real_escape_string($conn, $user['dob']);
        $photo = mysqli_real_escape_string($conn, $user['photo']);
        $phone = mysqli_real_escape_string($conn, $user['phone']);
        $address = mysqli_real_escape_string($conn, $user['address']);
        // $username = mysqli_real_escape_string($conn, $user['username']);
        // $password = mysqli_real_escape_string($conn, $user['password']);
    }
}

// If the request is POST, handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, test_input($_POST['name']));
    $email = mysqli_real_escape_string($conn, test_input($_POST['email']));
    $username = mysqli_real_escape_string($conn, test_input($_POST['username']));
    $password = mysqli_real_escape_string($conn, test_input($_POST['password']));
    $phone = mysqli_real_escape_string($conn, test_input($_POST['phone']));
    $dob = mysqli_real_escape_string($conn, test_input($_POST['dob']));
    $address = mysqli_real_escape_string($conn, test_input($_POST['address']));
    $genderid = intval($_POST['genderid']);

    // Handle file upload if exists
    if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $photo = $target_file;
    }

    // Update the user's data in the `users` table
    $update_user_sql = "UPDATE users SET 
        name='$name', email='$email', phone='$phone', dob='$dob', address='$address', 
        genderid='$genderid', photo='$photo' 
        WHERE userid='$userid'";
    mysqli_query($conn, $update_user_sql);

    // Update the login information in the `logins` table
    $update_login_sql = "UPDATE logins SET 
        username='$username', password='$password' 
        WHERE userid='$userid'";
    mysqli_query($conn, $update_login_sql);

    // Redirect to the profile page after submission
    header("Location: lawyer.dashboard.php");
    exit;
}
?>

<main id="main" class="main">
<div class="pagetitle">
  <h1>Edit Profile</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Update Your Profile</h5>

          <!-- Profile Edit Form -->
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

            <div class="row mb-3">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>">
              </div>
            </div>            

            <div class="row mb-3">
              <label for="phone" class="col-sm-2 col-form-label">Phone/Cell</label>
              <div class="col-sm-10">
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="fileToUpload" class="col-sm-2 col-form-label">Profile Picture</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload">
              </div>
            </div>

            <div class="row mb-3">
              <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label for="address" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px" id="address" name="address"><?php echo $address; ?></textarea>
              </div>
            </div>

            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
              <div class="col-sm-10">
                <?php foreach ($genders as $gender) { ?>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="genderid" id="gender<?php echo $gender['genderid']; ?>" value="<?php echo $gender['genderid']; ?>" <?php if ($gender['genderid'] == $genderid) { echo "checked"; } ?>>
                    <label class="form-check-label" for="gender<?php echo $gender['genderid']; ?>">
                      <?php echo $gender['gender']; ?>
                    </label>
                  </div>
                <?php } ?>
              </div>
            </fieldset>

            <div class="row mb-3">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Update Profile</button>
              </div>
            </div>

          </form><!-- End Profile Edit Form -->

        </div>
      </div>

    </div>
  </div>
</section>

</main>

<?php include('lawyer.footer.inc.php'); ?>