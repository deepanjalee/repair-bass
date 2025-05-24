<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Invoice</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 40px;
      background-color: #fff;
      color: #000;
    }
    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 2px solid #d40000;
      box-shadow: 0 0 10px rgba(0,0,0,0.15);
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .logo img {
      height: 60px;
    }
    .company-info h1 {
      color: #d40000;
      margin-bottom: 0;
    }
    .company-info p {
      margin: 2px 0;
    }
    .details {
      margin-top: 30px;
    }
    .details .left,
    .details .right {
      width: 48%;
    }
    .details .left {
      float: left;
    }
    .details .right {
      float: right;
      text-align: right;
    }
    .clear {
      clear: both;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    table th {
      background-color: #d40000;
      color: white;
      padding: 10px;
      text-align: left;
    }
    table td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    .total {
      margin-top: 30px;
      text-align: right;
    }
    .total p {
      margin: 2px 0;
    }
    .footer {
      margin-top: 50px;
      text-align: center;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="invoice-box">
    <!-- Header with logo -->
    <div class="header">
      <div class="company-info">
        <h1>QUOTATION</h1>
        <b>Repair Bass PVT LTD</b>
        <p>No:7/A,St.michel Rd, </p>
        <p>Hadigama,Piliyandala </p>
        <p>+94 70 563 6002</p>
      </div>
      <div class="logo">
        <img src="{{ asset('img/repair-bass.png') }}" alt="Company Logo" style="width:150px;height: 150px;"/>
      </div>
    </div>

    <!-- Invoice details -->
    <div class="details">
      <div class="left">
        <p><strong>Bill To:</strong></p>
        <p> <strong>Customer: </strong> Mr/MRs/Miss . {{ optional($quotation->customer)->full_name }}</p>
        <p><strong>Site: </strong>{{ optional($quotation->site)->name }}</p>
        <p><strong>Address: </strong>{{ optional($quotation->site)->address }}</p>
        <p><strong>Mobile: </strong>{{ optional($quotation->customer)->mobile }}</p>
      </div>
      <div class="right">
       <p><strong>Quotation Details:</strong></p>
        <p><strong>Quotation No:</strong> INV-1001</p>
        <p><strong>Date:</strong> 2025-05-17</p>
        <p><strong>Due Date:</strong> 2025-05-31</p>
      </div>
      <div class="clear"></div>
    </div>

    <!-- Table of items -->
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Item</th>
          <th>U.Price</th>
          <th>Qty</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($quotation->items as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $item->item->item_name }}</td>
          <td>{{ $item->price }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $item->total }}</td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center">No items found</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Total section -->
    <div class="total">
      <p><strong>Subtotal:</strong> Rs. 14,000</p>
      <p><strong>Discount:</strong> Rs. 1,000</p>
      <p><strong>VAT (0%):</strong> Rs. 0</p>
      <p><strong>Total:</strong> <span style="color: #d40000;">Rs. 13,000</span></p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>Thank you for your business!</p>
      <p>If you have any questions, please contact info@redblackco.com</p>
    </div>
  </div>
</body>
</html>
