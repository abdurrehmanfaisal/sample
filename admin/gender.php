<?php
include('admin.header.inc.php');
$genders_sql = "SELECT * FROM `genders`";
$genders = mysqli_query($conn, $genders_sql);
?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>All Genders</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Genders</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Genders</h5>
                        <p><a href="add.gender.php" type="button" class="btn btn-primary"><i class="ri-add-box-line"></i> Add Gender</a></p>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Gender ID</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $srno = 1;
                                while ($gender = mysqli_fetch_assoc($genders)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $srno; ?></th>
                                        <td><?php echo $gender['genderid']; ?></td>
                                        <td><?php echo $gender['gender']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                                <a href="" type="button" class="btn btn-info">View</a>
                                                <a href="update.gender.php?genderid=<?php echo $gender['genderid']; ?>" type="button" class="btn btn-warning">Edit</a>
                                                <a href="delete.gender.php?genderid=<?php echo $gender['genderid']; ?>" type="button" class="btn btn-danger">Delete</a>
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