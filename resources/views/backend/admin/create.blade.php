@extends('backend.layouts.master')

@section('title') Create User @endsection

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
                                <form action="{{ route('user.store') }}" method="POST">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="name">User Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="email">User Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password">Assign Roles</label>
                                            <select name="roles[]" id="roles" class="form-control select2" multiple>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
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