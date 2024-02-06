<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- Add any additional styles or CSS here -->
    <style>
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #e6e6e6;
            background-color: #f9f9f9;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .invoice-header h2 {
            margin: 0;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details p {
            margin: 5px 0;
        }

        .invoice-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-table th {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <img src="../public/images/yazy.png" alt="Logo" height="100px" width="100px">
        </div>
        
        <div class="invoice-details">
            <h4>Order Number: {{ $order->order_number }}</h4>
            <p>Order Date: {{ $order->order_date }}</p>
        </div>

        <div class="invoice-customer">
            <h4>Billed To:</h4>
            
            <p><strong>Name: </strong>{{ $order->user->name }}</p>
            
            <p><strong>Email: </strong>{{ $order->user->email }}</p>
            
            <p><strong> Adress: </strong>{{ $order->shipping_adress }}</p>
        </div>

        <div class="invoice-items">
            <h4>Order Items:</h4>
            <table class="table invoice-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Weight</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Shipping price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{$item->weight}}</td>
                            <td>{{ $item->price }}DA</td>
                            <td>{{ $item->subtotal }}DA</td>
                            <td>400DA</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="invoice-total">
            <h2>Total Amount: {{ $order->total_amount }}</h2>
            <p><strong> Thank you for choosing us</strong> </p>
        </div>

        <!-- Add any additional content or sections as needed -->

    </div>
</body>
</html>
