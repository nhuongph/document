<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Wallet;
use Illuminate\Support\Facades\Auth;

class WalletsController extends Controller
{
    public function getWallet(){
        $where = ['user_id'=>Auth::user()->id,'current'=>'yes'];
        $current = Wallet::where($where)->first();
        if(isset($current) && $current!=""){
            $wallets = Wallet::where(['user_id'=>Auth::user()->id])->where('id','!=',$current->id)->get();
        }else{
            $wallets = Wallet::where(['user_id'=>Auth::user()->id])->get();
        }
        return view('Wallet.index')->with(['current'=>$current,'wallets'=>$wallets]);
    }
    
    public function getAddWallet(){
        return view('Wallet.add');
    }
    
    public function postAddWallet(Request $request, $id = null){
        $data_input = $request->all();        
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = $data_input['name'].'.jpg';
            $path = "uploads/".Auth::user()->username;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $data_input['image'] = $path.'/'.$file_name;
            $file->move($path,$file_name);
        }
        if(Wallet::create($data_input)){
            return redirect()->route('home')->withErrors(
                    'Your register Wallet done!');
        }else{
            return redirect()->back();
        }
    }
    
    public function setCurrentWallet($id = null){
//            dump($id);
//            exit(0);
        if(!isset($id) || $id==""){
            return redirect()->back()->withErrors("No find wallet. please try again!");
        }else{
            $current = Wallet::findOrFail($id);
            if(!isset($current)||$current==""){
                return redirect()->back()->withErrors("No find wallet. please try again!");
            }else{
                Wallet::where('user_id',Auth::user()->id)->update(['current'=>'no']);
                $current["current"] = "yes";
                $current->save();
                return redirect()->route('home');
            }
        }
    }
    
    public function getUpdateWallet($id = null){
        $wallet = Wallet::findOrFail($id);
        return view('Wallet.update')->with('wallet',$wallet);
    }
    
    public function postUpdateWallet(Request $request, $id = null){
        $data_input = new Wallet;        
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = $data_input['name'].'.jpg';
            $path = "uploads/".Auth::user()->username;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $data_input['image'] = $path.'/'.$file_name;
            $file->move($path,$file_name);
        }
        $data_input['id'] = $request->id;
        $data_input['name'] = $request->name;
        $data_input['money'] = $request->money;
        $data_input['type_money'] = $request->type_money;
        $data_input['note'] = $request->note;
        $data_input['current'] = $request->current;
        $data_input['user_id'] = Auth::user()->id;
        if($data_input->update()){
            return redirect()->route('home')->withErrors(
                    'Your update Wallet done!');
        }else{
            return redirect()->back();
        }
    }
    
    public function getDeleteWallet($id = null){
        if(!isset($id) || $id==""){
            return redirect()->back();
        }else{    
            if(Wallet::where('id',$id)->delete()){
                return redirect()->route('home');
            }else{
                return redirect()->back();
            }
        }
    }
}
