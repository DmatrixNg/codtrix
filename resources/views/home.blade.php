@extends('layouts.core')

@section('content')
@section('sidebar')
<div class="header-space"></div>
<!-- Header End -->
<!-- Breadcrumb Area Start -->
@if(Auth::user()->pay_status == null)
<script src="//voguepay.com/js/voguepay.js"></script>

<script>
    closedFunction=function() {
        alert('window closed');
    }

     successFunction=function(transaction_id) {
        alert('Transaction was successful, Ref: '+transaction_id)
    }

     failedFunction=function(transaction_id) {
         alert('Transaction was not successful, Ref: '+transaction_id)
    }
</script>

 <script>
 function get(item){
var price=document.getElementById("amount").value;
pay(item,price);
}
    function pay(item,price){
       //Initiate voguepay inline payment
        Voguepay.init({
            v_merchant_id: '1431-0029058',
            total: price,
            notify_url:'http://codtrix.com/notification?id={{Auth::user()->id}}',
            cur: 'NGN',
            memo:'Payment for '+item,
            developer_code: '5d558d80e2616',


           closed:closedFunction,
           success:successFunction,
           failed:failedFunction
       });
    }

 </script>

<nav class="breadcrumb-area bg-dark bg-6 ptb-70">
  <div class="container d-md-flex">
    <h2 class="text-white mb-0">Pricing Plan</h2>
    <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
      <li class="breadcrumb-item"><a href="index.html">Home</a> <span class="text-white">/</span></li>
      <li aria-current="page" class="breadcrumb-item active">Pricing</li>
    </ol>
  </div>
</nav>
<!-- Breadcrumb Area End -->
<!-- Pricing Section Start -->
<div class="section-ptb bg-light">
  <div class="container">
    <div class="row text-center">
      <div class="col mb-sm-30" data-aos="zoom-in">
        <div class="pricing-plan bg-white pt-55 pb-65">
          <h2>Starter</h2>
          <div class="price">
            <h3><sup>N</sup>2000 - <sup>N</sup>19000  </h3>
          </div>
          <ul class="list-unstyled mb-30 pt-10">
            <li>Commission Types</li>
            <li>Unlimited tutorial</li>
            <li>Practice video</li>
            <li></li>
            <li></li>
          </ul>
          <div class="p-3">
          <input class="form-control" type="number" id="amount" min="2000" max="19000" placeholder="Enter amount "name="number" value="">
          </div>
          <button onclick="get('Starter')" class="btn btn-primary">Pay Now</button>
        </div>
      </div>
      <!-- Single Plan End -->
      <div class="col mb-sm-30" data-aos="zoom-in" data-aos-delay="400">
        <div class="pricing-plan bg-primary pt-55 pb-65">
          <h2 class="text-white">Professional</h2>
          <div class="price">
            <h3 class="text-white"><sup>N</sup>20000 - <sup>N</sup>29000 </h3>
          </div>
          <ul class="list-unstyled mb-30 pt-10 text-white">
            <li>Commission Types</li>
            <li>Unlimited tutorial</li>
            <li>Video Assistance</li>
            <li>Online WorkStation</li>
            <li></li>
          </ul>
          <div class="p-3">
          <input class="form-control" type="number" id="amount" min="20000" max="29000"  placeholder="Enter amount "name="number" value="">
          </div>
          <button onclick="get('Professional')" class="btn btn-outline-light">Pay Now</button>
        </div>
      </div>

      <!-- Single Plan End -->
      <!-- Single Plan End -->
      <div class="col" data-aos="zoom-in" data-aos-delay="600">
        <div class="pricing-plan bg-white pt-55 pb-65">
          <h2>Business</h2>
          <div class="price">
            <h3><sup>N</sup>30000+ </h3>
          </div>
          <ul class="list-unstyled mb-30 pt-10">
            <li>Unlimited tutorial</li>
            <li>Video Assistance</li>
            <li>Online WorkStation</li>
            <li>Remote Support</li>
          </ul>
          <div class="p-3">
          <input class="form-control" type="number" min="30000"  id="amount" placeholder="Enter amount "name="number" value="">
          </div>
          <button onclick="get('Business')" class="btn btn-primary">Pay Now</button>
        </div>
      </div>
      <!-- Single Plan End -->
    </div>
  </div>
</div>
      @else
<nav class="breadcrumb-area bg-dark bg-6 ptb-70">
  <div class="container d-md-flex">
    <h2 class="text-white mb-0">Homepage</h2>

  </div>
</nav>

<section class="blog-page section-ptb bg-light">
  <div class="container">
    <div class="row">
      @parent
      <div class="col-12 col-md-8 col-lg-9 mb-sm-50">
        @foreach ($tut as $feed)
        <div class="card mb-50" data-aos="fade-up">
          <div class="card-header position-relative">
            <a href="blog-details.html"><img src="assets/img/blog/1.jpg" alt="Post Thumbnail"></a>
          </div>
          <div class="card-body bg-white">
            <h3><a href="blog-details.html">{{$feed['title']}}</a></h3>
            <h5 class="mb-25">Cod|triX</h5>
            <p class="mb-30">{{$feed['desc']}}</p>
            <a href="blog-details.html" class="btn btn-primary">Read More</a>
          </div>
        </div>
        @endforeach


      </div>
      <!-- Blog Posts End -->

    </div>
  </div>
</section>
@endif
<!-- Blog Post Section End -->
@endsection
@endsection
