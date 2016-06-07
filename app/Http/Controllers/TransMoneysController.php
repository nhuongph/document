<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\TransMoney;
use App\Category;
use App\Wallet;

class TransMoneysController extends Controller
{
    public function getTransactions(){
        $transmoneys = TransMoney::all();
        return view('TransMoney.index')->with('transmoneys',$transmoneys);
    }
    
    public function getAddTransaction(){
        $categories = Category::all();
        $wallets = Wallet::where('user_id',Auth::user()->id)->get();
        return view('TransMoney.add')->with(['categories'=>$categories,'wallets'=>$wallets]);
    }
    
    public function postAddTransaction(Request $request){
        $category = Category::where('id',$request->category_id)->first();
        $wallet = Wallet::where('id',$request->wallet_id)->first();
//        dump($wallet);
//        exit(0);
        if (!isset($category) || !isset($wallet)) {
            return redirect()->back()->withErrors('Can not add transaction money!');
        } else {
            TransMoney::insert([
                'name'=>$category->name, 
                'note'=>$request->note,
                'image'=>$category->image,
                'category_id'=>$category->id,
                'wallet_id'=>$wallet->id,
                'money'=>$request->money,
                'type_money'=>$wallet->type_money,
            ]);
            $wallet->money = $wallet->money + $request->money;
            Wallet::where('id', $wallet->id)->update([
                'money' => $wallet->money,
            ]);
            return redirect('transactions')->withErrors('Add transaction money complete!');
        }
    }
    
    public function getUpdateTransaction($id = null) {
        $transaction = TransMoney::where('id',$id)->first();
        $categories = Category::all();
        $wallets = Wallet::where('user_id',Auth::user()->id)->get();
        return view('TransMoney.update')->with(['transaction'=> $transaction,'categories'=>$categories,'wallets'=>$wallets]);
    }

    public function postUpdateTransaction(Request $request) {
        $id = $request->id;
        $category = Category::where('id',$request->category_id)->first();
        $wallet = Wallet::where('id',$request->wallet_id)->first();
        $transaction = TransMoney::where('id',$id)->first();
        if (!isset($category) || !isset($wallet)||!isset($transaction)) {
            return redirect()->back()->withErrors('Can not update transaction money!');
        } else {
            $old_wallet = Wallet::where('id',$transaction->wallet_id)->first();            
            if(isset($old_wallet)){
                $old_wallet->money = $old_wallet->money - $transaction->money;
                Wallet::where('id', $old_wallet->id)->update([
                    'money' => $old_wallet->money,
                ]);
            }
            TransMoney::where('id',$id)->update([
                'name'=>$category->name, 
                'note'=>$request->note,
                'image'=>$category->image,
                'category_id'=>$category->id,
                'wallet_id'=>$wallet->id,
                'money'=>$request->money,
                'type_money'=>$wallet->type_money,
            ]);
            $wallet->money = $wallet->money + $request->money;
            Wallet::where('id', $wallet->id)->update([
                'money' => $wallet->money,
            ]);
            return redirect('transactions')->withErrors('Update transaction money complete!');
        }
    }
    
    public function getDeleteTransaction($id = null) {
        if (!isset($id) || $id == "") {
            return redirect()->back();
        } else {
            if (TransMoney::where('id', $id)->delete()) {
                return redirect('transactions');
            } else {
                return redirect()->back();
            }
        }
    }
    
    public function getMonthTransaction(){
        $transmoneys = TransMoney::all();
        return view('TransMoney.month')->with('transmoneys',$transmoneys);
    }
}
