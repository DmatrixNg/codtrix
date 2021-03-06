@extends('layouts.core')

@section('content')
@section('sidebar')
<div class="header-space"></div>
<!-- Header End -->
<!-- Breadcrumb Area Start -->
<nav class="breadcrumb-area bg-dark bg-6 ptb-70">
  <div class="container d-md-flex">
    <h2 class="text-white mb-0">Blog Details</h2>
    <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
      <li class="breadcrumb-item"><a href="index.html">Home</a> <span class="text-white">/</span></li>
      <li class="breadcrumb-item"><a href="blog.html">Blog</a> <span class="text-white">/</span></li>
      <li aria-current="page" class="breadcrumb-item active">Blog Details</li>
    </ol>
  </div>
</nav>
<section class="blog-page blog-details section-ptb bg-light">
  <div class="container">
    <div class="row">
      @parent
      <div class="col-12 col-md-8 col-lg-9 mb-sm-50" data-aos="fade-up">
        <div class="card">
          <div class="card-header position-relative">
            <img src="assets/img/blog/lg.jpg" alt="Post Thumbnail">
          </div>
          <div class="card-body bg-white">
            <h3>Resume notifications only when you’re ready</h3>
            <h5 class="mb-25">By the team at RNR, March 18, 2019</h5>
            <p class="mb-30">Looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
            <h4>Cancel my subscription</h4>
            <p>Looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the. Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
            <blockquote class="quote-card bg-light mt-50 mb-50">
              <p>Looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the.</p>
            </blockquote>
            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>
            <ul class="list-group mt-25">
              <li>Phasellus bibendum ante et enim tincidunt aliquam.</li>
              <li>Quisque vehicula ligula sit amet aliquet condimentum.</li>
              <li>Nunc vel turpis vitae quam tincidunt viverra.</li>
              <li>Cras dignissim risus egestas justo vulputate feugiat.</li>
            </ul>
          </div>
        </div>
        <!-- Post Details End -->
        <div class="next-prev-post bg-white mt-50 mb-60 clearfix">
          <div class="float-left">
            <p>All the Lorem Ipsum gen..</p>
            <a href="#"><i class="ti-arrow-left"></i>&nbsp; &nbsp; Prev Post</a>
          </div>
          <div class="float-right text-right">
            <p>Finibus Bonorum et Malorum</p>
            <a href="#">Next Post &nbsp; &nbsp;<i class="ti-arrow-right"></i></a>
          </div>
        </div>
        <!-- Next Prev Box End -->
        <!-- Comment Area Start -->
        <div class="comments-area">
          <div class="comment-boxs">
            <div class="media admin-box bg-white mb-40">
              <div class="thumb">
                <img src="assets/img/blog/author/1.png" alt="Commentor Image">
              </div>
              <div class="media-body pl-30">
                <h4 class="mb-10">Maria Lynch <span class="text-primary">Admin</span></h4>
                <p>Lorem Ipsum is not simply random text. It has roots in a pieclassical Latin literature from 45 BC, making it over 2000 years old.</p>
              </div>
            </div>
            <!-- Admin Box Comment End -->
            <div class="media bg-white mb-30">
              <div class="thumb">
                <img src="assets/img/blog/author/2.png" alt="Commentor Image">
              </div>
              <div class="media-body pl-30">
                <h6 class="mb-0 float-right">July 13, 2018</h6>
                <h4 class="mb-10">Terry Mendez</h4>
                <p>Lorem Ipsum is not simply random text. It has roots in a pieccal Latin literature from 45 BC, making it over 2000 years old.</p>
                <a class="reply item-link" href="#">Reply</a>
                <!-- Comment Reply Start -->
                <div class="media">
                  <div class="thumb">
                    <img src="assets/img/blog/author/3.png" alt="Commentor Image">
                  </div>
                  <div class="media-body pl-20">
                    <h6 class="mb-0 float-right">July 14, 2018</h6>
                    <h4 class="mb-10">Linda Ryan</h4>
                    <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model. </p>
                    <a class="reply item-link" href="#">Reply</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Single Comment End -->
            <div class="media bg-white">
              <div class="thumb">
                <img src="assets/img/blog/author/4.png" alt="Commentor Image">
              </div>
              <div class="media-body pl-30">
                <h6 class="mb-0 float-right">July 10, 2018</h6>
                <h4 class="mb-10">Kevin Nichols</h4>
                <p>It was popularised in the 1960s with the release of Letra containing Lorem Ipsum passages, and more.</p>
                <a class="reply item-link" href="#">Reply</a>
              </div>
            </div>
            <!-- Single Comment End -->
          </div>
          <!-- Comment Boxs End -->
          <div class="comment-form bg-white mt-50">
            <div class="title mb-40">
              <h3 class="mb-10">Leave a Reply</h3>
              <hr class="line bw-2 line-sm mb-5">
              <hr class="line bw-2">
            </div>
            <form class="form-group" action="#">
              <div class="row">
                <div class="col-12 col-lg-6">
                  <input class="form-control" type="text" name="name" placeholder="Your Name">
                </div>
                <div class="col-12 col-lg-6">
                  <input class="form-control" type="email" name="email" placeholder="Email Address">
                </div>
              </div>
              <input class="form-control" name="website" type="text" placeholder="Enter Website">
              <textarea class="form-control" name="comment" rows="3" placeholder="Enter Comments"></textarea>
              <button class="btn btn-primary mt-10" type="submit">Post Comment</button>
            </form>
          </div>
        </div>
        <!-- Comments Area End -->
      </div>
    </div>
  </div>
</section>
<!-- Blog Post Section End -->
@endsection
@endsection
