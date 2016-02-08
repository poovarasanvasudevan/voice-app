<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Group;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //

    public function createUser($name, $email, $password)
    {

        $sucess = array();
        $sucess['status'] = 1;
        $sucess['desc'] = 'User Created Succesfully..';


        $failure = array();
        $failure['status'] = 0;
        $failure['desc'] = 'Failed to create user..';

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;

        if ($user->save()) {
            return response()->json($sucess);
        } else {
            return response()->json($failure);
        }
    }

    public function login($email, $password)
    {
        $user = DB::table('users')->where('email', $email)->where('password', $password)->get();

        $sucess = array();
        $sucess['status'] = 1;

        $failure = array();
        $failure['status'] = 0;
        $failure['desc'] = 'invalid Login..';


        if (sizeof($user) == 1) {
            $sucess['result'] = array(['id' => $user[0]->id, 'email' => $user[0]->email]);

            return response()->json($sucess);
        } else {
            return response()->json($failure);
        }
    }

    public function createGroup($userid, $groupName)
    {
        $user = User::find($userid);

        $group = new Group();
        $group->name = $groupName;
        $group->user()->associate($user);


        $sucess = array();
        $sucess['status'] = 1;
        $sucess['desc'] = "group succesfully created...";


        $failure = array();
        $failure['status'] = 0;
        $failure['desc'] = 'failed to create group..';
        if ($group->save()) {
            return response()->json($sucess);
        } else {
            return response()->json($failure);
        }
    }

    public function listGroup($userid)
    {

        $user = User::find($userid);

        $sucess = array();
        $sucess['status'] = 1;


        $failure = array();
        $failure['status'] = 0;
        $failure['desc'] = 'No Groups found..';


        if (sizeof($user) > 0) {
            $sucess['result'] = $user->groups;
            return response()->json($sucess);
        } else {
            return response()->json($failure);
        }
    }

    public function createContact($groupid,$name,$number)
    {
        $group = Group::find($groupid);

        $contact = new Contact();
        $contact->name = $name;
        $contact->number = $number;
        $contact->group()->associate($group);

        $sucess = array();
        $sucess['status'] = 1;
        $sucess['desc'] = "Contact succesfully created...";


        $failure = array();
        $failure['status'] = 0;
        $failure['desc'] = 'failed to create Contact..';
        if ($contact->save()) {
            return response()->json($sucess);
        } else {
            return response()->json($failure);
        }
    }

    public function listContact($groupid)
    {

        $group = Group::find($groupid);

        $sucess = array();
        $sucess['status'] = 1;


        $failure = array();
        $failure['status'] = 0;
        $failure['desc'] = 'No Groups found..';


        if (sizeof($group) > 0) {
            $sucess['result'] = $group->contacts;
            return response()->json($sucess);
        } else {
            return response()->json($failure);
        }
    }
}
