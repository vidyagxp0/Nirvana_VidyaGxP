@extends('frontend.rcms.layout.main_rcms')

<script>
    // Function to update the options of the second dropdown based on the selection in the first dropdown
    function updateQueryOptions() {
        var scopeSelect = document.getElementById('scope');
        var querySelect = document.getElementById('query');
        var scopeValue = scopeSelect.value;

        // Clear existing options in the query dropdown
        querySelect.innerHTML = '';

        // Add options based on the selected scope
        if (scopeValue === 'external_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));


        } else if (scopeValue === 'internal_audit') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Audit Preparation', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Pending Response', '4'));
            querySelect.options.add(new Option('CAPA Execution in Progress', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'capa') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('CAPA In Progress', '3'));
            querySelect.options.add(new Option('Pending Approval', '4'));
            querySelect.options.add(new Option('Pending Actions Completion', '5'));
            querySelect.options.add(new Option('Closed - Done', '6'));

        } else if (scopeValue === 'audit_program') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Pending Audit', '3'));
            querySelect.options.add(new Option('Closed - Done', '4'));

        } else if (scopeValue === 'lab_incident') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Incident Review ', '2'));
            querySelect.options.add(new Option('Pending Investigation', '3'));
            querySelect.options.add(new Option('Pending Activity Completion', '4'));
            querySelect.options.add(new Option('Pending CAPA', '5'));
            querySelect.options.add(new Option('Pending QA Review', '6'));
            querySelect.options.add(new Option('Pending QA Head Approve', '7'));
            querySelect.options.add(new Option('Close - Done', '8'));

        } else if (scopeValue === 'risk_assement') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Risk Analysis & Work Group Assignment', '2'));
            querySelect.options.add(new Option('Risk Processing & Action Plan', '3'));
            querySelect.options.add(new Option('Pending HOD Approval ', '4'));
            querySelect.options.add(new Option('Actions Items in Progress', '5'));
            querySelect.options.add(new Option('Residual Risk Evaluation', '6'));
            querySelect.options.add(new Option('Close - Done', '7'));

        } else if (scopeValue === 'root_cause_analysis') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Investigation in Progress', '2'));
            querySelect.options.add(new Option('Pending Group Review Discussion', '3'));
            querySelect.options.add(new Option('Pending Group Review', '4'));
            querySelect.options.add(new Option('Pending QA Review', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));

        } else if (scopeValue === 'management_review') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('In Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'extension') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending Approval', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'documents') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Close - Cancel', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'observation') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Pending CAPA Plan', '2'));
            querySelect.options.add(new Option('Pending Approval', '3'));
            querySelect.options.add(new Option('Pending Final Approval', '4'));
            querySelect.options.add(new Option('Close - Done', '5'));
        } else if (scopeValue === 'action_item') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Work in Progress', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'effectiveness_check') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Check Effectiveness', '2'));
            querySelect.options.add(new Option('Close - Done', '3'));

        } else if (scopeValue === 'CC') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        } else if (scopeValue === 'QualityFollowUp') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        } else if (scopeValue === 'Product_Validation') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        } else if (scopeValue === 'Validation') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Review', '2'));
            querySelect.options.add(new Option('Protocol Approval', '3'));
            querySelect.options.add(new Option('Test in Progress', '4'));
            querySelect.options.add(new Option('Deviation in Progress', '5'));
            querySelect.options.add(new Option('Pending Completion', '6'));
            querySelect.options.add(new Option('Pending Approval', '7'));
            querySelect.options.add(new Option('Active Document', '8'));
            querySelect.options.add(new Option('Closed-Done', '9'));
        } else if (scopeValue === 'Equipment') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        } else if (scopeValue === 'MonthlyWorking') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        } else if (scopeValue === 'Calibration') {
            querySelect.options.add(new Option('Opened', '1'));
            querySelect.options.add(new Option('Under HOD Review', '2'));
            querySelect.options.add(new Option('Pending QA Review', '3'));
            querySelect.options.add(new Option('CFT Review', '4'));
            querySelect.options.add(new Option('Pending Change Implementation', '5'));
            querySelect.options.add(new Option('Close - Done', '6'));
        }
    }
