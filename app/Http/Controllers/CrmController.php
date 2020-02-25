<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Email;
use App\Group;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CrmController extends Controller
{
    public function getCustomers() {

        $users = Customer::all();
        $groups = Group::all();

        return view('admin.crm.customers', compact('users', 'groups'));
    }

    public function getEdit($id) {

        $user = Customer::find($id);
        $emails = Email::where('customer_id', $id)->get();
        $groups = Group::all();

        return view('admin.crm.edit', compact('user', 'emails', 'groups'));
    }

    public function postSendEmail() {

        $id = Input::get('customer_id');

        $customer = Customer::find($id);

        $msg = Input::get('message');
        $msg  = wordwrap($msg, 70);

        //mail($customer->email . ",laky.bulatovic95@gmail.com", Input::get('subject'), $msg);

        Email::create(Input::all());

        return back()->with('message', 'Email has been sent!');
    }

    public function getDeleteEmail($id) {
        Email::find($id)->delete();

        return back()->with('message', 'Message has been deleted!');
    }

    public function getCustomersGroups() {
        $groups = Group::all();

        return view('admin.crm.usergroups', compact('groups'));
    }

    public function getCreateGroup() {
        return view('admin.crm.creategroup');
    }

    public function postCreateGroup() {

        Group::create(Input::all());

        return back()->with('message', 'Group has been created!');
    }

    public function getDeleteGroup($id) {

        Group::find($id)->delete();

        return back()->with('message', 'Group has been deleted!');
    }

    public function getFilterGroup() {

        $groups = Group::all();

        $users = Customer::whereHas('group', function ($query) {
            $query->where('id', Input::get('group_id'));
        })->get();

        return view('admin.crm.customers', compact('users', 'groups'));
    }

    public function postBulkGroupUsers() {
        if(Input::get('customer_id')) {
            if(Input::get('group_id')) {
                foreach (Input::get('customer_id') as $customer_id) {
                    Customer::find($customer_id)->update([
                        'group_id' => Input::get('group_id')
                    ]);
                }

                return back()->with('message', 'Group applied to users!');
            } else {
                return back()->with('message', 'You didnt select any group!');
            }
        } else {
            return back()->with('message', 'You didnt select any user!');
        }
    }
}
