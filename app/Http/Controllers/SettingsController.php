<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    // to show settings 
    public function index()
    {
        $settingsData = Setting::all()->first();
        return view('backend.settings.settings', compact('settingsData'));
    }

    // update settings data 
    public function updateSettings(Request $request, $id)
    {
        // validation set
        $validatedData = $request->validate([
            'upload_max_filesize' => ['required', 'integer'],
        ]);

        $data['upload_max_filesize'] = $request->upload_max_filesize;

        $settingsData = DB::table('settings')->where('id', $id)->update($data);
        if ($settingsData) {
            $notification = array(
                'message' => 'Settings Update Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
