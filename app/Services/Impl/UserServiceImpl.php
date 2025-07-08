<?php

namespace App\Services\Impl;

use App\Services\UserService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService

{
    public function all(){
        return User::included()->filter()->get();
    }
    public function show($id){
        return user::with(['requestts', 'company'])->find($id);
    }
     public function update($id, array $data){
        $user = User::find($id);
        if(!$user){
            return null;
        }

        $user->update($data);
        return $user;
    }

    public function delete($id){
        $user = User::find($id);
        if(!$user){
            return false;
        }
        $user->delete();
        return true;
    }

    public function create(array $data){
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

}
