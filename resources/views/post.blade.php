@extends('layouts.core')

@section('content')
<style>
  .btn.btn-primary.canel-post {
    background-color: transparent !important;
    border: 1px solid red;
    color: red;
    padding: 6px 5px;
  }

  .btn.btn-primary.publish-post,
  .btn.btn-primary.save-draft,
  .btn.btn-primary.add-tags {
    background-color: #871e99 !important;
    border: 1px solid #871e99;
    padding: 6px 5px;
    color: #fff;
  }

  .main-content {
    padding-top: 30px;
    padding-bottom: 30px;
  }

  .btn-info {
    background-color: #871e99 !important;
    border: 0 !important;
  }



  .form-check-label {
    padding-right: 10px;
  }

  .mb-editor-area {
    background: #f5f5f5;
    border-radius: 5px;
  }

  #new-post-title {
    outline: 0px !important;
    -webkit-appearance: none;
    box-shadow: none !important;
  }

  .mb-editor {
    background: #ffffff;
    border-radius: 5px;
  }


  .micro-blog-enclosure {
    background-color: #E0E0E0;
    border-radius: 10px;
  }

  .editor-btns {
    background: #871e99;
    border-radius: 5px;
  }

  /*Tag styles*/
  .tags {
    padding-right: 10px;
  }

  .btn-outline-primary:not(:disabled):not(.disabled).active,
  .btn-outline-primary:not(:disabled):not(.disabled):active,
  .show>.btn-outline-primary.dropdown-toggle {
    color: #fff !important;
    background-color: #871e99 !important;
    border-color: #871e99 !important;
  }

  .btn-outline-primary {
    color: #871e99 !important;
    border-color: #871e99 !important;
  }

  .btn-outline-primary:hover {
    color: #fff !important;
    background-color: #871e99 !important;
    border-color: #871e99 !important;
  }

  /*tag styples end here..*/
  .mb-textarea {
    /* border: none; */
    font-size: 18px;
    line-height: 22px;
    resize: none;
  }

  .mb-textarea::placeholder {
    font-weight: bold;

  }

  .mb-textarea:focus {
    outline: none !important;
    border: 1px solid red;
    box-shadow: none;
  }

  .mb-icon-link {
    color: #000000;
  }

  .mb-icon-link:hover {
    color: #000000;
  }

  .icon-audio,
  .icon-photo,
  .icon-video {
    cursor: pointer;
  }

  .icon-audio {
    color: #C61639;
  }

  .icon-photo {
    color: #871e99;
  }

  .icon-video {
    color: #6C63FF;
  }

  .btn-mb-post,
  .btn-mb-submit {
    background: #3B0E75;
    color: #ffffff;
    border-radius: 5px;
    border: none;

  }

  .btn-mb-post:hover,
  .btn-mb-submit:hover,
  .btn-mb-cancel {
    background: #ffffff;
    color: #3B0E75;
    border-radius: 5px;
    border: 1px solid #3B0E75;

  }

  .mb-content {
    color: var(--mb-text-color);
    font-size: 18px;
    line-height: 140%;
  }

  .mb-image {
    object-fit: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
  }

  .mb-title {
    color: #000000;
    line-height: 1.3em;
    font-size: 24px;
  }

  .mb-title:hover {
    color: #000000;
    text-decoration: underline;
  }

  .mb-post-time {
    color: #000000;
    font-size: 14px;
    font-weight: 500;
  }

  .mb-reply {
    color: var(--primary-color);
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
  }

  .mb-reply:hover {
    color: var(--primary-color);
    text-decoration: underline;
  }

  .mb-pagination a {
    color: var(--primary-color);
    font-size: 18px;
    font-weight: 500;
  }

  .mb-pagination a:hover {
    color: var(--primary-color);
    text-decoration: underline;
  }

  /* Media Query */
  @media screen and (max-width: 768px) {
    .mb-editor {
      flex-direction: column-reverse;
      padding: 1rem 0.5rem !important;
      align-items: flex-start !important;
    }

    .textarea-control {
      align-items: flex-start !important;
      margin-top: 1rem !important;
    }

    .mb-textarea,
    .mb-audio,
    .mb-photo,
    .mb-video {
      margin: 0 0 0 4px !important;
    }

    /* .mb-textarea {
      font-size: 14px;
      padding: 0 !important;
    } */

    .reply-form {
      width: 100% !important;
    }
  }

  .tokenfield .token.standardColor {
    background: #871e99;
    color: #fff;
    padding-bottom: 23px;
  }

  .tokenfield {
    padding: 7px;

  }
  .ui-front {
    z-index: 9999999 !important;
}
  .tokenfield .token{
    border: none;
  }
  .ui-front {
    z-index: 9999999 !important;
}
/* Only make edit and delete buttons appear on hover for bigger screens */
@media screen and (min-width: 1024px){
  div.edit-delete-buttons{
    display: none;
  }
  .post-content-body:hover div.edit-delete-buttons {
    display: initial;
  }
}
</style>
@section('sidebar')
<div class="header-space"></div>
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
      @parent
      <div class="col-12 col-md-8 col-lg-9 mb-sm-50" data-aos="fade-up">
        <div class="card">
          <div class="card-header position-relative">
            @if($post['image'] !== null)

              <img src="{{ url('/').'/'.$post['image']}}" alt="Post Thumbnail">

            @endif
            </div>
          <div class="card-body bg-white">
            <h3>{{ \Illuminate\Support\Str::title($post['title']) }}</h3>
            <h5 class="mb-25">Published on {{ $post['date'] }}</h5>
            <p class="mb-30">
  {!! $post['body'] !!}
</p>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-layout="in-article"
     data-ad-format="fluid"
     data-ad-client="ca-pub-3183155544576437"
     data-ad-slot="4428908445"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
          </div>
        </div>

          </div>

      </div>


</div>
</section>
<!-- Blog Post Section End -->
@endsection


@endsection
