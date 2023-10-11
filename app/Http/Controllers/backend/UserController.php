<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepositoryInterface;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $user;
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->getAll();
        return view('admin.users.usersView',['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.usersFormView', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:5|max:20|confirmed'
        ]);

        $user = $this->user->create($request);
        $user->assignRole($request->role);
        return redirect(route('users.index'));
    }

    public function show($id)
    {
        $user = $this->user->getOne($id);
        return view('admin.users.usersDetailView', ['user' => $user]);
    }

    public function edit($id)
    {
        $record = $this->user->getOne($id);
        $roles = Role::all();
        return view('admin.users.usersFormView', ['record' => $record, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $record = $this->user->getOne($id);
        $checkUnique = '';
        if($request->email != $record->email) {
            $checkUnique = 'unique:users';
        }
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|'.$checkUnique,
            'password' => 'required'
        ]);
        $this->user->update($request, $id);
        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $this->user->delete($id);
        return redirect(route('users.index'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|max:255'
        ]);
        $users = $this->user->search($request);
        return view('admin.users.usersView',['users' => $users]);
    }
}
