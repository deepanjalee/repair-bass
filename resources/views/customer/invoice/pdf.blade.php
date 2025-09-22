<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <style>

        @media print {
            @page {
                margin: 20mm 10mm 30mm 10mm;
            }

            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
                margin: 0;
                /* leave space for footer */
            }

            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 20mm;
                text-align: center;
                font-size: 12px;
                color: #888;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            padding: 0;
            background-color: #fff;
            color: #000;
            width: 100%;
            overflow-x: hidden;
            font-size: 13px;
        }

        .invoice-box {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo img {
            height: 60px;
        }

        .company-info h1 {
            color: #333;
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
            border: 1px solid #ddd;
        }

        table th {
            background-color: #333 !important;
            color: white !important;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .total {
            margin-top: 30px;
            text-align: right;
        }

        .total p {
            margin: 2px 0;
        }



        .small-text {
            font-size: 11px;
            color: #8f8f8f;
        }

        .light-row {
            background-color: #dfdee1 !important;
            border: 2px solid white !important;
        }
    </style>
    <script>
        window.print();
    </script>

</head>

<body>
    <div class="invoice-box">
        <!-- Header with logo -->
        <div class="header">
            <div class="company-info">
                <h1>INVOICE</h1>
                <b>Repair Bass PVT LTD</b>
                <p>No:7/A,St.michel Rd, </p>
                <p>Hadigama,Piliyandala </p>
                <p>+94 70 563 6002 | +94 75 703 6002</p>
            </div>
            <div class="logo">
                <img src="{{ asset('img/repair-bass.png') }}" alt="Company Logo" style="width:150px;height: 150px;" />
            </div>
        </div>

        <!-- Invoice details -->
        <div class="details">
            <div class="left">
                <p><strong>Bill To:</strong></p>
                <p> <strong>Customer: </strong> Mr/MRs/Miss . {{ optional($invoice->customer)->full_name }}</p>
                <p><strong>Site: </strong>{{ optional($invoice->site)->name }}</p>
                <p><strong>Address: </strong>{{ optional($invoice->site)->address }}</p>
                <p><strong>Mobile: </strong>{{ optional($invoice->customer)->mobile }}</p>
            </div>
            <div class="right">
                <p><strong>Invoice Details:</strong></p>
                <p><strong>Invoice No:</strong> {{ $invoice->invoice_number }}</p>
                <p><strong>Date:</strong> {{ $invoice->date }} </p>
            </div>
            <div class="clear"></div>
        </div>

        <!-- Table of items -->
        <table>
            <thead>
                <tr>
                    <td colspan="5">Material Cost</td>
                </tr>

                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>U.Price</th>
                    <th>Qty</th>
                    <th style="text-align: right;">Total(LKR)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoice->items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->item->item_name }}
                            <br>
                            <span class="small-text">
                                {{ $item->description }}
                            </span>
                        </td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td style="text-align: right;">{{ number_format($item->total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No items found</td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="5">Labour & Other Cost</td>
                </tr>
                <thead>
                    <tr>
                        <th>#</th>
                        <th colspan="3">Cost</th>

                        <th style="text-align: right;">Peice(LKR)</th>
                    </tr>
                </thead>


                
                @forelse ($invoice->expenses as $expense)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td colspan="3">{{ $expense->name }}
                            <br>
                            <span class="small-text">
                                {{ $expense->description }}
                            </span>
                        </td>
                        <td style="text-align: right;">{{ number_format($expense->price, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No items found</td>
                    </tr>
                @endforelse

                <tr class="light-row">
                    <td colspan="4" style="text-align: right;"><strong>Subtotal:</strong></td>
                    <td style="text-align: right;"><strong> {{ number_format($invoice->sub_total, 2) }} </strong>
                    </td>
                </tr>
                <tr class="light-row">
                    <td colspan="4" style="text-align: right;"><strong>Discount:</strong> </td>
                    <td style="text-align: right;"><strong>{{ number_format($invoice->discount, 2) }}</strong> </td>
                </tr>
                <tr class="light-row">
                    <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                    <td style="text-align: right;"><strong>{{ number_format($invoice->total, 2) }}</strong> </td>
                </tr>

                <tr>
                    <td colspan="5"><strong>Remarks:</strong>
                        <span style="color: #ff5f5f;"> {{ $invoice->remarks }} <span>
                    </td>

                </tr>
            </tbody>



        </table>

        <!-- Total section -->


        <div style="margin-top: 30px; display: flex; justify-content: space-between;">
            <div style="width: 20%;">
                <div style="border-top: 2px dotted #000; margin-top: 50px; padding-top: 10px;">
                    <p style="margin: 0; text-align: center; ">Customer Signature</p>
                </div>
            </div>
            <div style="width: 20%;">
                <div style="border-top: 2px dotted #000; margin-top: 50px; padding-top: 10px;">
                    <p style="margin: 0;text-align: center; ">Proprietor Signature</p>
                </div>
            </div>
        </div>

        <!-- Footer -->

    </div>

    {{-- <div class="footer">
        <p>Thank you for your business! If you have any questions, please contact repairbass@gmail.com </p>
    </div> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>
