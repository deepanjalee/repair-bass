<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice </title>

    <script>
        window.print();
    </script>
    {{-- <style>
    @font-face {
            font-family: 'FMArjun';
            src: url('{{ public_path("fonts/FMArjun.ttf") }}') format('truetype');
        }
        body {
            font-family: 'FMArjun', sans-serif;
        }

        .unicode{
            font: normal 12px/20px FMArjun;
        }
   </style> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sinhala:wght@100..900&display=swap" rel="stylesheet">

    <style>
        .unicode {
            font-family: "Noto Sans Sinhala", serif;
            font-optical-sizing: auto;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }
    </style>
</head>

<body>


    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Desc
                    </th>

                    <th scope="col" class="px-6 py-3 unicode">
                        Price
                        ලෝකයේ පවත්නා නිද

                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="unicode px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->description }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $item->price }}
                        </td>
                    </tr>
                @empty
                @endforelse


            </tbody>
        </table>
    </div>

</body>

</html>
