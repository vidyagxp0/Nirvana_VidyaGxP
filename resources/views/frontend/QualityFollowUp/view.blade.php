
@extends('frontend.layout.main')
@section('container')
<style>
    textarea.note-codable {
        display: none !important;
    }

    header {
        display: none;
    }
</style>

<style>
    .progress-bars div {
        flex: 1 1 auto;
        border: 1px solid grey;
        padding: 5px;
        text-align: center;
        position: relative;
        /* border-right: none; */
        background: white;
    }

    .state-block {
        padding: 20px;
        margin-bottom: 20px;
    }

    .progress-bars div.active {
        background: green;
        font-weight: bold;
    }

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(1) {
        border-radius: 20px 0px 0px 20px;
    }

    #change-control-fields>div>div.inner-block.state-block>div.status>div.progress-bars.d-flex>div:nth-child(4) {
        border-radius: 0px 20px 20px 0px;

    }
     .input_width {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 11px;
        }
</style>

<div class="form-field-head">
    {{-- <div class="pr-id">
            New Child
        </div> --}}
    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        / Quality Follow Up
    </div>
</div>



{{-- ! ========================================= --}}
{{-- !               DATA FIELDS                 --}}
{{-- ! ========================================= --}}
<div id="change-control-fields">
    <div class="container-fluid">

        <div class="inner-block state-block">
            <div class="d-flex justify-content-between align-items-center">
                <div class="main-head">Record Workflow </div>

                <div class="d-flex" style="gap:20px;">
                    {{-- @php
                        $userRoles = DB::table('user_roles')
                            ->where(['user_id' => Auth::user()->id, 'q_m_s_divisions_id' =>$data->division_id])->get();

                            $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                    @endphp --}}

                    @php
                    $userRoles = DB::table('user_roles')->where(['user_id' => Auth::user()->id])->get();
                    $userRoleIds = $userRoles->pluck('q_m_s_roles_id')->toArray();
                @endphp

                    {{-- <button class="button_theme1" onclick="window.print();return false;"
                        class="new-doc-btn">Print</button> --}}
                    <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/QualityFollowupAuditTrialDetails', $data->id) }} ">
                            {{-- {{ url('DeviationAuditTrial', $data->id) }} --}}

                            {{-- add here url for auditTrail i.e. href="{{ url('CapaAuditTrial', $data->id) }}" --}}
                            Audit Trail </a> </button>

                     @if ($data->stage == 1 && (in_array(3, $userRoleIds) || in_array(18, $userRoleIds)))
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Acknowledge
                    </button>


                    @elseif($data->stage == 2 && (in_array(18, $userRoleIds) || in_array(18, $userRoleIds)))
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Complete
                    </button>


                    @elseif($data->stage == 3 && (in_array(24, $userRoleIds) || in_array(18, $userRoleIds)))
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#quality_send2">
                        Reject
                    </button>
                    <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#signature-modal">
                        Quality Approval
                    </button>
                    @elseif($data->stage == 4 &&(in_array(24, $userRoleIds) || in_array(18, $userRoleIds) || in_array(Auth::user()->id, $valuesArray)))
                    {{-- <button class="button_theme1" data-bs-toggle="modal" data-bs-target="#child-modal">
                        Closed - Done
                    </button> --}}
                    @endif
                     <button class="button_theme1"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit
                        </a> </button>
                </div>
            </div>

