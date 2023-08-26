<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-changeStatus', ['only' => ['changeStatus']]);
        $this->middleware('permission:user-show', ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        $users = User::where('id','!=',userID())->get();
        $num_users = User::get()->count();

        return view('users.index',compact('users', 'num_users'));
    }

    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'role_names' => $input['roles'],
        ]);

        $user->assignRole($request->input('roles'));

        session()->flash('user_created', 'تم اضافة المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ],[
            'name.required' => 'حقل الاسم مطلوب.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'البريد الإلكتروني يجب أن يكون عنوانًا صالحًا.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'password.required' => 'حقل كلمة المرور مطلوب.',
            'password.same' => 'يجب أن تتطابق كلمة المرور مع حقل تأكيد كلمة المرور.',
            'roles.required' => 'حقل الأدوار مطلوب.',
        ]);


        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
            $user = User::find($id);
            $user->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'role_names' => $input['roles'],
            ]);
        }
        else{
            $input = Arr::except($input,array('password'));
            $user = User::find($id);
            $user->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'role_names' => $input['roles'],
            ]);
        }


        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        session()->flash('user_updated', 'تم تحديث المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request)
    {
        User::find($request->id)->delete();

        session()->flash('user_deleted','تم حذف المستخدم بنجاح');
        return redirect()->route('users.index');
    }

    public function changeStatus(Request $request ){

        if ($request->status == 1)
        {
            session()->flash('changeStatus',' تم نوقيف حساب المستخدم '.$request->name);
            DB::table('users')->where("id", $request->id)->update(['status' =>  0]);
        }
        else{
            session()->flash('changeStatus',' تم تفعيل حساب المستخدم '.$request->name);
            DB::table('users')->where("id", $request->id)->update(['status' =>  1]);
        }
        return redirect()->back();
    }

}
