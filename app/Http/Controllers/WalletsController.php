<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Wallet;
use Validator;
use Illuminate\Support\Facades\Auth;

class WalletsController extends Controller {

    public function getWallet() {
        $where = ['user_id' => Auth::user()->id, 'current' => 'yes'];
        $current = Wallet::where($where)->first();
        if (isset($current) && $current != "") {
            $wallets = Wallet::where(['user_id' => Auth::user()->id])->where('id', '!=', $current->id)->get();
        } else {
            $wallets = Wallet::where(['user_id' => Auth::user()->id])->get();
        }
        return view('Wallet.index')->with(['current' => $current, 'wallets' => $wallets]);
    }

    public function getAddWallet() {
        return view('Wallet.add');
    }

    public function postAddWallet(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:wallets',
            'money' => 'required|numeric',
            'type_money'=> 'required',
            'image'=> 'required|mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
        $data_input = $request->all();
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = $data_input['name'] . '.jpg';
            $path = "uploads/" . Auth::user()->username.'/wallet';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $data_input['image'] = $path . '/' . $file_name;
            $data_input['user_id'] = Auth::user()->id;
            $file->move($path, $file_name);
        }
        if (Wallet::create($data_input)) {
            return redirect()->route('home')->withErrors(
                            'Your register Wallet done!');
        } else {
            return redirect()->back();
        }
    }

    public function setCurrentWallet($id = null) {
//            dump($id);
//            exit(0);
        if (!isset($id) || $id == "") {
            return redirect()->back()->withErrors("No find wallet. please try again!");
        } else {
            $current = Wallet::findOrFail($id);
            if (!isset($current) || $current == "") {
                return redirect()->back()->withErrors("No find wallet. please try again!");
            } else {
                Wallet::where('user_id', Auth::user()->id)->update(['current' => 'no']);
                $current["current"] = "yes";
                $current->save();
                return redirect()->route('home');
            }
        }
    }

    public function getUpdateWallet($id = null) {
        $wallet = Wallet::findOrFail($id);
        return view('Wallet.update')->with('wallet', $wallet);
    }

    public function postUpdateWallet(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'money' => 'required|numeric',
            'type_money'=> 'required',
            'image'=> 'mimes:jpeg,jpg,png',
        ]);
        
        
        $id = $request->id;
        $name = Wallet::where('id','!=',$id)->where('name',$request->name)->get();
        if($name->count()){
            return redirect()->back()->withErrors(
                            'Name has been use. Please chose diffrent name!');
        }

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
        $image = '';
        if (!empty($request->file('image')) && $request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = $request->name . '.jpg';
            $path = "uploads/" . Auth::user()->username;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image = $path . '/' . $file_name;
            $file->move($path, $file_name);
        }
        if ($image == '') {
            $results = Wallet::where('id', $request->id)->update([
                'name' => $request->name,
                'money' => $request->money,
                'type_money' => $request->type_money,
                'note' => $request->note,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $results = Wallet::where('id', $request->id)->update([
                'name' => $request->name,
                'money' => $request->money,
                'type_money' => $request->type_money,
                'note' => $request->note,
                'image' => $image,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
//            dump($results);
//            exit(0);
        if ($results > 0) {
            return redirect()->route('home')->withErrors(
                            'Your update Wallet done!');
        } else {
            return redirect()->back()->withErrors(
                            'Your update Wallet not done. Please check again!');
        }
    }

    public function getTransWallet($id = null) {
        $wallet = Wallet::where('id', $id)->first();
        if (isset($wallet)) {
            $wallets = ['' => '--- Select ---'] + Wallet::where('user_id' , Auth::user()->id)->where('id', '!=', $id)->where('type_money', $wallet->type_money)->lists('name','id')->all();
//            dump($wallets);
//            exit(0);
            return view('Wallet.transwallet')->with(['wallet'=> $wallet,'wallets'=> $wallets]);
        } else {
            return redirect()->back()->withErrors("No find wallet. please try again!");
        }
    }

    public function postTransWallet(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'trans_money' => 'required|numeric',
            'select_wallet'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
        $current = Wallet::where('id',$request->id)->first();
        $current->money = $current->money - $request->trans_money;
        $current->save();
        $trans = Wallet::where('id',$request->select_wallet)->first();
        $trans->money = $trans->money + $request->trans_money;
        $trans->save();
        return redirect()->route('home')->withErrors('Transfer money complete!');
    }

    public function getDeleteWallet($id = null) {
        if (!isset($id) || $id == "") {
            return redirect()->back();
        } else {
            if (Wallet::where('id', $id)->delete()) {
                return redirect()->route('home');
            } else {
                return redirect()->back();
            }
        }
    }

}
