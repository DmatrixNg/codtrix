@extends('layouts.landing')

@section('content')
<!-- Slider Section Start -->
<section class="slider-area h-100 h-sm-auto bg-1">
  <div class="container h-100 h-sm-auto d-flex flex-row align-items-center flex-wrap flex-md-nowrap">
    <div class="caption" data-aos="fade-right">
      <h5 class="display-3 mb-10"></h5>
      <h1 class="display-1 mb-25">Remote Web Designing Course</h1>
      <p class="mb-30">Collaborate with teams on learning and building web Applications</p>
      <a href="/register" class="btn btn-primary">Get Started</a>
      </div>
    <div class="image-layer ml-md-auto align-self-md-center align-self-start mr-minus-80" data-aos="fade-left">
      <img src="{{ asset('img/slider/layer/2.png')}}" alt="Layer Image">
    </div>
  </div>
</section>
<!-- Slider Section End -->

<div class="bg-2 bg-white mt-120">
  <!-- Featured Section Start -->
  <section class="section-pb">
    <div class="container">
      <div class="row text-center">
        <div class="col-12" data-aos="zoom-in">
          <div class="heading mb-80">
            <h3>Why Choose Us</h3>
            <h1 class="mb-25">Our Application Features</h1>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-12 col-md-6 col-lg-3 mb-sm-30 mb-md-30" data-aos="zoom-in">
          <div class="card featured-item">
            <div class="card-body ptb-45">
              <div class="icon circle-icon mb-30 mx-auto">
                <i class="ti-shield"></i>
              </div>
              <h5>Choose what to learn</h5>
              <p class="mb-20">From building websites to analyzing data, the choice is yours. Not sure where to start? We'll point you in the right direction.</p>
              <a class="item-link link-btn" href="#">Read More</a>
            </div>
          </div>
        </div>
        <!-- Single Featured End -->
        <div class="col-12 col-md-6 col-lg-3 mb-sm-30 mb-md-30" data-aos="zoom-in" data-aos-delay="400">
          <div class="card featured-item">
            <div class="card-body ptb-45">
              <div class="icon circle-icon mb-30 mx-auto">
                <i class="ti-lock"></i>
              </div>
              <h5>Learn by doing</h5>
              <p class="mb-20">No matter your experience level, you'll be writing real, working code in minutes.</p>
              <a class="item-link link-btn" href="#">Read More</a>
            </div>
          </div>
        </div>
        <!-- Single Featured End -->
        <div class="col-12 col-md-6 col-lg-3 mb-sm-30" data-aos="zoom-in" data-aos-delay="600">
          <div class="card featured-item">
            <div class="card-body ptb-45">
              <div class="icon circle-icon mb-30 mx-auto">
                <i class="ti-heart"></i>
              </div>
              <h5>Get instant feedback</h5>
              <p class="mb-20">Your code is tested as soon as you submit it, so you always know if you're on the right track.</p>
              <a class="item-link link-btn" href="#">Read More</a>
            </div>
          </div>
        </div>
        <!-- Single Featured End -->
        <div class="col-12 col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="800">
          <div class="card featured-item">
            <div class="card-body ptb-45">
              <div class="icon circle-icon mb-30 mx-auto">
                <i class="ti-pencil"></i>
              </div>
              <h5>Put your learning into practice</h5>
              <p class="mb-20">Apply your learning with real-world projects.</p>
              <a class="item-link link-btn" href="#">Read More</a>
            </div>
          </div>
        </div>
        <!-- Single Featured End -->
      </div>
    </div>
  </section>
  <!-- Featured Section End -->
  <!-- Hero Block Start -->
  <section class="hero-block mt-30">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-12 col-md-6 mb-sm-30" data-aos="fade-right">
          <div class="hero-text">
            <h3 class="mb-5">About</h3>
            <h1 class="mb-25">Cod|triX Management</h1>
            <p class="mb-30 mw-5">Join the Exclusive Developer Team</p>
            <a href="register" class="btn btn-primary">Get Started</a>
          </div>
        </div>
        <div class="col-12 col-md-6 ml-auto" data-aos="fade-left">
          <div class="hero-thumb m-minus-60">
            <img src="{{ asset('img/slider/layer/1.png')}}" alt="Hero Thumbnail">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Block End -->
  <!-- Timeline Line Start-->
  <div class="timeline-line" data-aos="fade-in" data-aos-delay="500">
    <div class="container">
      <div class="timeline-box position-relative">
        <div class="move-line position-absolute topLeft">
          <hr class="line">
        </div>
        <div class="move-line position-absolute mx-auto center">
          <hr class="line">
        </div>
        <div class="move-line position-absolute bottomRight">
          <hr class="line">
        </div>
        <div class="dot bg-primary left-dot"></div>
        <div class="dot bg-primary right-dot"></div>
      </div>
    </div>
  </div>
  <!-- Timeline Line End-->
  <!-- Hero Block Start -->
  <section class="hero-block section-pb">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-12 col-md-6 col-xl-5 mb-sm-30" data-aos="fade-right">
          <div class="hero-thumb m-minus-70">
            <img src="{{ asset('img/1.png')}}" alt="Hero Thumbnail">
          </div>
        </div>
        <div class="col-12 col-md-6 col-xl-6 ml-auto">
          <div class="hero-text" data-aos="fade-left">
            <h3 class="mb-5">Best Feature</h3>
            <h1 class="mb-25">Cod|triX</h1>
            <ul class="list-group pl-20 mb-30">

              <li>Complete Web Designing Courses .</li>
              <li>Daily tasks and weekly challenges.</li>
              <li>Integrate with teams on tasks.</li>
              <li>Collaborate to Create MVPs</li>
            </ul>
            <a href="register" class="btn btn-primary">Get Started</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Block End -->
</div>

@endsection
