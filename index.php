<?php
include('header.inc.php');
$sp_sql = "SELECT * FROM `specializations`";
$specializations = mysqli_query($conn, $sp_sql);
$att_sql = "SELECT * FROM `users` AS usr 
    LEFT JOIN `genders` AS gdr ON usr.genderid = gdr.genderid
    LEFT JOIN `lawyerdetails` AS ldt ON usr.userid = ldt.lawyerid
    LEFT JOIN `specializations` AS spz ON ldt.specializationid = spz.spid
    WHERE roleid = 2";
    $attorneys = mysqli_query($conn,$att_sql);
?>
<!-- Carousel Start -->
<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/carousel-1.jpg" alt="Carousel Image">
            <div class="carousel-caption">
                <h1 class="animated fadeInLeft">We fight for your justice</h1>
                <p class="animated fadeInRight">Best Service Garantee.</p>
                <a class="btn animated fadeInUp" href="Bookanappoitment.php">Book an appointment</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="img/carousel-2.jpg" alt="Carousel Image">
            <div class="carousel-caption">
                <h1 class="animated fadeInLeft">We prepared to oppose for you</h1>
                <p class="animated fadeInRight">Best Service Garantee.</p>
                <a class="btn animated fadeInUp" href="#">Book an appointment</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="img/carousel-3.jpg" alt="Carousel Image">
            <div class="carousel-caption">
                <h1 class="animated fadeInLeft">We fight for your privilege</h1>
                <p class="animated fadeInRight">Best Service Garantee.</p>
                <a class="btn animated fadeInUp" href="#">Book an appointment</a>
            </div>
        </div>
    </div>

    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Carousel End -->


<!-- Top Feature Start-->
<div class="feature-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-3 col-sm-6">
                <div class="feature-item">
                    <i class="far fa-check-circle"></i>
                    <h3>Legal</h3>
                    <p>Govt Approved</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="feature-item">
                    <i class="fa fa-user-tie"></i>
                    <h3>Attorneys</h3>
                    <p>Expert Attorneys</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="feature-item">
                    <i class="far fa-thumbs-up"></i>
                    <h3>Success</h3>
                    <p>99.99% Case Won</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="feature-item">
                    <i class="far fa-handshake"></i>
                    <h3>Support</h3>
                    <p>Quick Support</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Feature End-->



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
                    <h2>Learn About Us</h2>
                </div>
                <div class="about-text">
                    <p>
                        At our firm, we are dedicated legal professionals with a client-centered approach, offering personalized solutions to meet your unique needs.
                        With expertise across key practice areas such as family law, business law, and criminal defense, we are committed to providing high-quality representation.
                        Our proven track record of successful outcomes reflects our dedication to pursuing justice with integrity. We value clear communication, ensuring you are informed throughout every step of your legal journey.
                        Whether through innovative legal strategies or community engagement, we are here to advocate for your rights and deliver the best possible results. </p>
                    </p>
                    <!-- <a class="btn" href="">Learn More</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Service Start -->
<div class="service">
    <div class="container">
        <div class="section-header">
            <h2>Our Practices Areas</h2>
        </div>
        <div class="row">
            <?php
            $counter = 0; // Initialize a counter
            while ($sp = mysqli_fetch_assoc($specializations)) {
                if ($counter >= 6) break; // Stop after 5 services
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-item">
                        <div class="service-icon">
                            <?php echo $sp['icon'] ?>
                        </div>
                        <h3 style="height: 120px;"><?php echo $sp['specialization'] ?></h3>
                        <p style="height: 240px;">
                            <?php echo $sp['description'] ?>
                        </p>
                        <a class="btn" href="practices.php?spid=<?php echo $sp['spid'] ?>">Learn More</a>
                    </div>
                </div>
            <?php
                $counter++; // Increment the counter
            }
            ?>
        </div>

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
                            Best law practices deliver client-focused, ethical, and knowledgeable service with effective case management, strategic problem-solving.
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
                            Efficiency and trust are at the core of our practice, ensuring swift, reliable, and effective legal solutions for our clients.
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
                            Delivering the results you deserve with dedication, expertise, and a commitment to achieving your legal goals. </p>
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


<!-- Team Start -->
<div class="team">
    <div class="container">
        <div class="section-header">
            <h2>Meet Our Expert Attorneys</h2>
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
</div>
<!-- Team End -->


<!-- FAQs Start -->
<!-- <div class="faqs">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="faqs-img">
                            <img src="img/faqs.jpg" alt="Image">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="section-header">
                            <h2>Have A Questions?</h2>
                        </div>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                        <span>1</span> Lorem ipsum dolor sit amet?
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                                        <span>2</span> Lorem ipsum dolor sit amet?
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapseThree">
                                        <span>3</span> Lorem ipsum dolor sit amet?
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapseFour">
                                        <span>4</span> Lorem ipsum dolor sit amet?
                                    </a>
                                </div>
                                <div id="collapseFour" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapseFive">
                                        <span>5</span> Lorem ipsum dolor sit amet?
                                    </a>
                                </div>
                                <div id="collapseFive" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn" href="">Ask more</a>
                    </div>
                </div>
            </div>
        </div> -->
<!-- FAQs End -->


