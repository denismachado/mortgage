<?php

namespace App\Http\Controllers;

use App\Models\Amortization;
use App\Models\Loans;
use App\Service\Calculator;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

class LoansController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'amount' => 'required|decimal:0,2',
            'interest' => 'required|decimal:0,2',
            'terms' => 'required|integer|min:1',
            'extra_payment' => 'nullable|decimal:0,2',
        ]);

        Loans::truncate();
        Loans::create($validated);

        return redirect('/loan');
    }

    public function show(){
        $loanData = Loans::latest()->first();

        if(!$loanData){
            return redirect('/');
        }

        Amortization::truncate();

        $monthlyInterest = Calculator::getMonthlyInterest($loanData->interest);
        $months = Calculator::getMonths($loanData->terms);
        $monthlyPayment = Calculator::getMonthlyPayment($loanData->amount, $monthlyInterest, $months);

        for ($month = 1; $month <= $months; $month++) {
            if ($month == 1){
                $startBalance = $loanData->amount;
            } else {
                $startBalance = Amortization::where('month_number', $month-1)->pluck('ending_balance')->first();
            }
            $interestComponent = $startBalance * $monthlyInterest;
            $principalComponent = $monthlyPayment - $interestComponent;
            $endBalance = $startBalance - $monthlyPayment;

            $result = Amortization::create([
                'month_number' => $month,
                'starting_balance' => $startBalance,
                'monthly_payment' => $monthlyPayment,
                'principal_component' => $principalComponent,
                'interest_component' => $interestComponent,
                'ending_balance' => $endBalance,
            ]);
        }

        $result = [
            'monthly_interest' => $monthlyInterest,
            'months' => $months,
            'monthly_payment' => $monthlyPayment,
        ];

        return view('loan', [
            'loan' => $result
        ]);
    }
}
