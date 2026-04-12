<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactUs;
use App\Mail\TestMail;
use App\Models\Plan;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class HomeController extends Controller
{
    public function index()
    {
        $plans = Plan::orderBy('price')->get();
        return view(
            'front.home.index',
            [
                'plans' => $plans,
            ]
        );

    }

    public function sendMail(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required'],
            'message' => ['required'],
        ]);

        $name = request()->input('name');
        $phone = request()->input('phone');
        $messageBody = request()->input('message');
        $admins = User::admins()->get();
        Mail::to($admins)->send(new ContactUs(name: $name, phone: $phone, messageBody: $messageBody));
        return response()->json(['message' => 'message sent', 'status' => true]);

    }
}
