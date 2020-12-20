@extends('layout.master')
@section('content')
<div class="alert alert-primary" role="alert">
    <h1 style="text-align: center">Sales Area Input</h1>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <form action="{{ url('/task') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Sales Person Name</label>
          <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="mb-3">
          <label for="postalCode" class="form-label">Postal Code</label>
          <input type="text" name="postalCode" class="form-control" id="postalCode" maxlength="5">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
