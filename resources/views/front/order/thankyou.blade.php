<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{config('app.name')}}</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f8fb;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .success-container {
      background-color: #fff;
      padding: 40px 30px;
      text-align: center;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      max-width: 400px;
      width: 100%;
    }

    .success-icon {
      font-size: 60px;
      color: #4BB543;
    }

    h1 {
      font-size: 26px;
      color: #333;
      margin: 20px 0 10px;
    }

    p {
      font-size: 16px;
      color: #666;
    }

    .btn-home {
      margin-top: 25px;
      display: inline-block;
      background-color: #4BB543;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .btn-home:hover {
      background-color: #3aa634;
    }
  </style>
</head>
<body>

  <div class="success-container">
    <div class="success-icon">✅</div>
    <h1>Order Successful!</h1>
    <p>Thank you for your order. Your order has been completed successfully🎉.</p>
    <a class="btn-home" href="{{url('user/orderlist')}}">View Orders</a>
  </div>

</body>
</html>
