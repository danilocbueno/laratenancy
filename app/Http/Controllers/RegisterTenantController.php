<?php

namespace App\Http\Controllers;

use App\Enum\UserRoleEnum;
use App\Http\Requests\RegisterTenantRequest;
use App\Models\Tenant;
use Illuminate\Http\Request;

class RegisterTenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenant.index', compact('tenants'));

    }

    public function create()
    {
        return view('tenant.register');
    }

    public function store(RegisterTenantRequest $request)
    {
        //dd($request->validated());
        $tenant = Tenant::create($request->all());
        $tenant->createDomain(['domain' => $request->domain]);

        return redirect(tenant_route($tenant->domains->first()->domain, 'login'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = auth()->user();
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
