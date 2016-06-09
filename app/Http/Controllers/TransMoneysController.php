<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\TransMoney;
use App\Category;
use App\Wallet;
use DateTime;
use DB;
use Validator;

class TransMoneysController extends Controller
{
    public function getTransactions(){
        $transmoneys = TransMoney::paginate(5);
        return view('TransMoney.index')->with('transmoneys',$transmoneys);
    }
    
    public function getAddTransaction(){
        $categories = ['' => '--- Select ---'] + Category::lists('name','id')->all();
        $wallets = ['' => '--- Select ---'] + Wallet::where('user_id',Auth::user()->id)->lists('name','id')->all();
        return view('TransMoney.add')->with(['categories'=>$categories,'wallets'=>$wallets]);
    }
    
    public function postAddTransaction(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id'=> 'required|numeric',
            'wallet_id'=> 'required|numeric',
            'money'=> 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $wallet->money = $wallet->money + $request->money;
            Wallet::where('id', $wallet->id)->update([
                'money' => $wallet->money,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return redirect('transactions')->withErrors('Add transaction money complete!');
        }
    }
    
    public function getUpdateTransaction($id = null) {
        $transaction = TransMoney::where('id',$id)->first();
        $categories = ['' => '--- Select ---'] + Category::lists('name','id')->all();
        $wallets = ['' => '--- Select ---'] + Wallet::where('user_id',Auth::user()->id)->lists('name','id')->all();
        return view('TransMoney.update')->with(['transaction'=> $transaction,'categories'=>$categories,'wallets'=>$wallets]);
    }

    public function postUpdateTransaction(Request $request) {
        $validator = Validator::make($request->all(), [
            'category_id'=> 'required|numeric',
            'wallet_id'=> 'required|numeric',
            'money'=> 'required|numeric',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
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
                    'updated_at' => date('Y-m-d H:i:s')
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
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $wallet->money = $wallet->money + $request->money;
            Wallet::where('id', $wallet->id)->update([
                'money' => $wallet->money,
                'updated_at' => date('Y-m-d H:i:s')
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
    
    public function getSearchReport(){
        $transmoneys = TransMoney::all();
        $categories = ['' => '--- Select ---'] + Category::lists('name','id')->all();
        return view('TransMoney.search')->with(['transmoneys'=>$transmoneys,'categories'=>$categories]);
    }
    
    public function postSearchReport(Request $request){
        $validator = Validator::make($request->all(), [
            'date_search'=> 'date_format:d/m/Y',
            'category_id'=> 'numeric',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        $category = $request->category_id;
        if(isset($request->date_search)&& $request->date_search != ""){
            $date = DateTime::createFromFormat('d/m/Y', $request->date_search);            
            $date = $date->format('Y-m-d');
//            dump($date);
//            exit(0);
        }
        
        if(isset($date)&& ($date != "") && isset($category)&& ($category != "") ){
            $transmoneys = TransMoney::where(DB::raw('DATE(updated_at)'), '=', $date)->where('category_id',$category)->get();
        }elseif(isset($date)&& ($date != "")){
            $transmoneys = TransMoney::where(DB::raw('DATE(updated_at)'), '=', $date)->get();
//            $transmoneys = TransMoney::where(DB::raw('DATE(updated_at)'), '=', $date)->toSql();
//            dd($date);
//            exit(0);
        }elseif(isset($category)&& ($category != "") ){
            $transmoneys = TransMoney::where('category_id',$category)->get();
        }else{
            $transmoneys = TransMoney::all();
        }
        $categories = ['' => '--- Select ---'] + Category::lists('name','id')->all();
        return view('TransMoney.search')->with(['transmoneys'=>$transmoneys,'categories'=>$categories]);
    }
    
    
    public function getReportMonth(){
        $date = new DateTime();
        $m = $date->format('m');
        $y = $date->format('Y');
        $transmoneys = TransMoney::whereMonth('updated_at','=', $m)->whereYear('updated_at','=', $y)->get();
        $categories = Category::all();
        return view('TransMoney.report')->with(['transmoneys'=>$transmoneys,'categories'=>$categories]);
    }
    
    public function postReportMonth(Request $request){
        $validator = Validator::make($request->all(), [
            'month'=> 'date_format:m/Y',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        $month = $request->month;
        
        if(isset($month)&& ($month != "")){
            list($m, $y) = explode("/", $request->month);
            $transmoneys = TransMoney::whereMonth('updated_at','=',$m)->whereYear('updated_at','=',$y)->get();
        }else{
            $transmoneys = TransMoney::all();
        }
        $categories = Category::all();
        return view('TransMoney.report')->with(['transmoneys'=>$transmoneys,'categories'=>$categories]);
    }
    
}
