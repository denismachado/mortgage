# Mortgage Calculator

### Entry point
Your entry point is the url `http://localhost` where you should get the form to input the loan information.

After the data is validated you should be able to save the initial information in the db. (any previous information saved in the table will be erased and I will be saving only the most recent information)

After initial data is saved application goes to another method in the Loan controller which will populate the amortization table.

### Files created
```
app/Http/Controllers/LoansController.php
app/Http/Models/Loans.php
app/Http/Models/Amortization.php
app/Http/Service/Calculator.php
database/migrations/2023_05_23_165005_loans.php
database/migrations/2023_05_23_185625_loan_amortization_schedule.php
resources/views/loan.blade.php
routes/web.php
```

### Disclaimer

I only managed to go thus far on the development and had to manage my current work and this test. 

I also lost a day of development due to a local holiday. 

I apologize for submitting an incomplete test, but I believe it evaluates the skills you are looking for: form input, validating input values, performing financial calculations, storing
data in a database, etc.

