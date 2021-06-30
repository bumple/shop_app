<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $this->isPermission('admin');


        return view('admin.index');
    }
}
