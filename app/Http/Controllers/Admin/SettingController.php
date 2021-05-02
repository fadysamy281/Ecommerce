<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class SettingController extends Controller
{

    public function index()
    {
        $this->setPageTitle('Settings', 'Manage Settings');
        return view('admin.settings.index');
    }
    public function handleImage($request,$image_type,$s='_'){
        if($request->has($image_type))
        { $settingValue = Setting::getSetting($image_type);
            if($settingValue != null)
            return $this->updateFile($request->image_type,
            SETTINGS_PATH,$settingValue,$s);
        else return $this->uploadFile($request->image_type,
        SETTINGS_PATH,$s);}
        else return ;
    }
    public function update(Request $request){
        $request->site_logo=handleImage($request,'site_logo',$s='_1_');
        $request->site_favicon=handleImage($request,'site_favicon',$s='_2_');
        $keys = $request->except('_token');
        foreach($keys as $key => $value)
        {
            Setting::setSetting($key,$value);
        }
        return $this->responseRedirectBack('Settings updated successfully.', 'success');
    }

}
