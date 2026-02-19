<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\WhatsappTemplate;
use App\Models\Configuration;
use App\Models\StaticContent;
use App\Models\Countrie;
use App\Models\Banner;
use App\Models\Module;
use App\Models\State;
use App\Models\Citie;
use App\Models\ClientReviews;
use App\Models\Role;

class MasterController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function appConfig()
    {
        $data = Configuration::whereIn('value_type', ['text','password','checkbox','dropdown','date','email','range','url','time','month','textarea','color'])->get();
        return view('admin.setting.app-config', compact('data'));
    }

    
    public function appConfigImage()
    {
        $data = Configuration::whereIn('value_type', ['file'])->get();
        return view('admin.setting.app-config', compact('data'));
    } 


    public function updateConfig(Request $request)
        $request->request->remove('_token');
        foreach ($request->all() as $key => $value) {

            $settingKey = str_replace('app_', 'app.', $key);

            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $fileName = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/config'), $fileName);
                Configuration::where('name', $settingKey)->update(['value' => $fileName]);
            } else {
                Configuration::where('name', $settingKey)->update(['value' => $value]);
            }
        }

        return back()->with(['success' => 'Configuration updated successfully.']);
    }



    // public function faqList(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $query = Faq::latest();

    //         if ($request->has('question') && !empty($request->question)) {
    //             $query->where('question', 'like', '%' . $request->question . '%');
    //         }

    //         if ($request->has('status') && !empty($request->status)) {
    //             $query->where('status', $request->status);
    //         }

    //         return DataTables::of($query)
    //             ->addIndexColumn()
    //             ->editColumn('status', function ($row) {
    //                 if ($row->status == 'Active') {
    //                     return '<span class="badge bg-success">' . $row->status . '</span>';
    //                 } elseif ($row->status == 'Inactive') {
    //                     return '<span class="badge bg-danger">' . $row->status . '</span>';
    //                 } else {
    //                     return '<span class="badge bg-secondary">' . $row->status . '</span>';
    //                 }
    //             })
    //             ->addColumn('action', function ($row) {
    //                 return '<div class="dropdown">
    //                         <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
    //                           <i class="icon-base ti tabler-dots-vertical"></i>
    //                         </button>
    //                         <div class="dropdown-menu">
    //                           <a class="dropdown-item" href="' . route('edit_faq', [$row->id]) . '"><i class="icon-base ti tabler-pencil me-1"></i> Edit</a>
    //                           <a class="dropdown-item" href="javascript:void(0);" onclick="deleteFaq(' . $row->id . ')"><i class="icon-base ti tabler-trash me-1"></i>Delete</a
    //                           >
    //                           <a class="dropdown-item" href="javascript:void(0);" onclick="changeFaq(' . $row->id . ')"><i class="icon-base ti tabler-progress-check me-1"></i>Change Status</a
    //                           >
    //                         </div>
    //                       </div>';
    //             })
    //             ->rawColumns(['status', 'action'])
    //             ->make(true);
    //     }

    //     return view('setting.faq.faq_list');
    // }



    public function staticContent(Request $request)
    {
        $data = StaticContent::withTrashed()->get();
        return view('admin.setting.static-content',compact('data'));
    }

    public function staticContentEdit($id, Request $request)
    {
        $data = StaticContent::withTrashed()->findOrFail($id);
<<<<<<< HEAD
        return view('admin.setting.static-content-edit',compact('data'));
    }
    
        return view('admin.setting.static-content-edit', compact('data'));
    }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $data->title = $request->title;
        $data->desc = $request->content;
        $check = $data->save();

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('static-content')->with(['success' => 'Content Update Successfully,']);
        } else {
                return redirect()->route('static-content')->with(['error' => 'Content Not Update.']);
        }
    }
    
=======
            return redirect()->route('static-content')->with(['success' => 'Content Update Successfully,']);
        } else {
            return redirect()->route('static-content')->with(['error' => 'Content Not Update.']);
        }
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function staticContentStatus($id, Request $request)
    {
        $data = StaticContent::withTrashed()->findOrFail($id);

        if ($data->trashed()) {
            $data->restore();
            $message = 'Content restored successfully!';
        } else {
            $data->delete();
            $message = 'Content deleted successfully!';
        }

        return redirect()->route('static-content')->with('success', $message);
    }
