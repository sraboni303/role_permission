@extends('backend.layouts.master')

@section('title') Create Role @endsection
@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- basic form start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Create Role</h4>
                                <form action="{{ route('role.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>
                                    @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $permission->id }}" name="permission[]" value="{{ $permission->name }}">
                                            <label class="form-check-label" for="{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                    @endforeach

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
