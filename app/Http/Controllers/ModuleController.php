<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Module;
use App\Models\ModuleField;
use App\Models\ModuleFieldValue;

class ModuleController extends Controller
{
    public function index($module_name)
    {
        $moduleDetail = Module::where('module_name', $module_name)->first();

        if (!$moduleDetail) {
            abort(404);
        }

        $fields = getModuleFields($module_name, 'list');

        if (!$fields) {
            abort(404);
        }

        $moduleFieldIds = $fields->pluck('id')->toArray();
        
        $query = DB::table($module_name)->select('value_code');

        foreach ($moduleFieldIds as $moduleId) {
            $query->selectRaw("MAX(CASE WHEN module_field_id = $moduleId THEN module_field_value END) AS field_$moduleId");
        }

        $query->where('value_code', 'LIKE', $moduleDetail->module_code . '%')->groupBy('value_code');

        $distinctResults = $query->get();
        $distinctResults = $distinctResults->reverse();

        // Paginate the distinct results
        $perPage = 5; // You can adjust the number of items per page
        $currentPage = request()->query('page', 1);
        $pagedResults = new \Illuminate\Pagination\LengthAwarePaginator(
        $distinctResults->forPage($currentPage, $perPage),
        $distinctResults->count(),
        $perPage,
        $currentPage,
        ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('module_elements.list', compact('module_name', 'fields', 'pagedResults'));
    }

    public function create(Request $request,$module_name)
    {
        $fields = getModuleFields($module_name,'create');
        if(!$fields)
        {
            abort(404);
        }
        
        return view('module_elements.create',['module_name'=>$module_name,'fields'=>$fields]);
    }
    public function store(Request $request,$module_name)
    {
        $moduleDetail=Module::where('module_name',$module_name)->first();
        if(!$moduleDetail){
            abort(404);
        }
        
        $productDetails = [];
        foreach ($request->all() as $key=>$value) {

            $module_field=ModuleField::where('module_id',$moduleDetail->module_id)->where('name',$key)->first();
            if(!$module_field)
            {
                continue;
            }
            $entityData[] = [
                'module_field_id' => $module_field->id,
                'module_field_value' => $value,
                'value_code'=>$moduleDetail->module_code.randomCode()
            ];
        }
        DB::table($module_name)->insert($entityData);

        return redirect()->route('module.list',$module_name);

        
    }
    public function edit($module_name, $value_code)
    {
        $moduleDetail = Module::where('module_name', $module_name)->firstOrFail();
    
        $fields = getModuleFields($module_name, 'create');
    
        $entity = DB::table($module_name)
            ->where('value_code', $value_code)
            ->get();
    
        if ($entity->isEmpty()) {
            abort(404);
        }
    
        return view('module_elements.edit', compact('module_name', 'fields', 'entity'));
    }
    public function update(Request $request, $module_name, $value_code)
    {
        $moduleDetail = Module::where('module_name', $module_name)->firstOrFail();

        foreach ($request->all() as $key => $value) {
            $module_field = ModuleField::where('module_id', $moduleDetail->module_id)->where('name', $key)->first();
            if (!$module_field) {
                continue;
            }
            DB::table($module_name)
                ->updateOrInsert(
                    ['value_code' => $value_code, 'module_field_id' => $module_field->id],
                    ['module_field_value' => $value]
                );
            
        }

        return redirect()->route('module.list',$module_name);
    }

    
    
}
