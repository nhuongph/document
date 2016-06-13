<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Wallet;
use Validator;
use Illuminate\Support\Facades\Auth;
use Session;
use Excel;

class WalletsController extends Controller {

    public function __construct() {
        $lang = Session::get('language');
        if ($lang != null)
            \App::setLocale($lang);
    }

    public function getWallet() {
        $current = Wallet::where('user_id', Auth::user()->id)->where('current', 'yes')->first();
        if (isset($current) && $current != "") {
            $wallets = Wallet::where(['user_id' => Auth::user()->id])->where('id', '!=', $current->id)->paginate(3);
        } else {
            $wallets = Wallet::where(['user_id' => Auth::user()->id])->paginate(3);
        }
        return view('Wallet.index')->with(['current' => $current, 'wallets' => $wallets]);
    }

    public function getAddWallet() {
        return view('Wallet.add');
    }

    public function postAddWallet(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|min:4',
                    'money' => 'required|numeric|min:0',
                    'type_money' => 'required',
                    'image' => 'required|mimes:jpeg,jpg,png',
        ]);
        $user_id = Auth::user()->id;
        $check_name = Wallet::where('user_id', $user_id)->where('name', $request->name)->get();
        if ($check_name->count()) {
            return redirect()
                            ->back()->withErrors(trans('money_lover.wallet_err_1'));
        }
        if ($validator->fails()) {
            return redirect()
                            ->back()
                            ->withErrors($validator);
        }

        $data_input = $request->all();
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $file_name = $data_input['name'] . '.jpg';
            $path = "uploads/" . Auth::user()->username . '/wallet';
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $data_input['image'] = $path . '/' . $file_name;
            $data_input['user_id'] = Auth::user()->id;
            $file->move($path, $file_name);
        }
        if (Wallet::create($data_input)) {
            Session::flash('message', trans('money_lover.wallet_mes_1'));
            return redirect('wallet');
        } else {
            return redirect()->back();
        }
    }

    public function setCurrentWallet($id = null) {
//            dump($id);
//            exit(0);
        if (!isset($id) || $id == "") {
            return redirect()->back()->withErrors(trans('money_lover.wallet_message_current_err_1'));
        } else {
            $current = Wallet::findOrFail($id);
            if (!isset($current) || $current == "") {
                return redirect()->back()->withErrors(trans('money_lover.wallet_message_current_err_1'));
            } else {
                Wallet::where('user_id', Auth::user()->id)->update(['current' => 'no']);
                $current["current"] = "yes";
                $current->save();
                Session::flash('message', trans('money_lover.wallet_message_current'));
                return redirect('wallet');
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
                    'money' => 'required|numeric|min:0',
                    'type_money' => 'required',
                    'image' => 'mimes:jpeg,jpg,png',
        ]);


        $id = $request->id;
        $name = Wallet::where('id', '!=', $id)->where('user_id', Auth::user()->id)->where('name', $request->name)->get();
        if ($name->count()) {
            return redirect()->back()->withErrors(trans('money_lover.wallet_message_update'));
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
            Session::flash('message', trans('money_lover.wallet_message_update_1'));
            return redirect('wallet');
        } else {
            return redirect()->back()->withErrors(trans('money_lover.wallet_message_update_2'));
        }
    }

    public function getTransWallet($id = null) {
        $wallet = Wallet::where('id', $id)->first();
        if (isset($wallet)) {
            $wallets = ['' => '--- '.trans('money_lover.select').' ---'] + Wallet::where('user_id', Auth::user()->id)->where('id', '!=', $id)->where('type_money', $wallet->type_money)->lists('name', 'id')->all();
//            dump($wallets);
//            exit(0);
            return view('Wallet.transwallet')->with(['wallet' => $wallet, 'wallets' => $wallets]);
        } else {
            return redirect()->back()->withErrors(trans('money_lover.wallet_err_2'));
        }
    }

    public function postTransWallet(Request $request) {

        $validator = Validator::make($request->all(), [
                    'id' => 'required',
                    'trans_money' => 'required|numeric|min:0',
                    'select_wallet' => 'required',
        ]);
        $money = $request->trans_money;
        $wallet = Wallet::where('id', $request->id)->first();
        if (($wallet->money - $money) < 0) {
            return redirect()
                            ->back()
                            ->withErrors(trans('money_lover.wallet_err_3'));
        }

        if ($validator->fails()) {
            return redirect()
                            ->back()
                            ->withErrors($validator);
        }

        $current = Wallet::where('id', $request->id)->first();
        $current->money = $current->money - $request->trans_money;
        $current->save();
        $trans = Wallet::where('id', $request->select_wallet)->first();
        $trans->money = $trans->money + $request->trans_money;
        $trans->save();
        Session::flash('message', trans('money_lover.wallet_mes_2'));
        return redirect('wallet');
    }

    public function getDeleteWallet($id = null) {
        if (!isset($id) || $id == "") {
            return redirect()->back();
        } else {
            if (Wallet::where('id', $id)->delete()) {
                Session::flash('message', trans('money_lover.wallet_mes_3'));
                return redirect('wallet');
            } else {
                return redirect()->back();
            }
        }
    }

    public function getExcel() {
        Excel::create('First Excel', function($excel) {

            $excel->sheet('Day la sheet 1', function($sheet) {

                $sheet->loadView('admin.excel');
            });
            $excel->export('xlsx');
        });
    }

}
