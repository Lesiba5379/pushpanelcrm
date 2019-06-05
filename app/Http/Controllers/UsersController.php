<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\DataTables\UsersDataTablesEditor;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {        
        return $dataTable->render('home');
    }

    public function store(UsersDataTablesEditor $editor)
    {
        return $editor->process(request());
    }
}
