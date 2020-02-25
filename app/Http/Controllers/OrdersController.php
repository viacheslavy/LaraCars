<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Auth, Validator;
use App\PayType;
use App\Orders;

class OrdersController extends Controller{

    public function getIndex() {
        $orders = Orders::paginate(10);
        return view('admin.orders.list', compact('orders'));
    }

    public function getDelete($id) {
        $order = Orders::find($id);
        if($order){
            $order->delete();
            return redirect('/cpanel/orders')->with('message', "La commande a été supprimée !");
        }else return redirect('/cpanel/orders')->withErrors('La commande est introuvable !');
    }

    public function getView($id) {
        $order = Orders::find($id);
        if($order){
            return view('admin.orders.view', compact('order'));
        }else return redirect('/cpanel/orders')->withErrors('Order Not found!!');
    }

    public function getType(){
        $type = PayType::first();
        if(!$type){
            $type = PayType::create(['type' => 'payzee']);
        }
        return view('admin.orders.type', compact('type'));
    }

    public function postType(Request $request){
        $validator = Validator::make($request->all(), ['type' => 'required']);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();
        $data = $request->input('type');
        $type = PayType::first();
        if($type){
            $insert = $type->update(['type' => $data]);
            if($insert) return redirect('/cpanel/orders/type')->with('message', "La méthode de paiement a été mise à jour !");
            else return redirect('/cpanel/orders/type')->withErrors("Quelque chose s'est mal passée !");
        }else return redirect()->back()->withErrors("Quelque chose s'est mal passée !")->withInput();
    }
}