<<<<<<< HEAD
    



    
    public function roles(Request $request)
    {
        $data = Role::withTrashed()->get();
        return view('admin.master.role.list',compact('data'));
    }

    public function roleAdd(Request $request)
    {        
        return view('admin.master.role.add');
    }
    
=======





    public function roles(Request $request)
    {
        $data = Role::withTrashed()->get();
        return view('admin.master.role.list', compact('data'));
    }

    public function roleAdd(Request $request)
    {
        return view('admin.master.role.add');
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function roleStore(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:Employee,Manager,Admin',
            'name' => 'required|string|max:100|unique:roles,name',
            'order_by' => 'required|integer|min:1',
            'show' => 'required|string|in:Yes,No',
        ]);
<<<<<<< HEAD
            
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $check = Role::create([
            'type' => $request->type,
            'name' => $request->name,
            'order_by' => $request->order_by,
            'show' => $request->show
        ]);

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('roles')->with(['success'=> 'Role Added Successfully,']);
        } else {
                return redirect()->route('roles')->with(['error'=> 'Role Not Added.']);
        }
    }
    
    public function roleEdit($id, Request $request)
    {
        $data = Role::withTrashed()->findOrFail($id);
        return view('admin.master.role.edit',compact('data'));
    }
    
=======
            return redirect()->route('roles')->with(['success' => 'Role Added Successfully,']);
        } else {
            return redirect()->route('roles')->with(['error' => 'Role Not Added.']);
        }
    }

    public function roleEdit($id, Request $request)
    {
        $data = Role::withTrashed()->findOrFail($id);
        return view('admin.master.role.edit', compact('data'));
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function roleUpdate($id, Request $request)
    {
        $data = Role::withTrashed()->findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|string|in:Employee,Manager,Admin',
<<<<<<< HEAD
            'name' => 'required|string|max:100|unique:roles,name,'.$id,
=======
            'name' => 'required|string|max:100|unique:roles,name,' . $id,
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            'order_by' => 'required|integer|min:1',
            'show' => 'required|string|in:Yes,No',
        ]);

        $data->type = $request->type;
        $data->name = $request->name;
        $data->order_by = $request->order_by;
        $data->show = $request->show;
        $check = $data->save();

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('roles')->with(['success'=> 'Role Update Successfully,']);
        } else {
                return redirect()->route('roles')->with(['error'=> 'Role Not Update.']);
        }
    }
    
=======
            return redirect()->route('roles')->with(['success' => 'Role Update Successfully,']);
        } else {
            return redirect()->route('roles')->with(['error' => 'Role Not Update.']);
        }
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function roleDelete($id, Request $request)
    {
        $data = Role::withTrashed()->findOrFail($id);

        if ($data->trashed()) {
            $data->restore();
            $message = 'Role restored successfully!';
        } else {
            $data->delete();
            $message = 'Role deleted successfully!';
        }

        return redirect()->route('roles')->with('success', $message);
    }
