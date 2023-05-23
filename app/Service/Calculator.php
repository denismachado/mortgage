<?php

namespace App\Service;

class Calculator
{
    public static function getMonthlyInterest(float $annualInterest): float
    {
        return ($annualInterest / 12) / 100;
    }

    public static function getMonths(int $years): int
    {
        return $years * 12;
    }

    public static function getMonthlyPayment(float $loanAmount, float $interest, int $totalPayments): float
    {
        $val1 = $interest * pow((1 + $interest), $totalPayments);
        $val2 = pow((1 + $interest), $totalPayments) - 1;
        return $loanAmount * ($val1 / $val2);
    }
}
