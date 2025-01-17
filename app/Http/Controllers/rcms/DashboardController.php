<?php

namespace App\Http\Controllers\rcms;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use App\Models\Capa;
use App\Models\CC;
use App\Models\EffectivenessCheck;
use App\Models\Extension;
use App\Models\InternalAudit;
use App\Models\ManagementReview;
use App\Models\RiskManagement;
use App\Models\LabIncident;
use App\Models\Auditee;
use App\Models\AuditProgram;
use App\Models\Deviation;
use App\Models\Observation;

use App\Models\Calibration;
use App\Models\Sanction;
use App\Models\Validation;
use App\Models\Equipment;
use App\Models\MonthlyWorking;
use App\Models\NationalApproval;

use App\Models\LabInvestigation;

use App\Models\GcpStudy;
use App\Models\SupplierContract;
use App\Models\SubjectActionItem;
use App\Models\Violation;
use App\Models\CTAAmendement;
use App\Models\Correspondence;
use App\Models\ContractTestingLabAudit;
use App\Models\ClinicalSite;
use App\Models\DosierDocuments;
use App\Models\PreventiveMaintenances;

use App\Models\ClientInquiry;
use App\Models\MeetingManagement;
use App\Models\AdditionalInformation;
use App\Models\AuditTask;

use App\Models\PSUR;
use App\Models\MedicalDevice;
use App\Models\Commitment;

use App\Models\QualityFollowup;
use App\Models\Product_Validation;
use App\Models\Reccomended_action;

use App\Models\RootCauseAnalysis;
use App\Models\Hypothesis;
use App\Models\Renewal;