<<<<<<< HEAD
   
     
    public function countries(Request $request)
    {
        $data = Countrie::withTrashed()->get();
        return view('admin.master.country.list',compact('data'));
=======


    public function countries(Request $request)
    {
        $data = Countrie::withTrashed()->get();
        return view('admin.master.country.list', compact('data'));
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    }

    public function countryAdd(Request $request)
    {
        return view('admin.master.country.add');
    }
<<<<<<< HEAD
    
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function countryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:countries,name',
            'iso2' => 'required|string|size:2|unique:countries,iso2',
            'iso3' => 'required|string|size:3|unique:countries,iso3',
            'phonecode' => 'required|numeric|unique:countries,phonecode',
            'capital' => 'required|string|max:255',
            'currency' => 'required|string|max:3',
            'currency_symbol' => 'required|string|max:5',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
<<<<<<< HEAD
            
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $check = Countrie::create([
            'name' => $request->name,
            'iso2' => $request->iso2,
            'iso3' => $request->iso3,
            'phonecode' => $request->phonecode,
            'capital' => $request->capital,
            'currency' => $request->currency,
            'currency_symbol' => $request->currency_symbol,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('countries')->with(['success'=> 'Country Added Successfully,']);
        } else {
                return redirect()->route('countries')->with(['error'=> 'Country Not Added.']);
        }
    }
    
    public function countryEdit($id, Request $request)
    {
        $data = Countrie::withTrashed()->findOrFail($id);
        return view('admin.master.country.edit',compact('data'));
    }
    
=======
            return redirect()->route('countries')->with(['success' => 'Country Added Successfully,']);
        } else {
            return redirect()->route('countries')->with(['error' => 'Country Not Added.']);
        }
    }

    public function countryEdit($id, Request $request)
    {
        $data = Countrie::withTrashed()->findOrFail($id);
        return view('admin.master.country.edit', compact('data'));
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function countryUpdate($id, Request $request)
    {
        $data = Countrie::withTrashed()->findOrFail($id);

        $request->validate([
<<<<<<< HEAD
            'name' => 'required|string|max:255|unique:countries,name,'.$id,
            'iso2' => 'required|string|size:2|unique:countries,iso2,'.$id,
            'iso3' => 'required|string|size:3|unique:countries,iso3,'.$id,
            'phonecode' => 'required|numeric|unique:countries,phonecode,'.$id,
=======
            'name' => 'required|string|max:255|unique:countries,name,' . $id,
            'iso2' => 'required|string|size:2|unique:countries,iso2,' . $id,
            'iso3' => 'required|string|size:3|unique:countries,iso3,' . $id,
            'phonecode' => 'required|numeric|unique:countries,phonecode,' . $id,
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            'capital' => 'required|string|max:255',
            'currency' => 'required|string|max:3',
            'currency_symbol' => 'required|string|max:5',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
<<<<<<< HEAD
            
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $data->name = $request->name;
        $data->iso2 = $request->iso2;
        $data->iso3 = $request->iso3;
        $data->phonecode = $request->phonecode;
        $data->capital = $request->capital;
        $data->currency = $request->currency;
        $data->currency_symbol = $request->currency_symbol;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $check = $data->save();

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('countries')->with(['success'=> 'Country Update Successfully,']);
        } else {
                return redirect()->route('countries')->with(['error'=> 'Country Not Update.']);
        }
    }
    
=======
            return redirect()->route('countries')->with(['success' => 'Country Update Successfully,']);
        } else {
            return redirect()->route('countries')->with(['error' => 'Country Not Update.']);
        }
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function countryDelete($id, Request $request)
    {
        $data = Countrie::withTrashed()->findOrFail($id);

        if ($data->trashed()) {
            $data->restore();
            $message = 'Country restored successfully!';
        } else {
            $data->delete();
            $message = 'Country deleted successfully!';
        }

        return redirect()->route('countries')->with('success', $message);
    }


    public function states(Request $request)
    {
        $countrie = Countrie::withTrashed()->orderBy('name', 'asc')->get();
<<<<<<< HEAD
        
        if(empty($request->country_id)) {
=======

        if (empty($request->country_id)) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            // $request->merge(['country_id' => $countrie[0]->id??'0']);
            $request->merge(['country_id' => '101']);
        }

        $data = State::with('country')->where('country_id', $request->country_id)->withTrashed()->get();
<<<<<<< HEAD
        return view('admin.master.state.list',compact('data','countrie'));
=======
        return view('admin.master.state.list', compact('data', 'countrie'));
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    }

    public function stateAdd(Request $request)
    {
        $countrie = Countrie::withTrashed()->get();
<<<<<<< HEAD
        return view('admin.master.state.add',compact('countrie'));
    }
    
=======
        return view('admin.master.state.add', compact('countrie'));
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function stateStore(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('states')->where(function ($query) use ($request) {
                    return $query->where('country_id', $request->country_id);
                }),
            ],
            'iso2' => [
                'required',
                'string',
                'size:3',
                Rule::unique('states')->where(function ($query) use ($request) {
                    return $query->where('country_id', $request->country_id);
                }),
            ],
            'country_id' => 'required|integer|exists:countries,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
<<<<<<< HEAD
            
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $check = State::create([
            'name' => $request->name,
            'iso2' => $request->iso2,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('states')->with(['success'=> 'State Added Successfully,']);
        } else {
                return redirect()->route('states')->with(['error'=> 'State Not Added.']);
        }
    }
    
=======
            return redirect()->route('states')->with(['success' => 'State Added Successfully,']);
        } else {
            return redirect()->route('states')->with(['error' => 'State Not Added.']);
        }
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function stateEdit($id, Request $request)
    {
        $data = State::withTrashed()->findOrFail($id);
        $countrie = Countrie::withTrashed()->get();
<<<<<<< HEAD
        return view('admin.master.state.edit',compact('data','countrie'));
    }
    
