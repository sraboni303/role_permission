@extends('backend.layouts.master')

@section('title') Roles List @endsection

@section('content')



<div class="row">
    <!-- table primary start -->
    <div class="col-12 mt-5">
        @if (session()->has('message'))
            <p class="alert alert-success">{{ session()->get('message') }}</p>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Roles List</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-primary">
                                <tr class="text-white">
                                    <th width="20%">Name</th>
                                    <th width="60%">Permissions</th>
                                    {{-- @if (Auth::guard('web')->user()->can('role.edit') || Auth::user()->can('role.delete')) --}}
                                        <th width="20%">Action</th>
                                    {{-- @endif --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $perm)
                                                <span class="badge badge-success mr-1">
                                                    {{ $perm->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{-- @if (Auth::guard('web')->user()->can('role.edit')) --}}
                                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-info btn-sm">Edit</a>
                                            {{-- @endif

                                            @if (Auth::guard('web')->user()->can('role.delete')) --}}
                                                <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Are You Sure?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            {{-- @endif --}}
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
