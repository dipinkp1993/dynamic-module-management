<?php
use App\Models\Module;
use App\Models\ModuleField;
use App\Models\ModuleFieldValue;
function getModuleFields($module_name,$render_type)
{
    $moduleDetail=Module::where('module_name',$module_name)->first();
    if($moduleDetail==NULL)
    {
        return NULL;
    }
    if($render_type=='create')
    {
        return ModuleField::with('field')->where('module_id',$moduleDetail->module_id)->orderBy('form_priority','ASC')->where('is_in_form',1)->get();

    }
    return ModuleField::with('field')->where('module_id',$moduleDetail->module_id)->orderBy('table_priority','ASC')->where('is_in_table',1)->get();
    
}
function getModuleValues($module_name)
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
        
        $query = DB::table('module_field_values')->select('value_code');

        foreach ($moduleFieldIds as $moduleId) {
            $query->selectRaw("MAX(CASE WHEN module_field_id = $moduleId THEN module_field_value END) AS field_$moduleId");
        }

        $query->where('value_code', 'LIKE', $moduleDetail->module_code . '%')->groupBy('value_code');

        $distinctResults = $query->get();

       $array=$distinctResults->toArray();
    //    $normalArray = collect($array)->toArray();

       $valuesArray = collect($array)->map(function ($item) {
        return array_values((array)$item);
    })->toArray();
    
   return $valuesArray;

}
function randomCode()
{
    return once(function () {
        return random_int(1, 1000);
    });
}

