<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class SubscribeController extends Controller
{
    // Create subscribtion
    public function create(Request $request){
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email'
        ]);

            if(Newsletter::isSubscribed($request->email)){
                return redirect()->back()->with('error', 'Email already subscribed');
            } else {
                Newsletter::subscribe($request->email, ['FNAME' => $request->fname, 'LNAME' => $request->lname]);
                return redirect('/subscribed')->with('success', 'Email subscribed');
            }
        try {
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // Subbed
    public function done(){
        $titlename = 'Subscribed';
        return view('orders.subscribed', compact('titlename'));
    }
}