<!-- Testimonial Start -->
<div class="testimonial">
    <div class="container">
        <div class="section-header">
            <h2>Review From Client</h2>
        </div>
        <div class="owl-carousel testimonials-carousel">
            <div class="testimonial-item">
                <i class="fa fa-quote-right"></i>
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="img/testimonial-1.jpg" alt="">
                    </div>
                    <div class="col-9">
                        <h2>Joseph</h2>
                        <p>Teacher</p>
                    </div>
                    <div class="col-12">
                        <p>
                            Very nice services 100% recomended.
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <i class="fa fa-quote-right"></i>
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="img/testimonial-2.jpg" alt="">
                    </div>
                    <div class="col-9">
                        <h2>Ashley</h2>
                        <p>Cook</p>
                    </div>
                    <div class="col-12">
                        <p>
                            Very nice services with low fee.
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <i class="fa fa-quote-right"></i>
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="img/testimonial-3.jpg" alt="">
                    </div>
                    <div class="col-9">
                        <h2>Leon</h2>
                        <p>Plumber</p>
                    </div>
                    <div class="col-12">
                        <p>
                            This place is absolute insane totally recomended.
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <i class="fa fa-quote-right"></i>
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="img/testimonial-4.jpg" alt="">
                    </div>
                    <div class="col-9">
                        <h2>Ada</h2>
                        <p>Athlete</p>
                    </div>
                    <div class="col-12">
                        <p>
                            Average service.
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <i class="fa fa-quote-right"></i>
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="img/testimonial-1.jpg" alt="">
                    </div>
                    <div class="col-9">
                        <h2>Jack</h2>
                        <p>Developer</p>
                    </div>
                    <div class="col-12">
                        <p>
                            This place is 100% authentic.
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <i class="fa fa-quote-right"></i>
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="img/testimonial-2.jpg" alt="">
                    </div>
                    <div class="col-9">
                        <h2>Amanda</h2>
                        <p>Programmer</p>
                    </div>
                    <div class="col-12">
                        <p>
                            good service respect for crew members.
                        </p>
                    </div>
                </div>
            </div>
            <div class="testimonial-item">
                <i class="fa fa-quote-right"></i>
                <div class="row align-items-center">
                    <div class="col-3">
                        <img src="img/testimonial-3.jpg" alt="">
                    </div>
                    <div class="col-9">
                        <h2>John</h2>
                        <p>Developer</p>
                    </div>
                    <div class="col-12">
                        <p>
                            Nice service.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- <div class="wrapper"> -->
<!-- Blog Start -->
<!-- <div class="blog">
        <div class="container">
            <div class="section-header">
                <h2>Latest From Blog</h2>
            </div>
            <div class="owl-carousel blog-carousel">
                <div class="blog-item">
                    <img src="img/blog-1.jpg" alt="Blog">
                    <h3>Lorem ipsum dolor</h3>
                    <div class="meta">
                        <i class="fa fa-list-alt"></i>
                        <a href="">Civil Law</a>
                        <i class="fa fa-calendar-alt"></i>
                        <p>01-Jan-2045</p>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                    </p>
                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="blog-item">
                    <img src="img/blog-2.jpg" alt="Blog">
                    <h3>Lorem ipsum dolor</h3>
                    <div class="meta">
                        <i class="fa fa-list-alt"></i>
                        <a href="">Family Law</a>
                        <i class="fa fa-calendar-alt"></i>
                        <p>01-Jan-2045</p>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                    </p>
                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="blog-item">
                    <img src="img/blog-3.jpg" alt="Blog">
                    <h3>Lorem ipsum dolor</h3>
                    <div class="meta">
                        <i class="fa fa-list-alt"></i>
                        <a href="">Business Law</a>
                        <i class="fa fa-calendar-alt"></i>
                        <p>01-Jan-2045</p>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                    </p>
                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="blog-item">
                    <img src="img/blog-1.jpg" alt="Blog">
                    <h3>Lorem ipsum dolor</h3>
                    <div class="meta">
                        <i class="fa fa-list-alt"></i>
                        <a href="">Education Law</a>
                        <i class="fa fa-calendar-alt"></i>
                        <p>01-Jan-2045</p>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                    </p>
                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="blog-item">
                    <img src="img/blog-2.jpg" alt="Blog">
                    <h3>Lorem ipsum dolor</h3>
                    <div class="meta">
                        <i class="fa fa-list-alt"></i>
                        <a href="">Criminal Law</a>
                        <i class="fa fa-calendar-alt"></i>
                        <p>01-Jan-2045</p>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                    </p>
                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="blog-item">
                    <img src="img/blog-3.jpg" alt="Blog">
                    <h3>Lorem ipsum dolor</h3>
                    <div class="meta">
                        <i class="fa fa-list-alt"></i>
                        <a href="">Cyber Law</a>
                        <i class="fa fa-calendar-alt"></i>
                        <p>01-Jan-2045</p>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                    </p>
                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                </div>
                <div class="blog-item">
                    <img src="img/blog-1.jpg" alt="Blog">
                    <h3>Lorem ipsum dolor</h3>
                    <div class="meta">
                        <i class="fa fa-list-alt"></i>
                        <a href="">Business Law</a>
                        <i class="fa fa-calendar-alt"></i>
                        <p>01-Jan-2045</p>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor
                    </p>
                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div> -->
<!-- Blog End -->


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

<?php
include('footer.inc.php')
?>