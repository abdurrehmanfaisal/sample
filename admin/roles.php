<?php
include('admin.header.inc.php');

$roles_sql = "SELECT * FROM `roles`";
$roles = mysqli_query($conn, $roles_sql);
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>All Roles</h1>
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
              <h5 class="card-title">All Roles</h5>
              <p><a href="add.role.php" type="button" class="btn btn-primary"><i class="ri-add-box-line"></i> Add Role</a></p>

              <!-- Table with stripped rows -->
              <div class="table-responsive">

                  <table class="table datatable">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Role ID</th>
                              <th scope="col">Role</th>
                              <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            <?php $cnt = 1; while($role = mysqli_fetch_assoc($roles)) {?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php echo $role['roleid']?></td>
                                    <td><?php echo $role['role']?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="" type="button" class="btn btn-info">View</a>
                                            <a href="update.role.php?roleid=<?php echo $role['roleid'];?>" type="button" class="btn btn-warning">Edit</a>
                                            <a href="delete.role.php?roleid=<?php echo $role['roleid'];?>" type="button" class="btn btn-danger">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $cnt ++;}?>
                            </tbody>
                        </table>
                    </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


<?php include('admin.footer.inc.php');?>