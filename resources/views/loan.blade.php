<html>
<body>
<h1>Mortgage Calculator</h1>
<html>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="post" action="/loan">
    @csrf
    <div class="form-group">
        <label>Loan amount (principal)</label>
        <input type="text" class="form-control" name="amount" id="amount">
    </div>
    <div class="form-group">
        <label>Annual interest rate (in percentage)</label>
        <input type="text" class="form-control" name="interest" id="interest">
    </div>
    <div class="form-group">
        <label>Loan term (in years)</label>
        <input type="text" class="form-control" name="terms" id="terms">
    </div>
    <div class="form-group">
        <label>Monthly fixed extra payment (optional)</label>
        <input type="text" class="form-control" name="extra_payment" id="extra_payment">
    </div>
    <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
</form>
@if(isset($loan))
    monthly_interest: {{ $loan['monthly_interest'] }}<br>
    months: {{ $loan['months'] }}<br>
    monthly_payment: {{ $loan['monthly_payment'] }}<br>
@endif
</body>
</html>
