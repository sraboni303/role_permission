<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(is_null($this->user) || !$this->user->can('profile.view')){
        //     abort(403, "You can't view any role");
        // }

        $roles = Role::all();
        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(is_null($this->user) || !$this->user->can('role.create')){
        //     abort(403, "You can't create any role!");
        // }

        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.role.create', compact('permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        // if(is_null($this->user) || !$this->user->can('role.create')){
        //     abort(403, "You can't create any role!");
        // }

        $role = Role::create($request->validated());

        $permissions = $request->permissions;

        if($permissions){
            $role->syncPermissions($permissions);
        }
        session()->flash('message', 'Role Created Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort(403, "You can't edit any role!");
        }

        $role = Role::findById($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.role.edit', compact('role', 'permissions', 'permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort(403, "You can't create any role!");
        }


        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ], [
            'name.requried' => 'Please give a role name'
        ]);


        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        $permissions = $request->permissions;

        if($permissions){
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }
        session()->flash('message', 'Role has been updated Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($this->user) || !$this->user->can('role.delete')){
            abort(403, "You can't delete any role!");
        }

        $role = Role::findById($id);
        if(!is_null($role)){
            $role->delete();
        }

        session()->flash('message', 'Role has been deleted !!');
        return back();
    }
}