{{-- =============================================================================================================== --}}
            <div class="status">
                <div class="head">Current Status</div>
                @if ($data->stage == 0)
                <div class="progress-bars ">
                    <div class="bg-danger">Closed-Cancelled</div>
                </div>

                @else
               <div class="progress-bars d-flex" style="font-size: 15px;">
                    @if ($data->stage >= 1)
                    <div class="active">Opened</div>
                    @else
                    <div class="">Opened</div>
                    @endif

                    @if ($data->stage >= 2)
                    <div class="active">Work In Progress</div>
                    @else
                    <div class="">Work In Progress</div>
                    @endif

                    @if ($data->stage >= 3)
                    <div class="active">Pending Approval</div>
                    @else
                    <div class="">Pending Approval</div>
                    @endif

                    @if ($data->stage >= 4)
                    <div class="bg-danger">Closed - Done</div>
                    @else
                    <div class="">Closed - Done</div>
                    @endif

               </div>






                    @endif
                </div>



                    {{-- <div class="progress-bars d-flex" style="font-size: 15px;">
                        <div class="{{ $data->stage >= 1 ? 'active' : '' }}">Opened</div>

                        <div class="{{ $data->stage >= 2 ? 'active' : '' }}">Submission Preparation</div>

                        <div class="{{ $data->stage >= 3 ? 'active' : '' }}">Pending Submission Review</div>

                        <div class="{{ $data->stage >= 4 ? 'active' : '' }}">Authority Assessment</div>

                        @if ($data->stage == 5)
                            <div class="bg-danger">Closed - Withdrawn</div>
                        @elseif ($data->stage == 6)
                            <div class="bg-danger">Closed - Not Approved</div>
                        @elseif ($data->stage == 8)
                            <div class="bg-danger">Approved</div>
                        @elseif ($data->stage == 9)
                            <div class="bg-danger">Closed - Retired</div>
                        @else
                            <div class="{{ $data->stage >= 7 ? 'active' : '' }}">Pending Registration Update</div>
                        @endif
                    </div>
                @endif --}}

                {{-- </div>
              @endif
                ---------------------------------------------------------------------------------------- --}}
            </div>
















        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Quality Follow Up</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Activity Log</button>
        </div>

        <form action="{{ route('quality.update' , $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
 @method('PUT')
            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif

                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">

                        <div class="sub-head">General Information</div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Originator"><b>Record Number</b></label>
                                 <input type="text" name="record"   disabled  value="{{ Helpers::getDivisionName(session()->get('division')) }}/QF/{{ date('Y') }}/{{ $data->record }}">


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Originator"><b>Division Id</b></label>
                                <input readonly type="text" name="division_id" value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                <input type="hidden"  disabled name="division_id" value="{{ session()->get('division') }}" disabled>


                            </div>
                        </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Originator"><b>Initiator</b></label>
                                    <input type="text" name="initiator_id" value="{{ $validation->initiator_id ?? Auth::user()->name }}" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Division Code"><b>Date Of Initiation</b></label>
                                    <input disabled type="text" value="{{ date('d-M-Y') }}" name="date_of_initiation">
                                    <input type="hidden" value="" name="date_of_initiation">

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">


                                    <label for="Short Description">Product</label>
                                    <input id="docname" type="text" name="product" {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}   value = "{{$data->product}}" >
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Short Description">Short Description<span class="text-danger">*</span></label><span id="rchars">255</span>
                                    characters remaining
                                    <input id="docname" type="text" name="short_description"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}  value = "{{ $data->short_description }}"   maxlength="255" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">
                                        Assigned To <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}} >
                                        <option value="">Select a value</option>
                                        <option value="Vibha" @if (isset($data->assign_to) && $data->assign_to == 'Vibha') selected @endif>Vibha</option>
                                        <option value="Shruti" @if (isset($data->assign_to) && $data->assign_to == 'Shruti') selected @endif>Shruti</option>
                                        <option value="Monika" @if (isset($data->assign_to) && $data->assign_to == 'Monika') selected @endif>Monika</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date"> Due Date<span class="text-danger"></span></label>
                                    <div><small class="text-primary">Please mention expected date of completion</small></div>

                                    <div class="calenderauditee">
                                        <input type="hidden" value="{{$due_date}}" name="due_date">
                                        <input  type="text" value="{{Helpers::getdateFormat($due_date)}}"  {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}} >
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Type">Type Of Product</label>
                                    <select name="product_type"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}>
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="1" @if (isset($data->product_type) && $data->product_type == '1') selected @endif>1</option>
                                        <option value="2" @if (isset($data->product_type) && $data->product_type == '2') selected @endif>2</option>
                                        <option value="3" @if (isset($data->product_type) && $data->product_type == '3') selected @endif>3</option>


                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Type">Priority Level</label>
                                    <select name="priority_level"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}>
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="1" @if (isset($data->priority_level) && $data->priority_level == '1') selected @endif>1</option>
                                        <option value="2" @if (isset($data->priority_level) && $data->priority_level == '2') selected @endif>2</option>
                                        <option value="3" @if (isset($data->priority_level) && $data->priority_level == '3') selected @endif>3</option>


                                    </select>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Description</label>
                                    <textarea class="summernote"     {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}  name="discription" id="summernote-16"> {{$data->discription}}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Comments</label>
                                    <textarea class="summernote"      {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}} name="comments" id="summernote-16">{{$data->comments}}</textarea>
                                </div>
                            </div>


                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="scheduled_start_date">Scheduled Start Date <span class="text-danger"></span></label>

                                    <div class="calenderauditee">

                                        <input type="text"    {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}  value="{{ \Carbon\Carbon::parse($data->scheduled_start_date)->format('d-M-Y') }}" name="scheduled_start_date" id="scheduled_start_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}  value="{{ \Carbon\Carbon::parse($data->scheduled_start_date)->format('Y-m-d') }}" id="start_date_checkdate" name="scheduled_start_date" class="hide-input" oninput="handleDateInput(this, 'scheduled_start_date');checkDate('start_date_checkdate','end_date_checkdate')" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="scheduled_end_date">Scheduled End Date <span class="text-danger"></span></label>
                                    <div class="calenderauditee">
                                        <input type="text"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}  value="{{ \Carbon\Carbon::parse($data->scheduled_end_date)->format('d-M-Y') }}" name="scheduled_end_date" id="scheduled_end_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date"     {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}   value="{{ \Carbon\Carbon::parse($data->scheduled_end_date)->format('Y-m-d') }}" id="start_date_checkdate" name="scheduled_end_date" class="hide-input" oninput="handleDateInput(this, 'scheduled_end_date');checkDate('start_date_checkdate','end_date_checkdate')" />

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Inv Attachments">File Attachments</label>
                                    <div>
                                        <small class="text-primary">Please Attach all relevant or supporting documents</small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="file_attachment"    {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}  oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                            @if (!is_null($data->file_attachment))
                                                @php
                                                    $attachments = json_decode($data->file_attachment);
                                                @endphp
                                                @if (is_array($attachments) || is_object($attachments))
                                                    @foreach ($attachments as $file)
                                                        <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                                            <b>{{ $file }}</b>
                                                            <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                                                <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                                            </a>
                                                            <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                                                <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                                            </a>
                                                        </h6>
                                                    @endforeach
                                                @endif
                                            @endif
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="file_attachment" name="file_attachment[]"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}  oninput="addMultipleFiles(this, 'file_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Type">Related URLs</label>
                                    <select name="related_url"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}} >
                                        <option value="">Enter Your Selection Here</option>

                                        <option value="1" @if (isset($data->related_url) && $data->related_url == '1') selected @endif>1</option>
                                        <option value="2" @if (isset($data->related_url) && $data->related_url == '2') selected @endif>2</option>
                                        <option value="3" @if (isset($data->related_url) && $data->related_url == '3') selected @endif>3</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Reference Recores"> Related Records</label>
                                    <select name="related_record"   {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}} >
                                        <option value="">Enter Your Selection Here</option>

                                        <option value="Ankit" @if (isset($data->related_record) && $data->related_record == 'Ankit') selected @endif>Ankit</option>
                                        <option value="Rohit" @if (isset($data->related_record) && $data->related_record == 'Rohit') selected @endif>Rohit</option>

                                    </select>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label class="mt-4" for="Audit Comments"> Quality Follow Up Summary</label>
                                    <textarea class="summernote" name="quality_follow_up_summary" id="summernote-16"> {{$data->quality_follow_up_summary}}     {{ $data->stage == 0 || $data -> stage == 4 ? 'disabled' : ''}}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>




                <div id="CCForm2" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Submitted By">Acknowledge By</label>
                                    <div class="static">{{ $data->acknowledge_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Submitted On">Acknowledge On</label>
                                    <div class="Date">{{ $data->acknowledge_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Incident Review Completed By">Complete
                                        By</label>
                                    <div class="static">{{ $data->Complete_by }} </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Incident Review Completed On">Complete
                                        On</label>
                                    <div class="Date">{{ $data->Complete_on }} </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Investigation Completed By">Reject By</label>
                                    <div class="static">{{ $data->Reject_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Investigation Completed On">Reject On</label>
                                    <div class="Date">{{ $data->Reject_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA Review Completed By">Quality Approval By</label>
                                    <div class="static">{{ $data->Quality_Approval_by }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA Review Completed On">Quality Approval On</label>
                                    <div class="Date">{{ $data->Quality_Approval_on }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA Head Approval Completed By"></label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="QA Head Approval Completed On"></label>
                                    <div class="Date"></div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="All Activities Completed By"></label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="All Activities Completed On"></label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                             <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Review Completed By"></label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Review Completed On"></label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Cancelled By"></label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Cancelled On"></label>
                                    <div class="Date"></div>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="All Activities Completed By">All Activities Completed By</label>
                                    <div class="static">{{ $data->all_activities_completed_by }}</div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="All Activities Completed On">All Activities Completed On</label>
                                    <div class="Date">{{ $data->all_activities_completed_on }}</div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Review Completed By">Review Completed By</label>
                                    <div class="static">{{$data->review_completed_by}}</div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Review Completed On">Review Completed On</label>
                                    <div class="Date">{{$data->review_completed_on}}</div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="submit" {{ $data->stage == 0 || $data->stage == 8 ? "disabled" : "" }}>Submit</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}"> Exit </a> </button>
                        </div>
                    </div>
                </div>

        </form>

    </div>
</div>

<div class="modal fade" id="signature-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('quality_send_stage', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username  <span
                            class="text-danger">*</span></label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password  <span
                            class="text-danger">*</span></label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment</label>
                        <input type="comment" name="comment">
                    </div>
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal">Submit</button>
                    <button>Close</button>
                </div> -->
                <div class="modal-footer">
                          <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
             </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="quality_send2">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">E-Signature</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('quality_send2', $data->id) }}" method="POST">
                @csrf
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3 text-justify">
                        Please select a meaning and a outcome for this task and enter your username
                        and password for this task. You are performing an electronic signature,
                        which is legally binding equivalent of a hand written signature.
                    </div>
                    <div class="group-input">
                        <label for="username">Username  <span
                            class="text-danger">*</span></label>
                        <input type="text" class="input_width" name="username" required>
                    </div>
                    <div class="group-input">
                        <label for="password">Password  <span
                            class="text-danger">*</span></label>
                        <input type="password" class="input_width" name="password" required>
                    </div>
                    <div class="group-input">
                        <label for="comment">Comment</label>
                        <input type="comment" class="input_width" name="comment">
                    </div>
                </div>

                <!-- Modal footer -->
                <!-- <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal">Submit</button>
                    <button>Close</button>
                </div> -->
                <div class="modal-footer">
                          <button type="submit">Submit</button>
                            <button type="button" data-bs-dismiss="modal">Close</button>
             </div>
            </form>
        </div>
    </div>
</div>
<style>
    #step-form>div {
        display: none
    }

    #step-form>div:nth-child(1) {
        display: block;
    }
</style>

<script>
    VirtualSelect.init({
        ele: '#related_records, #hod'
    });

    function openCity(evt, cityName) {
        var i, cctabcontent, cctablinks;
        cctabcontent = document.getElementsByClassName("cctabcontent");
        for (i = 0; i < cctabcontent.length; i++) {
            cctabcontent[i].style.display = "none";
        }
        cctablinks = document.getElementsByClassName("cctablinks");
        for (i = 0; i < cctablinks.length; i++) {
            cctablinks[i].className = cctablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";

        // Find the index of the clicked tab button
        const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

        // Update the currentStep to the index of the clicked tab
        currentStep = index;
    }

    const saveButtons = document.querySelectorAll(".saveButton");
    const nextButtons = document.querySelectorAll(".nextButton");
    const form = document.getElementById("step-form");
    const stepButtons = document.querySelectorAll(".cctablinks");
    const steps = document.querySelectorAll(".cctabcontent");
    let currentStep = 0;

    function nextStep() {
        // Check if there is a next step
        if (currentStep < steps.length - 1) {
            // Hide current step
            steps[currentStep].style.display = "none";

            // Show next step
            steps[currentStep + 1].style.display = "block";

            // Add active class to next button
            stepButtons[currentStep + 1].classList.add("active");

            // Remove active class from current button
            stepButtons[currentStep].classList.remove("active");

            // Update current step
            currentStep++;
        }
    }

    function previousStep() {
        // Check if there is a previous step
        if (currentStep > 0) {
            // Hide current step
            steps[currentStep].style.display = "none";

            // Show previous step
            steps[currentStep - 1].style.display = "block";

            // Add active class to previous button
            stepButtons[currentStep - 1].classList.add("active");

            // Remove active class from current button
            stepButtons[currentStep].classList.remove("active");

            // Update current step
            currentStep--;
        }
    }
</script>

<script>
    VirtualSelect.init({
        ele: '#reference_record, #notify_to'
    });

    $('#summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    $('.summernote').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    let referenceCount = 1;

    function addReference() {
        referenceCount++;
        let newReference = document.createElement('div');
        newReference.classList.add('row', 'reference-data-' + referenceCount);
        newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
        let referenceContainer = document.querySelector('.reference-data');
        referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
    }
</script>


<script>
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
@endsection


































































































