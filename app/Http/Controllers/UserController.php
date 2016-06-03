<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\User;
use Mail;

class UserController extends Controller
{
    public function getLogin(){
        if(!Auth::check()){
            return view("User.login");
        }else{
            return redirect()->route('home');
        }
    }
    
    public function postLogin(UserRequest $request){
        $login = array(
                'username' => $request->username,
                'password' => $request->password,
                'active' => 'yes',
        );
        if (Auth::attempt($login)) {
            return redirect()->route('home');
        }else{
            return redirect()->back();
        }        
    }
    
    public function getLogout(){
        Auth::logout();
        return redirect()->route('getLogin');
    }
    
    public function getRegister(){
        return view('User.register');
    }
    
    public function postRegister(RegisterRequest $request){
        $data_input = $request->all();        
        if ($request->file('avatar')->isValid()) {
            $file = $request->file('avatar');
            $file_name = $data_input['username'].'.jpg';
            $data_input['avatar'] = 'uploads/'.$file_name;
            $file->move('uploads',$file_name);
        }
        
        $token = str_random('60');        
        Mail::send('User.createAccount', ['token' => $token], function ($message) use ($data_input) {
            $message->from('gitlab@rikkeisoft.com', 'Create Account');

            $message->to($data_input['email'])->subject('Create Account');
        });
        
        $data_input["active"] = "no";
        $data_input["remember_token"] = $token;
        if(User::create($data_input)){
            return redirect()->route('getLogin')->withErrors(
                    'We have been send your an email to active account. Please check your email!');
        }else{
            return redirect()->back();
        }
    }
    
    public function createAccount($token = null){
//            var_dump($user);
//            exit(0);
        $user = User::where('remember_token', '=', $token)->first(); 
        if(!isset($user) || $user ==""){
            return redirect()->route('getLogin')->withErrors(
                'Not find account active!');        
        }else{
            $user['active'] = 'yes';
            $user->save();
            return redirect()->route('home');
        }
    }
    
    public function getUpdate($username = null){
        $user = User::where('username', '=', $username)->first();
        return view('User.update')->with('user',$user);
    }
    
    public function postUpdate(UpdateRequest $request){
        $data_input = User::where('id', '=', $request->id)->first();
//        $data_input = $request->all();
        $data_input->save();
        return redirect()->route('home');
    }
    
}