=======
        return view('admin.master.state.edit', compact('data', 'countrie'));
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function stateUpdate($id, Request $request)
    {
        $data = State::withTrashed()->findOrFail($id);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('states')->where(function ($query) use ($request) {
                    return $query->where('country_id', $request->country_id);
                })->ignore($id),
            ],

            'iso2' => [
                'required',
                'string',
                'size:3',
                Rule::unique('states')->where(function ($query) use ($request) {
                    return $query->where('country_id', $request->country_id);
                })->ignore($id),
            ],
            'country_id' => 'required|integer|exists:countries,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);
<<<<<<< HEAD
            
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $data->name = $request->name;
        $data->iso2 = $request->iso2;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $check = $data->save();

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('states')->with(['success'=> 'State Update Successfully,']);
        } else {
                return redirect()->route('states')->with(['error'=> 'State Not Update.']);
        }
    }
    
=======
            return redirect()->route('states')->with(['success' => 'State Update Successfully,']);
        } else {
            return redirect()->route('states')->with(['error' => 'State Not Update.']);
        }
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function stateDelete($id, Request $request)
    {
        $data = State::withTrashed()->findOrFail($id);

        if ($data->trashed()) {
            $data->restore();
            $message = 'State restored successfully!';
        } else {
            $data->delete();
            $message = 'State deleted successfully!';
        }

        return redirect()->route('states')->with('success', $message);
    }



<<<<<<< HEAD
    
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514

    public function cities(Request $request)
    {
        $countrie = Countrie::withTrashed()->orderBy('name', 'asc')->get();
<<<<<<< HEAD
        
        if(empty($request->country_id)) {
=======

        if (empty($request->country_id)) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            // $request->merge(['country_id' => $countrie[0]->id??'0']);
            $request->merge(['country_id' => '101']);
        }

        $states = State::where('country_id', $request->country_id)->withTrashed()->orderBy('name', 'asc')->get();
<<<<<<< HEAD
     
        if(empty($request->state_id)) {
            $request->merge(['state_id' => $states[0]->id??'0']);
        }

        $data = Citie::with('country','state')->where(['country_id' => $request->country_id,'state_id' => $request->state_id])->withTrashed()->get();

        return view('admin.master.city.list', compact('data','countrie','states'));
=======

        if (empty($request->state_id)) {
            $request->merge(['state_id' => $states[0]->id ?? '0']);
        }

        $data = Citie::with('country', 'state')->where(['country_id' => $request->country_id, 'state_id' => $request->state_id])->withTrashed()->get();

        return view('admin.master.city.list', compact('data', 'countrie', 'states'));
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    }

    public function cityAdd(Request $request)
    {
        $countrie = Countrie::withTrashed()->orderBy('name', 'asc')->get();
        return view('admin.master.city.add', compact('countrie'));
    }
<<<<<<< HEAD
    
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function cityStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'country_id' => 'required|integer|exists:countries,id',
            'state_id' => 'required|integer|exists:states,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);
<<<<<<< HEAD
  
        
=======


>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $check = Citie::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('cities')->with(['success'=> 'City Added Successfully,']);
        } else {
                return redirect()->route('cities')->with(['error'=> 'City Not Added.']);
        }
    }
    
