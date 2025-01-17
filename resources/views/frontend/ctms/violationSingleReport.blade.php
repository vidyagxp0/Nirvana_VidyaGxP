<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vidyagxp - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
    }

    .w-25 {
        width: 25%;
    }

    .w-30 {
        width: 30%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .w-70 {
        width: 70%;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 90%;
    }

    .w-100 {
        width: 100%;
    }

    .h-100 {
        height: 100%;
    }

    header table,
    header th,
    header td,
    footer table,
    footer th,
    footer td,
    .border-table table,
    .border-table th,
    .border-table td {
        border: 1px solid black;
        border-collapse: collapse;
        font-size: 0.9rem;
        vertical-align: middle;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    footer .head,
    header .head {
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
    }

    @page {
        size: A4;
        margin-top: 160px;
        margin-bottom: 60px;
    }

    header {
        position: fixed;
        top: -140px;
        left: 0;
        width: 100%;
        display: block;
    }

    footer {
        width: 100%;
        position: fixed;
        display: block;
        bottom: -40px;
        left: 0;
        font-size: 0.9rem;
    }

    footer td {
        text-align: center;
    }

    .inner-block {
        padding: 10px;
    }

    .inner-block tr {
        font-size: 0.8rem;
    }

    .inner-block .block {
        margin-bottom: 30px;
    }

    .inner-block .block-head {
        font-weight: bold;
        font-size: 1.1rem;
        padding-bottom: 5px;
        border-bottom: 2px solid #4274da;
        margin-bottom: 10px;
        color: #4274da;
    }

    .inner-block th,
    .inner-block td {
        vertical-align: baseline;
    }

    .table_bg {
        background: #4274da57;
    }
</style>

<body>

    <header>
        <table>
            <tr>
                <td class="w-70 head">
                    Violation Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://vidyagxp.com/vidyaGxp_logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Violation No.</strong>{{ $violation_data->id }}
                </td>
                <td class="w-40">
                       {{ Helpers::getDivisionName($violation_data->division_id) }}/Violation/{{ Helpers::year($violation_data->created_at) }}/{{ str_pad($violation_data->record, 4, '0', STR_PAD_LEFT) }}
                    {{--{{ Helpers::divisionNameForQMS($violation_data->division_id) }}/{{ Helpers::year($violation_data->created_at) }}/{{ $violation_data->record_number ? str_pad($violation_data->record_number->record_number, 4, '0', STR_PAD_LEFT) : '' }}--}}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($violation_data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{--<td class="w-30">
                    <strong>Page :</strong> 1 of 2
                </td>--}}
            </tr>
        </table>
    </footer>


    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    Monitor Visit
                </div>
                <table>

                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($violation_data->record)
                                {{ str_pad($violation_data->record, 4, '0', STR_PAD_LEFT) }}
                            @else
                                Not Applicable
                            @endif
                        </td>

                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">
                            @if ( Helpers::getDivisionName(session()->get('division')) )
                            {{ Helpers::getDivisionName(session()->get('division')) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr> {{ $violation_data->created_at }} added by {{ $violation_data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $violation_data->originator }}</td>

                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($violation_data->created_at) }}</td>
                    </tr>
                    <tr>

                        <th class="w-20">Assign To</th>
                        <td class="w-80">{{ $violation_data->a_originator }}</td>

                        <th class="w-20">Date Due</th>
                        <td class="w-80">{{ date('d-M-Y', strtotime($violation_data->due_date)) }}</td>
                    </tr>

                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">
                            @if ($violation_data->short_description)
                                {{ $violation_data->short_description }}

                            @endif
                        </td>

                        <th class="w-20">Type</th>
                        <td class="w-30">
                            @if ($violation_data->type)
                                {{ $violation_data->type }}

                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Other Type</th>
                        <td class="w-30">
                            @if ($violation_data->other_type)
                                {{ $violation_data->other_type }}

                            @endif
                        </td>

                        <th class="w-20">Related URL</th>
                        <td class="w-30">
                            @if ($violation_data->related_url)
                                {{ $violation_data->related_url }}

                            @endif
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th class="w-10">Description</th>
                        <td class="w-90">
                            @if ($violation_data->description)
                                {{ $violation_data->description }}

                            @endif
                        </td>
                    </tr>
                </table>

            </div>
            <div class="block">
                <div class="block-head">
                    Location
                </div>
                <table>

                    <tr>
                        <th class="w-20">Zone</th>
                        <td class="w-30">
                            @if ($violation_data->zone)
                                {{ $violation_data->zone }}

                            @endif
                        </td>

                        <th class="w-20">Country</th>
                        <td class="w-30">
                            @if ($violation_data->country_id)
                                {{ $violation_data->country_id }}

                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">State/District</th>
                        <td class="w-30">
                            @if ($violation_data->state_id)
                                {{ $violation_data->state_id }}

                            @endif
                        </td>

                        <th class="w-20">City</th>
                        <td class="w-30">
                            @if ($violation_data->city_id)
                                {{ $violation_data->city_id }}

                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Site Name</th>
                        <td class="w-30">
                            @if ($violation_data->site_name_id)
                                {{ $violation_data->site_name_id }}

                            @endif
                        </td>

                        <th class="w-20">Building</th>
                        <td class="w-30">
                            @if ($violation_data->building_id)
                                {{ $violation_data->building_id }}

                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Floor</th>
                        <td class="w-30">
                            @if ($violation_data->flore_id)
                                {{ $violation_data->flore_id }}

                            @endif
                        </td>

                        <th class="w-20">Room</th>
                        <td class="w-30">
                            @if ($violation_data->room_id)
                                {{ $violation_data->room_id }}

                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="block">
                <div class="block-head">
                    Violation Information
                </div>
                <table>

                    <tr>
                        <th class="w-20">Date Occured</th>
                        <td class="w-30">
                            @if ($violation_data->date_occured)
                                {{ date('d-M-Y', strtotime($violation_data->date_occured)) }}

                            @endif
                        </td>

                        <th class="w-20">Notification Date</th>
                        <td class="w-30">
                            @if ($violation_data->notification_date)
                                {{ date('d-M-Y', strtotime($violation_data->notification_date)) }}

                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Severity Rate</th>
                        <td class="w-30">
                            @if ($violation_data->severity_rate)
                                {{ $violation_data->severity_rate }}

                            @endif
                        </td>

                        <th class="w-20">Occurance</th>
                        <td class="w-30">
                            @if ($violation_data->occurance)
                                {{ $violation_data->occurance }}

                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Detection</th>
                        <td class="w-30">
                            @if ($violation_data->detection)
                                {{ $violation_data->detection }}

                            @endif
                        </td>

                        <th class="w-20">RPN</th>
                        <td class="w-30">
                            @if ($violation_data->rpn)
                                {{ $violation_data->rpn }}

                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Manufacturer</th>
                        <td class="w-30">
                            @if ($violation_data->manufacturer)
                                {{ $violation_data->manufacturer }}

                            @endif
                        </td>

                        <th class="w-20">Date Sent</th>
                        <td class="w-30">
                            @if ($violation_data->date_sent)
                                {{ date('d-M-Y', strtotime($violation_data->date_sent)) }}

                            @endif
                        </td>

                    </tr>

                    <tr>
                        <th class="w-20">Date Returned</th>
                        <td class="w-30">
                            @if ($violation_data->date_returned)
                                {{ date('d-M-Y', strtotime($violation_data->date_returned)) }}

                            @endif
                        </td>
                    </tr>
                </table>

                <table>

                    <tr>
                        <th class="w-20">Follow Up</th>
                        <td class="w-90">
                            @if ($violation_data->follow_up)
                                {{ $violation_data->follow_up }}

                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Summary</th>
                        <td class="w-80">
                            @if ($violation_data->summary)
                                {{ $violation_data->summary }}

                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Comments</th>
                        <td class="w-80">
                            @if ($violation_data->Comments)
                                {{ $violation_data->Comments }}

                            @endif
                        </td>
                    </tr>

                </table>
            </div>


            <div class="block">
                {{-- <div class="block"> --}}
                {{-- <div class="block-head"> --}}
                <div style="font-weight: 200">Product/Material</div>
                {{-- </div> --}}
                <div class="border-table">
                    <table>
                        <tr class="table_bg">
                            <th class="w-10">Sr. no.</th>
                            <th class="w-20">Product Name</th>
                            <th class="w-10">Batch Number</th>
                            <th class="w-10">Expiry Date</th>
                            <th class="w-10">Manufactured Date</th>
                            <th class="w-20">Disposition</th>
                            <th class="w-20">Comment</th>
                            <th class="w-20">Remarks</th>
                        </tr>

                            @php
                              $data = isset($grid_Data) && $grid_Data->data ? json_decode($grid_Data->data, true) : null;
                            @endphp

                            @if ($data && is_array($data))
                                @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}.</td>
                                    <td>{{ isset($item['ProductName']) ? $item['ProductName'] : '' }}</td>
                                    <td>{{ isset($item['BatchNumber']) ? $item['BatchNumber'] : '' }}</td>
                                    <td>{{ isset($item['ExpiryDate']) ? $item['ExpiryDate'] : '' }}</td>
                                    <td>{{ isset($item['ManufacturedDate']) ? $item['ManufacturedDate'] : '' }}</td>
                                    <td>{{ isset($item['Disposition']) ? $item['Disposition'] : '' }}</td>
                                    <td>{{ isset($item['Comment']) ? $item['Comment'] : '' }}</td>
                                    <td>{{ isset($item['Remarks']) ? $item['Remarks'] : '' }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                                <td>Not Applicable</td>
                            </tr>
                        @endif
                    </table>
                </div>
                {{-- </div> --}}
            </div>
        <div>


</body>

</html>
