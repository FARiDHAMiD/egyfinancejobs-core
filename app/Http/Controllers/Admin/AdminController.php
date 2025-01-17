<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Validation\Rule;



class AdminController extends Controller
{

    public function index()
    {
        $rows = User::whereRoleIs('admin')->latest();
        $search = [];
        if (request()->has('name') && request()->get('name') != '') {
            $searchTerms = request()->name;
            $search['name'] = $searchTerms;
            $rows->where('first_name', 'like', '%' . $searchTerms . '%')
                ->orWhere('email', 'like', '%' . $searchTerms . '%');
        }
        $data = [
            'page_name' => 'admins',
            'page_title' => 'admins',
            'search' => $search,
            'admins' => $rows->get(),
        ];
        return view('admin.admins.index', $data);
    }

    public function create()
    {
        $data = [
            'page_name' => 'admins',
            'page_title' => 'Create User',
            'roles' => Role::where('name', 'admin')->get()
        ];
        return view('admin.admins.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

        ]);


        $user =  User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->attachRole('admin');

        if ($request->has('profile_img')) {
            $request->validate(
                ['profile_img' => 'image|max:5000'],
                [
                    'profile_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                    'profile_img.max' => 'The file size must not exceed 5 MB.'
                ]
            );
            $user->clearMediaCollection('profile_img');
            $user->addMediaFromRequest('profile_img')
                ->toMediaCollection('profile_img');
        }

        session()->flash('alert_message', ['message' => 'The user has been created successfully', 'icon' => 'success']);
        return redirect()->route('admins.index');
    }


    public function show($id) {}

    public function edit($id)
    {
        $user = User::find($id);
        $data = [
            'page_name' => 'admins',
            'page_title' => 'Edit user',
            'roles' => Role::where('name', 'admin')->get(),
            'user' => $user
        ];
        return view('admin.admins.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],

        ]);

        if ($id == 1) {
            session()->flash('alert_message', ['message' => 'Cannot update super admin', 'icon' => 'danger']);
            return redirect()->back();
        } else {
            User::find($id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
            $user = User::find($id);
            if ($request->has('profile_img')) {
                $request->validate(
                    ['profile_img' => 'image|max:5000'],
                    [
                        'profile_img.image' => 'The file must be an image (JPEG, PNG, BMP, GIF, or SVG).',
                        'profile_img.max' => 'The file size must not exceed 5 MB.'
                    ]
                );
                $user->clearMediaCollection('profile_img');
                $user->addMediaFromRequest('profile_img')
                    ->toMediaCollection('profile_img');
            }

            session()->flash('alert_message', ['message' => 'The user has been updated successfully', 'icon' => 'success']);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if ($id == 1) {
            session()->flash('alert_message', ['message' => 'Cannot Delete Super Admin User', 'icon' => 'danger']);
            return redirect()->back();
        } else {
            User::where('id', $id)->delete();
            session()->flash('alert_message', ['message' => 'The user has been deleted successfully', 'icon' => 'success']);
            return redirect()->back();
        }
    }
}
