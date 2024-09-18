<?php
    include('header.inc.php');
    $att_sql = "SELECT * FROM `users` AS usr 
    LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
    LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
    LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
    WHERE roleid = 2";
    $attorneys = mysqli_query($conn,$att_sql);
?>
<div class="wrapper">

    
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
                    <?php while($attorney = mysqli_fetch_assoc($attorneys)){?>
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
        </div>
        <!-- Wraper End -->

            
            
            <?php
    include('footer.inc.php');
?>