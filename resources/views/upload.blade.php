@extends('layouts.core')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    @if (count($errors)>0)
                    <p>error</p>
                    foreach($errors->all() as $error)
                    <ul>
                    <li>
                    {{ $error}}
                  </li>
                  </ul>
                    @endforech
                    @endif
                    @if ($message = Session::get('success'))

                    <ul>
                    <li>
                    {{ $message }}
                  </li>
                  </ul>
                    @endif
                    <form class="" action="{{ url('/upload')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="file" name="select_file" value="">
                        <input type="submit" name="submit" value="submit">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
