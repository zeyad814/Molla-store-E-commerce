<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size:16px;">


            <h1>you have received an order:</h1>
    <h2>Your Order ID: #{{ $mailData['order']->id }}</h2>
    <h1 class="h5 mb-3">Shipping Address</h1>
                            <address>
                                <strong>{{ $mailData['order']->first_name." ".$mailData['order']->last_name }}</strong><br>
                                {{ $mailData['order']->address }}<br>
                                {{ $mailData['order']->town }},{{ $mailData['order']->state }},{{ $mailData['order']->postal_code }}<br>
                                Phone: (+20) {{ $mailData['order']->phone }}<br>
                                Email: {{ $mailData['order']->email }}
                            </address>
                            </div>

    <h2>Products :</h2>

    <table cellpadding="3" cellspacing="3" border="0">
        <thead>

            <tr style="color:#ccc;">
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData['products'] as $product)
            <tr>
                <td>{{ $product->product->product_name }}</td>
                <td>${{ $product->product->final_price }}</td>
                <td>{{ $product->product_qty }}</td>
                <td>${{ $product->product->final_price*$product->product_qty }}</td>
            </tr>
            @endforeach


            <tr>
                <th colspan="3" align="right">Subtotal:</th>
                <td>${{ $mailData['order']->total }}</td>
            </tr>

            <tr>
                <th colspan="3" align="right">Shipping:</th>
                <td>$0</td>
            </tr>
            <tr>
                <th colspan="3" align="right">Grand Total:</th>
                <td>${{ $mailData['order']->total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
