<?php

namespace App\Actions\Fortify;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Image;
use File;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $request = request();

        Validator::make($input, [
            'avatar'=>['mimes:jpg,jpeg,png,bmp,tiff'],
            'name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'patronymic' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'patronymic'=>$input['patronymic'],
            'password' => Hash::make($input['password']),
        ]);
        $user->assignRole('patient');

        if($request->file('avatar')){
            $avatar = $request->file('avatar');
            $filename = 'avatar.'.$avatar->getClientOriginalExtension();
            $save_path = storage_path('app/public/avatar/users/id/'.$user->id.'/');
            $path = $save_path.$filename;
            File::makeDirectory($save_path, $mode = 0755, true, true);
            Image::make($avatar)->resize(300, 300)->save($path);
            $public_path = '/storage/avatar/users/id/'.$user->id.'/'.$filename;
        }else{
            $public_path = null;
        }

        $member = new Member([
            'phone'=>$input['phone'],
            'male'=>$input['male'],
            'address'=>$input['address'],
            'city'=>$input['city'],
            'DOB'=>$input['DOB'],
            'weight'=>$input['weight'],
            'rise'=>$input['rise'],
            'avatar'=>$public_path,
        ]);
        $user->members()->save($member);

        return $user;
    }
}
