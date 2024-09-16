<?php
require("admin.header.inc.php");
$userid = $name = $email = $phone = $username = $password = $cPassword = $genderid = $roleid = '';
$nameErr = $emailErr = $phoneErr = $usernameErr = $passwordErr = '';

$gender_sql = "SELECT * FROM genders";
$genders = mysqli_query($conn, $gender_sql);

$logins_sql = "SELECT * FROM logins";
$logins = mysqli_query($conn, $logins_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["roleid"])) {
        $roleid = '';
    } else {
        $roleid = test_input($_POST["roleid"]);
    }

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["genderid"])) {
        $genderid = '';
    } else {
        $genderid = test_input($_POST["genderid"]);
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "phone number is required";
    } else {
        $phone = test_input($_POST["phone"]);
        // check if e-mail address is well-formed
        if (!preg_match("/^(\+92|0092|0)-?3\d{2}-?\d{7}$/", $phone)) {
            $phoneErr = "Invalid phone format";
        }
    }
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        while ($login = mysqli_fetch_assoc($logins)) {
            if ($login['username'] == $username) {
                $usernameErr = "username is alreay taken! try another";
                break;
            }
        }
    }
    if (empty($_POST['password'])) {
        $passwordErr = "password is required!";
    } elseif (empty($_POST['cPassword'])) {
        $passwordErr = "confirm the password";
    } else {
        $password = test_input($_POST['password']);
        $cPassword = test_input($_POST['cPassword']);
        if ($password !== $cPassword) {
            $passwordErr = "Password miss-matched!";
        }
    }

    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($passwordErr)) {
        $insert_user_sql = "INSERT INTO `users`
         (`name`, `email`, `genderid`, `phone`, `roleid`)
         VALUES
         ('$name', '$email', '$genderid', '$phone', '$roleid')";
        if (mysqli_query($conn, $insert_user_sql)) {
            $userid = mysqli_insert_id($conn);
            $insert_login_sql = "INSERT INTO `logins`
          (`username`,`password`,`userid`)
          VALUES
          ('$username','$password','$userid')";

            if (mysqli_query($conn, $insert_login_sql)) {
                header('LOCATION:login.php');
            }
        }
    }
}
?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Elements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="users.php">Users</a></li>
                <li class="breadcrumb-item active">Add User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADD New User</h5>

                        <!-- ADD New User -->

                        <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            <div class="col-12">
                                <label for="roleid" class="form-label">Select Role</label>
                                <select name="roleid" id="roleid" class="form-control" required>
                                    <option value="1">Admin</option>
                                    <option value="2">Lawyer</option>
                                    <option value="3">Customer</option>
                                </select>
                                <div class="invalid-feedback">Select Role!</div>
                            </div>
                            <div class="col-12">
                                <label for="yourName" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" id="yourName" value="<?php echo $name; ?>" required>
                                <div class="invalid-feedback">Please, enter your name!</div>
                                <div class="text-danger"><?php echo $nameErr ?></div>
                            </div>

                            <div class="col-12">
                                <label for="yourEmail" class="form-label">Your Email</label>
                                <input type="email" name="email" class="form-control" id="yourEmail" value="<?php echo $email; ?>" required>
                                <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                <div class="text-danger"><?php echo $emailErr ?></div>
                            </div>


                            <div class="col-12">
                                <label for="genderid" class="form-label">Select Gender</label>
                                <select name="genderid" id="genderid" class="form-control" required>
                                    <?php while ($gender = mysqli_fetch_assoc($genders)) { ?>
                                        <option value="<?php echo $gender['genderid'] ?>"><?php echo $gender['gender'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">Please enter a valid Date!</div>
                            </div>
                            <!-- 
                    <div class="col-12">
                      <label for="dob" class="form-label">Date of Birth</label>
                      <input type="date" name="dob" class="form-control" id="dob"required>
                      <div class="invalid-feedback">Please enter a valid Date!</div>
                    </div> -->

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone/Cell Number</label>
                                <input type="tel" name="phone" class="form-control" id="phone" placeholder="+92-3XX-XXXXXXX" value="<?php echo $phone; ?>" required>
                                <div class="invalid-feedback">Please enter a valid Phone Number!</div>
                                <div class="text-danger"><?php echo $phoneErr ?></div>
                            </div>


                            <div class="col-12">
                                <label for="yourUsername" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" name="username" class="form-control" id="yourUsername" value="<?php echo $username; ?>" required>
                                    <div class="invalid-feedback">Please choose a username.</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="yourPassword" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="yourPassword" value="<?php echo $password; ?>" required>
                                <div class="invalid-feedback">Please enter your password!</div>
                            </div>

                            <div class="col-12">
                                <label for="cPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="cPassword" class="form-control" id="cPassword" value="<?php echo $cPassword; ?>" required>
                                <div class="invalid-feedback">Please re-enter your password!</div>
                            </div>                            
                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Create Account</button>
                            </div>
                           
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php'); ?>