=======
            return redirect()->route('cities')->with(['success' => 'City Added Successfully,']);
        } else {
            return redirect()->route('cities')->with(['error' => 'City Not Added.']);
        }
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function cityEdit($id, Request $request)
    {
        $data = Citie::withTrashed()->findOrFail($id);
        $countrie = Countrie::withTrashed()->orderBy('name', 'asc')->get();
        $states = State::where('country_id', $data->country_id)->withTrashed()->orderBy('name', 'asc')->get();
<<<<<<< HEAD
        return view('admin.master.city.edit',compact('data','countrie','states'));
=======
        return view('admin.master.city.edit', compact('data', 'countrie', 'states'));
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    }

    public function cityUpdate($id, Request $request)
    {
        $data = Citie::withTrashed()->findOrFail($id);

        $request->validate([
<<<<<<< HEAD
            'name' => 'required|string|max:255|unique:cities,name,'.$id,
=======
            'name' => 'required|string|max:255|unique:cities,name,' . $id,
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            'country_id' => 'required|integer|exists:countries,id',
            'state_id' => 'required|integer|exists:states,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);
<<<<<<< HEAD
            
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $data->name = $request->name;
        $data->country_id = $request->country_id;
        $data->state_id = $request->state_id;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $check = $data->save();

        if ($check) {
<<<<<<< HEAD
                return redirect()->route('cities')->with(['success'=> 'City Update Successfully,']);
        } else {
                return redirect()->route('cities')->with(['error'=> 'City Not Update.']);
        }
    }
    
=======
            return redirect()->route('cities')->with(['success' => 'City Update Successfully,']);
        } else {
            return redirect()->route('cities')->with(['error' => 'City Not Update.']);
        }
    }

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
    public function cityDelete($id, Request $request)
    {
        $data = Citie::withTrashed()->findOrFail($id);

        if ($data->trashed()) {
            $data->restore();
            $message = 'City restored successfully!';
        } else {
            $data->delete();
            $message = 'City deleted successfully!';
        }

        return redirect()->route('cities')->with('success', $message);
    }



    public function acm(Request $request)
    {
        $role_id = $request->role_id;

        $roles = Role::where('show', 'Yes')->get();

<<<<<<< HEAD
        if(empty($role_id)) {
=======
        if (empty($role_id)) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            $role_id = $roles[0]->id;
        }

        $role = Role::where('id', $role_id)->first();
<<<<<<< HEAD
        
        $modules = Module::orderBy('parent_id')
            ->whereRaw('FIND_IN_SET(?, module_for)', [$role->type])
            ->orderBy('order', 'asc')     
=======

        $modules = Module::orderBy('parent_id')
            ->whereRaw('FIND_IN_SET(?, module_for)', [$role->type])
            ->orderBy('order', 'asc')
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            ->get()
            ->groupBy('parent_id');

        $data = ($modules[null] ?? collect())->map(function ($parent) use ($modules) {
            $parent->sub_modules = $modules[$parent->id] ?? collect();
            return $parent;
        });
<<<<<<< HEAD
        
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        return view('admin.master.acm.list', compact('data', 'roles', 'role', 'role_id'));
    }

    public function acmSave(Request $request)
    {
        $menu = Module::find($request->module_id);
        $type = 'role_id_' . $request->permission_type;

        // Convert existing comma-separated string into array
        $existingUsers = $menu->$type ? explode(',', $menu->$type) : [];

        $status = '';
        $message = '';


        if ($request->isChecked == 'true') {
            // Add user if not already present
            if (!in_array($request->role_id, $existingUsers)) {
                $existingUsers[] = $request->role_id;
            }

            $status = 'success';
            $message = 'Menu Assigned';
        } else {
            // Remove user when unchecked
            $existingUsers = array_diff($existingUsers, [$request->role_id]);

            $status = 'error';
            $message = 'Menu Unassigned';
        }

        // Convert back to comma-separated string
        $menu->$type = implode(',', $existingUsers);
<<<<<<< HEAD
        if($request->permission_type == 'add') {
            $menu->role_id_store = implode(',', $existingUsers);   
        }
        if($request->permission_type == 'update') {
            $menu->role_id_edit = implode(',', $existingUsers);   
=======
        if ($request->permission_type == 'add') {
            $menu->role_id_store = implode(',', $existingUsers);
        }
        if ($request->permission_type == 'update') {
            $menu->role_id_edit = implode(',', $existingUsers);
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        }

        $menu->save();

<<<<<<< HEAD
        return response()->json([$status=> $message]);
    }

 
=======
        return response()->json([$status => $message]);
    }


