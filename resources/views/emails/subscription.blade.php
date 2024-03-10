<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: rgb(238, 238, 238);
        }

        .bill-container {
            width: 60%;
            margin-inline: auto;
            border: 1px solid rgb(201, 201, 201);
            background-color: white;
        }

        .bill-container .bill-header {
            padding: 15px;
            background-color: rgb(75, 75, 163);
            color: white;
            /* text-align: end; */
            font-size: 26px;
            font-weight: 700;
        }

        .bill-container .bill-body {
            padding: 25px;
            /* text-align: end; */

        }

        .bill-container .bill-body table {
            border: 1px solid rgb(201, 201, 201);
            width: 100%;
            /* text-align: end; */
        }

        .bill-container .bill-body table thead th {
            padding: 10px;
        }

        .bill-container .bill-body table thead tr {
            padding: 10px;
        }

        table,
        th,
        td {
            border: 1px solid rgb(201, 201, 201);
            border-collapse: collapse;
            padding: 10px;
        }

        .bill-title .title-details {
            border: 1px solid rgb(201, 201, 201);
            padding: 7px;
        }

        .fw-bold {
            font-weight: 600;
        }
    </style>
</head>
@if ($data['lang'] == 'ar')

    <body dir="rtl">
        <div class="bill-container">
            <div class="bill-header">
                <p> طلب جديد: رقم {{ $data['subscribtion']['id'] }}</p>
            </div>
            <div class="bill-body">
                <span>لقد استلمت الطلب التالي من {{ $data['user']['name'] }}
                    :</span>
                <p>الطلب#[{{ $data['subscribtion']['id'] }}]
                    ({{ date('Y-m-d', strtotime($data['subscribtion']['subscription_date'])) }})</p>

                <div class="bill-table">
                    <table>
                        <thead>
                            <th>المنتج</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>اشتراك الباقة ({{ $data['packageName'] }})</td>
                                <td>1</td>
                                <td>{{ $data['subscribtion']['price'] }}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    المجموع
                                </td>
                                <td>
                                    {{ $data['subscribtion']['price'] }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    وسيلة الدفع
                                </td>
                                <td>
                                    IDEAL
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    المجموع
                                </td>
                                <td>
                                    {{ $data['subscribtion']['price'] }}
                                </td>

                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bill-title">
                    <h3>
                        عنوان الفاتوة
                    </h3>
                    <div class="title-details">
                        {{ $data['address_ar'] }}
                        <br>
                        {{ $data['first_phone'] }}
                        <br>
                        {{ $data['email'] }}
                    </div>
                    <p>
                        تهانينا بنجاح الطلب
                    </p>
                </div>
            </div>
        </div>
    </body>
@else

    <body dir="rtl">
        <div class="bill-container">
            <div class="bill-header">
                <p> Bestellingsnummer : {{ $data['subscribtion']['id'] }}</p>
            </div>
            <div class="bill-body">
                <span>Ik heb de volgende bestelling ontvangen van {{ $data['user']['name'] }}
                    :</span>
                <p>de eis#[{{ $data['subscribtion']['id'] }}]
                    ({{ date('Y-m-d', strtotime($data['subscribtion']['subscription_date'])) }})</p>

                <div class="bill-table">
                    <table>
                        <thead>
                            <th>Product</th>
                            <th>Hoeveelheid</th>
                            <th>Prijs</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pakket abonnement ({{ $data['packageName'] }})</td>
                                <td>1</td>
                                <td>{{ $data['subscribtion']['price'] }}</td>
                            </tr>
                            <tr>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    het totaal
                                </td>
                                <td>
                                    {{ $data['subscribtion']['price'] }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    Betaalmethode
                                </td>
                                <td>
                                    IDEAL
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold">
                                    het totaal
                                </td>
                                <td>
                                    {{ $data['subscribtion']['price'] }}
                                </td>

                            </tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bill-title">
                    <h3>
                        Adres
                    </h3>
                    <div class="title-details">
                        {{ $data['address_nl'] }}
                        <br>
                        {{ $data['secound_phone'] }}
                        <br>
                        {{ $data['email'] }}
                    </div>
                    <p>
                        Gefeliciteerd met de verkoop
                    </p>
                </div>
            </div>
        </div>
    </body>
@endif

</html>
