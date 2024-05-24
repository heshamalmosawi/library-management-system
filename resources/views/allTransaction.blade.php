<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/Alltransaction.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>Alltransaction</title>
</head>
<body>
    @include('header')
    <div id="transactions-container">
        <h2>All Transactions</h2>
        <h3>Date: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h3>
        <h3>Time: {{ \Carbon\Carbon::now()->format('H:i:s') }}</h3>

        <!-- Filter bar -->
        <div id="filterbar"> 
            <form method="GET" action="{{ url('/AllTransaction') }}">
                <label for="email">Filter by Email:</label>
                <input type="text" id="email" name="email" value="{{ request('email') }}">
                <button type="submit" class="sub">Filter</button> 
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Transaction no</th>
                    <th>UserID</th>
                    <th>E-mail</th>
                    <th>Transaction Date</th>
                    <th>Book Title</th>
                    <th>Transaction Type</th>
                    <th>Returned</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->transaction_id }}</td>
                        <td>{{ $transaction->user_id }}</td>
                        <td>{{ $transaction->user->email }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->book->title }}</td>
                        @if ($transaction->transaction_type == 0)
                            <td>Borrow</td>
                        @else
                            <td>Reserve</td>
                        @endif
                        <td>{{ $transaction->is_returned ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('footer')
</body>
</html>