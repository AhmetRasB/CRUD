@extends('layouts.app')



@section('content')
<body>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h3>Customers</h3>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{ route('customer.index') }}" class="btn" style="background-color: #4643d3; color: white;"><i class="fas fa-chevron-left"></i> Back</a>
                        </div>

                    </div>

                </div>
                <div class="card-body">
                    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Image</label>
                                <input type="file" class="form-control" name="image" id="image" value="{{ old('image') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Bank Account Number</label>
                                <input type="text" class="form-control" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number') }}">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">About</label>
                                <textarea class="form-control" name="about" id="about" rows="4">{{ old('about') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Create</button>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection