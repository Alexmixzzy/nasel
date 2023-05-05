<?php $obj->renderView('siteHead.php'); ?>
<?php //require_once 'siteHead.php'; ?>

<body>
<!-- ======= Loader ======= -->
<?php $obj->renderView('siteLoader.php'); ?>
<!-- *****Main Wrapper***** -->
<div id="home" class="main-wrapper">
  <!-- ======= Header ======= -->
  <?php $obj->renderView('siteHeaderNav.php'); ?>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <?php $obj->renderView('siteHomeBanner.php'); ?>
  <!-- End Hero -->
<!-- Start Main-->
  
  <!-- *****Things You Get section***** -->
  <section id="things_you_get">
    <div class="container text-center">
      <div class="row" hidden>
        <div class="col-md-12">
          <div class="section-heading">
            <h1 class="">Things You Get</h1>
            <p class="">Lorem ipsum dolor sit amet, consectetur adi sollicitudin et mollis tellus neque vitae elit.</p>
          </div>
        </div>
      </div>
      <div class="row">
        {% for hometop in hometops  %}
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="my-col p-4">
            <div class="mb-3 section-icon fa-2x">
              <i class="fa fa-paper-plane"></i>
            </div>
            <div class="section-heading mt-2">
              <h4 class="text-capitalize">{{hometop.heading}}</h4>
            </div>
            <div class="seaction-paragraph">
              <p class="text-center">{{hometop.short_text| striptags | truncatewords:22}}</p>
              <!--{{hometop.show_more}}-->
              {% if hometop.show_more == "yes" %}
              <a href="#" class="btn btn-primary">Read More</a>
              {% endif  %}
              
            </div>
          </div>
        </div>
        {% endfor  %}
      </div>
    </div>
  </section>

 <!-- *****About section***** -->

<section id="about" class="bg-light">
  <div class="container">
    <div class="row">
      <!-- for homeabout in homeabouts   -->
      <div class="col-12 col-lg-6 col-sm-12">
        <div class="about_img mb-30-sm">
          <img src="{% static 'assets/images/bg-img/about.jpg' %}" alt="about_img">
        </div>
      </div>
      <div class="col-12 col-lg-6 col-sm-12">
        <div class="about">
          <h1 class="section-heading">{{homeabout.heading| striptags}}</h1>
          <p>
            {{homeabout.top_text| striptags | truncatewords:70}} <?php //if($obj->PDB()){ echo 'connected';}else{echo 'Not connected';} ?> cone
          </p>
          <ul class="list-item">
            <li><i class="far fa-check-square"></i> {{homeabout.key_point1| striptags}}</li>
            <li><i class="far fa-check-square"></i> {{homeabout.key_point2| striptags}}</li>
            <li><i class="far fa-check-square"></i> {{homeabout.key_point3| striptags}}</li>
          </ul>
          <a href="../about/" class="btn btn-primary" type="button">Read More</a>
        </div>
      </div>
      <!--  endforss   -->
      
    </div>
  </div>
  
</section>


  <!-- *****Home Service section***** -->
  <section id="global_leadership" class="bg-dark">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h1 class="text-white">Our Services {{ses.fullname}}</h1>
            <p class="text-white-50">Lorem ipsum dolor sit amet, consectetur adi sollicitudin et mollis tellus neque vitae elit.</p>
          </div>
        </div>
      </div>
      <div class="row">
        {% for service in services  %}
        <div class="col-md-4 col-sm-6">
          <div class="my-col">
            <div class="card">
                    <img class="card-img-top" src="{% static 'assets/images/bg-img/upcoming_events_img_1.jpg' %}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{service.heading}}</h4>
                        <p class="card-text">{{service.short_text| striptags | truncatewords:22}}</p>
                        {% if service.show_more == "yes" %}
                          <a href="#" class="btn btn-primary">Read More</a>
                        {% endif  %}
                    </div>
                </div>
          </div>
        </div>

        {% endfor  %}

        
      </div>
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-2">
          
          <div class="col-12 col-lg-2 col-md-2 col-xs-12">
            <a href="../services/" class="btn btn-outline-info blue bg-warning text-center">See Our Services</a>
          </div>
        </div>
        <div class="col-md-5"></div>
      </div>
    </div>
  </section>
  <!-- ***** More Service ***** -->
  <section id="faqs" hidden>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="col-12 col-lg-2 col-md-2 col-xs-12">
            <a href="#" class="btn btn-outline-info blue bg-warning">See Our Services</a>
          </div>
        </div>
      </div>
      
    </div>
  </section>

