<?php
require("admin.header.inc.php");
$role = '';
$roleErr = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["role"])) {
        $roleErr = "role is required";
    } else {
        $role = test_input($_POST["role"]);        
        $roles_sql = "SELECT role FROM roles";
        $roles = mysqli_query($conn,$roles_sql);
        
        while($loc = mysqli_fetch_assoc($roles)) {
            if($loc['role'] == $role) {
                $roleErr = "role already exist";
            }
        }
    }

    if (empty($roleErr)) {
        $insert_role_sql = "INSERT INTO `roles`
         (`role`)
         VALUES
         ('$role')";
        if (mysqli_query($conn, $insert_role_sql)) {
            
            header('LOCATION:roles.php');
            
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
                <li class="breadcrumb-item"><a href="role.php">roles</a></li>
                <li class="breadcrumb-item active">Add role</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADD role</h5>

                        <!-- ADD New Location -->

                        <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            
                            <div class="col-12">
                                <label for="yourName" class="form-label">role</label>
                                <input type="text" name="role" class="form-control" id="yourName" value="<?php echo $role; ?>" required>
                                <div class="invalid-feedback">Please, enter role!</div>
                                <div class="text-danger"><?php echo $roleErr ?></div>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary w-100" type="submit">Submit</button>
                            </div>
                           
                        </form>

                    </div>
                </div>

            </div>

        </div>

    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php'); ?>