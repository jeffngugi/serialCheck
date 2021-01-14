<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use DB;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        // return $users;
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create')->with('roles', $roles);
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => 'required|regex:/(07)[0-9]{8}/',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            'role_id' => ['required', 'integer',],
            
        ]);

        if($validator->fails()){
            $errors =  $validator->messages();
            // return $errors;
            return back()->withInput()->with('errors',$errors);
        }

        $request['password'] = Hash::make($request->password);
        $request['name'] = $request->first_name.' ' .$request->last_name;
        
        $data = $request->all();
        // return $data;
        $user = User::create($data);
        if($user){
            return redirect('users')->with('success','User added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        if(!$user){
            return redirect('users')->with('error', 'User not found');
        }
        return view('users.edit')->with('user',$user)->with('roles', $roles);
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
        // return $request;
        $user = User::find($id);
        if(!$user){
            return redirect('users')->with('error', 'User not found');
        }
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => 'required|regex:/(07)[0-9]{8}/',
            'email' => 'required|email|max:255|exists:users',
            // 'email' => ['required', 'string', 'email', 'max:255','exists:users' ],
            'role_id' => ['required', 'integer',],
        ]);
        $request['name'] = $request->first_name.' ' .$request->last_name;
    //   return  $request->all();
    // return $user->id;
      $update =  $user->update($request->all());
            // $user->email = $request->email;
        // $user
        // return $update;
        if($update){
            return redirect('users')->with('success','User succesfully updated');
        }
        return $request;
    }

    public function change(Request $request){
        // return $request;
        $validator = Validator::make($request->all(), [
            'old_password'=>['required', 'string'],
            'password' => ['required', 'string', 'min:8','confirmed'],
            
        ]);
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return redirect()->back()->with('error','Old password do not match' );
        }
        
        if($validator->fails()){
            $errors =  $validator->messages();
            // return $errors;
            return redirect()->back()->with('errors',$errors);
        }
        $update = DB::table('users')->where('id', Auth::user()->id)->update(['pass_changed_at'=>Carbon::now()]);
       
        if($update){
            return redirect('/dashboard');
        }
    }

    public function changep(Request $request){
        return view('auth.change');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id){
            return redirect()->back()->with('success','Error: Can not self delete');
        }
        $user = User::find($id);
        if(!$user){
            return redirect()->back()->with('errors','User not found');
        }
        $del = $user->delete();
        if($del){
            return redirect()->back()->with('success','User successfully deleted');
        }
    }
}
