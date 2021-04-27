@extends('backend.layouts.master')

@section('title') Create Role @endsection

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
                                    {{-- @php $i = 1; @endphp
                                    @foreach ($permission_groups as $group)
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                    <label class="form-check-label" for="{{ $i }}Management">{{ $group->name }}</label>
                                                </div>
                                            </div>
                                            <div class="col-9 role-{{ $i }}-management-checkbox">
                                                @php
                                                    $permissions = App\Models\User::getPermissionsByGroupName($group->name);
                                                    $j = 1;
                                                @endphp

                                                @foreach ($permissions as $permission)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="checkPermission{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}">
                                                        <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </div>
                                                    @php $j++; @endphp

                                                @endforeach
                                                <br>

                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach --}}

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
{{-- @section('script')
    <script>

        $("#checkAllPermissions").click(function(){

            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked',true);
            }else{
                // uncheck all the checkbox
                $('input[type=checkbox]').prop('checked',false);
            }

        });

        function checkPermissionByGroup(className, checkThis){
            const groupIdName = $("#"+checkThis.id);
            const classCheckBox = $('.'+className+' input');
            if(groupIdName.is(':checked')){
                 classCheckBox.prop('checked', true);
             }else{
                 classCheckBox.prop('checked', false);
             }
            // implementAllChecked();
         }

    </script>
@endsection --}}
