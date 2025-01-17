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
                 Lab Investigation  Single Report
                </td>
                <td class="w-30">
                    <div class="logo">
                        <img src="https://navin.mydemosoftware.com/public/user/images/logo.png" alt="" class="w-100">
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td class="w-30">
                    <strong>Lab Investigation No.</strong>
                </td>
                <td class="w-40">
                   {{ Helpers::divisionNameForQMS($data->division_id) }}/LI/{{ Helpers::year($data->created_at) }}/{{ str_pad($data->record, 4, '0', STR_PAD_LEFT) }}
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
            <div style="max-width: 700px!important; overflow: hidden;">
                <table>
                    <tr>  {{ $data->created_at }} added by {{ $data->originator }}
                        <th class="w-20">Initiator</th>
                        <td class="w-30">{{ Helpers::getInitiatorName($data->initiator_id) }}</td>
                        <th class="w-20">Date Initiation</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->created_at) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Site/Location Code</th>
                        <td class="w-30">@if($data->division_code){{ $data->division_code }} @else Not Applicable @endif</td>
                        <th class="w-20">Initiator Group</th>
                        <td class="w-30">@if($data->initiator_Group){{ $data->initiator_Group }} @else Not Applicable @endif</td>
                       
                    </tr>
                    <tr>
                        <th class="w-20">Record Number</th>
                        <td class="w-30">@if($data->record){{ $data->record }} @else Not Applicable @endif</td>
                        <th class="w-20">Severity Level</th>
                        <td class="w-30">@if($data->severity_level){{ $data->severity_level }} @else Not Applicable @endif</td>

                    </tr>
                    <tr>
                        <th class="w-20">Short Description</th>
                        <td class="w-80" colspan="3">
                            @if($data->short_description){{ $data->short_description }}@else Not Applicable @endif
                        </td>
                    </tr>
                    <tr>    
                        <th class="w-20">Assigned To </th>
                        <td class="w-30">@if($data->assign_to){{ $data->assign_to }} @else Not Applicable @endif</td>
                        {{--  <th class="w-20">Assigned To</th>
                        <td class="w-30">@if($data->assign_to){{ Helpers::getInitiatorName($data->assign_to) }} @else Not Applicable @endif</td>r>
                     --}}
                        <th class="w-20">Date Due</th>
                        <td class="w-30">@if($data->due_date){{ $data->due_date }} @else Not Applicable @endif</td>
                   
                    </tr>
                    <tr>
                        <th class="w-20">Trainer</th>
                        <td class="w-30"> @if($data->trainer) {{ $data->trainer }} @else Not Applicable @endif</td>
                        <th class="w-20">Expiry Date</th>
                        <td class="w-30">@if($data->expiry_date){{$data->expiry_date }} @else Not Applicable @endif</td>r>
                    </tr>
                    <tr>
                        <th class="w-20">Type</th>
                        <td class="w-30"> @if($data->type) {{ $data->type }} @else Not Applicable @endif</td>
                        <th class="w-20">Priority Level</th>
                        <td class="w-30">@if($data->priority_level){{$data->priority_level }} @else Not Applicable @endif</td>r>
                    </tr>
                    <tr> 
                        <th class="w-20">External Tests</th>
                        <td class="w-30"> @if($data->external_tests) {{ $data->external_tests }} @else Not Applicable @endif</td>
                        <th class="w-20">Test Lab</th>
                        <td class="w-30">@if($data->test_lab){{$data->test_lab }} @else Not Applicable @endif</td>r>
                   </tr>


                   <tr> 
                        <th class="w-20">Original Test Results</th>
                        <td class="w-30"> @if($data->original_test_result) {{ $data->original_test_result }} @else Not Applicable @endif</td>
                        <th class="w-20">Limits / Specifications</th>
                        <td class="w-30">@if($data->limit_specifications){{$data->limit_specifications }} @else Not Applicable @endif</td>r>
                   </tr>
                    <tr>
                        {{-- <th class="w-20">Additional Investigators</th>
                        <td class="w-30">@if($data->investigators){{ $data->investigators }}@else Not Applicable @endif</td> --}}
                        <th class="w-20">Department(s)</th>
                        <td class="w-30">@if($data->departments){{ $data->departments }}@else Not Applicable @endif</td>
                         <th class="w-20">Additional Investigators</th>
                        <td class="w-30">@if($data->additional_investigator){{ $data->additional_investigator }}@else Not Applicable @endif</td>
                    
                    
                    </tr>
                    <tr>
                        <th class="w-20">Description</th>
                        <td class="w-80">@if($data->description){{ $data->description }}@else Not Applicable @endif</td>
                    </tr> 
                    
                    
                    <tr>  
                       
                        <th class="w-20">Comments</th>
                        <td class="w-80">@if($data->comments){{ $data->comments }}@else Not Applicable @endif</td>
                    </tr>                       
                  <tr>  
                       
                        <th class="w-20">Related URLs</th>
                        <td class="w-80">@if($data->related_urls){{ $data->related_urls }}@else Not Applicable @endif</td>
                    </tr>  
                    
                </table>
            </div>

                <div class="border-table">
                    <div class="block-head">
                        File Attachment, if any
                    </div>
                    <table>

                        <tr class="table_bg">
                            <th class="w-20">S.N.</th>
                            <th class="w-60">Batch No</th>
                        </tr>
                            @if($data->attached_test)
                            @foreach(json_decode($data->attached_test) as $key => $file)
                                <tr>
                                    <td class="w-20">{{ $key + 1 }}</td>
                                    <td class="w-20"><a href="{{ asset('upload/' . $file) }}" target="_blank"><b>{{ $file }}</b></a> </td>
                                </tr>
                            @endforeach
                            @else
                        <tr>
                            <td class="w-20">1</td>
                            <td class="w-20">Not Applicable</td>
                        </tr>
                        @endif

                    </table>
                </div>

            </div>
            <div class="block">
                <div class="block-head">
                    Risk assessment
                </div>
                    <table>
                        <tr>
                            <th class="w-20">Severity Rate</th>
                            <td class="w-80">@if($data->severity_rate){{ $data->severity_rate }}@else Not Applicable @endif</td>
                            <th class="w-20">Occurrence</th>
                            <td class="w-80">@if($data->occurrence){{ $data->occurrence }}@else Not Applicable @endif</td>
                        
                        </tr>

                        <tr>
                            <th class="w-20">Detection</th>
                            <td class="w-80">@if($data->detection){{ $data->detection }}@else Not Applicable @endif</td>
                            <th class="w-20">RPN</th>
                            <td class="w-80">@if($data->RPN){{ $data->RPN }}@else Not Applicable @endif</td>
                        </tr>
                          <tr>  
                       
                        <th class="w-20">Risk Analysis</th>
                        <td class="w-80">@if($data->risk_analysis){{ $data->risk_analysis }}@else Not Applicable @endif</td>
                    </tr>  
                     
                    </table>
                </div>    
                <div class="block-head">
                                Geogrephic Information
                            </div>
                     <table>
                        <tr>
                            <th class="w-20">Zone</th>
                            <td class="w-80">@if($data->zone){{ $data->zone }}@else Not Applicable @endif</td>
                            <th class="w-20">Country</th>
                            <td class="w-80">@if($data->country){{ $data->country }}@else Not Applicable @endif</td>
                        
                        </tr>

                        <tr>
                            <th class="w-20">City</th>
                            <td class="w-80">@if($data->city){{ $data->city }}@else Not Applicable @endif</td>
                            <th class="w-20">State/District</th>
                            <td class="w-80">@if($data->state_district){{ $data->state_district }}@else Not Applicable @endif</td>
                        </tr>
                         
                     
                    </table>




                    

           <div class="block">
                <div class="block-head">
                Failure Mode and Effect Analysis
                </div>
                <table>
                    <tr>
                        <th class="w-20">Activity</th>
                        <td class="w-30">
                            @if($failure_mode->risk_factor)
                                @foreach(unserialize($failure_mode->risk_factor) as $riskFactor)
                                    {{ $riskFactor }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Possible Risk/Failure (Identified Risk)</th>
                        <td class="w-30">
                            @if($failure_mode->problem_cause)
                                @foreach(unserialize($failure_mode->problem_cause) as $problemCause)
                                    {{ $problemCause }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="w-50">Consequences of Risk/Potential Causes</th>
                        <td class="w-50">
                            @if($failure_mode->existing_risk_control)
                                @foreach(unserialize($failure_mode->existing_risk_control) as $riskControl)
                                    {{ $riskControl }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>


                        <th class="w-20">Severity (S)</th>
                        <td class="w-30">
                            @if($failure_mode->initial_severity)
                                @foreach(unserialize($failure_mode->initial_severity) as $severity)
                                    {{ $severity }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>
                    <tr>
    
                        <th class="w-20">Probability (P)</th>
                        <td class="w-30">
                            @if($failure_mode->initial_probability)
                                @foreach(unserialize($failure_mode->initial_probability) as $probability)
                                    {{ $probability }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                         <th class="w-20">Detection (D)</th>
                            <td class="w-80">
                                @if($failure_mode->initial_detectability)
                                    @foreach(unserialize($failure_mode->initial_detectability) as $detectability)
                                        {{ $detectability }}<br>
                                    @endforeach
                                @else
                                    Not Applicable
                                @endif
                            </td>

                    </tr>
               <tr>
                        <th class="w-20">Risk Level (RPN)</th>
                        <td class="w-30">
                            @if($failure_mode->initial_rpn)
                                @foreach(unserialize($failure_mode->initial_rpn) as $rpn)
                                    {{ $rpn }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                       <tr>
                            <th class="w-20">Control Measures recommended/ Risk mitigation proposed</th>
                            <td class="w-30">
                                @if($failure_mode->risk_control_measure)
                                    @foreach(unserialize($failure_mode->risk_control_measure) as $control_measure)
                                        {{ $control_measure }}<br>
                                    @endforeach
                                @else
                                    Not Applicable
                                @endif
                            </td>
                        </tr>

                    </tr>

                    <tr>
                        <th class="w-20">Severity (S)</th>
                        <td class="w-30">
                            @if($failure_mode->residual_severity)
                                @foreach(unserialize($failure_mode->residual_severity) as $severity)
                                    {{ $severity }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Probability (P)</th>
                        <td class="w-30">
                            @if($failure_mode->residual_probability)
                                @foreach(unserialize($failure_mode->residual_probability) as $probability)
                                    {{ $probability }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="w-20">Detection (D)</th>
                        <td class="w-30">
                            @if($failure_mode->residual_detectability)
                                @foreach(unserialize($failure_mode->residual_detectability) as $detectability)
                                    {{ $detectability }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                          <th class="w-20">Risk Level (RPN)</th>
                            <td class="w-30">
                                @if($failure_mode->residual_rpn)
                                    @foreach(unserialize($failure_mode->residual_rpn) as $resudual_rpndata)
                                        {{ $resudual_rpndata }}<br>
                                    @endforeach
                                @else
                                    Not Applicable
                                @endif
                            </td>
                    </tr>

                    <tr>
                        <th class="w-20">Category of Risk Level (Low, Medium, and High)</th>
                        <td class="w-30">
                            @if($failure_mode->risk_acceptance)
                                @foreach(unserialize($failure_mode->risk_acceptance) as $risk_level)
                                    {{ $risk_level }}<br>
                                @endforeach
                            @else
                                Not Applicable
                            @endif
                        </td>
                        <th class="w-20">Risk Acceptance (Y/N)</th>
                       <td class="w-30">
                        @if($failure_mode->risk_acceptance2)
                            @php
                                $riskAcceptance2 = unserialize($failure_mode->risk_acceptance2);
                            @endphp
                            @if(is_array($riskAcceptance2))
                                @foreach($riskAcceptance2 as $acceptance)
                                    {{ $acceptance }}<br>
                                @endforeach
                            @else
                                {{ $riskAcceptance2 }}
                            @endif
                        @else
                            Not Applicable
                        @endif
                    </td>

                    </tr>

                    <tr>
                       <th class="w-20">Traceability document</th>
                       <td class="w-80">
                        @if($failure_mode->mitigation_proposal)
                            @php
                                $proposals = unserialize($failure_mode->mitigation_proposal);
                            @endphp
                            @if(is_array($proposals))
                                @foreach($proposals as $proposal)
                                    {{ $proposal }}<br>
                                @endforeach
                            @else
                                {{ $proposals }}
                            @endif
                        @else
                            Not Applicable
                        @endif
                    </td>

                    </tr>

                </table>




            </div>    



                    <div class="block-head">
                        Fishbone or Ishikawa Diagram 
                    </div>
                    <table>

                    <tr>
                            <th class="w-20">Root Cause Methodology</th>
                            <td class="w-80">@if($data->root_cause_methodology){{ $data->root_cause_methodology }}@else Not Applicable @endif</td>
                    </tr>
                    <tr>

                         
                        <th class="w-20">Measurement</th>
                        {{-- <td class="w-80">@if($riskgrdfishbone->measurement){{ $riskgrdfishbone->measurement }}@else Not Applicable @endif</td> --}}
                             <td class="w-80">
                            @php
                                $measurement = unserialize($data->measurement);
                            @endphp
                            
                            @if(is_array($measurement))
                                @foreach($measurement as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($measurement))
                                {{ htmlspecialchars($measurement) }}
                            @else
                                Not Applicable
                            @endif
                              </td>
                        <th class="w-20">Materials</th>
                        {{-- <td class="w-80">@if($data->materials){{ $data->materials }}@else Not Applicable @endif</td> --}}
                             <td class="w-80">
                            @php
                                $materials = unserialize($data->materials);
                            @endphp
                            
                            @if(is_array($materials))
                                @foreach($materials as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($materials))
                                {{ htmlspecialchars($materials) }}
                            @else
                                Not Applicable
                            @endif
                               </td>
                        
                    </tr>
                       <tr>
                        <th class="w-20">Methods</th>
                        {{-- <td class="w-80">@if($data->methods){{ $data->methods }}@else Not Applicable @endif</td> --}}
                           <td class="w-80">
                            @php
                                $methods = unserialize($data->methods);
                            @endphp
                            
                            @if(is_array($methods))
                                @foreach($methods as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($methods))
                                {{ htmlspecialchars($methods) }}
                            @else
                                Not Applicable
                            @endif
                           </td>
                        <th class="w-20">Environment</th>
                        {{-- <td class="w-80">@if($data->environment){{ $data->environment }}@else Not Applicable @endif</td> --}}
                            <td class="w-80">
                            @php
                                $environment = unserialize($data->environment);
                            @endphp
                            
                            @if(is_array($environment))
                                @foreach($environment as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($environment))
                                {{ htmlspecialchars($environment) }}
                            @else
                                Not Applicable
                            @endif
                            </td>
                    </tr>
                    <tr>
                        <th class="w-20">Manpower</th>
                        {{-- <td class="w-80">@if($data->manpower){{ $data->manpower }}@else Not Applicable @endif</td> --}}
                            <td class="w-80">
                            @php
                                $manpower = unserialize($data->manpower);
                            @endphp
                            
                            @if(is_array($manpower))
                                @foreach($manpower as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($manpower))
                                {{ htmlspecialchars($manpower) }}
                            @else
                                Not Applicable
                            @endif
                           </td>
                        <th class="w-20">Machine</th>
                        {{-- <td class="w-80">@if($data->machine){{ $data->machine }}@else Not Applicable @endif</td> --}}
                          <td class="w-80">
                            @php
                                $machine = unserialize($data->machine);
                            @endphp
                            
                            @if(is_array($machine))
                                @foreach($machine as $value)
                                    {{ htmlspecialchars($value) }}
                                @endforeach
                            @elseif(is_string($machine))
                                {{ htmlspecialchars($machine) }}
                            @else
                                Not Applicable
                            @endif
                          </td>
                    </tr>
                    <tr>
                        <th class="w-20">Problem Statement1</th>
                        <td class="w-80">@if($data->problem_statement){{ $data->problem_statement }}@else Not Applicable @endif</td>
                      
                    </tr> 
             </table>
                        
             <div class="block-head">
                Why-Why Chart 
            </div>
            <table>
            - <tr>
                <th class="w-20">Problem Statement</th>
                <td class="w-80">@if($data->why_problem_statement){{ $data->why_problem_statement }}@else Not Applicable @endif</td>
              </tr>
               <tr>
              
                <th class="w-20">Why 1 </th>
                {{-- <td class="w-80">@if($data->why_1){{ $data->why_1 }}@else Not Applicable @endif</td> --}}
                <td class="w-80">
                    @php
                        $why_1 = unserialize($data->why_1);
                    @endphp
                    
                    @if(is_array($why_1))
                        @foreach($why_1 as $value)
                            {{ htmlspecialchars($value) }}
                        @endforeach
                    @elseif(is_string($why_1))
                        {{ htmlspecialchars($why_1) }}
                    @else
                        Not Applicable
                    @endif
                      </td>
            </tr>
               <tr>
                <th class="w-20">Why 2</th>
                {{-- <td class="w-80">@if($data->why_2){{ $data->why_2 }}@else Not Applicable @endif</td> --}}
                <td class="w-80">
                    @php
                        $why_2 = unserialize($data->why_2);
                    @endphp
                    
                    @if(is_array($why_2))
                        @foreach($why_2 as $value)
                            {{ htmlspecialchars($value) }}
                        @endforeach
                    @elseif(is_string($why_2))
                        {{ htmlspecialchars($why_2) }}
                    @else
                        Not Applicable
                    @endif
                      </td>

            </tr>
                 <tr>
                <th class="w-20">Why 3</th>
                {{-- <td class="w-80">@if($data->why_3){{ $data->why_3 }}@else Not Applicable @endif</td> --}}
                <td class="w-80">
                    @php
                        $why_3 = unserialize($data->why_3);
                    @endphp
                    
                    @if(is_array($why_3))
                        @foreach($why_3 as $value)
                            {{ htmlspecialchars($value) }}
                        @endforeach
                    @elseif(is_string($why_3))
                        {{ htmlspecialchars($why_3) }}
                    @else
                        Not Applicable
                    @endif
                      </td>
            </tr>
            <tr>
                <th class="w-20">Why 4</th>
                {{-- <td class="w-80">@if($data->why_4){{ $data->why_4 }}@else Not Applicable @endif</td> --}}
                <td class="w-80">
                    @php
                        $why_4 = unserialize($data->why_4);
                    @endphp
                    
                    @if(is_array($why_4))
                        @foreach($why_4 as $value)
                            {{ htmlspecialchars($value) }}
                        @endforeach
                    @elseif(is_string($why_4))
                        {{ htmlspecialchars($why_4) }}
                    @else
                        Not Applicable
                    @endif
                      </td>

             </tr>
             <tr>
                <th class="w-20">Why5</th>
                {{-- <td class="w-80">@if($data->why_4){{ $data->why_4 }}@else Not Applicable @endif</td> --}}
                <td class="w-80">
                    @php
                        $why_5 = unserialize($data->why_5);
                    @endphp
                    
                    @if(is_array($why_5))
                        @foreach($why_5 as $value)
                            {{ htmlspecialchars($value) }}
                        @endforeach
                    @elseif(is_string($why_5))
                        {{ htmlspecialchars($why_5) }}
                    @else
                        Not Applicable
                    @endif
                      </td>
            </tr>
            <tr>
                <th class="w-20">Root Cause :	</th>
                <td class="w-80">@if($data->why_root_cause){{ $data->why_root_cause }}@else Not Applicable @endif</td>
              
            </tr> 
     </table>
     <div class="block-head">
        Is/Is Not Analysis
    </div>
<div style="max-width: 700px!important; overflow: hidden;">
    <table>
        <tr>
            <th class="20">What Will Be</th>
            <td class="80">@if($data->what_will_be){{ $data->what_will_be }}@else Not Applicable @endif</td>
        </tr>
        <tr>
            <th class="20">What Will Not Be </th>
            <td class="80">@if($data->what_will_not_be){{ $data->what_will_not_be }}@else Not Applicable @endif</td>   
        </tr>
        <tr>   
            <th class="20">What Will Rationale </th>
            <td class="80">@if($data->what_rationable){{ $data->what_rationable }}@else Not Applicable @endif</td>
        </tr>
        <tr>
            <th class="w-20">Where Will Be</th>
            <td class="w-80">@if($data->where_will_be){{ $data->where_will_be }}@else Not Applicable @endif</td>
        </tr>  
            <th class="w-20">Where Will Not Be </th>
            <td class="w-80">@if($data->where_will_not_be){{ $data->where_will_not_be }}@else Not Applicable @endif</td>
        </tr>
        <tr> 
            <th class="w-20">Where Will Rationale </th>
            <td class="w-80">@if($data->where_rationable){{ $data->where_rationable }}@else Not Applicable @endif</td>
        </tr>
        <tr>
            <th class="w-20">When Will Be</th>
            <td class="w-80">@if($data->when_will_be){{ $data->when_will_be }}@else Not Applicable @endif</td>
        </tr>
        <tr>
            <th class="w-20">When Will Not Be </th>
            <td class="w-80">@if($data->when_will_not_be){{ $data->when_will_not_be }}@else Not Applicable @endif</td>
        </tr>
        <tr>  
            <th class="w-20">When Will Rationale </th>
            <td class="w-80">@if($data->when_rationable){{ $data->when_rationable }}@else Not Applicable @endif</td>
        </tr>
        <tr>       
            <th class="w-20">Coverage Will Be</th>
            <td class="w-80">@if($data->coverage_will_be){{ $data->coverage_will_be }}@else Not Applicable @endif</td>
        </tr>
        <tr>   

            <th class="w-20">Coverage Will Not Be </th>
            <td class="w-80">@if($data->coverage_will_not_be){{ $data->coverage_will_not_be }}@else Not Applicable @endif</td>
        </tr>
        <tr>
            <th class="w-20">Coverage Will Rationale </th>
            <td class="w-80">@if($data->coverage_rationable){{ $data->coverage_rationable }}@else Not Applicable @endif</td>
        
        </tr> 
        <tr>
            <th class="w-20">Who Will Be</th>
            <td class="w-80">@if($data->who_will_be){{ $data->who_will_be }}@else Not Applicable @endif</td>
        </tr>
        <tr>
            <th class="w-20">Who Will Not Be </th>
            <td class="w-80">@if($data->who_will_not_be){{ $data->who_will_not_be }}@else Not Applicable @endif</td>
        </tr>
        <tr>

           
            <th class="w-20">Who Will Rationale </th>
            <td class="w-80">@if($data->who_rationable){{ $data->who_rationable }}@else Not Applicable @endif</td>
        
        </tr> 
    </table>        
               
</div>












            <div class="block">
                <div class="block-head">
                    Investigation & Root Cause
                </div>

                    <table>
                    
                        <tr>
                            <th class="w-20">Root Cause Description</th>
                              <td class="w-80">@if($data->root_cause_description){{ $data->root_cause_description }}@else Not Applicable @endif</td>
                        </tr>


                        <tr>
                            <th class="w-20">Investigation Summary</th>
                              <td class="w-80">@if($data->investigation_summary){{ $data->investigation_summary }}@else Not Applicable @endif</td>
                        </tr>
                      
                       
                    </table>
                   
                </div>
            
                
                <div class="block">
                    <div class="block-head">
                        Activity log
                    </div>
                    <table>

                    <tr>
                        <th class="w-20">Acknowledge By</th>
                        <td class="w-30">{{ $data->submitted_by }}</td>
                        <th class="w-20">Acknowledge By</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->submitted_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">Submited By</th>
                        <td class="w-30">{{ $data->submitted_by }}</td>
                        <th class="w-20">Submited On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->submitted_on) }}</td>
                    </tr>
                    <tr>
                        <th class="w-20">QA Review Completed By</th>
                        <td class="w-30">{{ $data->submitted_by }}</td>
                        <th class="w-20">QA Review Completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->submitted_on) }}</td>
                    </tr>

                     <tr>
                        <th class="w-20">QA Review More Information Required By</th>
                        <td class="w-30">{{ $data->qA_review_complete_by }}</td>
                        <th class="w-20">QA Review More Information Required On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->qA_review_complete_on) }}</td>
                    </tr>
                    {{-- <tr>
                        <th class="w-20">Audit preparation completed by</th>
                        <td class="w-30">{{ $data->audit_preparation_completed_by }}</td>
                        <th class="w-20">Audit preparation completed On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->audit_preparation_completed_on) }}</td>
                    </tr> --}}
                    <tr>
                        <th class="w-20">Cancelled By</th>
                        <td class="w-30">{{ $data->cancelled_by }}</td>
                        <th class="w-20">Cancelled On</th>
                        <td class="w-30">{{ Helpers::getdateFormat($data->cancelled_by) }}</td>
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
                {{--  <td class="w-30">
                    <strong>Page :</strong> 1 of 1
                </td>  --}}
            </tr>
        </table>
    </footer>

</body>

</html>
