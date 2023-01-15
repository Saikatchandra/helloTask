@extends('layouts.app')

@section('content')
<div class="container">
   @if(Session::has('success'))
   <div class="alert alert-success">
       {{ Session::get('success') }}
       @php
           Session::forget('success');
       @endphp
   </div>
   @endif

   <h4 class="card-title">Update Company</h4>

   <form method="POST" action=" {{(route('company.store',$company->id))}} "  enctype="multipart/form-data">

       {{ csrf_field() }}

       <div class="form-group">
           <label>Name:</label>
           <input type="text" name="name" class="form-control" placeholder="Name" value="{{$company->name}}">
           @if ($errors->has('name'))
               <span class="text-danger">{{ $errors->first('name') }}</span>
           @endif
       </div>
       <div class="form-group">
           <label>Email:</label>
           <input type="text" name="email" class="form-control" placeholder="Email" value="{{$company->email}}">
           @if ($errors->has('email'))
               <span class="text-danger">{{ $errors->first('email') }}</span>
           @endif
       </div>

       <div class="form-group">
           <label>Website:</label>
           <input type="text" name="website" class="form-control" value="{{$company->website}}">
           @if ($errors->has('website'))
               <span class="text-danger">{{ $errors->first('website') }}</span>
           @endif
       </div>
       <div class="form-group">
           <label>Logo:</label>
           <input type="file" name="logo" class="form-control" placeholder="logo">
           @if ($errors->has('logo'))
               <span class="text-danger">{{ $errors->first('logo') }}</span>
           @endif
       </div>


       <div class="form-group mt-2">
           <button class="btn btn-success btn-submit">Submit</button>
           <a href="{{route('company.list')}}" class="btn btn-success btn-submit">Back</a>
       </div>
       <!-- <div class="form-group mt-2">
       </div> -->
   </form>


</div>
@endsection
