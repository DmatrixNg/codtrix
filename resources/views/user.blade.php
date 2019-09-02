@extends('layouts.core')

@section('content')

@section('sidebar')
<div class="header-space"></div>
<!-- Header End -->
<!-- Breadcrumb Area Start -->
<nav class="breadcrumb-area bg-dark bg-6 ptb-70">
  <div class="container d-md-flex">
    <h2 class="text-white mb-0">Users</h2>
    <ol class="breadcrumb p-0 m-0 bg-dark ml-auto">
      <li class="breadcrumb-item"><a href="/tutorials">Home</a> <span class="text-white">/</span></li>
      <li aria-current="page" class="breadcrumb-item active">Blog</li>
    </ol>
  </div>
</nav>
<section class="blog-page section-ptb bg-light">
  <div class="container">
    @php
$users = DB::table('users')->get();

@endphp
<table>
<thead>
  <td>id</td>
  <td>name</td>
  <td>email</td>
  <td>interest</td>
  <td>pay_status</td>
<td>action</td>
</thead>
<tbody>

        @forelse($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->interest}}</td>
          <td>{{$user->pay_status}}</td>
          <td>
          @if($user->pay_status == 'Paid')
             <a href="{{ url('/')}}/admin/deactivate/{{$user->id}}">Deactivate</a>
             @else
              <a href="{{ url('/')}}/admin/activate/{{$user->id}}">activate</a>
             @endif
             </td>
           </tr>
        @empty
        <tr>
          <td>no user</td>
        </tr>
        @endforelse

      </tbody>

</table>
          </div>



</section>
<!-- Blog Post Section End -->
@endsection


@endsection
