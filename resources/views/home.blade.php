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
      <!-- Header End -->
      <!-- Breadcrumb Area Start -->
      <nav class="breadcrumb-area bg-dark bg-6 ptb-70">
        <div class="container d-md-flex">
          <h2 class="text-white mb-0">Tutorial</h2>
          <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
            <li class="breadcrumb-item"><a href="/tutorials">Home</a> <span class="text-white">/</span></li>
            <li aria-current="page" class="breadcrumb-item active">Blog</li>
          </ol>
        </div>
      </nav>
      <section class="blog-page section-ptb bg-light">
        <div class="container">
          <div class="row">

      <div class="col-12 col-md-8 col-lg-9 mb-sm-50">
        @forelse($posts as $post)


        <div class="card mb-50" data-aos="fade-up">
          <div class="card-header position-relative">
          @if($post['image'] !== '')

            <a href="post/{{$post['slug']}}"><img src="{{$post['image']}}" alt="Post Thumbnail"></a>

          @endif
          </div>
          <div class="card-body bg-white">
            <h3><a href="post/{{$post['slug']}}"></a>{!! $post['title'] !!}</h3>
            <h5 class="mb-25">{{ $post['date'] }}</h5>
            <p class="mb-30">
              @php
              echo strip_tags($post['body'])
            @endphp
            </p>
            <a href="post/{{$post['slug']}}" class="btn btn-primary">Read More</a>
            </div>
        </div>
            <div class="col-2 edit-delete-buttons">
              <a title="edit this post" href="" class="mr-4 text-dark" data-toggle="modal" data-target="#editModal" onclick="editPost(
                '{{ $post['slug'] }}')"><i class="icon ion-md-create" style="font-size: 1.5em"></i></a>
              <a title="delete this post" href="javascript:void(0)" class="text-dark"  onclick="deletePost({{ $post['id'] }})" data-toggle="modal" data-target="#deleteModal"><i class="icon ion-md-trash" style="font-size: 1.5em"></i></a>
            </div>



        @empty

        <div class="post-content">
          <div class="post-content-body">
            no posts yet
          </div>
        </div>

        @endforelse

      </div>

      @parent
    </div>
  </div>

</section>
<!-- Blog Post Section End -->
@endif
@endsection
@endsection