</script>
@section('rcms_container')
<div id="rcms-dashboard">
    <div class="container-fluid">
        <div class="dash-grid">

            <div>
                <div class="inner-block scope-table" style="height: calc(100vh - 170px); padding: 0;">

                    <div class="grid-block">
                        <div class="group-input">
                            <label for="scope">Process</label>
                            <select id="scope" name="form">
                                <option value="">All Records</option>
                                {{-- <option value="Internal-Audit">Internal Audit</option>
                                    <option value="External-Audit">External Audit</option> --}}
                                <option value="Capa">CAPA</option>
                                {{-- <option value="Audit-Program">Audit Program</option>
                                    <option value="Lab Incident">Lab Incident</option>
                                    <option value="Risk Assesment">Risk Assesment</option> --}}
                                <option value="Root-Cause-Analysis">Root Cause Analysis</option>
                                <option value="Management Review">Management Review</option>
                                {{-- <option value="Document">Document</option>
                                    <option value="Extension">Extension</option>
                                    <option value="Observation">Observation</option>
                                    <option value="Change Control">Change Control</option>
                                    <option value="Action Item">Action Item</option> --}}
                                <option value="Effectiveness Check">Effectiveness Check</option>
                                <option value="Deviation">Deviation</option>
                                <option value="Equipment">Equipment</option>
                                  
                                    <option value="GCP Study">GCP Study</option>
                                    <option value="Supplier Contract">Supplier Contract</option>
                                    {{-- <option value="tms">TMS</option>  --}}
                                   
                            </select>
                        </div>
                        <div class="group-input">
                            <label for="query">Criteria</label>
                            <select id="query" name="stage">
                                <option value="">All Records</option>
                                <option value="Closed">Closed Records</option>
                                <option value="Opened">Opened Records</option>
                                <option value="Cancelled">Cancelled Records</option>
                                {{-- <option value="4">Overdue Records</option>
                                    <option value="Assigned">Assigned To Me</option>
                                    <option value="Records">Records Created Today</option> --}}
                            </select>
                        </div>
                        <div class="item-btn" onclick="window.print()">Print</div>
                    </div>
                    <div class="main-scope-table">
                        <table class="table table-bordered" id="auditTable">
                            <thead>
                                <tr>
                                    <th>Record</th>
                                    {{-- <th>Parent ID</th> --}}
                                    <th>Division</th>
                                    <th>Process</th>
                                    <th class="td_desc">Short Description</th>
                                    <th>Date Opened</th>
                                    <th>Originator</th>
                                    <th>Initiation Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="searchTable">
                                @php
                                $table = json_encode($datag);
                                $tables = json_decode($table);

                                @endphp
                                @foreach ($tables->data as $datas)
                                <tr>
                                    <td>
                                        @if ($datas->type == 'Change-Control')
                                        <a href="{{ route('CC.show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        <a href="{{ url('rcms/qms-dashboard', $datas->id) }}/CC">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/single.png') }}" alt="..."
                                                class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        {{-- -----------------------by pankaj-------------------- --}}
                                        @elseif ($datas->type == 'Internal-Audit')
                                        <a href="{{ route('showInternalAudit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/internal_audit">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif ($datas->type == 'Risk-Assesment')
                                        <a href="{{ route('showRiskManagement', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/risk_assesment">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif ($datas->type == 'Lab-Incident')
                                        <a href="{{ route('ShowLabIncident', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/lab_incident">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                       
                                        @elseif ($datas->type == 'External-Audit')
                                        <a href="{{ route('showExternalAudit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/external_audit">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                        @elseif ($datas->type == 'Audit-Program')
                                        <a href="{{ route('ShowAuditProgram', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/audit_program">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif ($datas->type == 'Observation')
                                        <a href="{{ route('showobservation', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/observation">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        {{-- ----------------------------------------------- --}}
                                        @elseif($datas->type == 'Action-Item')
                                        <a href="{{ route('actionItem.show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/action_item">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Extension')
                                        <a href="{{ route('extension.show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/extension">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Effectiveness-Check')
                                        <a href="{{ route('effectiveness.show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/effectiveness_check">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Capa')
                                        <a href="{{ route('capashow', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/capa">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Validation')
                                        <a href="{{ route('validation.edit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/validation">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                        @elseif($datas->type == 'MonthlyWorking')
                                        <a href="{{ route('monthly_working.edit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/validation">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Equipment')
                                        <a href="{{ route('equipment.edit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/equipment">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                        @elseif($datas->type == 'Calibration')
                                        <a href="{{ route('calibration.edit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/equipment">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                        @elseif($datas->type == 'National Approval')
                                        <a href="{{ route('national_approval.edit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/national-approval">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                        @elseif($datas->type == 'Sanction')
                                        <a href="{{ route('sanction.edit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/sanction">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'lab-investigation')
                                            <a href="{{ route('lab_invest_edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                                <a
                                                    href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/lab_investigation">
                                                    <div class="icon" onclick="showChild()"
                                                        data-bs-toggle="tooltip" title="Related Records">
                                                        {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                            alt="..." class="w-100 h-100"> --}}
                                                    </div>
                                                </a>
                                            @endif

                                        @elseif($datas->type == 'Management-Review')
                                        <a href="{{ route('manageshow', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/management_review">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Deviation')
                                        <a href="{{ route('devshow', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/deviation">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Root-Cause-Analysis')
                                        <a href="{{ route('root_show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/root_cause_analysis">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                  
                                        @elseif($datas->type == 'Product_Validation')
                                        <a href="{{ route('production_show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/production_page">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Reccomended_action')
                                        <a href="{{ route('Reccomendation_show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/reccomendedAction_page">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Quality-Follow-Up')
                                        <a href="{{ route('quality_show', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/qualityfollowup_page">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                        @elseif($datas->type == 'MedicalDeviceRegistration')
                                        <a href="{{ route('medical_edit', $datas->id) }}">
                                            {{ str_pad($datas->id, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/root_cause_analysis">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif
                                        @elseif($datas->type == 'Dossier Documents')
                                            <a href="{{ route('dosierdocuments.view', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/dosierdocuments">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                        @endif
                                        @elseif($datas->type == 'Preventive Maintenance')
                                            <a href="{{ route('preventivemaintenance.view', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/preventivemaintenance">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                        @endif
                                        @elseif($datas->type == 'Gcp-Study')
                                        <a href="{{ route('GCP_study.edit', $datas->id) }}">
                                            {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                        </a>
                                        @if (!empty($datas->parent_id))
                                        <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/gcp_study">
                                            <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                alt="..." class="w-100 h-100"> --}}
                                            </div>
                                        </a>
                                        @endif

                                            @elseif($datas->type == 'Supplier-Contract')
                                            <a href="{{ route('supplier_contract.edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/supplier_contract">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                            @endif
                                            

                                            @elseif($datas->type == 'Subject-Action-Item')
                                            <a href="{{ route('subject_action_item.edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/subject_action_item">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                            @endif

                                            @elseif($datas->type == 'Violation')
                                            <a href="{{ route('violation.edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/violation">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                            @endif

                                            @elseif($datas->type == 'First_product_validation')
                                            <a href="{{ route('first_product_validation.edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/root_cause_analysis">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                            @endif

                                            @elseif($datas->type == 'CTA-Amendement')
                                            <a href="{{ route('cta_amendement.edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/cta_amendement">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                            @endif

                                            @elseif($datas->type == 'Correspondence')
                                            <a href="{{ route('correspondence.edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/correspondence">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                            @endif

                                            @elseif($datas->type == 'CTL-Audit')
                                            <a href="{{ route('contract_testing_lab_audit.edit', $datas->id) }}">
                                                {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                            </a>
                                            @if (!empty($datas->parent_id))
                                            <a href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/ctl-audit">
                                                <div class="icon" onclick="showChild()" data-bs-toggle="tooltip" title="Related Records">
                                                    {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                    alt="..." class="w-100 h-100"> --}}
                                                </div>
                                            </a>
                                            @endif
                                            
                                            @elseif($datas->type == 'ClinicalSite')
                                                <a href="{{ route('clinicshow', $datas->id) }}">
                                                    {{ str_pad($datas->id, 4, '0', STR_PAD_LEFT) }}
                                                </a>
                                                @if (!empty($datas->parent_id))
                                                    <a
                                                        href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/clinicalsite">
                                                        <div class="icon" onclick="showChild()"
                                                            data-bs-toggle="tooltip" title="Related Records">
                                                            {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                alt="..." class="w-100 h-100"> --}}
                                                        </div>
                                                    </a>
                                                @endif
                                                @elseif ($datas->type == 'ClientInquiry')
                                                    <a href="{{ route('client_inquiry_view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/ClientInquiry">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif



                                                    @elseif($datas->type == 'MeetingManagement')
                                                    <a href="{{ route('meeting_management_view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/MeetingManagement">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                                @elseif($datas->type == 'AdditionalInformation')
                                                    <a href="{{ route('additional_information_view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/AdditionalInformation">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                                @elseif($datas->type == 'AuditTask')
                                                    <a href="{{ route('show_audit_task', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/AuditTask">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                                    else if (scopeValue === 'MedicalDevice') {
                                                         querySelect.options.add(new Option('Opened', '1'));
                                                                querySelect.options.add(new Option('Under HOD Review', '2'));
                                                                querySelect.options.add(new Option('Pending QA Review', '3'));
                                                                querySelect.options.add(new Option('CFT Review', '4'));
                                                                querySelect.options.add(new Option('Pending Change Implementation', '5'));
                                                                querySelect.options.add(new Option('Close - Done', '6'));
                                                            }
                                                            else if (scopeValue === 'PSUR') {
                                                                querySelect.options.add(new Option('Opened', '1'));
                                                                querySelect.options.add(new Option('Submission Preparation', '2'));
                                                                querySelect.options.add(new Option('Pending Submission review', '3'));
                                                                querySelect.options.add(new Option('Authority Assesment', '4'));
                                                                querySelect.options.add(new Option('Close - Done', '5'));
                                                                // querySelect.options.add(new Option('Close - Done', '6'));
                                                            }
                                                            else if (scopeValue === 'Commitment') {
                                                                querySelect.options.add(new Option('Opened', '1'));
                                                                querySelect.options.add(new Option('Execution in Progress', '2'));
                                                                querySelect.options.add(new Option('Close - Done', '3'));
                                                                // querySelect.options.add(new Option('Close - Done', '6'));
                                                            }



                                                @elseif($datas->type == 'Medical Device')``
                                                    <a href="{{ route('medical_Device_view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/medicalDevice">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                                    @elseif($datas->type == 'Hypothesis')
                                                    <a href="{{ route('hypothesis.show', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/hypothesis">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                                 @elseif($datas->type == 'PSUR')
                                                    <a href="{{ route('psur.view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/psur">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                                    @elseif($datas->type == 'Commitment')
                                                    <a href="{{ route('commitment.view', $datas->id) }}">
                                                        {{ str_pad($datas->record, 4, '0', STR_PAD_LEFT) }}
                                                    </a>
                                                    @if (!empty($datas->parent_id))
                                                        <a
                                                            href="{{ url('rcms/qms-dashboard_new', $datas->id) }}/commitment">
                                                            <div class="icon" onclick="showChild()"
                                                                data-bs-toggle="tooltip" title="Related Records">
                                                                {{-- <img src="{{ asset('user/images/parent.png') }}"
                                                                    alt="..." class="w-100 h-100"> --}}
                                                            </div>
                                                        </a>
                                                    @endif
                                         <!--last close  -->
                                        @endif



                                    </td>
                                    {{-- @if ($datas->parent != '-')
                                                        <td>
                                                            {{ str_pad($datas->parent, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    @else
                                    <td>
                                        {{ $datas->parent }}
                                    </td>
                                    @endif --}}
                                    <td class="viewdetails" data-id="{{ $datas->id }}" data-type="{{ $datas->type }}" data-bs-toggle="modal" data-bs-target="#record-modal">
                                        @if ($datas->division_id)
                                        {{ Helpers::getDivisionName($datas->division_id) }}
                                        @else
                                        Dewas/India
                                        @endif
                                    </td>
                                    <td class="viewdetails" data-id="{{ $datas->id }}" data-type="{{ $datas->type }}" data-bs-toggle="modal" data-bs-target="#record-modal">
                                        {{ $datas->type }}
                                    </td>
                                    <td class="viewdetails" data-id="{{ $datas->id }}" data-type="{{ $datas->type }}" data-bs-toggle="modal" data-bs-target="#record-modal">
                                        {{ $datas->short_description }}
                                    </td>
                                    <td class="viewdetails" data-id="{{ $datas->id }}" data-type="{{ $datas->type }}" data-bs-toggle="modal" data-bs-target="#record-modal">
                                        {{ $datas->date_open }}
                                    </td>
                                    <td class="viewdetails" data-id="{{ $datas->id }}" data-type="{{ $datas->type }}" data-bs-toggle="modal" data-bs-target="#record-modal">
                                        {{-- {{ $datas->assign_to }} --}}
                                        {{ Helpers::getInitiatorName($datas->initiator_id) }}
                                        {{-- {{ $datas->initiator_id }} --}}
                                    </td>
                                    <td class="viewdetails" data-id="{{ $datas->id }}" data-type="{{ $datas->type }}" data-bs-toggle="modal" data-bs-target="#record-modal">
                                        {{ Helpers::getdateFormat($datas->intiation_date) }}

                                    </td>
                                    <td class="viewdetails" data-id="{{ $datas->id }}" data-type="{{ $datas->type }}" data-bs-toggle="modal" data-bs-target="#record-modal">
                                        {{ $datas->stage }}
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="scope-pagination">
                            {{ $datag->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade modal-sm" id="record-modal">
    <div class="modal-contain">
        <div class="modal-dialog m-0">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body " id="auditTableinfo">
                    Please wait...
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function showChild() {
        $(".child-row").toggle();
    }

    $(".view-list").hide();

    function toggleview() {
        $(".view-list").toggle();
    }

    $("#record-modal .drop-list").hide();

    function showAction() {
        $("#record-modal .drop-list").toggle();
    }
</script>
<script type='text/javascript'>
    $(document).ready(function() {
        $('#auditTable').on('click', '.viewdetails', function() {
            var auditid = $(this).attr('data-id');
            var formType = $(this).attr('data-type');
            if (auditid > 0) {
                // AJAX request
                var url = "{{ route('ccView', ['id' => ':auditid', 'type' => ':formType']) }}";
                url = url.replace(':auditid', auditid).replace(':formType', formType);

                // Empty modal data
                $('#auditTableinfo').empty();
                $.ajax({
                    url: url,
                    dataType: 'json',
                    success: function(response) {
                        // Add employee details
                        $('#auditTableinfo').append(response.html);
                        // Display Modal
                        $('#record-modal').modal('show');
                    }
                });
            }
        });
    });
</script>
@endsection
