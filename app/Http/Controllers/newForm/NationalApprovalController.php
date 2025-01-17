<?php

namespace App\Http\Controllers\newForm;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Extension;
use App\Models\NationalApproval;
use App\Models\NationalApprovalAudit;
use App\Models\NationalApprovalGrid;
use App\Models\NationalApprovalStage;
use App\Models\RecordNumber;
use App\Models\RoleGroup;
use App\Models\User;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NationalApprovalController extends Controller
{
    public function index()
    {

        $old_record = NationalApproval::select('id', 'division_id', 'record')->get();
        $record_number = ((RecordNumber::first()->value('counter')) + 1);
        $record_number = str_pad($record_number, 4, '0', STR_PAD_LEFT);
        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');

        return view('frontend.New_forms.national-approval.national-approval', compact('old_record', 'record_number', 'currentDate', 'formattedDate', 'due_date'));
    }

    public function npStore(Request $request)
    {

        try {
            $recordCounter = RecordNumber::first();
            $newRecordNumber = $recordCounter->counter + 1;

            $recordCounter->counter = $newRecordNumber;
            $recordCounter->save();

            $national = new NationalApproval;

            $national->stage = '1';
            $national->status = 'Opened';
            $national->parent_id = $request->parent_id;
            $national->parent_type = $request->parent_type;
            $national->record = $newRecordNumber;

            $national->initiator_id = Auth::user()->id;
            $national->user_name = Auth::user()->name;
            $national->division_id = $request->division_id;
            $national->divison_code = $request->divison_code;
            $national->manufacturer = $request->manufacturer;
            $national->trade_name = $request->trade_name;
            $national->initiator = $request->initiator;
            $national->initiation_date = $request->initiation_date;
            $national->short_description = $request->short_description;
            $national->originator = $request->originator;
            $national->assign_to = $request->assign_to;
            $national->due_date = $request->due_date;
            $national->procedure_type = $request->procedure_type;
            $national->planned_subnission_date = $request->planned_subnission_date;
            $national->member_state = $request->member_state;
            $national->local_trade_name = $request->local_trade_name;
            $national->registration_number = $request->registration_number;
            $national->renewal_rule = $request->renewal_rule;
            $national->dossier_parts = $request->dossier_parts;
            $national->related_dossier_documents = $request->related_dossier_documents;
            $national->pack_size = $request->pack_size;
            $national->shelf_life = $request->shelf_life;
            $national->psup_cycle = $request->psup_cycle;
            $national->expiration_date = $request->expiration_date;

            // Approval Plan
            $national->ap_assigned_to = $request->ap_assigned_to;
            $national->ap_date_due = $request->ap_date_due;
            $national->approval_status = $request->approval_status;
            $national->marketing_authorization_holder = $request->marketing_authorization_holder;
            $national->planned_submission_date = $request->planned_submission_date;
            $national->actual_submission_date = $request->actual_submission_date;
            $national->planned_approval_date = $request->planned_approval_date;
            $national->actual_approval_date = $request->actual_approval_date;
            $national->actual_withdrawn_date = $request->actual_withdrawn_date;
            $national->actual_rejection_date = $request->actual_rejection_date;
            $national->comments = $request->comments;

            $national->save();

            $national_id = $national->id;
            $newDataGridErrata = NationalApprovalGrid::where(['national_id' => $national_id, 'identifier' => 'details'])->firstOrCreate();
            $newDataGridErrata->national_id = $national_id;
            $newDataGridErrata->identifier = 'details';
            $newDataGridErrata->data = $request->details;
            $newDataGridErrata->save();


            //===========audit trails ===========//
            if (!empty($request->manufacturer)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = '(Root Parent) Manufacturer';
                $validation2->previous = "Null";
                $validation2->current = $request->manufacturer;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->trade_name)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = '(Root Parent) Trade Name';
                $validation2->previous = "Null";
                $validation2->current = $request->trade_name;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->short_description)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->previous = "Null";
                $validation2->current = $request->short_description;
                $validation2->activity_type = 'Short Description';
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->comment = "Not Applicable";
                $validation2->save();
            }

            if (!empty($request->initiation_date)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Initiation Date';
                $validation2->previous = "Null";
                $validation2->current = \Carbon\Carbon::parse($request->initiation_date)->format('d-M-Y');
                $validation2->comment = "Not Applicable";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->assign_to)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Assign To';
                $validation2->previous = "Null";
                $validation2->current = $request->assign_to;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->due_date)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Due Date';
                $validation2->previous = "Null";
                $validation2->current = \Carbon\Carbon::parse($request->due_date)->format('d-M-Y');
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';

                $validation2->save();
            }

            if (!empty($request->procedure_type)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = '(Parent) Procedure Type';
                $validation2->previous = "Null";
                $validation2->current = $request->procedure_type;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';

                $validation2->save();
            }

            if (!empty($request->planned_subnission_date)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Planned Subnission Date';
                $validation2->previous = "Null";
                $validation2->current = \Carbon\Carbon::parse($request->planned_subnission_date)->format('d-M-Y');
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';

                $validation2->save();
            }

            if (!empty($request->member_state)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Member State';
                $validation2->previous = "Null";
                $validation2->current = $request->member_state;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->local_trade_name)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Local Trade Name';
                $validation2->previous = "Null";
                $validation2->current = $request->local_trade_name;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->registration_number)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Registration Number';
                $validation2->previous = "Null";
                $validation2->current = $request->registration_number;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }


            if (!empty($request->renewal_rule)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Renewal Rule';
                $validation2->previous = "Null";
                $validation2->current = $request->renewal_rule;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->dossier_parts)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Dossier Parts';
                $validation2->previous = "Null";
                $validation2->current = $request->dossier_parts;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->related_dossier_documents)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Related Dossier Documents';
                $validation2->previous = "Null";
                $validation2->current = $request->related_dossier_documents;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->pack_size)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Pack Size';
                $validation2->previous = "Null";
                $validation2->current = $request->pack_size;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->shelf_life)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Shelf Life';
                $validation2->previous = "Null";
                $validation2->current = $request->shelf_life;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->psup_cycle)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'PSUP Cycle';
                $validation2->previous = "Null";
                $validation2->current = $request->psup_cycle;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }

            if (!empty($request->expiration_date)) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national->id;
                $validation2->activity_type = 'Expiration Date';
                $validation2->previous = "Null";
                $validation2->current = \Carbon\Carbon::parse($request->expiration_date)->format('d-M-Y');
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Opened";
                $validation2->change_from = "Initiation";
                $validation2->action_name = 'Create';
                $validation2->save();
            }



            toastr()->success("National Approval is created Successfully");
            return redirect(url('rcms/qms-dashboard'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to save National Approval : ' . $e->getMessage());
        }
    }

    public function npEdit($id)
    {
        $national = NationalApproval::findOrFail($id);
        $packagingDetails = NationalApprovalGrid::where('national_id', $id)->where('identifier', 'details')->first();

        $details = $packagingDetails ? json_decode($packagingDetails->data, true) : [];
        // $national->formatted_initiation_date = Carbon::parse($national->initiation_date)->format('d-m-y');

        $currentDate = Carbon::now();
        $formattedDate = $currentDate->addDays(30);
        $due_date = $formattedDate->format('Y-m-d');
        return view('frontend.New_forms.national-approval.np_update', compact('national', 'details', 'due_date'));
    }

    public function npUpdate(Request $request, $id)
    {
        try {

            // $recordCounter = RecordNumber::first();

            // $newRecordNumber = $recordCounter->counter + 1;

            // $recordCounter->counter = $newRecordNumber;
            // $recordCounter->save();
            $lastDocument = NationalApproval::find($id);
            $national1 = NationalApproval::findOrFail($id);

            // $national->stage = '1';
            // $national->status = 'Opened';
            $national1->parent_id = $request->parent_id;
            $national1->parent_type = $request->parent_type;
            // $national1->record = $newRecordNumber;

            $national1->initiator_id = Auth::user()->id;
            $national1->user_name = Auth::user()->name;
            $national1->manufacturer = $request->manufacturer;
            $national1->trade_name = $request->trade_name;
            $national1->initiator = $request->initiator;
            // $national1->initiation_date = $request->initiation_date;
            $national1->short_description = $request->short_description;
            $national1->originator = $request->originator;
            $national1->assign_to = $request->assign_to;
            $national1->due_date = $request->due_date;
            $national1->procedure_type = $request->procedure_type;
            $national1->planned_subnission_date = $request->planned_subnission_date;
            $national1->member_state = $request->member_state;
            $national1->local_trade_name = $request->local_trade_name;
            $national1->registration_number = $request->registration_number;
            $national1->renewal_rule = $request->renewal_rule;
            $national1->dossier_parts = $request->dossier_parts;
            $national1->related_dossier_documents = $request->related_dossier_documents;
            $national1->pack_size = $request->pack_size;
            $national1->shelf_life = $request->shelf_life;
            $national1->psup_cycle = $request->psup_cycle;
            $national1->expiration_date = $request->expiration_date;

            // Approval Plan
            $national1->ap_assigned_to = $request->ap_assigned_to;
            $national1->ap_date_due = $request->ap_date_due;
            $national1->approval_status = $request->approval_status;
            $national1->marketing_authorization_holder = $request->marketing_authorization_holder;
            $national1->planned_submission_date = $request->planned_submission_date;
            $national1->actual_submission_date = $request->actual_submission_date;
            $national1->planned_approval_date = $request->planned_approval_date;
            $national1->actual_approval_date = $request->actual_approval_date;
            $national1->actual_withdrawn_date = $request->actual_withdrawn_date;
            $national1->actual_rejection_date = $request->actual_rejection_date;
            $national1->comments = $request->comments;

            $national1->save();

            $national_id = $national1->id;
            $newDataGridErrata = NationalApprovalGrid::where(['national_id' => $national_id, 'identifier' => 'details'])->firstOrCreate();
            $newDataGridErrata->national_id = $national_id;
            $newDataGridErrata->identifier = 'details';
            $newDataGridErrata->data = $request->details;
            $newDataGridErrata->save();

            //===========audit trails ===========//
            if ($lastDocument->manufacturer != $request->manufacture) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = '(Root Parent) Manufacturer';
                $validation2->previous = $lastDocument->manufacturer;
                $validation2->current = $request->manufacturer;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->manufacture) || $lastDocument->manufacture === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->trade_name != $request->trade_name) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = '(Root Parent) Trade Name';
                $validation2->previous = $lastDocument->trade_name;
                $validation2->current = $request->trade_name;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->manufacture) || $lastDocument->manufacture === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->short_description != $request->short_description) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->previous = $lastDocument->short_description;
                $validation2->current = $request->short_description;
                $validation2->activity_type = 'Short Description';
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->short_description) || $lastDocument->short_description === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->comment = "Not Applicable";
                $validation2->save();
            }

            if ($lastDocument->initiation_date != $request->initiation_date) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Initiation Date';
                $validation2->previous = \Carbon\Carbon::parse($lastDocument->initiation_date)->format('d-M-Y');
                $validation2->current = \Carbon\Carbon::parse($request->initiation_date)->format('d-M-Y');
                $validation2->comment = "Not Applicable";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->initiation_date) || $lastDocument->initiation_date === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->assign_to != $request->assign_to) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Assign To';
                $validation2->previous = $lastDocument->assign_to;
                $validation2->current = $request->assign_to;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->assign_to) || $lastDocument->assign_to === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->due_date != $request->due_date) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Due Date';
                $validation2->previous = \Carbon\Carbon::parse($lastDocument->due_date)->format('d-M-Y');
                $validation2->current = \Carbon\Carbon::parse($request->due_date)->format('d-M-Y');
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->due_date) || $lastDocument->due_date === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->procedure_type != $request->procedure_type) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = '(Parent) Procedure Type';
                $validation2->previous = $lastDocument->procedure_type;
                $validation2->current = $request->procedure_type;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->procedure_type) || $lastDocument->procedure_type === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->planned_subnission_date != $request->planned_subnission_date) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Planned Subnission Date';
                $validation2->previous = \Carbon\Carbon::parse($lastDocument->planned_subnission_date)->parse('d-M-Y');
                $validation2->current = \Carbon\Carbon::parse($request->planned_subnission_date)->format('d-M-Y');
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->planned_subnission_date) || $lastDocument->planned_subnission_date === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->member_state != $request->member_state) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Member State';
                $validation2->previous = $lastDocument->member_state;
                $validation2->current = $request->member_state;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->member_state) || $lastDocument->member_state === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }
            if ($lastDocument->local_trade_name != $request->local_trade_name) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Local Trade Name';
                $validation2->previous = $lastDocument->local_trade_name;
                $validation2->current = $request->local_trade_name;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->local_trade_name) || $lastDocument->local_trade_name === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->registration_number != $request->registration_number) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Registration Number';
                $validation2->previous = $lastDocument->registration_number;
                $validation2->current = $request->registration_number;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->registration_number) || $lastDocument->registration_number === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }


            if ($lastDocument->renewal_rule != $request->renewal_rule) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Renewal Rule';
                $validation2->previous = $lastDocument->renewal_rule;
                $validation2->current = $request->renewal_rule;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->renewal_rule) || $lastDocument->renewal_rule === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->dossier_parts != $request->dossier_parts) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Dossier Parts';
                $validation2->previous = $lastDocument->dossier_parts;
                $validation2->current = $request->dossier_parts;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->dossier_parts) || $lastDocument->dossier_parts === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->related_dossier_documents != $request->related_dossier_documents) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Related Dossier Documents';
                $validation2->previous = $lastDocument->related_dossier_documents;
                $validation2->current = $request->related_dossier_documents;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->related_dossier_documents) || $lastDocument->related_dossier_documents === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->pack_size != $request->pack_size) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Pack Size';
                $validation2->previous = $lastDocument->pack_size;
                $validation2->current = $request->pack_size;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->pack_size) || $lastDocument->pack_size === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->shelf_life != $request->shelf_life) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Shelf Life';
                $validation2->previous = $lastDocument->shelf_life;
                $validation2->current = $request->shelf_life;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->shelf_life) || $lastDocument->shelf_life === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->psup_cycle != $request->psup_cycle) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'PSUP Cycle';
                $validation2->previous = $lastDocument->psup_cycle;
                $validation2->current = $request->psup_cycle;
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->psup_cycle) || $lastDocument->psup_cycle === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }

            if ($lastDocument->expiration_date != $request->expiration_date) {
                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $national1->id;
                $validation2->activity_type = 'Expiration Date';
                $validation2->previous = \Carbon\Carbon::parse($lastDocument->expiration_date)->format('d-M-Y');
                $validation2->current = \Carbon\Carbon::parse($request->expiration_date)->format('d-M-Y');
                $validation2->comment = "NA";
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');

                $validation2->change_to =   "Not Applicable";
                $validation2->change_from = $lastDocument->status;
                if (is_null($lastDocument->expiration_date) || $lastDocument->expiration_date === '') {
                    $validation2->action_name = 'New';
                } else {
                    $validation2->action_name = 'Update';
                }
                $validation2->save();
            }
            toastr()->success("National Approval is Update Successfully");
            return redirect(url('rcms/qms-dashboard'));
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to update National Approval : ' . $e->getMessage());
        }
    }

    public  function nationalApproval_send_stage(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $equipment = NationalApproval::find($id);
            $lastDocument = NationalApproval::find($id);

            if (!$equipment) {
                toastr()->error('National Approval not found');
                return back();
            }

            if ($equipment->stage == 1) {
                $equipment->stage = "2";
                $equipment->status = "Authority Assessment";
                $equipment->submit_by = Auth::user()->name;
                $equipment->submit_on = Carbon::now()->format('d-M-Y');
                // $equipment->comment = $request->comment;

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $equipment->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Send Translation';
                $validation2->change_to = "Authority Assessment";
                $validation2->stage = 'Submited';
                $validation2->save();

                $equipment->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($equipment->stage == 2) {
                $equipment->stage = "4";
                $equipment->status = "Approved";

                $equipment->submit_by = Auth::user()->name;
                $equipment->submit_on = Carbon::now()->format('d-M-Y');
                // $equipment->comment = $request->comment;

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $equipment->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Approval Received';
                $validation2->change_to = "Approved";
                $validation2->stage = 'Submited';
                $validation2->save();

                $equipment->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($equipment->stage == 3) {
                $equipment->stage = "4";
                $equipment->status = "Approved";

                $equipment->submit_by = Auth::user()->name;
                $equipment->submit_on = Carbon::now()->format('d-M-Y');
                // $equipment->comment = $request->comment;

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $equipment->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Update Done';
                $validation2->change_to = "Approved";
                $validation2->stage = 'Submited';
                $validation2->save();

                $equipment->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($equipment->stage == 4) {
                $equipment->stage = "3";
                $equipment->status = "Update Ongoing";


                $equipment->submit_by = Auth::user()->name;
                $equipment->submit_on = Carbon::now()->format('d-M-Y');
                // $equipment->comment = $request->comment;

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $equipment->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Add Updates';
                $validation2->change_to = "Update Ongoing";
                $validation2->stage = 'Submited';
                $validation2->save();

                $equipment->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function national_approvalCancel(Request $request, $id)
    {

        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $equipment = NationalApproval::find($id);
            $lastDocument = NationalApproval::find($id);

            if ($equipment->stage == 1) {
                $equipment->stage = "0";
                $equipment->status = "Closed-Cancelled";

                $equipment->submit_by = Auth::user()->name;
                $equipment->submit_on = Carbon::now()->format('d-M-Y');

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $equipment->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Cancel';
                $validation2->change_to = "Closed-Cancelled";
                $validation2->stage = 'Submited';
                $validation2->save();

                $equipment->update();
                toastr()->success('Document Sent');
                return back();
            }

            if ($equipment->stage == 2) {
                $equipment->stage = "6";
                $equipment->status = "Closed - Not Approved ";
                $equipment->submit_by = Auth::user()->name;
                $equipment->submit_on = Carbon::now()->format('d-M-Y');

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $equipment->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Refused';
                $validation2->change_to = "Closed - Not Approved";

                $validation2->stage = 'Submited';
                $validation2->save();

                $equipment->update();
                toastr()->success('Document Sent');
                return back();
            }


            if ($equipment->stage == 4) {
                $equipment->stage = "5";
                $equipment->status = "Closed - Retired";

                $equipment->submit_by = Auth::user()->name;
                $equipment->submit_on = Carbon::now()->format('d-M-Y');

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $equipment->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Retire';
                $validation2->change_to = "Closed - Retired";
                $validation2->stage = 'Submited';
                $validation2->save();

                $equipment->update();
                toastr()->success('Document Sent');
                return back();
            }

            toastr()->error('States not Defined');
            return back();
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }


    public function np_qa_more_info(Request $request, $id)
    {
        if ($request->username == Auth::user()->email && Hash::check($request->password, Auth::user()->password)) {
            $national1 = NationalApproval::find($id);
            $lastDocument = NationalApproval::find($id);


            if ($national1->stage == 2) {
                $national1->stage = "7";
                $national1->status = "Closed - Withdrawn";


                $national1->submit_by = Auth::user()->name;
                $national1->submit_on = Carbon::now()->format('d-M-Y');

                $validation2 = new NationalApprovalAudit();
                $validation2->nationalApproval_id = $id;
                $validation2->activity_type = 'Activity Log';
                $validation2->current = $national1->submit_by;
                $validation2->comment = $request->comment;
                $validation2->user_id = Auth::user()->id;
                $validation2->user_name = Auth::user()->name;
                $validation2->user_role = RoleGroup::where('id', Auth::user()->role)->value('name');
                $validation2->change_from = $lastDocument->status;
                $validation2->action = 'Withdraw';
                $validation2->change_to = "Closed - Withdrawn";
                $validation2->stage = 'Submited';
                $validation2->save();

                $national1->update();
                toastr()->success('Document Sent');
                return back();
            }
        } else {
            toastr()->error('E-signature Not match');
            return back();
        }
    }

    public function audit_NationalApproval($id)
    {
        $national = NationalApproval::findOrFail($id);
        $audit = NationalApprovalAudit::where('nationalApproval_id', $id)->orderByDESC('id')->paginate();
        $today = Carbon::now()->format('d-m-y');
        $document = NationalApproval::where('id', $id)->first();
        $document->originator = User::where('id', $document->initiator_id)->value('name');

        return view('frontend.New_forms.national-approval.auditNationalApproval', compact('document', 'audit', 'today', 'national'));
    }

    public function nationalAuditTrialDetails($id)
    {
        $detail = NationalApprovalAudit::find($id);
        $detail_data = NationalApprovalAudit::where('activity_type', $detail->activity_type)->where('nationalApproval_id', $detail->nationalApproval_id)->latest()->get();
        $doc = NationalApproval::where('id', $detail->nationalApproval_id)->first();
        // $doc->origiator_name =  User::where('id', $document->initiator_id)->value('name');
        return view('frontend.New_forms.national-approval.np_audit_details', compact('detail', 'doc', 'detail_data'));
    }

    public function singleReport($id)
    {
        $data = NationalApproval::find($id);
        if (!empty($data)) {
            $data->originator = User::where('id', $data->initiator_id)->value('name');

            $doc = NationalApprovalAudit::where('nationalApproval_id', $data->id)->first();
            $detail_data = NationalApprovalAudit::where('activity_type', $data->activity_type)
                ->where('nationalApproval_id', $data->nationalApproval_id)
                ->latest()
                ->get();

            // pdf related work
            $pdf = App::make('dompdf.wrapper');
            $time = Carbon::now();
            $pdf = PDF::loadview('frontend.New_forms.national-approval.singleNationalApprovalReport', compact(
                'detail_data',
                'doc',
                'data'
            ))
                ->setOptions([
                    'defaultFont' => 'sans-serif',
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'isPhpEnabled' => true,
                ]);

            $pdf->setPaper('A4');
            $pdf->render();
            $canvas = $pdf->getDomPDF()->getCanvas();
            $height = $canvas->get_height();
            $width = $canvas->get_width();
            $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');
            $canvas->page_text($width / 4, $height / 2, $data->status, null, 25, [0, 0, 0], 2, 6, -20);
            return $pdf->stream('National Approval' . $id . '.pdf');
        }

        return redirect()->back()->with('error', 'National Approval not found.');
    }

    public function audit1_pdf($id)
    {
        $doc = NationalApproval::find($id);
        if (!empty($doc)) {
            $doc->originator = User::where('id', $doc->initiator_id)->value('name');
        } else {
            $datas = ActionItem::find($id);

            if (empty($datas)) {
                $datas = Extension::find($id);
                $doc = NationalApproval::find($datas->national_id);
                $doc->originator = User::where('id', $doc->initiator_id)->value('name');
                $doc->created_at = $datas->created_at;
            } else {
                $doc = NationalApproval::find($datas->national_id);
                $doc->originator = User::where('id', $doc->initiator_id)->value('name');
                $doc->created_at = $datas->created_at;
            }
        }
        $data = NationalApprovalAudit::where('nationalApproval_id', $doc->id)->orderByDesc('id')->get();
        // pdf related work
        $pdf = App::make('dompdf.wrapper');
        $time = Carbon::now();
        $pdf = PDF::loadview('frontend.New_forms.national-approval.np_audit_trail_pdf', compact('data', 'doc'))
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);
        $pdf->setPaper('A4');
        $pdf->render();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->page_script('$pdf->set_opacity(0.1,"Multiply");');

        $canvas->page_text(
            $width / 3,
            $height / 2,
            $doc->status,
            null,
            60,
            [0, 0, 0],
            2,
            6,
            -20
        );

        return $pdf->stream('National Approval' . $id . '.pdf');
    }

    public function np_child_1($stage)
    {
        $national = NationalApproval::find($stage);

        if ($national->stage == 2) {
            return view('frontend.New_forms.correspondence');
        } elseif ($national->stage == 3 || value('variation')) {
            return view('frontend.Registration-Tracking.variation');
        } else {
            return view('frontend.New_forms.correspondence');
        }
    }
}