use Helpers;
use App\Models\User;
use App\Models\ValidationAudit;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index(){
    //     if(Helpers::checkRoles(3)){
    //         $data = CC::where('initiator_id',Auth::user()->id)->orderbyDESC('id')->get();
    //         $child = [];
    //         $childs = [];
    //         foreach($data as $datas){
    //             $datas->originator = User::where('id',$datas->initiator_id)->value('name');
    //             $datas->actionItem = ActionItem::where('cc_id',$datas->id)->get();
    //             $datas->extension = Extension::where('cc_id',$datas->id)->get();


    //         }


    //         return view('frontend.rcms.dashboard',compact('data'));
    //     }
    // }

    public function index()
    {
        $table = [];

        $datas = CC::orderByDesc('id')->get();
        $datas1 = ActionItem::orderByDesc('id')->get();
        $datas2 = Extension::orderByDesc('id')->get();
        $datas3 = EffectivenessCheck::orderByDesc('id')->get();
        $datas4 = InternalAudit::orderByDesc('id')->get();
        $datas5 = Capa::orderByDesc('id')->get();
        $datas6 = RiskManagement::orderByDesc('id')->get();
        $datas7 = ManagementReview::orderByDesc('id')->get();
        $datas8 = LabIncident::orderByDesc('id')->get();
        $datas9 = Auditee::orderByDesc('id')->get();
        $datas10 = AuditProgram::orderByDesc('id')->get();
        $datas11 = RootCauseAnalysis::orderByDesc('id')->get();
        $datas12 = Observation::orderByDesc('id')->get();
        $datas13 = Deviation::orderByDesc('id')->get();

        $datas14 = Validation::orderByDesc('id')->get();
        $datas15 = Equipment::orderByDesc('id')->get();
        $datas16 = Calibration::orderByDesc('id')->get();
        $datas17 = NationalApproval::orderByDesc('id')->get();
        $datas18 = Sanction::orderByDesc('id')->get();
        $datas19 = MonthlyWorking::orderByDesc('id')->get();

        $datas20 = LabInvestigation::orderByDesc('id')->get();
        
        $datas21 = GcpStudy::orderByDesc('id')->get();
        $datas22 = SupplierContract::orderByDesc('id')->get();
        $datas23 = SubjectActionItem::orderByDesc('id')->get();
        $datas24 = Violation::orderByDesc('id')->get();
        $datas25 = CTAAmendement::orderByDesc('id')->get();
        $datas26 = Correspondence::orderByDesc('id')->get();
        $datas27 = ContractTestingLabAudit::orderByDesc('id')->get();
        $datas28 = ClinicalSite::orderByDesc('id')->get();

        $datas29 = DosierDocuments::orderByDesc('id')->get();
        $datas30 = PreventiveMaintenances::orderByDesc('id')->get();

        $datas31 = ClientInquiry::orderByDesc('id')->get();
        $datas32 = MeetingManagement::orderByDesc('id')->get();
        $datas33 = AdditionalInformation::orderByDesc('id')->get();
        $datas34 = AuditTask::orderByDesc('id')->get();

        $datas35 = MedicalDevice::orderByDesc('id')->get();
        $datas36 = PSUR::orderByDesc('id')->get();
        $datas37 =Commitment::orderByDesc('id')->get();

        $datas38 = QualityFollowup::orderByDesc('id')->get();
        $datas39 = Product_Validation::orderByDesc('id')->get();
        $datas40 = Reccomended_action::orderByDesc('id')->get();

        $datas41 = Hypothesis::orderByDesc('id')->get();
        // $datas42 = Renewal::orderByDesc('id')->get();

        foreach ($datas as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Change-Control",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas1 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Action-Item",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas2 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->cc_id ? $data->cc_id : "-",
                "record" => $data->record,
                "type" => "Extension",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas3 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Effectiveness-Check",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas4 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Internal-Audit",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas5 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            $revised_date = Extension::where('parent_id', $data->id)->where('parent_type', "Capa")->value('revised_date');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Capa",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $revised_date ? $revised_date : $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas6 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Risk-Assesment",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas7 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Management-Review",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas8 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Lab-Incident",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_desc ? $data->short_desc : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas9 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "External-Audit",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas10 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "type" => "Audit-Program",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "division_id" => $data->division_id,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas11 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Root-Cause-Analysis",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas12 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Observation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas13 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Deviation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas14 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Validation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas15 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Equipment",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->initiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas16 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Calibration",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->initiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas17 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "National Approval",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->initiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas18 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Sanction",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->initiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas19 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "MonthlyWorking",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->initiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        
        foreach ($datas20 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
    
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "lab-investigation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas21 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Gcp-Study",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description_gi ? $data->short_description_gi : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas22 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Supplier-Contract",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description_gi ? $data->short_description_gi : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas23 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');
            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Subject-Action-Item",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description_ti ? $data->short_description_ti : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas24 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Violation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        
        foreach ($datas25 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "CTA-Amendement",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas26 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Correspondence",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas27 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "CTL-Audit",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas28 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "ClinicalSite",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas29 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Dossier Documents",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas30 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Preventive Maintenance",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        
        foreach ($datas31 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "ClientInquiry",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->originator,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas32 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "MeetingManagement",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas33 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "AdditionalInformation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas34 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "AuditTask",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->date_opened,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }

        foreach ($datas35 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Medical Device",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->date_of_initiation,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas36 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "PSUR",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }


        foreach ($datas37 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Commitment",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator,
                "intiation_date" => $data->date_of_initiaton,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas38 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Quality-Follow-Up",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas39 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Product_Validation",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->short_description ? $data->short_description : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->intiation_date,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas40 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Reccomended_action",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->parent_short_desecription ? $data->parent_short_desecription : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->date_of_initiation,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);
        }
        foreach ($datas41 as $data) {
            $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

            array_push($table, [
                "id" => $data->id,
                "parent" => $data->parent_record ? $data->parent_record : "-",
                "record" => $data->record,
                "division_id" => $data->division_id,
                "type" => "Hypothesis",
                "parent_id" => $data->parent_id,
                "parent_type" => $data->parent_type,
                "short_description" => $data->parent_short_desecription ? $data->parent_short_desecription : "-",
                "initiator_id" => $data->initiator_id,
                "intiation_date" => $data->date_of_initiation,
                "stage" => $data->status,
                "date_open" => $data->create,
                "date_close" => $data->updated_at,
            ]);

        }
        // foreach ($datas42 as $data) {
        //     $data->create = Carbon::parse($data->created_at)->format('d-M-Y h:i A');

        //     array_push($table, [
        //         "id" => $data->id,
        //         "parent" => $data->parent_record ? $data->parent_record : "-",
        //         "record" => $data->record,
        //         "division_id" => $data->division_id,
        //         "type" => "Renewal",
        //         "parent_id" => $data->parent_id,
        //         "parent_type" => $data->parent_type,
        //         "short_description" => $data->parent_short_desecription ? $data->parent_short_desecription : "-",
        //         "initiator_id" => $data->initiator_id,
        //         "intiation_date" => $data->date_of_initiation,
        //         "stage" => $data->status,
        //         "date_open" => $data->create,
        //         "date_close" => $data->updated_at,
        //     ]);

        // }

        
        $table  = collect($table)->sortBy('record')->reverse()->toArray();
        // return $table;
        // $paginatedData = json_encode($table);

        //  $datag = $this->paginate($table);
        $datag = $this->paginate($table);
        //   $paginatedData = json_encode($datag);
        
        return view('frontend.rcms.dashboard', compact('datag'));
    }
    public function dashboard_child($id, $process){
        if ($process == 1) {
            $datas1 = ActionItem::where('cc_id', $id)->orderByDesc('id')->get();
            $datas2 = Extension::where('cc_id', $id)->orderByDesc('id')->get();
            
            foreach ($datas1 as $data) {
                array_push($table, [
                    "id" => $data->id,
                    "parent" => $data->cc_id ? $data->cc_id : "-",
                    "record" => $data->record,
                    "type" => "Action-Item",
                    "short_description" => $data->short_description ? $data->short_description : "-",
                    "initiator_id" => $data->initiator_id,
                    "intiation_date" => $data->intiation_date,
                    "stage" => $data->status,
                    "date_open" => $data->created_at,
                    "date_close" => $data->updated_at,
                ]);
            }

            foreach ($datas2 as $data) {
                array_push($table, [
                    "id" => $data->id,
                    "parent" => $data->cc_id ? $data->cc_id : "-",
                    "record" => $data->record,
                    "type" => "Extension",
                    "short_description" => $data->short_description ? $data->short_description : "-",
                    "initiator_id" => $data->initiator_id,
                    "intiation_date" => $data->intiation_date,
                    "stage" => $data->status,
                    "date_open" => $data->created_at,
                    "date_close" => $data->updated_at,
                ]);
            }
        } else {
            if ($process == 2) {
                $ab = ActionItem::find($id);
                $data = CC::where('id', $ab->cc_id)->orderByDesc('id')->first();
                $datas1 = ActionItem::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                $datas2 = Extension::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                foreach ($data as $datas) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Change-Control",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }

                foreach ($datas1 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Action-Item",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }

                foreach ($datas2 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Extension",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }
            } elseif ($process == 3) {
                $ab = Extension::find($id);
                $data = CC::where('id', $ab->cc_id)->orderByDesc('id')->first();
                $datas1 = ActionItem::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                $datas2 = Extension::where('cc_id', $ab->cc_id)->orderByDesc('id')->get();
                foreach ($data as $datas) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Change-Control",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }

                foreach ($datas1 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Action-Item",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->intiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }

                foreach ($datas2 as $data) {
                    array_push($table, [
                        "id" => $data->id,
                        "parent" => $data->cc_id ? $data->cc_id : "-",
                        "record" => $data->record,
                        "type" => "Extension",
                        "short_description" => $data->short_description ? $data->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data->initiation_date,
                        "stage" => $data->status,
                        "date_open" => $data->created_at,
                        "date_close" => $data->updated_at,
                    ]);
                }
            }
        }
        $table = collect($table)->sortBy('date_open')->reverse()->toArray();
        $datag = json_encode($table);
        return view('frontend.rcms.dashboard', compact('datag'));
    }
    public function dashboard_child_new($id, $process)
    {
        $table = [];

        if ($process == "extension") {

            $data = Extension::where('id', $id)->orderByDesc('id')->first();

            if ($data->parent_type == "Capa") {
                $data2 = Capa::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Capa",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Internal_audit") {
                $data2 = InternalAudit::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Internal-Audit",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Product Validation") {
                $data2 = InternalAudit::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Product Validation",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "QualityFollowup") {
                $data2 = InternalAudit::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "QualityFollowup",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Reccomended_action") {
                $data2 = InternalAudit::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Reccomended_action",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }

            if ($data->parent_type == "External_audit") {
                $data2 = Auditee::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "External-Audit",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            
            if ($data->parent_type == "meeting_management") {
                $data2 = CC::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "meeting-management",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "MeetingManagement") {
                $data2 = MeetingManagement::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "MeetingManagement",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "AdditionalInformation") {
                $data2 = MeetingManagement::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "AdditionalInformation",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
             if ($data->parent_type == "AuditTask") {
                $data2 = AuditTask::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "AuditTask",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->date_opened,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }

            if ($data->parent_type == "Action_item") {
                $data2 = ActionItem::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Action-Item",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Audit_program") {
                $data2 = AuditProgram::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Audit-Program",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Observation") {
                $data2 = Observation::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Observation",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Validation_audit") {
                $data2 = ValidationAudit::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Validation-Audit",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
            if ($data->parent_type == "Change_control") {
                $data2 = CC::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "Change-Control",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
             if ($data->parent_type == "client_inquiry") {
                $data2 = CC::where('id', $data->parent_id)->first();
                $data2->create = Carbon::parse($data2->created_at)->format('d-M-Y h:i A');
                array_push(
                    $table,
                    [
                        "id" => $data2->id,
                        "parent" => $data2->parent_record ? $data2->parent_record : "-",
                        "record" => $data2->record,
                        "type" => "client-inquiry",
                        "parent_id" => $data2->parent_id,
                        "parent_type" => $data2->parent_type,
                        "division_id" => $data2->division_id,
                        "short_description" => $data2->short_description ? $data2->short_description : "-",
                        "initiator_id" => $data->initiator_id,
                        "intiation_date" => $data2->intiation_date,
                        "stage" => $data2->status,
                        "date_open" => $data2->create,
                        "date_close" => $data2->updated_at,
                    ]
                );
            }
                
        } else {
            return redirect(url('rcms/qms-dashboard'));
        }

        $table  = collect($table)->sortBy('record')->reverse()->toArray();
        $datag = $this->paginate($table);



        // return redirect(url('rcms/qms-dashboard'));
        return view('frontend.rcms.dashboard', compact('datag'));
    }

    public function ccView($id, $type)
    {

        if ($type == "Change-Control") {
            $data = CC::find($id);
            $single = "change_control_single_pdf/" . $data->id;
            $audit = "audit/" . $data->id;
        } elseif ($type == "Capa") {
            $data = Capa::find($id);
            $single = "capaSingleReport/" . $data->id;
            $audit = "capaAuditReport/" . $data->id;
        } elseif ($type == "Internal-Audit") {
            $data = InternalAudit::find($id);
            $single = "internalSingleReport/" . $data->id;
            $audit = "internalauditReport/" . $data->id;
        } elseif ($type == "Risk-Assesment") {
            $data = RiskManagement::find($id);
            $single = "riskSingleReport/" . $data->id;
            $audit = "riskAuditReport/" . $data->id;
        } elseif ($type == "Lab-Incident") {
            $data = LabIncident::find($id);
            $single = "LabIncidentSingleReport/" . $data->id;
            $audit = "LabIncidentAuditReport/" . $data->id;
        } elseif ($type == "External-Audit") {
            $data = Auditee::find($id);
            $single = "ExternalAuditSingleReport/" . $data->id;
            $audit = "ExternalAuditTrialReport/" . $data->id;
        } elseif ($type == "Audit-Program") {
            $data = AuditProgram::find($id);
            $single = "auditProgramSingleReport/" . $data->id;
            $audit = "auditProgramAuditReport/" . $data->id;
        } elseif ($type == "Action-Item") {
            $data = ActionItem::find($id);
            $single = "actionitemSingleReport/"  . $data->id;
            $audit = "actionitemAuditReport/" . $data->id;
        } elseif ($type == "QualityFollowUp") {
            $data = ActionItem::find($id);
            $single = "qualityFollowUpSingleReport/"  . $data->id;
            $audit = "qualityFollowUpAuditReport/" . $data->id;
        } elseif ($type == "Extension") {
            $data = Extension::find($id);
            $single = "extensionSingleReport/" . $data->id;
            $audit = "extensionAuditReport/" . $data->id;
        } elseif ($type == "Observation") {
            $data = Observation::find($id);
            $single = "#";
            $audit = "ObservationAuditTrialShow/" . $data->id;
        } elseif ($type == "Effectiveness-Check") {
            $data = EffectivenessCheck::find($id);
            $single = "effectiveSingleReport/" . $data->id;
            $audit = "effectiveAuditReport/" . $data->id;
        } elseif ($type == "Management-Review") {
            $data = ManagementReview::find($id);
            $single = "managementReview/" . $data->id;
            $audit = "managementReviewReport/" . $data->id;
        } 
        elseif ($type == "Root-Cause-Analysis") {
            $data = RootCauseAnalysis::find($id);
            $single = "rootSingleReport/" . $data->id;
            $audit = "rootAuditReport/" . $data->id;
        } 
        elseif ($type == "Deviation") {
            $data = Deviation::find($id);
            $single = "deviationSingleReport/" . $data->id;
            $audit = "#";
            $parent = "deviationparentchildReport/" . $data->id;
        } elseif ($type == "Validation") {
            $data = Validation::find($id);
            $single = "validationSingleReport/" . $data->id;
            $audit = "audit_validationPdf/" . $data->id;
            $parent = "validationparentchildReport/" . $data->id;
        } elseif ($type == "Equipment") {
            $data = Equipment::find($id);
            $single = "equipmentSingleReport/" . $data->id;
            $audit = "audit_pdf/" . $data->id;
            $parent = "equipmentparentchildReport/" . $data->id;
        } elseif ($type == "Calibration") {
            $data = Calibration::find($id);
            $single = "calibrationSingleReport/" . $data->id;
            $audit = "calibration_audit/" . $data->id;
            $parent = "calibrationparentchildReport/" . $data->id;
        } elseif ($type == "National Approval") {
            $data = NationalApproval::find($id);
            $single = "national_approvalSingleReport/" . $data->id;
            $audit = "np_audit/" . $data->id;
            $parent = "calibrationparentchildReport/" . $data->id;
        } elseif ($type == "Sanction") {
            $data = Sanction::find($id);
            $single = "sanctionSingleReport/" . $data->id;
            $audit = "sanction_audit/" . $data->id;
            $parent = "sanctionparentchildReport/" . $data->id;
        } elseif ($type == "MonthlyWorking") {
            $data = MonthlyWorking::find($id);
            $single = "monthlySingleReport/" . $data->id;
            $audit = "monthly_audit/" . $data->id;
            $parent = "monthlyparentchildReport/" . $data->id;
        } elseif ($type == "lab-investigation") {
            $data = LabInvestigation::find($id);
            $single = "lab_singleReport/". $data->id;
            $audit = "lab_auditReport/".$data->id;
            $parent="#". $data->id;
        } 
        elseif ($type == "Dossier Documents") {
            $data = DosierDocuments::find($id);
            $single = "dosierdocuments/single_report/" . $data->id;
            $audit = "dosierdocuments/audit_report/" . $data->id;
            $parent = "deviationparentchildReport/" . $data->id;
        } elseif ($type == "Preventive Maintenance") {
            $data = PreventiveMaintenances::find($id);
            $single = "preventivemaintenance/single_report/" . $data->id;
            $audit = "preventivemaintenance/audit_report/" . $data->id;
            $parent = "deviationparentchildReport/" . $data->id;
        } elseif ($type == "ClinicalSite") {
            $data = ClinicalSite::find($id);
            $audit = "pdf/" . $data->id;
            $single = "pdf-report/" . $data->id;
            $parent = "deviationparentchildReport/" . $data->id;
        } elseif ($type == "Gcp-Study") {
            $data = GcpStudy::find($id);
            $single = "GCP_study/SingleReport/" . $data->id;
            $audit = "GCP_study/AuditTrailPdf/" . $data->id;
            $parent = "/" . $data->id;
        } elseif ($type == "Supplier-Contract") {
            $data = SupplierContract::find($id);
            $single = "supplier_contract/SingleReport/" . $data->id;
            $audit = "supplier_contract/AuditTrailPdf/" . $data->id;
            $parent = "/" . $data->id;
        } elseif ($type == "Subject-Action-Item") {
            $data = SubjectActionItem::find($id);
            $single = "subject_action_item/SingleReport/" . $data->id;
            $audit = "subject_action_item/AuditTrailPdf/" . $data->id;
            $parent = "/" . $data->id;
        } elseif ($type == "Violation") {
            $data = Violation::find($id);
            $single = "violation/SingleReport/" . $data->id;
            $audit = "violation/AuditTrailPdf/" . $data->id;
            $parent = "/" . $data->id;
        } elseif ($type == "CTA-Amendement") {
            $data = CTAAmendement::find($id);
            $single = "CTA_Amendement/SingleReport/" . $data->id;
            $audit = "CTA_Amendement/AuditTrailPdf/" . $data->id;
            $parent = "/" . $data->id;
        } elseif ($type == "Correspondence") {
            $data = Correspondence::find($id);
            $single = "correspondence/SingleReport/" . $data->id;
            $audit = "correspondence/AuditTrailPdf/" . $data->id;
            $parent = "/" . $data->id;
        } elseif ($type == "CTL-Audit") {
            $data = ContractTestingLabAudit::find($id);
            $single = "ctl_audit/SingleReport/" . $data->id;
            $audit = "ctl_audit/AuditTrailPdf/" . $data->id;
            $parent = "/" . $data->id;
        }
        elseif ($type == "ClientInquiry") {
            $data = ClientInquiry::find($id);
            $single = "clientinquarySingleReport/". $data->id;
            $audit = "clientInquiryAuditReport/". $data->id;
            $parent="#". $data->id;
        }elseif ($type == "MeetingManagement") {
            $data = MeetingManagement::find($id);
            $single = "meetingmanagementSingleReport/". $data->id;
            $audit = "meetingManagementAuditReport/". $data->id;
            $parent="#". $data->id;
        }
        elseif ($type == "AdditionalInformation") {
            $data = AdditionalInformation::find($id);
            $single = "additionalinformationSingleReport/". $data->id;
            $audit = "additionalinformationAuditReport/". $data->id;
            $parent="#". $data->id;
        }
         elseif ($type == "AuditTask") {
            $data = AuditTask::find($id);
            $single = "audittaskSingleReport/". $data->id;
            $audit = "audittaskAuditReport/". $data->id;
            $parent="#". $data->id;
        }
        elseif ($type == "Medical Device") {
            $data = MedicalDevice::find($id);
            $single = "medicalSingleReport/". $data->id;
            $audit = "medicaldevice_audit/";
            $parent="medicalparentchildReport/". $data->id;
        }elseif ($type == "PSUR") {
            $data = PSUR::find($id);
            $single = "PSURSingleReport/". $data->id;
            $audit = "psur_auditpdf/". $data->id;
            $parent= "#";
        }elseif ($type == "Commitment") {
            $data = Commitment::find($id);
            $single = "CommitmentSingleReport/". $data->id;
            $audit = "Commitmentaudit.pdf/". $data->id;
            $parent= "#";
        }
        
        elseif ($type == "Quality-Follow-Up") {
            $data = QualityFollowup::find($id);
            $single = "quality_singleReports/". $data->id;
            $audit = "quality_audit/". $data->id;
            $parent="#". $data->id;
        }
        elseif ($type == "Reccomended_action") {
            $data = Reccomended_action::find($id);
            $single = "singleReports/". $data->id;
            $audit = "RcomendedAuditTrail.pdf/". $data->id;
            $parent="#". $data->id;
        }elseif ($type == "Product_Validation") {
            $data = Product_Validation::find($id);
            $single = "singleReports/". $data->id;
            $audit = "QualityAuditTrail.pdf/". $data->id;
            $parent= "#";
        }elseif ($type == "Hypothesis") {
            $data = Hypothesis::find($id);
            $single = "deviationSingleReport/". $data->id;
            $audit = "#";
            $parent="#". $data->id;
        }
        // elseif ($type == "Renewal") {
        //     $data = Renewal::find($id);
        //     $single = "deviationSingleReport/". $data->id;
        //     $audit = "#";
        //     $parent="#". $data->id;
        // }
        

        $html = '';
        $html = '<div class="block"> 
        <div class="record_no">
            Record No. ' . str_pad($data->record, 4, '0', STR_PAD_LEFT) .
            '</div>
        <div class="division">
        ' . Helpers::getDivisionName(session()->get('division')) . '/ ' . $type . '
        </div>
        <div class="status">' .
            $data->status . '
        </div>
            </div>
            <div class="block">
                <div class="block-head">
                    Actions
                </div>
                <div class="block-list">
                    <a href="send-notification" class="list-item">Send Notification</a>
                    <div class="list-drop">
                        <div class="list-item" onclick="showAction()">
                            <div>Run Report</div>
                            <div><i class="fa-solid fa-angle-down"></i></div>
                        </div>
                        <div class="drop-list">
                            <a target="__blank" href="' . $audit . '" class="inner-item">Audit Trail</a>
                            <a target="__blank" href="' . $single . '" class="inner-item">' . $type . ' Single Report</a>
                            <a target="__blank" href="' . $parent . '" class="inner-item">' . $type . ' Parent with immediate child Report</a>
                        </div>
                    </div>
                </div>
            </div>';
        $response['html'] = $html;

        return response()->json($response);
    }

    //----------PAginator

    public function paginate($items, $perPage = 100000, $page = null, $options = ['path' => 'mytaskdata'])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
