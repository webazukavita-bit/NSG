<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Countrie;
use App\Models\State;
use App\Models\Citie;
use App\Models\Lead;
use App\Models\User;
use App\Models\FollowUp;
use App\Models\ContactUs;


class CRMController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function leads(Request $request)
    {   
        $role_type = auth()->user()->roles->type;
        $user = auth()->user();

        $employees = User::withTrashed()->whereHas('roles', function($query) {
                        $query->where('type', 'Employee');
                    })->get();
        
        if ($role_type == "Admin") {
            $query = Lead::withTrashed()->latest();
        } elseif ($user->role_id == 5) {
            $query = Lead::latest()
                        ->where(function ($q) use ($user) {
                            $q->where('assigned_to', $user->id)->orWhere('created_by', $user->id)->orWhereNull('assigned_to'); 
                        });
        } else {
            $query = Lead::latest()
                        ->where(function ($q) use ($user) {
                            $q->where('assigned_to', $user->id)->orWhere('created_by', $user->id);
                        });
        }

        $data = $query->get();
        if ($role_type == "Admin") {
            return view('admin.crm.lead.list', compact('data','employees'));
        } else {
            return view('admin.crm.lead.for-emp-list', compact('data','employees'));
        }
    }

    public function leadAdd()
    {
        $countrie = Countrie::orderBy('name', 'asc')->get();
        $country_id = '101';
        $states = [];
        $cities = [];
        if(!empty($country_id)) {
            $states = State::where(['country_id' => $country_id])->orderBy('name', 'asc')->get();
        }
        if(!empty($address->state_id)) {
            $cities = Citie::where(['state_id' => $address->state_id])->orderBy('name', 'asc')->get();
        }
        return view('admin.crm.lead.add',compact('countrie','states','cities','country_id'));
    }
    
    public function leadStore(Request $request)
    {
        $validated = $request->validate([
                'user_name' => 'required|string|max:255',
                'phone' => ['required', 'regex:/^[6-9]\d{9}$/'], 
                'email' => 'required|email',
                'state' => 'required|string', 
                'source' => 'required|string',
            ], [
                'phone.regex' => 'Please enter a valid 10-digit mobile number starting with 6-9.'
            ]);

        $lead = new Lead();
        $lead->code = config('app.shortname').time();
        $lead->user_name = $request->user_name;
        $lead->company_name = $request->company_name;
        $lead->phone = $request->phone;
        $lead->email = $request->email;
        $lead->source = $request->source;
        $lead->country_id = $request->country;
        $lead->state_id = $request->state;
        $lead->city_id = $request->city;
        $lead->zip_code = $request->zip;
        $lead->address = $request->address;
        $lead->source_description = $request->source_description;
        $lead->created_by = auth()->user()->id;
        

        $check = $lead->save();

        if($check) {
            return redirect()->route('leads')->with('success', 'Lead created successfully.');
        } else {
            return redirect()->route('leads')->with('error', 'Lead Not created.');
        }
    }

    public function leadEdit($id)
    {
        $data = Lead::findOrFail($id);

        $countrie = Countrie::orderBy('name', 'asc')->get();
        $country_id = $data->country_id??'';
        $states = [];
        $cities = [];
        if(!empty($country_id)) {
            $states = State::where(['country_id' => $country_id])->orderBy('name', 'asc')->get();
        }
        if(!empty($data->state_id)) {
            $cities = Citie::where(['state_id' => $data->state_id])->orderBy('name', 'asc')->get();
        }

        return view('admin.crm.lead.edit',compact('countrie','states','cities','country_id','data'));
    }

    public function leadUpdate(Request $request, $id)
    {
        $validated = $request->validate([
                'user_name' => 'required|string|max:255',
                'phone' => ['required', 'regex:/^[6-9]\d{9}$/'], 
                'email' => 'required|email',
                'state' => 'required|string', 
                'source' => 'required|string',
            ], [
                'phone.regex' => 'Please enter a valid 10-digit mobile number starting with 6-9.'
            ]);

        $lead = Lead::findOrFail($id);
        $lead->user_name = $request->user_name;
        $lead->company_name = $request->company_name;
        $lead->phone = $request->phone;
        $lead->email = $request->email;
        $lead->source = $request->source;
        $lead->country_id = $request->country;
        $lead->state_id = $request->state;
        $lead->city_id = $request->city;
        $lead->zip_code = $request->zip;
        $lead->address = $request->address;
        $lead->source_description = $request->source_description;
        
        $check = $lead->save();

        if($check) {
            return redirect()->route('leads')->with('success', 'Leads updated successfully.');
        } else {
            return redirect()->route('leads')->with('error', 'Leads not updated.');
        }
    }

    public function leadDelete($id)
    {
        $data = Lead::withTrashed()->findOrFail($id);
        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Lead restored successfully!';
        } else {
            $data->delete();
            $message = 'Lead deleted successfully!';
        }

        return redirect()->route('leads')->with('success', $message);
    }

    
    public function contactUs(Request $request)
    {
        $data = ContactUs::withTrashed()->latest()->get();
        return view('admin.crm.contact-us', compact('data'));
    }

    
    public function contactUsDelete($id)
    {
        $data = ContactUs::withTrashed()->findOrFail($id);
        
        if ($data->trashed()) {
            $data->restore();
            $message = 'Contact Us restored successfully!';
        } else {
            $data->delete();
            $message = 'Contact Us deleted successfully!';
        }

        return redirect()->route('crm-contact-us')->with('success', $message);
    }



    public function takeLead(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $user = auth()->user();
   
        $lead->assigned_to = $user->id;
        $lead->assigned_date = now();

        $check = $lead->save();

        if($check) {
            return redirect()->route('leads')->with('success', 'Leads achieved successfully.');
        } else {
            return redirect()->route('leads')->with('error', 'Leads not achieved.');
        }
    } 
    

         
    public function leadFollowUp($id, Request $request)
    {       
        $data = Lead::with(['assignedAgent','creator'])->findOrFail($id);

        $profile = auth()->user()->gender == 'Female'? 'images/user-2.svg':'images/user-1.svg';

        $query = FollowUp::where('lead_id', $id)->orderBy('created_at', 'desc');

        if ($request->has('before_id')) {
            $query->where('id', '<', $request->before_id);
        }

        $messages = $query->limit(10)->get()->reverse();

        if ($request->ajax()) {
            return view('admin.crm.lead.partials.messages-list', compact('messages','data','profile'))->render();
        }

        $employees = User::withTrashed()->whereHas('roles', function($query) {
                                $query->where('type', 'Employee');
                            })->get(['id', 'name']);

        $support = FollowUp::with(['user', 'assignee', 'replies' => function ($query) {
                                    $query->orderBy('created_at', 'desc')->limit(1);
                                }])->orderBy('updated_at','desc')->get();

        return view('admin.crm.lead.messages', compact('messages', 'data','employees','support','profile'));
    }

    // public function leadFollowUp($id, Request $request)
    // {
    //         $data = Lead::findOrFail($id);
          
    //         $request->validate([
    //             'message' => 'required',
    //             'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
    //         ], [
    //             'message.required' => 'Message Required',
    //             'attachment.max' => 'File must be under 10MB',
    //         ]);

    //         $filename = null;
    //         $filetype = null;
    //         if ($request->hasFile('attachment')) {
    //             $file = $request->file('attachment');
    //             $filetype = $file->getClientOriginalExtension(); 
    //             $filename = $data->code . '_' . date("Y-m-d_H-i-s") . '.' . $filetype;
    //             $destinationPath = public_path('images/support');
    //             $file->move($destinationPath, $filename);
    //         }

    //         $insert = SupportReply::insert([
    //                                     'support_id' => $id, 
    //                                     'user_id' => Auth::user()->id, 
    //                                     'description' => $request->message,
    //                                     'type' => Auth::user()->roles->type,
    //                                     'file_type' => $filetype,
    //                                     'file' => $filename,
    //                                     'replay_id' => 0,
    //                                 ]);
            
    //         $count = SupportReply::groupBy('user_id')->where('support_id',$id)->count();
            
    //         if($count > 1 && $data->status != 'Closed') {
    //             $data->status = 'Open';
    //             $data->save();
    //         }

    //         return to_route('ticket-reply', [$id]);
    // }

    public function storeQuotation(Request $request)
   {
    $request->validate([
        'id'        => 'required|integer|exists:leads,id',
        'quotation' => 'required|file|mimes:pdf|max:2048',
    ]);

    $lead = Lead::findOrFail($request->id);

    if ($request->hasFile('quotation')) {

        $file = $request->file('quotation');

        $fileName = 'quotation_' . time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images/quotation'), $fileName);

        $lead->quotation = $fileName;

        $lead->save();

        return redirect()->route('leads')
            ->with('success', 'Quotation added successfully.');
    }

    return redirect()->route('leads')
        ->with('error', 'No file uploaded.');
   }

   public function addData()
   {
     $countrie = Countrie::orderBy('name', 'asc')->get();
        $country_id = '101';
        $states = [];
        if(!empty($country_id)) {
            $states = State::where(['country_id' => $country_id])->orderBy('name', 'asc')->get();
        }

        return view('front.form',compact('countrie','states','country_id'));
    }
   
   public function storeData(Request $request )
   {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'whatsapp_number' => ['required', 'regex:/^[6-9]\d{9}$/'],
        'pincode' => ['required', 'digits:6'],
        'state' =>'required|string',
        // Residential
        'bill' => 'required_if:type,residential|nullable|string',

        // Commercial
        'electricity_bill' => 'required_if:type,commercial|nullable|string|in:0-50000,5000-2lacs,> 2lacs',
        'house_name' => 'required_if:type,commercial|nullable|string',
        'approval_status' => 'required_if:type,commercial|nullable|string|in:We already have AGM approval,We don\'t have an AGM approval yet,We want help in preparing for our AGM',

        // Industrial
        'company_name' => 'required_if:type,industrial|nullable|string|max:255',
        'city' => 'required_if:type,industrial|nullable|string|max:255',
        'avg_bill' => 'required_if:type,industrial|nullable|string|max:255',
        ], [
        'whatsapp_number.regex' => 'Please enter a valid 10-digit mobile number starting with 6-9.',
        ]);


        $lead = new Lead();
        $lead->code = config('app.shortname').time();
        $lead->email=$request->email??'--';
        $lead->user_name = $request->name;
        $lead->phone = $request->whatsapp_number;
        $lead->zip_code = $request->pincode;
        $lead->country_id = $request->country;
        $lead->state_id = $request->state;
        $lead->company_name = $request->company_name;
        $lead->address = $request->city;
       $lead->source_description =
            "<p>Monthly Bill: {$request->bill}</p>" .
            "<p>Electricity Bill: {$request->electricity_bill}</p>" .
            "<p>House Name: {$request->house_name}</p>" .
            "<p>Approval Status: {$request->approval_status}</p>" .
            "<p>Average Bill: {$request->avg_bill}</p>";
        $lead->created_by=0;
         $lead->source ="Website";
        // dd($lead);
        $check = $lead->save();

        if($check) {
            return redirect()->route('data-form')->with('success', 'Lead created successfully.');
        } else {
            return redirect()->route('data-form')->with('error', 'Lead Not created.');
        }
   }

}
