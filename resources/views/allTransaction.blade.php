<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/allTransaction.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title>allTransaction</title>
</head>
<body>
    @include('header')
    @if (!session('is_admin'))
    <script>
    alert('Restriced page! Only library admin can show all Transaction!')
    window.location = "/login";</script>    
    @endif
    <div id="transactions-container">
        <h2>All Transactions</h2>
        <h3> Date: {{$mytime = Carbon\Carbon::now()->format('d-m-Y');}}</h3>
        <h3> Time: {{$mytime = Carbon\Carbon::now()->setTimezone('Asia/Bahrain')->format('h:i A');}}</h3>

        <!-- Filter bar -->
        <div id="filterbar"> 
            <form method="GET" action="{{ url('/allTransaction') }}">
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

    <div class=downloadContainter>
        <button id="downloadBtn">Download Transactions</button>
    </div>
    {{-- @include('footer') --}}
</body>
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script> --}}
<script>
    document.getElementById('downloadBtn').addEventListener('click', function() {
        var table = document.querySelector('table');
        var tableContent = table.outerHTML;
        var pageTitle = document.title;
        var printWindow = window.open('', '', 'height=400,width=800');
        printWindow.document.write('<html><head><title>' + pageTitle + '</title></head><body>');
        printWindow.document.write('<h1>' + pageTitle + '</h1>');
        printWindow.document.write(tableContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
</script>

</html>