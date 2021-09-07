<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Role;


class ApiController extends Controller
{
    public function roles() {
        return Role::where('name', '!=', 'Admin')->get();
    }
}
