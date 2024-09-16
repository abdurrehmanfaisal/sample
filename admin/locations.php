<?php
include('admin.header.inc.php');
$locations_sql = "SELECT * FROM locations";
$locations = mysqli_query($conn, $locations_sql);
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Locations</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Locations</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Locations</h5>
                        <p><a href="add.location.php" type="button" class="btn btn-primary"><i class="ri-add-box-line"></i> Add Location</a></p>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Location ID</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                while ($location = mysqli_fetch_assoc($locations)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $srno; ?></th>
                                        <td><?php echo $location['locationid']; ?></td>
                                        <td><?php echo $location['location']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="" type="button" class="btn btn-info">View</a>
                                                <a href="update.location.php?locationid=<?php echo $user['locationid']; ?>" type="button" class="btn btn-warning">Edit</a>
                                                <a href="delete.location.php?locationid=<?php echo $user['locationid']; ?>" type="button" class="btn btn-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $srno++;
                                } ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php include('admin.footer.inc.php'); ?>