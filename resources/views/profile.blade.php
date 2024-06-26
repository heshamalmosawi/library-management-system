<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>
<body>
    @include('header')
    <div id="profile-container">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            <h1>Update Profile</h1>

            <input type="text" placeholder="Name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="email" placeholder="Email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="text" placeholder="Phone number" name="contact_no" value="{{ old('contact_no') }}">
            @error('contact_no')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" placeholder="New Password (leave blank if not changing)" name="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit" id="update-button">Update</button>

            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif
        </form>
    </div>
</div>
@if (session('userType') == 'student')
<div id="transactions-container">
    <h2>My Transactions</h2>
    <h3> Date: {{$mytime = Carbon\Carbon::now()->format('d-m-Y');}}</h3>
    <h3> Time: {{$mytime = Carbon\Carbon::now()->setTimezone('Asia/Bahrain')->format('h:i A');}}</h3>

    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>ISBN</th>
                <th>Due Date</th>
                <th>Returned</th>
                <th>Transaction Type</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->book->title }}</td>
                    <td>{{ $transaction->book->ISBN }}</td>
                    <td>{{ $transaction->due_date }}</td>
                    <td>{{ $transaction->is_returned ? 'Yes' : 'No' }}</td>
                    @if ($transaction->transaction_type== 0)
                    <td>Borrow</td> 
                    @else
                    <td>Reserve</td> 
                    @endif
                    <td> 
                    @if ($transaction->transaction_type == 1 && $transaction->is_returned == false)
                    <form action="/cancel" method="GET" >
                        <input type="hidden" name="isbn" value="{{ $transaction->book->ISBN }}">
                        <button class="newbuttons cancel" >Cancel</button>
                    </form>
                    @else
                        
                    @endif

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class=downloadContainter>
    <button class="newbuttons">Download Transactions</button>
</div>
@endif 

@include('footer')

 
</body>
<script>
    document.getElementById('downloadBtn').addEventListener('click', function() {
        var table = document.querySelector('table');
        var tableContent = table.outerHTML;
        var pageTitle = "Transactions";
        var printWindow = window.open('', '', 'height=400,width=800');
        printWindow.document.write('<html><head><title>' + pageTitle + '</title></head><body>');
        printWindow.document.write('<h1>' + pageTitle + '</h1>');
        printWindow.document.write(tableContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
</script>
</script>
</html>