>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514

    public function whatsappTemplate()
    {
        $data = WhatsappTemplate::withTrashed()->latest()->get();
        return view('admin.master.whatsapp_template.list', compact('data'));
    }

    public function whatsappTemplateAdd()
    {
        return view('admin.master.whatsapp_template.add');
    }

    public function whatsappTemplateStore(Request $request)
    {
        $slug = Str::slug($request->template_name);

        $request->validate([
            'template_name' => 'required|unique:whatsapp_templates,template_name',
            'language' => 'required|min:2|max:10',
            'mappings' => 'required|array',
            'mappings.*.api_key' => 'required',
            'mappings.*.data_key' => 'required',
        ]);
<<<<<<< HEAD
        
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        // Transform the form array: 
        // From: [['api_key' => 'field_1', 'data_key' => 'name'], ...]
        // To:   ['field_1' => 'name', ...]
        $formattedMapping = [];
        foreach ($request->mappings as $map) {
            $formattedMapping[$map['api_key']] = $map['data_key'];
        }

        $check = WhatsappTemplate::create([
            'slug' => $slug,
            'template_name' => $request->template_name,
            'language' => $request->language,
            'variable_mapping' => $formattedMapping,
        ]);

<<<<<<< HEAD
        if($check){
=======
        if ($check) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            return redirect()->route('whatsapp-templates')->with('success', 'Template created successfully.');
        } else {
            return redirect()->route('whatsapp-templates')->with('error', 'Template not created.');
        }
    }

    public function whatsappTemplateEdit($id)
    {
        $whatsappTemplate = WhatsappTemplate::findOrFail($id);

        return view('admin.master.whatsapp_template.edit', compact('whatsappTemplate'));
    }

    public function whatsappTemplateUpdate($id, Request $request)
    {
        $whatsappTemplate = WhatsappTemplate::findOrFail($id);
        $slug = Str::slug($request->template_name);
<<<<<<< HEAD
        
=======

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $request->validate([
            'template_name' => 'required|unique:whatsapp_templates,template_name,' . $whatsappTemplate->id,
            'language' => 'required|min:2|max:10',
            'mappings' => 'required|array',
            'mappings.*.api_key' => 'required',
            'mappings.*.data_key' => 'required',
        ]);

        $formattedMapping = [];
<<<<<<< HEAD
        if($request->has('mappings')) {
            foreach ($request->mappings as $map) {
                if(!empty($map['api_key']) && !empty($map['data_key'])) {
=======
        if ($request->has('mappings')) {
            foreach ($request->mappings as $map) {
                if (!empty($map['api_key']) && !empty($map['data_key'])) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
                    $formattedMapping[$map['api_key']] = $map['data_key'];
                }
            }
        }

        $check = $whatsappTemplate->update([
            'slug' => $slug,
            'template_name' => $request->template_name,
            'language' => $request->language,
            'variable_mapping' => $formattedMapping,
        ]);

<<<<<<< HEAD
        
        if($check){
=======

        if ($check) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            return redirect()->route('whatsapp-templates')->with('success', 'Template updated successfully.');
        } else {
            return redirect()->route('whatsapp-templates')->with('error', 'Template not updated.');
        }
    }

    public function whatsappTemplateDelete($id)
    {
        $data = WhatsappTemplate::withTrashed()->findOrFail($id);

        if ($data->trashed()) {
            $data->restore();
            $message = 'Template restored successfully!';
        } else {
            $data->delete();
            $message = 'Template deleted successfully!';
        }

        return redirect()->route('whatsapp-templates')->with('success', $message);
<<<<<<< HEAD

    }

    
    public function bannerAdd(Request $request)
    {        
=======
    }


    public function bannerAdd(Request $request)
    {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        return view('admin.master.banner.add');
    }


<<<<<<< HEAD
    public function banners(){
        $data = Banner::withTrashed()->get();
        return view('admin.master.banner.list',compact('data'));
    }


    public function bannerStore(Request $request){
        
        $request->validate([
           'for'=>'required|string|in:Android,Website,Both',
            'type' => 'required|in:Home Abaut Consalt,Home Offer Banner,Home Offer Zone Banner,Home Our Testimonials,Home Slider,Footer Product Banner,Header Banner,Offer Brand Image,Other',
            'name'=>'required|string|max:255',
            'title'=>'nullable|string|max:255',
            'url'=>'required_if:file_type,url|max:255',
            'image'=>'required_if:file_type,image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'=>'required|in:Active,Inactive',
            'file_type'=>'required|in:image,url',
            'description'=>'nullable|string',
=======
    public function banners()
    {
        $data = Banner::withTrashed()->get();
        return view('admin.master.banner.list', compact('data'));
    }


    public function bannerStore(Request $request)
    {

        $request->validate([
            'for' => 'required|string|in:Android,Website,Both',
            'type' => 'required|in:Home Abaut Consalt,Home Offer Banner,Home Offer Zone Banner,Home Our Testimonials,Home Slider,Footer Product Banner,Header Banner,Offer Brand Image,Other',
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'url' => 'required_if:file_type,url|max:255',
            'image' => 'required_if:file_type,image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:Active,Inactive',
            'file_type' => 'required|in:image,url',
            'description' => 'nullable|string',
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        ]);

        $banner = new Banner();
        $banner->for = $request->for;
        $banner->type = $request->type;
<<<<<<< HEAD
        $banner->name = $request->name;         
=======
        $banner->name = $request->name;
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $banner->title = $request->title;
        $banner->status = $request->status;
        $banner->desc = $request->description;
        $banner->file_type = $request->file_type;

<<<<<<< HEAD
        if($request->file_type=='image') {
=======
        if ($request->file_type == 'image') {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/banner'), $fileName);
                $banner->image = $fileName;
                $banner->url = null;
            }
        } else {
            $banner->image = null;
            $banner->url = $request->url;
        }

        $check = $banner->save();

<<<<<<< HEAD
        if($check) {
=======
        if ($check) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            return redirect()->route('banners')->with('success', 'Banner created successfully.');
        } else {
            return redirect()->route('banners')->with('error', 'Banner Not created.');
        }
    }

<<<<<<< HEAD
    public function bannerEdit($id){
        $data = Banner::withTrashed()->findOrFail($id);
        return view('admin.master.banner.edit',compact('data'));
    }

    public function bannerUpdate($id, Request $request){
      
        $request->validate([
           'for'=>'required|string|in:Android,Website,Both',
            'type' => 'required|in:Home Abaut Consalt,Home Offer Banner,Home Offer Zone Banner,Home Our Testimonials,Home Slider,Footer Product Banner,Header Banner,Offer Brand Image,Other',
            'name'=>'required|string|max:255',
            'title'=>'nullable|string|max:255',
            'url'=>'required_if:file_type,url|max:255',
            'image'=>'required_if:file_type,image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'status'=>'required|in:Active,Inactive',
             'file_type'=>'required|in:image,url',
            'description'=>'nullable|string',
=======
    public function bannerEdit($id)
    {
        $data = Banner::withTrashed()->findOrFail($id);
        return view('admin.master.banner.edit', compact('data'));
    }

    public function bannerUpdate($id, Request $request)
    {

        $request->validate([
            'for' => 'required|string|in:Android,Website,Both',
            'type' => 'required|in:Home Abaut Consalt,Home Offer Banner,Home Offer Zone Banner,Home Our Testimonials,Home Slider,Footer Product Banner,Header Banner,Offer Brand Image,Other',
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'url' => 'required_if:file_type,url|max:255',
            'image' => 'required_if:file_type,image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:Active,Inactive',
            'file_type' => 'required|in:image,url',
            'description' => 'nullable|string',
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        ]);


        $data = Banner::withTrashed()->findOrFail($id);
<<<<<<< HEAD
        
        $data->for = $request->for;
        $data->type = $request->type;
        $data->name = $request->name;         
=======

        $data->for = $request->for;
        $data->type = $request->type;
        $data->name = $request->name;
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $data->title = $request->title;
        $data->status = $request->status;
        $data->desc = $request->description;
        $data->file_type = $request->file_type;

<<<<<<< HEAD
        if($request->file_type=='image') {
            if ($request->hasFile('image')) {

                if ($data->image && file_exists(public_path('images/banner/'.$data->image))) {
                    unlink(public_path('images/banner/'.$data->image));
=======
        if ($request->file_type == 'image') {
            if ($request->hasFile('image')) {

                if ($data->image && file_exists(public_path('images/banner/' . $data->image))) {
                    unlink(public_path('images/banner/' . $data->image));
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
                }
                $file = $request->file('image');
                $fileName = 'banner_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/banner'), $fileName);
                $data->image = $fileName;
                $data->url = null;
            }
        } else {
<<<<<<< HEAD
            if($data->image && file_exists(public_path('images/banner/'.$data->image))) {
                unlink(public_path('images/banner/'.$data->image));
=======
            if ($data->image && file_exists(public_path('images/banner/' . $data->image))) {
                unlink(public_path('images/banner/' . $data->image));
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            }
            $data->image = null;
            $data->url = $request->url;
        }

        $check = $data->save();

<<<<<<< HEAD
        if($check) {
=======
        if ($check) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            return redirect()->route('banners')->with('success', 'Banner updated successfully.');
        } else {
            return redirect()->route('banners')->with('error', 'Banner Not updated.');
        }
    }


<<<<<<< HEAD
    public function bannerDelete($id){
=======
    public function bannerDelete($id)
    {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $data = Banner::withTrashed()->findOrFail($id);

        if ($data->trashed()) {
            $data->restore();
            $message = 'Banner restored successfully!';
        } else {
            $data->delete();
            $message = 'Banner deleted successfully!';
        }

        return redirect()->route('banners')->with('success', $message);
    }
<<<<<<< HEAD
    
    public function reviewAdd(){
        
        return view('admin.order.client_review.add');
    }
    
    public function clientReviews(){
        $data = ClientReviews::withTrashed()->get();
        return view('admin.order.client_review.list',compact('data'));
    }
    
    public function reviewStore(Request $request){
        
        $request->validate([
         'title'=>'required|string|max:255',
         'url'=>'required|url|max:255',
         'content'=>'nullable|string',
        ]);

        $reveiew=new ClientReviews();
        $reveiew->title=$request->title;
        $reveiew->url=$request->url;
        $reveiew->description=$request->content;
        $check = $reveiew->save();

        if($check) {
=======

    public function reviewAdd()
    {

        return view('admin.order.client_review.add');
    }

    public function clientReviews()
    {
        $data = ClientReviews::withTrashed()->get();
        return view('admin.order.client_review.list', compact('data'));
    }

    public function reviewStore(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'content' => 'nullable|string',
        ]);

        $reveiew = new ClientReviews();
        $reveiew->title = $request->title;
        $reveiew->url = $request->url;
        $reveiew->description = $request->content;
        $check = $reveiew->save();

        if ($check) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            return redirect()->route('client-reviews')->with('success', 'Review created successfully.');
        } else {
            return redirect()->route('client-reviews')->with('error', 'Review Not created.');
        }
    }

<<<<<<< HEAD
    public function reviewEdit($id){
        $data=ClientReviews::withTrashed()->findOrFail($id);
        return view('admin.order.client_review.edit',compact('data'));
    }

    public function reviewUpdate($id, Request $request){
        
        $request->validate([
         'title'=>'required|string|max:255',
         'url'=>'required|url|max:255',
         'content'=>'nullable|string',
        ]);

        $data=ClientReviews::withTrashed()->findOrFail($id);
        $data->title=$request->title;
        $data->url=$request->url;
        $data->description=$request->content;
        $check = $data->save();

        if($check) {
=======
    public function reviewEdit($id)
    {
        $data = ClientReviews::withTrashed()->findOrFail($id);
        return view('admin.order.client_review.edit', compact('data'));
    }

    public function reviewUpdate($id, Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'content' => 'nullable|string',
        ]);

        $data = ClientReviews::withTrashed()->findOrFail($id);
        $data->title = $request->title;
        $data->url = $request->url;
        $data->description = $request->content;
        $check = $data->save();

        if ($check) {
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
            return redirect()->route('client-reviews')->with('success', 'Review updated successfully.');
        } else {
            return redirect()->route('client-reviews')->with('error', 'Review Not updated.');
        }
    }

<<<<<<< HEAD
    public function reviewDelete($id){
        $data = ClientReviews::withTrashed()->findOrFail($id);  
=======
    public function reviewDelete($id)
    {
        $data = ClientReviews::withTrashed()->findOrFail($id);
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        if ($data->trashed()) {
            $data->restore();
            $message = 'Review restored successfully!';
        } else {
            $data->delete();
            $message = 'Review deleted successfully!';
        }
        return redirect()->route('client-reviews')->with('success', $message);
    }
<<<<<<< HEAD
=======
    public function department_index()
    {
        $department = Department::latest()->get();
        return view('admin.master.department.list', compact('department'));
    }

    public function department_add()
    {
        return view('admin.master.department.add');
    }

    public function departmentstore(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Department::create([
            'name' => $request->name,
            'slug' => $request->name,
        ]);

        return redirect()->route('department.index')
            ->with('success', 'Department created successfully');
    }

    public function departmentedit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.master.department.edit', compact('department'));
    }

    public function departmentupdate(Request $request, $id)

    {
        $request->merge(['slug' => Str::slug($request->name)]);
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $item = Department::findOrFail($id);
        $item->update([
            'name' => $request->name,
            'slug' => $request->name,
        ]);

        return redirect()->route('department.index')
            ->with('success', 'Department updated successfully');
    }

    public function departmentdestroy($id)
    {
        $item = Department::findOrFail($id);
        $item->delete();

        return redirect()->route('department.index')
            ->with('success', 'Department deleted successfully');
    }
}