<!-- *****Why Us section***** -->
  <section id="whyus">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading text-center mb-5">
          <h1>Why Choose Us</h1>
        </div>
        </div>
      </div>
      <div class="row">
        {% for why in whys  %}
        <div class="col-md-6">
          <div class="my-col  p-4">
            <div class="faq_info">
              <h5>{{why.heading| striptags}}</h5>
              <p>{{why.short_text| striptags | truncatewords:60}}</p>
            </div>
          </div>
          
        </div>
        {% endfor %}


        
      </div>
    </div>
  </section>

  <section class="offer-section" id="special">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-10 col-md-10">
          <div class="offer-content">
            
          </div>
        </div>
        
      </div>
    </div>
  </section>


  <!-- *****Services section***** -->
  <section id="services" class="bg-white">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-6">
          <div class="services_info">
            <h1 class="section-heading">business consulting</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adi sollicitudin. Suspendisse pulvinar, velit nec pharetra interdum, ante tellus ornare mi, et mollis tellus neque vitae elit.</p>
            <a href="#" class="btn btn-primary">Register Now</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="services_img">
            <img src="{% static 'assets/images/bg-img/services_img.jpg' %}" alt="Services">
          </div>
        </div>
      </div>

      
    </div>
  </section>

  <section class="offer-section" id="special">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-10 col-md-10">
          <div class="offer-content">
            <h1 class="section-heading1">If you have any query related investment.</h1>
            <h4 class="offer">we are available 24/7</h4>
          </div>
        </div>
        <div class="col-12 col-lg-2 col-md-2 col-xs-12">
          <a href="#" class="btn btn-outline-info blue bg-warning">Contact Us</a>
        </div>
      </div>
    </div>
  </section>


  <!-- *****Global Leadership section***** -->
  <section id="global_leadership" class="bg-light">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h1>global investment Source</h1>
            <p class="">Lorem ipsum dolor sit amet, consectetur adi sollicitudin et mollis tellus neque vitae elit.</p>
          </div>
        </div>
      </div>
      <div class="row">
        {% for investment in investsource  %}
        <div class="col-md-4 col-sm-6">
          <div class="my-col">
            <div class="card">
                    <img class="card-img-top" src="{% static 'assets/images/bg-img/upcoming_events_img_1.jpg' %}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{investment.heading| striptags}}</h4>
                        <p class="card-text">{{investment.short_text| striptags | truncatewords:22}}</p>
                        {% if investment.show_more == "yes" %}
                        <a href="#" class="btn btn-primary">Read More</a>
                      {% endif  %}
                    </div>
                </div>
          </div>
        </div>
        {% endfor  %}
        
      </div>
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-2">
          
          <div class="col-12 col-lg-2 col-md-2 col-xs-12">
            <a href="../investment/" class="btn btn-primary text-center">See Our investments</a>
          </div>
        </div>
        <div class="col-md-5"></div>
      </div>
    </div>
  </section>

  <!-- ***** Video Area Start ***** -->
    <div class="video-section" id="">
        <!-- Video Area Start -->
        <div class="video-area" style="background-image: url( 'assets/images/bg-img/video_img.jpg' );">
            <div class="video-play-btn">
                <a class="video_btn" href="http://www.youtube.com/watch?v=0O2aH4XLbto"><i class="fa fa-play" aria-hidden="true"></i></a>
            </div>
        </div>            
    </div>
    

  <!-- Features section start-->
    <section id="features">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-lg-5">
            <div class="features_img">
              <img src="{% static 'assets/images/bg-img/features.jpg' %} " alt="features_img">
            </div>
          </div>
          <div class="col-12 col-sm-12 col-lg-6 mx-auto">
            <div class="my-col p-4">
              <div class="media">
                  <div class="media-body">
                      <h4><i class="far fa-smile"></i> We Are Professional</h4>
                      <p>We resource, train, speak, mentor and encourage; marketplace leaders, business owners and career professionals to be effective in the workplace.</p>
                   </div>
              </div>
            </div>
            <div class="my-col p-4">
              <div class="media">
                  <div class="media-body">
                      <h4><i class="fas fa-anchor"></i> We Are Creative</h4>
                     <p>With so many factors to consider when deciding how to characterize your company , wouldn’t it be great to have a group of forward-thinking, well-informed individuals on board who know what they’re doing?</p>
                  </div>
              </div>
            </div>
            <div class="my-col mb-0  p-4">
              <div class="media">
                  <div class="media-body">
                      <h4><i class="far fa-clock"></i> 24/7 Great Support</h4>
                      <p>Design clever and compelling marketing strategies, improve product positioning, and drive conversion rates, Elixir is all time available to guide you.</p>
                   </div>
              </div>
            </div>	
          </div>
        </div>
      </div>
    </section>

  <!-- Facts section start-->
    <section class="facts_area">
        <div class="container text-center">
            <div class="row">
                <!-- Single Fact-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="single-fact justify-content-center">
                      <div class="stats-icons">
                        <i class="far fa-check-circle"></i>
                      </div>
                        <div class="counter-area">
                            <h3><span class="counter">200</span></h3>
                        </div>
                        <div class="facts-content">
                            <i class="ion-arrow-down-a"></i>
                            <p>Cases Solved</p>
                        </div>
                    </div>
                </div>
                <!-- Single Cool Fact-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="single-fact justify-content-center">
                      <div class="stats-icons">
                        <i class="fas fa-user"></i>
                      </div>
                        <div class="counter-area">
                            <h3><span class="counter">20</span></h3>
                        </div>
                        <div class="facts-content">
                            <i class="ion-happy-outline"></i>
                            <p>Trained Experts</p>
                        </div>
                    </div>
                </div>
                <!-- Single Cool Fact-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="single-fact justify-content-center">
                      <div class="stats-icons">
                        <i class="fas fa-code-branch"></i>
                      </div>
                        <div class="counter-area">
                            <h3><span class="counter">37</span></h3>
                        </div>
                        <div class="facts-content">
                            <i class="ion-person"></i>
                            <p>Branches</p>
                        </div>
                    </div>
                </div>
                <!-- Single Cool Fact-->
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="single-fact justify-content-center">
                      <div class="stats-icons">
                        <i class="far fa-heart"></i>
                      </div>
                        <div class="counter-area">
                            <h3><span class="counter">480</span></h3>
                        </div>
                        <div class="facts-content">
                            <i class="ion-ios-star-outline"></i>
                            <p>Satisfied Clients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      <!-- ***** Pricing Tables Start ***** -->
  

    <!-- ***** Our Experts section start ***** -->
    

    <!-- ***** Contact-us-Area-start ***** -->
  <section class="contact-us" id="contact">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-12">
          
        </div>
      
      </div>
    </div>
  </section>

    <!-- ***** FAQ section start ***** -->
    <section id="faq">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
        
      </div>
    </section>
  <!-- End #main -->

  <?php $obj->renderView('siteFooter.php'); ?>
</div>
  <!-- Vendor JS Files -->
  <?php $obj->renderView('siteFooterJs.php'); ?>

</body>

</html>