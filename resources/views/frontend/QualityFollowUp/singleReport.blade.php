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
               Quality FollowUp Single Report
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
                    <strong> Audit No.</strong>
                </td>
                <td class="w-40">
                    {{ Helpers::divisionNameForQMS($data->division_id) }}/IA{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
                <td class="w-30">
                    <strong>Record No.</strong> {{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
                </td>
            </tr>
        </table>
    </header>

    <div class="inner-block">
        <div class="content-table">
            <div class="block">
                <div class="block-head">
                    General Information
                </div>
                <table>
                    <tr> {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ $data->originator }}</td>
                        <th class="w-20">Date of Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">
                            @if ($data->record)
                                {{ $data->record }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Division Id</th>
                        <td class="w-30">
                            @if ($data->division_id)
                                {{ $data->division_id }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Assigned To</th>
                        <td class="w-30">
                            @if ($data->assign_to)
                                {{ Helpers::getInitiatorName($data->assign_to) }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Product</th>
                        <td class="w-30">
                            @if ($data->product)
                                {{ $data->product }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-30">
                            @if ($data->short_description)
                                {{ $data->short_description }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Date Due </th>
                        <td class="w-30">
                            @if ($data->due_date)
                            {{ $data->due_date }}
                        @else
                            Not Applicable
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Type Of Product</th>
                        <td class="w-30">
                            @if ($data->product_type)
                                {{ $data->product_type }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Priority Level</th>
                        <td class="w-30">
                            @if ($data->priority_level)
                                {{ $data->priority_level }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-30">
                            @if ($data->discription)
                                {{ $data->discription }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Comments</th>
                        <td class="w-30">
                            @if ($data->comments)
                            {{ $data->comments }}
                        @else
                            Not Applicable
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Scheduled Start Date</th>
                        <td class="w-30">
                            @if ($data->scheduled_start_date)
                                {{ $data->scheduled_start_date }}
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">
                            Scheduled End Date</th>
                        <td class="w-30">
                            @if ($data->scheduled_end_date)
                            {{ $data->scheduled_end_date }}
                        @else
                            Not Applicable
                        @endif
                        </td>
                    </tr>
                </table>

                <div class="border-table">
                    <div class="block-head">
                        File Attachment
                    </div>
                    <table>
                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-100">Batch No</th>
                        </tr>
                        @if ($data->file_attachment)
                            @foreach (json_decode($data->file_attachment) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-100">
                                        <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                            <b>{{ $file }}</b>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="w-20">1</td>
                                <td class="w-100">Not Applicable</td>
                            </tr>
                        @endif
                    </table>

            </div>
        </div>
        <table>
<tr>
    <th class="w-20">Quality Follow Up Summary</th>
    <td class="w-30">
        @if ($data->quality_follow_up_summary)
        {{ $data->quality_follow_up_summary }}
    @else
        Not Applicable
    @endif
    </td>
</tr>
                    </tbody>
        </table>

        <div class="inner-block">
            <div class="content-table">
                <div class="block">
                    <div class="block-head">
                        Activity log
                    </div>
                    <table>
                        <tr>
                            <th class="w-20">Acknowledge By</th>
                            <td class="w-30">{{ $data->acknowledge_by }}</td>
                            <th class="w-20">Acknowledge On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->acknowledge_on) }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Complete
                                By</th>
                            <td class="w-30">{{ $data->Complete_by }}</td>
                            <th class="w-20">Complete
                                On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->Complete_on) }}</td>
                        </tr>
                        <tr>
                            <th class="w-20">Quality Approval By</th>
                            <td class="w-30">{{ $data->Quality_Approval_by }}</td>
                            <th class="w-20">Quality Approval On</th>
                            <td class="w-30">{{ Helpers::getdateFormat($data->Quality_Approval_on) }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    <footer>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Printed On :</strong> {{ date('d-M-Y') }}
                </td>
                <td class="w-40">
                    <strong>Printed By :</strong> {{ Auth::user()->name }}
                </td>
                {{-- <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td> --}}
            </tr>
        </table>
    </footer>

</body>

</html>
