<?php

namespace App\Http\Controllers;

use App\Plan;
use App\Services\PaymentSystems\TokenInterface;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TokenInterface $token)
    {
        $user = Auth::user();
        $userPlan = $user->plan()->first();
        $allPlans = Plan::all();
        $token = $token->getToken();
        return view('plan')
            ->with([
                'plans' => $allPlans,
                'userPlan' => $userPlan,
                'user' => $user,
                'token' => $token
            ]);
    }
}
