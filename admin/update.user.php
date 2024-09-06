<?php 
include('admin.header.inc.php');
$userid = $name = $email = $genderid = $roleid = $dob = $photo = $phone = $address = $username = $password ='';

$genders_sql = "SELECT * FROM genders";
$genders = mysqli_query($conn,$genders_sql);

$roles_sql = "SELECT * FROM roles";
$roles = mysqli_query($conn,$roles_sql);

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userid = test_input($_GET['userid']);
    $users_sql = "SELECT *,usr.userid AS usrid,usr.genderid AS gdrid,usr.roleid AS rolid FROM `users` AS `usr` 
    LEFT JOIN `logins` AS `lgn` ON usr.userid = lgn.userid
    LEFT JOIN `genders` AS `gdr` ON usr.genderid = gdr.genderid
    LEFT JOIN `roles` AS `rol` ON usr.roleid = rol.roleid
    WHERE usr.userid = $userid";

    $user = mysqli_fetch_assoc(mysqli_query($conn,$users_sql));
    $name = mysqli_real_escape_string($conn,$user['name']);
    $email = mysqli_real_escape_string($conn,$user['email']);
    $genderid = mysqli_real_escape_string($conn,$user['gdrid']);
    $roleid = mysqli_real_escape_string($conn,$user['rolid']);
    $dob = mysqli_real_escape_string($conn,$user['dob']);
    $photo = mysqli_real_escape_string($conn,$user['photo']);
    $phone = mysqli_real_escape_string($conn,$user['phone']);
    $address = mysqli_real_escape_string($conn,$user['address']);
    $username = mysqli_real_escape_string($conn,$user['username']);
    $password = mysqli_real_escape_string($conn,$user['password']);
}
?>
<main id="main" class="main">
<div class="pagetitle">
  <h1>Form Elements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin.dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="users.php">Users</a></li>
      <li class="breadcrumb-item active">Update User</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">General Form Elements</h5>

          <!-- General Form Elements -->
          <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
            <label for="userid" class="col-sm-2 col-form-label">User ID</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control-plaintext" id="userid" name="userid" value="<?php echo $userid;?>">
            </div>
            </div>
            <div class="row mb-3">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="username" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $username;?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="password" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password;?>">
              </div>
            </div>            
            <div class="row mb-3">
              <label for="phone" class="col-sm-2 col-form-label">Phone/Cell</label>
              <div class="col-sm-10">
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phone;?>">
              </div>
            </div>
            <div class="row mb-3">
              <label for="fileToUpload" class="col-sm-2 col-form-label">File Upload</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" id="fileToUpload" name="fileToUpload">
              </div>
            </div>
            <div class="row mb-3">
              <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob;?>">
              </div>
            </div>
            
            <div class="row mb-3">
              <label for="address" class="col-sm-2 col-form-label">Address</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px" id="address" name="address"><?php echo $address?></textarea>
              </div>
            </div>
            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
              <div class="col-sm-10">
                <?php while($gender = mysqli_fetch_assoc($genders)) {?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="genderid" id="<?php echo $gender['gender'];?>" value="<?php echo $gender['genderid'];?>" <?php if($gender['genderid'] == $genderid){echo "checked";}?>>
                        <label class="form-check-label" for="">
                            <?php echo $gender['gender'];?>
                        </label>
                    </div>
                <?php }?>
                
              </div>
            </fieldset>            

            <div class="row mb-3">
            <label for="roleid" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select name="roleid" id="roleid" class="form-select">
                    <?php while($role = mysqli_fetch_assoc($roles)){?>
                        <option value="<?php echo $role['roleid']?>" <?php if($role['roleid'] == $roleid){echo "selected";}?>><?php echo $role['role']?></option>
                        <?php }?>
                    </select>
                </div>
            </div>

            

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit Form</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>
    </div> 
  </div>
</section>

</main><!-- End #main -->


<?php include('admin.footer.inc.php');?>