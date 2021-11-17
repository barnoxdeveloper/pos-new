<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $i = 1;
        $title = 'Data User';
        $items = User::orderBy('name', 'ASC')
                        ->get();
        // ->whereNotIn('roles', ['ADMINISTRATOR'])
        if($request->ajax()){
            return datatables()->of($items)
                        ->addColumn('action', function($data){
                            if ($data->roles == "ADMINISTRATOR") {
                                return '-';
                            } else {
                                $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" id="tombol-edit" class="edit btn btn-warning btn-md edit-post"><i class="fa fa-edit"></i></a>';
                                $button .= '&nbsp;&nbsp;';
                                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-md"><i class="fa fa-trash"></i></button>';     
                                return $button;
                            }
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.pages.user.index_user', compact('i', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $id = $request->id;
        $username = $request->username;
        $roles = $request->roles;
        $password = $request->password;
        $type = $request->type;

        // check user exists
        $user_check = User::find($id);
        if ($user_check == NULL && $password !== NULL || $user_check !== NULL && $password !== NULL) {
            $pass = Hash::make($request->password);
        } else if($user_check !== NULL && $password == NULL) {
            $pass = $user_check->password;
        }
        // return $user_check->email ==;
        if ($type == 'edit') {
            $user_check = User::find($id);
            $validator = Validator::make( $request->all(),[
                'name' => 'required|max:50',
                'username' => 'required|min:6|max:50|unique:users,username,'.$user_check->username.',username',
                'email' => 'required|email|max:50|unique:users,email,'.$user_check->email.',email',
                'password' => 'max:50',
                'telephone' => 'max:15',
                'roles' => 'required|not_in:0',
            ]);
        } elseif ($type == 'tambah') {
            $validator = Validator::make( $request->all(),[
                'name' => 'required|max:50',
                'username' => 'required|min:6|max:50|unique:users,username',
                'email' => 'required|email|max:50|unique:users,email',
                'password' => 'max:50',
                'telephone' => 'max:15',
                'roles' => 'required|not_in:0',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $user = User::updateOrCreate(['id' => $id],
                    [
                        'name' => $request->name,
                        'username' => $request->username,
                        'email' => $request->email,
                        'password' => $pass,
                        'roles' => $request->roles,
                        'telephone' => $request->telephone,
                        'status' => $request->status,
                    ]); 
            return response()->json($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dec = decrypt($id);
        $item = User::where('id', $dec)->first();
        $this->validate($request, ['password' => 'required|max:30']);
        $pass = bcrypt($request->password);
        $data['password'] = $pass;
        $data['password_change_at'] = Carbon::now();
        $item->update($data);
        Auth::logout();

        return redirect()->route('login')
                        ->with('success', 'Password Berhasil di Update, Mohon Login Ulang!')
                        ->send();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return response()->json($user);
    }
}
