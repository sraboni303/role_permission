@extends('backend.layouts.master')

@section('title') Create Role @endsection
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
                                <h4 class="header-title">Create Role</h4>
                                <form action="{{ route('role.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkAllPermissions" value="1">
                                        <label class="form-check-label" for="checkAllPermissions">Select All</label>
                                    </div>
                                    <hr>
                                    @php $i = 1; @endphp
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

@section('script')
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
@endsection
