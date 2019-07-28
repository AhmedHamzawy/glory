<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Setting;
use App\Http\Resources\Setting as SettingResource;

class SettingsController extends Controller
{

    public function index()
    {   
        $settings = Setting::findOrFail(1);
        return new SettingResource($settings);
    }

    public function store(Request $request)
    {
        $settings =  Setting::findOrFail($request->timetable_id);

        $settings->name = $request->get('name');
        $settings->address = $request->get('address');
        $settings->town = $request->get('town');
        $settings->county = $request->get('county');
        $settings->post_code = $request->get('post_code');
        $settings->country = $request->get('country');
        $settings->telephone = $request->get('telephone');
        $settings->email = $request->get('email');
        $settings->website = $request->get('website');
        $settings->facebook = $request->get('facebook');
        $settings->twitter = $request->get('twitter');
        $settings->instagram = $request->get('instagram');
        $settings->youtube = $request->get('youtube');

        if($settings->save()){ return new SettingResource($setting); }
    }
}
