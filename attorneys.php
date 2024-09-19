<?php
include('header.inc.php');
$att_sql = "SELECT * FROM `users` AS usr 
LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
WHERE roleid = 2";
$attorneys = mysqli_query($conn,$att_sql);
?>

<!-- Page Header Start -->
<div class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Attorneys</h2>
      </div>
      <div class="col-12">
        <a href="index.php">Home</a>
        <a href="attorneys.php">Attorneys</a>
      </div>
    </div>
  </div>
</div>
<!-- Page Header End -->


<!-- About Start -->
<div class="about">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5 col-md-6">
        <div class="about-img">
          <img src="img/about.jpg" alt="Image">
        </div>
      </div>
      <div class="col-lg-7 col-md-6">
        <div class="section-header">
          <h2>About Attorneys</h2>
        </div>
        <div class="about-text">
          <p>
            Attorneys, often referred to as lawyers, are professionals licensed to practice law and represent clients in legal matters.
            They provide counsel, negotiate settlements, and advocate in court on behalf of individuals, businesses, or government agencies.
            Attorneys specialize in various fields, such as criminal law, civil rights, corporate law, or family law, offering legal guidance tailored to their client's specific needs.
            Their role extends beyond courtroom representation, encompassing legal research, drafting documents, and ensuring compliance with laws and regulations. Ethics, client confidentiality, and a deep understanding of legal precedents are essential pillars of their profession.
          </p>
          <!-- <a class="btn" href="">Learn More</a> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- About End -->


<!-- Team Start -->
<div class="team">
  <div class="container">
    <div class="section-header">
      <!-- <h2>Meet Our Expert Attorneys</h2> -->
    </div>
    <div class="row">
      <div class="col-lg-12">
        <form action="" method="get">
          <div class="row">
            <div class="col-lg-4">
              <select name="specialization" class="form-control">
                <option value="">Select Specialization</option>
                <?php
                $specialization_sql = "SELECT * FROM specializations";
                $specializations = mysqli_query($conn,$specialization_sql);
                while($specialization = mysqli_fetch_assoc($specializations)){?>
                  <option value="<?php echo $specialization['spid'];?>"><?php echo $specialization['specialization'];?></option>
                <?php }?>
              </select>
            </div>
            <div class="col-lg-4">
              <select name="location" class="form-control">
                <option value="">Select Location</option>
                <?php
                $location_sql = "SELECT * FROM locations";
                $locations = mysqli_query($conn,$location_sql);
                while($location = mysqli_fetch_assoc($locations)){?>
                  <option value="<?php echo $location['locationid'];?>"><?php echo $location['location'];?></option>
                <?php }?>
              </select>
            </div>
            <div class="col-lg-4">
              <input type="text" name="search" class="form-control d-flex" placeholder="Search Lawyers">
            </div>
          </div>
          <button type="submit" class="btn btn-primary ">Search</button>
        </form>
      </div>
    </div>
    <div class="row">
    <?php
    if(isset($_GET['specialization']) && isset($_GET['location']) && isset($_GET['search'])){
      $specialization = $_GET['specialization'];
      $location = $_GET['location'];
      $search = $_GET['search'];
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2 AND ldt.specializationid = '$specialization' AND ldt.locationid = '$location' AND usr.name LIKE '%$search%'";
    } elseif(isset($_GET['specialization']) && isset($_GET['location'])){
      $specialization = $_GET['specialization'];
      $location = $_GET['location'];
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2 AND ldt.specializationid = '$specialization' AND ldt.locationid = '$location'";
    } elseif(isset($_GET['specialization']) && isset($_GET['search'])){
      $specialization = $_GET['specialization'];
      $search = $_GET['search'];
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2 AND ldt.specializationid = '$specialization' AND usr.name LIKE '%$search%'";
    } elseif(isset($_GET['location']) && isset($_GET['search'])){
      $location = $_GET['location'];
      $search = $_GET['search'];
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.special izationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2 AND ldt.locationid = '$location' AND usr.name LIKE '%$search%'";
    } elseif(isset($_GET['specialization'])){
      $specialization = $_GET['specialization'];
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2 AND ldt.specializationid = '$specialization'";
    } elseif(isset($_GET['location'])){
      $location = $_GET['location'];
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2 AND ldt.locationid = '$location'";
    } elseif(isset($_GET['search'])){
      $search = $_GET['search'];
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2 AND usr.name LIKE '%$search%'";
    } else {
      $att_sql = "SELECT * FROM `users` AS usr 
      LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
      LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
      LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
      LEFT JOIN `locations` AS loc ON ldt.locationid = loc.locationid
      WHERE roleid = 2";
    }
    $attorneys = mysqli_query($conn,$att_sql);
    while($attorney = mysqli_fetch_assoc($attorneys)){?>
      <div class="col-lg-3 col-md-6">
        <div class="team-item">
          <div class="team-img">
            <a href=""><img src="<?php echo $attorney['photo']?>" alt="Team Image"></a>
          </div>
          <div class="team-text">
            <h2><?php echo $attorney['name']?></h2>
            <p><?php echo $attorney['specialization']?></p>
            <div class="team-social">
              <a class="social-tw" href=""><i class="fab fa-twitter"></i></a>
              <a class="social-fb" href=""><i class="fab fa-facebook-f"></i></a>
              <a class="social-li" href=""><i class="fab fa-linkedin-in"></i></a>
              <a class="social-in" href=""><i class="fab fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>   
    <?php }?>
    </div>
  </div>
</div>
<!-- Team End -->


<?php
include('footer.inc.php');
?>