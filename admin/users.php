<?php 
include('admin.header.inc.php');

$users_sql = "SELECT *,usr.userid AS usrid,usr.genderid AS gdrid,usr.roleid AS rolid FROM `users` AS `usr` 
LEFT JOIN `logins` AS `lgn` ON usr.userid = lgn.userid
LEFT JOIN `genders` AS `gdr` ON usr.genderid = gdr.genderid
LEFT JOIN `roles` AS `rol` ON usr.roleid = rol.roleid";

$users = mysqli_query($conn,$users_sql);
?>
<main id="main" class="main">
    <div class="pagetitle">
      <h1>All Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">All Users</h5>
              <p><a href="add.user.php" type="button" class="btn btn-primary"><i class="ri-add-box-line"></i> Add User</a></p>

              <!-- Table with stripped rows -->
              <div class="table-responsive">

                  <table class="table datatable">
                      <thead>
                          <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Gender</th>
                              <th scope="col">Date of Birth</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">Username</th>
                              <th scope="col">Password</th>
                              <th scope="col">Role</th>
                              <th scope="col">Photo</th>
                              <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>                    
                            <?php $cnt = 1; while($user = mysqli_fetch_assoc($users)) {?>
                                <tr>
                                    <th scope="row"><?php echo $cnt;?></th>
                                    <td><?php echo $user['name']?></td>
                                    <td><?php echo $user['email']?></td>
                                    <td><?php echo $user['gender']?></td>
                                    <td><?php echo $user['dob']?></td>
                                    <td><?php echo $user['address']?></td>
                                    <td><?php echo $user['phone']?></td>
                                    <td><?php echo $user['username']?></td>
                                    <td><?php echo $user['password']?></td>
                                    <td><?php echo $user['role']?></td>
                                    <td><img src="<?php echo $user['photo']?>" alt="<?php echo $user['name']?>"></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="" type="button" class="btn btn-info">View</a>
                                            <a href="update.user.php?userid=<?php echo $user['usrid'];?>" type="button" class="btn btn-warning">Edit</a>
                                            <a href="delete.user.php?userid=<?php echo $user['usrid'];?>" type="button" class="btn btn-danger">Delete</a>
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