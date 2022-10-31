<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Admin Profile Direct
    public function adminProfile()
    {
        $id  = Auth::user()->id;
        $userInfo = User::select('id','name','email','phone','address','gender')->where('id',$id)->first();
        return view('admin.profile.index',compact('userInfo'));
    }

    // Admin Update Profile
    public function adminProfileUpdate(Request $request)
    {
        $this->adminProfileValidation($request);
        $data  = $this->getProfileData($request);
        User::where('id',Auth::user()->id)->update($data);
        return redirect()->route('dashboard')->with(['updateAdminProfileSuccess' => 'စီမံခန့်ခွဲသူအကောင့်ကို အပ်ဒိတ်လုပ်ပြီးပါပြီ။']);
    }

    // Admin Password Change Page
    public function adminPasswordChangePage()
    {
        return view('admin.profile.changePassword');
    }

    public function adminPasswordChange(Request $request)
    {
        $this->adminChangePasswordValidation($request);
        $id = Auth::user()->id;
        $dbPassword = User::where('id',$id)->first();
        $dbPassword = $dbPassword->password;
        if(Hash::check($request->oldPassword, $dbPassword )){
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id',$id)->update($data);
            return redirect()->route('admin#changepasswordpage')->with(['updatePasswordSuccess'=>'admin စကားဝှက်ကို ပြောင်းပြီးပါပြီ။']);
        }
    }


    // Admin Profile Data
    private function getProfileData($request)
    {
        $response = [
            "name" => $request->adminName,
            "email" => $request->adminEmail,
            "phone" => $request->adminPhone,
            "address" => $request->adminAddress,
            "gender" => $request->adminGender,
        ];
        return $response;
    }

    // Admin Profile Validation
    private function adminProfileValidation($request)
    {
        $dataValidation = [
            'adminName' => 'required',
            'adminEmail' => 'required'
        ];
        Validator::make($request->all(),$dataValidation)->validate();
    }

    // Admin Change Password Validation
    private function adminChangePasswordValidation($request)
    {
        $dataValidation = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ];
        Validator::make($request->all(),$dataValidation)->validate();
    }
}
