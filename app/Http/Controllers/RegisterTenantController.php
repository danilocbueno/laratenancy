<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class RegisterTenantController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('tenant.register');
    }

    public function store(Request $request)
    {
        $tenant = Tenant::create($request->all());
        $tenant->createDomain(['domain' => $request->domain]);



    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
