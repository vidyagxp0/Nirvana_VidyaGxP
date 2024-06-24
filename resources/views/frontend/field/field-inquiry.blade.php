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

    @php
        $users = DB::table('users')->get();
    @endphp

    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            / Field Inquiry
        </div>
    </div>



    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Field Inquiry</button>
                <button class="cctablinks " onclick="openCity(event, 'CCForm2')">Inquiry Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Signatures</button>
            </div>

            <form action="{{ route('fieldstore_store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif

                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Originator"><b>Record Number</b></label>
                                        <input disabled type="text" name="record_number"
                                    value="{{ Helpers::getDivisionName(session()->get('division')) }}/FI/{{ date('Y') }}/{{ $record_number }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Originator"><b>Initiator</b></label>

                                        <input disabled type="text" name="originator_id"
                                            value="{{ $lab->originator_id ?? Auth::user()->name }}">

                                        {{-- <input disabled type="text" name="Originator" value=""> --}}
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label>
                                        <input id="docname" type="text" name="short_description" maxlength="255"
                                            required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Division Code"><b>Date Of Initiation</b></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="initiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="initiation_date">

                                        {{-- <input  type="date" name="Date Opened" value=""> --}}

                                    </div>
                                </div>






                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="If Others">Assigned To</label>
                                        <select name="assigned_to" onchange="">

                                            <option value="">Select a value</option>
                                            <option value="">-- select --</option>
                                            @if ($users->isNotEmpty())
                                                @foreach ($users as $user)
                                                    <option value='{{ $user->id }}'>{{ $user->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Date Due <span class="text-danger"></span></label>
                                        <div><small class="text-primary">Please mention expected date of completion</small>
                                        </div>

                                        <div class="calenderauditee">
                                            <input type="text" id="due_date" readonly placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="due_date"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value=""
                                                class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Customer Name</label>
                                        <input name="customer_name" />
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Submitted By</label>
                                        <select name="submitted_by">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">Pankaj</option>
                                            <option value="2">Gaurav</option>
                                            <option value="3">Mayank</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Type</label>
                                        <select name="type">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">T-1</option>
                                            <option value="2">T-2</option>
                                            <option value="3">T-3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Priority Level</label>
                                        <select name="priority_level">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">P-1</option>
                                            <option value="2">P-2</option>
                                            <option value="3">P-3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments"> Description</label>
                                        <textarea class="summernote" name="description" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <div class="why-why-chart">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr.No.</th>
                                                        <th style="width: 30%;">Question</th>
                                                        <th>Response</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1.</td>
                                                        <td style="background: #DCD8D8">
                                                            <textarea name="question_1"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="response_1"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="remark_1"></textarea>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>2.</td>
                                                        <td style="background: #DCD8D8">
                                                            <textarea name="question_2"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="response_2"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="remark_2"></textarea>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3.</td>
                                                        <td style="background: #DCD8D8">
                                                            <textarea name="question_3"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="response_3"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="remark_3"></textarea>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>4.</td>
                                                        <td style="background: #DCD8D8">
                                                            <textarea name="question_4"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="response_4"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="remark_4"></textarea>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>5.</td>
                                                        <td style="background: #DCD8D8">
                                                            <textarea name="question_5"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="response_5"></textarea>
                                                        </td>
                                                        <td>
                                                            <textarea name="remark_5"></textarea>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="group-input">
                                        <label for="Attached File">Attached File</label>
                                        <div>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="file_attachment"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="HOD_Attachments" name="file_attachment[]"
                                                    oninput="addMultipleFiles(this, 'file_attachment')" multiple>

                                                {{-- <input type="file" id="myfile" name="file_attachment" oninput="" multiple> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Related URLs</label>
                                        <select name="related_urls">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">URL1</option>
                                            <option value="2">URL2</option>
                                            <option value="3">URL3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Zone</label>
                                        <select name="zone_type">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">Zone-1</option>
                                            <option value="2">Zone-2</option>
                                            <option value="3">Zone-3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Country</label>
                                        <select name="country">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">India</option>
                                            <option value="2">USA</option>
                                            <option value="3">UK</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="city">City</label>
                                        <select name="city">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">Indore</option>
                                            <option value="2">Bhopal</option>
                                            <option value="3">Ujjain</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="state">State</label>
                                        <select name="state">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">MP</option>
                                            <option value="2">CG</option>
                                            <option value="3">RJ</option>
                                        </select>
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
                                        <label for="Type">Account Type</label>
                                        <select name="account_type">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">AT-1</option>
                                            <option value="2">AT-2</option>
                                            <option value="3">AT-3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Business Area">Business Area</label>
                                        <select name="business_area">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">B-1</option>
                                            <option value="2">B-2</option>
                                            <option value="3">B-3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Category</label>
                                        <select name="category">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">C-1</option>
                                            <option value="2">C-2</option>
                                            <option value="3">C-3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Sub Category</label>
                                        <select name="sub_category">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">C-1</option>
                                            <option value="2">C-2</option>
                                            <option value="3">C-3</option>>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="broker_id">Broker ID</label>
                                        <input type="text" name="broker_id" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Type">Related Inquiries</label>
                                        <select name="related_inquiries">
                                            <option value="">Enter Your Selection Here</option>
                                            <option value="1">Pankaj</option>
                                            <option value="2">Gaurav</option>
                                            <option value="3">Mayank</option>>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Comments</label>
                                        <textarea class="summernote" name="comments" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label class="mt-4" for="Audit Comments">Actions Taken</label>
                                        <textarea class="summernote" name="action_taken" id="summernote-16"></textarea>
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>


                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
                                        </a> </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="CCForm3" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="submitted by">Completed By</label>
                                        <div class="static"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Completed on">Completed On</label>
                                        <div class="Date"></div>
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">Exit
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