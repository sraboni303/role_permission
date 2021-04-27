@extends('backend.layouts.master')

@section('title') Edit User @endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- basic form start -->
                    <div class="col-12 mt-5">
                        @if (session()->has('message'))
                            <p class="alert alert-success">{{ session()->get('message') }}</p>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Create User</h4>
                                <form action="{{ route('user.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="name">User Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ $user->name }}">
                                            @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="email">User Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                                            @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                                            @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                                            @error('password_confirmation')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password">Assign Roles</label>
                                            <select name="roles[]" id="roles" class="form-control select2 @error('roles') is-invalid @enderror" multiple>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('roles')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- basic form end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })
    </script>
@endsection
