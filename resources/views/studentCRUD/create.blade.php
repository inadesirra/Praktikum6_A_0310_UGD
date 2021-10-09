@extends('dashboard')

@section('content')

<div class="d-flex justify-content-between mt-5 mb-5">
    <div>
        <h2>Create New Student</h2>
    </div>
    <div>
        <a class="btn btn-secondary" href="{{ route('students.index') }}">Back</a>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong>There were some problems with your input. <br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('students.store') }}" method="POST">
    @csrf

    <div class="row g-3">
        <div class="col-md-6">
            <strong>Student First Name</strong>
            <input type="text" name="nama_depan" class="form-control" placeholder="First name" aria-label="First name">
        </div>
        <div class="col-md-6">
            <strong>Student Last Name</strong>
            <input type="text" name="nama_belakang" class="form-control" placeholder="Last name" aria-label="Last name">
        </div>
        <div class="col-12">
            <strong>Student Email</strong>
            <input type="text" name="email" class="form-control" placeholder="xxx@example.com" aria-label="Student email">
        </div>
        <div class="col-md-4">
            <strong>Student Phone Number</strong>
            <input type="text" name="no_telp" class="form-control" placeholder="Phone Number" aria-label="Phone number">
        </div>
        <div class="col-md-4">
            <strong>Student Birthplace</strong>
            <input type="text" name="tempat_lahir" class="form-control" placeholder="Birthplace" aria-label="Birthplace">
        </div>
        <div class="col-md-4">
            <strong>Student Birthdate</strong>
            <input type="date" name="tanggal_lahir" class="form-control" aria-label="Birthdate">
        </div>
    
        <div class="col-xs-12 col-sm-12 col-md-12 mt-5 text-center">
               <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection