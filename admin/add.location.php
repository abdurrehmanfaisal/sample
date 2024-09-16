<?php
require("admin.header.inc.php");
$location = '';
$locationErr = '';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["location"])) {
        $locationErr = "location is required";
    } else {
        $location = test_input($_POST["location"]);        
        $locations_sql = "SELECT location FROM locations";
        $locations = mysqli_query($conn,$locations_sql);
        
        while($loc = mysqli_fetch_assoc($locations)) {
            if($loc['location'] == $location) {
                $locationErr = "location already exist";
            }
        }
    }

    if (empty($locationErr)) {
        $insert_location_sql = "INSERT INTO `locations`
         (`location`)
         VALUES
         ('$location')";
        if (mysqli_query($conn, $insert_location_sql)) {
            
            header('LOCATION:locations.php');
            
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
                <li class="breadcrumb-item"><a href="locations.php">Locations</a></li>
                <li class="breadcrumb-item active">Add Location</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">ADD New Location</h5>

                        <!-- ADD New Location -->

                        <form class="row g-3 needs-validation" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                            
                            <div class="col-12">
                                <label for="yourName" class="form-label">Location</label>
                                <input type="text" name="location" class="form-control" id="yourName" value="<?php echo $location; ?>" required>
                                <div class="invalid-feedback">Please, enter location!</div>
                                <div class="text-danger"><?php echo $locationErr ?></div>
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