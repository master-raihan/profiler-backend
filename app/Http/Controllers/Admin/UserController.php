<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Contracts\Services\UserContract;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;

    }
    public function getAllUsers()
    {
        return $this->userService->getAllUsers();
    }

    public function createUser(Request $request)
    {
        return response()->json($this->userService->createUser($request));
    }

    public function editUser($id)
    {
        return $this->userService->editUser($id);
    }

    public function updateUser(Request $request)
    {
        if($this->userService->updateUser($request)){
            return response()->json('User Updated successfully!');
        }else{
            return response()->json('User not Updated!');
        }

    }

    public function deleteUser($id)
    {

         if($this->userService->deleteUser( (int) $id)){
             return response()->json('Deleted successfully!');
         }
         else{
             return response()->json('Error!');
         }

    }



}
