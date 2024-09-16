<?php
require("admin.header.inc.php");
$gender = '';
$genderErr = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["gender"])) {
        $genderErr = "gender is required";
    } else {
        $gender = test_input($_POST["gender"]);        
        $genders_sql = "SELECT gender FROM genders";
        $genders = mysqli_query($conn,$genders_sql);
        
        while($loc = mysqli_fetch_assoc($genders)) {
            if($loc['gender'] == $gender) {
                $genderErr = "gender already exist";
            }
        }
    }

    if (empty($genderErr)) {
        $insert_gender_sql = "INSERT INTO `genders`
         (`gender`)
         VALUES
         ('$gender')";
        if (mysqli_query($conn, $insert_gender_sql)) {
            
            header('LOCATION:gender.php');
            
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
                <li class="breadcrumb-item"><a href="gender.php">Genders</a></li>
                <li class="breadcrumb-item active">Add Gender</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADD Gender</h5>

                        <!-- ADD New Location -->

                        <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            
                            <div class="col-12">
                                <label for="yourName" class="form-label">gender</label>
                                <input type="text" name="gender" class="form-control" id="yourName" value="<?php echo $gender; ?>" required>
                                <div class="invalid-feedback">Please, enter gender!</div>
                                <div class="text-danger"><?php echo $genderErr ?></div>
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