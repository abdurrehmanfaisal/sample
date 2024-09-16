<?php
include('header.inc.php');
$sp_sql = "SELECT * FROM `specializations`";
$specializations = mysqli_query($conn,$sp_sql);
?>
<div class="wrapper">
    <!-- Page Header Start -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Lawyers by Practices Areas</h2>
                </div>
                <div class="col-12">
                    <a href="index.php">Home</a>
                    <a href="attorneys.php">Attorneys</a>
                    <a>Lawyer by Practices Areas</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="service">
        <div class="container">
            <div class="section-header">
                <h2>Our Practices Areas</h2>
            </div>
            <div class="row">
            <?php while($sp = mysqli_fetch_assoc($specializations)) {?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <?php echo $sp['icon']?>
                        </div>
                        <h3 style="height: 120px;"><?php echo $sp['specialization']?></h3>
                        <p style="height: 240px;">
                            <?php echo $sp['description']?>
                        </p>
                        <a class="btn" href="lawyerbyprectice.php?spid=<?php echo $sp['spid']?>">Learn More</a>
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Feature Start -->
    <div class="feature">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="section-header">
                        <h2>Why Choose Us</h2>
                    </div>
                    <div class="row align-items-center feature-item">
                        <div class="col-5">
                            <div class="feature-icon">
                                <i class="fa fa-gavel"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <h3>Best law practices</h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate.
                            </p>
                        </div>
                    </div>
                    <div class="row align-items-center feature-item">
                        <div class="col-5">
                            <div class="feature-icon">
                                <i class="fa fa-balance-scale"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <h3>Efficiency & Trust</h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate.
                            </p>
                        </div>
                    </div>
                    <div class="row align-items-center feature-item">
                        <div class="col-5">
                            <div class="feature-icon">
                                <i class="far fa-smile"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <h3>Results you deserve</h3>
                            <p>
                                Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="feature-img">
                        <img src="img/feature.jpg" alt="Feature">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Newsletter Start -->
    <!-- <div class="newsletter">
        <div class="container">
            <div class="section-header">
                <h2>Subscribe Our Newsletter</h2>
            </div>
            <div class="form">
                <input class="form-control" placeholder="Email here">
                <button class="btn">Submit</button>
            </div>
        </div>
    </div> -->
    <!-- Newsletter End -->
</div>
<!-- Wrapper End -->


    <?php
    include('footer.inc.php');
    ?>