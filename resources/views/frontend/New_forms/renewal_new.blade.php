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

<div class="form-field-head">
    {{-- <div class="pr-id">
            New Child
        </div> --}}
    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        / Renewal
    </div>
</div>



{{-- ! ========================================= --}}
{{-- !               DATA FIELDS                 --}}
{{-- ! ========================================= --}}
<div id="change-control-fields">
    <div class="container-fluid">

        <!-- Tab links -->
        <div class="cctab">
            <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Renewal</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Renewal Plan</button>
            <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Product Information</button>
            {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Manufacturer Details</button> --}}
            {{-- <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Registration Information</button> --}}
            <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Signatures</button>
        </div>

        <form action="{{url('renewal/store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="step-form">
                @if (!empty($parent_id))
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                @endif

                  <!-- General information content -->
                <div id="CCForm1" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="manufacturer"><b>(Root Parent) Manufacturer</b></label>
                                    <input type="text" name="manufacturer" value="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Trade Name">(Root Parent)Trade Name</label>
                                    <input type="text" name="trade_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator"><b>Initiator</b></label>
                                    <input type="hidden" name="initiator" value="{{ auth()->id() }}">
                                    <input disabled type="text" name="initiator_show" value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Date of Initiation"><b>Date of Initiation</b></label>
                                    <input disabled type="text" name="date_of_initiation" value="{{date('j-F-Y')}}">
                                    <input type="hidden" value="{{date('j-F-Y')}}" name="date_of_initiation" >
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Short Description">Short Description<span class="text-danger">*</span></label><span id="rchars">255</span>
                                    characters remaining
                                    <input id="docname" type="text" name="short_description" maxlength="255" required>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="search">Assigned To <span class="text-danger"></span>
                                    </label>
                                    <select id="select-state" placeholder="Select..." name="assign_to">
                                        <option value="0">Select a value</option>
                                        <option value="Amit sir">Amit sir </option>
                                        <option value="Nilesh sir ">Nilesh sir </option>
                                        <option value="Himanshu sir">Himanshu sir </option>
                                        <option value="Goutam sir">Goutam sir</option>
                                        <option value="Gourav sir ">Gourav sir </option>


                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="due-date">Date Due</label>
                                    <div><small class="text-primary">Please mention expected date of completion</small></div>
                                    <div class="calenderauditee">
                                        <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="" class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Documents">Documents</label>
                                    <input type="text" name="documents" id="">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Attached_Files">Attached Files</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Attached_files"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="Attached_files" name="Attached_files[]"
                                                oninput="addMultipleFiles(this, 'Attached_files')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Documents">Dossier Parts</label>
                                    <input type="text" name="dossier_parts" id="">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Related_Dossier">Related Dossier Documents</label>
                                    <input type="text" name="related_dossier_documents" id="">
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
                            <div class="sub-head">
                                Registration Status
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Registration Status">Registration Status</label>
                                    <select name="registration_status">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Registration Number">Registration Number</label>
                                    <input type="text" name="registration_number">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Planned Submission Date">Planned Submission Date</label>
                                    <input type="date" name="planned_submission_date">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Actual Submission Date">Actual Submission Date</label>
                                    <input type="date" name="actual_submission_date">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Planed Approval Date">Planed Approval Date</label>
                                    <input type="date" name="planned_approval_date">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Actual Approval Date">Actual Approval Date</label>
                                    <input type="date" name="actual_approval_date">
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Actual Withdrawn Date">Actual Withdrawn Date</label>
                                    <input type="date" name="actual_withdrawn_date">
                                </div>
                            </div>
                           
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Actual Rejection Date">Actual Rejection Date</label>
                                    <input type="date" name="actual_rejection_date">
                                </div>
                            </div>
                           
                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Comments">Comments</label>
                                    <textarea name="comments" id="" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                           
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">
                                (Parent) Renewal Rule
                            </div>
                           
                            <div class="col-6">
                                <div class="group-input">
                                    <label for="safety_impact_Probability">(Root Parent) Trade Name</label>
                                    <input type="text" name="root_parent_trade_name" id="">
                                </div>
                            </div>
                           
                            <div class="col-6">
                                <div class="group-input">
                                    <label for="LocalTradeName">(Parent)Local Trade Name</label>
                                    <input type="text" name="parent_local_trade_name" id="">
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Renewal Rule">(Parent) Renewal Rule</label>
                                    <select name="renewal_rule">
                                        <option value="">--select--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="group-input">
                                <label for="audit-agenda-grid">
                                    Product Information
                                    <button type="button" name="Product_Information" id="Product_Information">+</button>
                                    <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                        (Launch Instruction)
                                    </span>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="Product_Information-field-instruction-modal">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">Row#</th>
                                                <th style="width: 12%">Primary Packaging</th>
                                                <th style="width: 16%">Material</th>
                                                <th style="width: 16%">Pack Size</th>
                                                <th style="width: 16%">Shelf Life</th>
                                                <th style="width: 15%">Storage Condition</th>
                                                <th style="width: 15%">Secondary Packaging</th>
                                                <th style="width: 15%">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td><input disabled type="text" name="serial[]" value="1"></td>
                                            {{-- <td><input type="text" name="[IDnumber]"></td> --}}
                                            <td><input type="text" name="productinfo[0][primary_packaging]"></td>
                                            <td><input type="text" name="productinfo[0][material]"></td>
                                            <td><input type="text" name="productinfo[0][pack_size]"></td>
                                            <td><input type="text" name="productinfo[0][shelf_life]"></td>
                                            <td><input type="text" name="productinfo[0][storage _condition]"></td>
                                            <td><input type="text" name="productinfo[0][secondary_packaging]"></td>
                                            <td><input type="text" name="productinfo[0][remarks]"></td>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div>

                {{-- <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div> --}}

                {{-- <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>
                </div> --}}

                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Started by">Started By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Started on">Started On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Submitted by">Submitted By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Submitted on">Submitted On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved_by">Approved By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Approved_on">Approved On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Withdrawn_by">Withdrawn By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Withdrawn on">Withdrawn On</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Refused">Refused By</label>
                                    <div class="static"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Refused on">Refused On</label>
                                    <div class="static"></div>
                                </div>
                            </div>

                            <div class="button-block">
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
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
        const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);
        currentStep = index;
    }

    const saveButtons = document.querySelectorAll(".saveButton");
    const nextButtons = document.querySelectorAll(".nextButton");
    const form = document.getElementById("step-form");
    const stepButtons = document.querySelectorAll(".cctablinks");
    const steps = document.querySelectorAll(".cctabcontent");
    let currentStep = 0;

    function nextStep() {
        if (currentStep < steps.length - 1) {
            steps[currentStep].style.display = "none";
            steps[currentStep + 1].style.display = "block";
            stepButtons[currentStep + 1].classList.add("active");
            stepButtons[currentStep].classList.remove("active");
            currentStep++;
        }
    }

    function previousStep() {
        if (currentStep > 0) {
            steps[currentStep].style.display = "none";
            steps[currentStep - 1].style.display = "block";
            stepButtons[currentStep - 1].classList.add("active");
            stepButtons[currentStep].classList.remove("active");
            currentStep--;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#Product_Information').click(function(e) {
            function generateTableRow(serialNumber) {

                var html =
                    '<tr>' +
                    '<td><input disabled type="text" name="serial[]" value="' + serialNumber + '"></td>' +
                    '<td><input type="text" name="[]"></td>' +
                    '<td><input type="text" name="[]"></td>' +
                    '<td><input type="text" name="[]"></td>' +
                    '<td><input type="text" name="[]"></td>' +
                    '<td><input type="text" name="[]"></td>' +
                    '<td><input type="text" name="[]"></td>' +
                    '<td><input type="text" name="[]"></td>' +
                    '</tr>';

                return html;
            }

            var tableBody = $('#Product_Information-field-instruction-modal tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>

<script>
    var maxLength = 255;
    $('#docname').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
    });
</script>
{{-- <script>
    // Function to calculate and populate the due date field with a date 30 days from now
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current date
        var currentDate = new Date();
        // Add 30 days to the current date
        var dueDate = new Date(currentDate.setDate(currentDate.getDate() + 30));
        //formate the due date as 'DD-MM-YYYY'
        var formattedDueDate = formatDate(dueDate);
        
        // Populate the due date input field
        document.getElementById("due_date").value = formattedDueDate;
    });

    // Function to format the date as 'DD-MM-YYYY'
    function formatDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();

        // Pad single digit day and month with leading zero
        if (day < 10) {
            day = '0' + day;
        }
        if (month < 10) {
            month = '0' + month;
        }

        return day + '-' + month + '-' + year;
    }
</script> --}}

<script>
    // Function to calculate and populate the due date field with a date 30 days from now
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current date
        var currentDate = new Date();
        // Add 30 days to the current date
        var dueDate = new Date(currentDate.setDate(currentDate.getDate() + 30));
        // Format the due date as 'DD-MMMM-YYYY'
        var formattedDueDate = formatDate(dueDate);
        
        // Populate the due date input field
        document.getElementById("due_date").value = formattedDueDate;
    });

    // Function to format the date as 'DD-MMMM-YYYY'
    function formatDate(date) {
        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        // Array of month names
        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        // Pad single digit day with leading zero
        if (day < 10) {
            day = '0' + day;
        }

        return day + '-' + monthNames[monthIndex] + '-' + year;
    }
</script>

@endsection