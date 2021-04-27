@extends('backend.layouts.master')

@section('title') Admin List @endsection

@section('content')



<div class="row">
    <!-- table primary start -->
    <div class="col-12 mt-5">
        @if (session()->has('message'))
            <p class="alert alert-success">{{ session()->get('message') }}</p>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Admins List</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-primary">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Name</th>
                                    <th width="10%">Email</th>
                                    <th width="40%">Roles</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @foreach ($admin->roles as $role)
                                                <span class="badge badge-info mr-1">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a class="btn btn-success text-white" href="{{ route('admin.edit', $admin->id) }}">Edit</a>

                                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                               @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- table primary end -->
</div>

@endsection
