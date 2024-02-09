<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="x-apple-disable-message-reformatting" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="color-scheme" content="light dark" />
    <meta name="supported-color-schemes" content="light dark" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('admin/assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <style>
        body{
    background:#eee;
}

.card {
  width: 350px;
  padding: 10px;
  border-radius: 20px;
  background: orange;
  border: none;
  color: #fff;
  height: 350px;
  display: flex;
  position: relative;
  align-items: center;
  justify-content: center;
}

.container {
  height: 100vh;
}

.card h1 {
  font-size: 48px;
  margin-bottom: 0px;
}

.card span {
  font-size: 28px;
}

.image {
  position: absolute;
  opacity: .1;
  left: 0;
  top: 0;
}

.image2 {
  position: absolute;
  bottom: 0;
  right: 0;
  opacity: .1;
}
    </style>
    <div class="d-flex justify-content-center align-items-center container">
        <div class="d-flex card text-center">
            <div class="image"><img src="https://i.imgur.com/DC94rZe.png" width="150"></div>
            <div class="image2"><img src="https://i.imgur.com/DC94rZe.png" width="150"></div>
            @if($formData['coupon_data']->type=="percent")
            <h1>{{ $formData['coupon_data']->discount_amount }}% OFF</h1><span class="d-block">On Everything</span><span class="d-block">for {{ \carbon\carbon::parse($formData['coupon_data']->expires_at)->format('d M,Y') }}</span>
            @else
            <h1>{{ $formData['coupon_data']->discount_amount }}$ OFF</h1><span class="d-block">On Everything</span><span class="d-block">for {{ \carbon\carbon::parse($formData['coupon_data']->expires_at)->format('d M,Y') }}</span>
            @endif
            <div class="mt-4"><small>With Code : {{ $formData['coupon_code'] }}</small></div>
        </div>
    </div>
<script src="{{ asset('admin/assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin/assets') }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset('admin/assets') }}/vendor/fontawesome-free-6.5.1-web/js/all.min.js"></script>
</body>
</html>
