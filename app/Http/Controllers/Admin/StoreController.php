<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    use UploadTrait;

    public function edit() {
        $store = tenant();
        return view('tenant.admin.store.edit', compact('store'));
    }

    public function store(Request $request) {

        $store = tenant();

        if($request->hasFile('logo')) {
            $lastLogo = $store->logo;
            if($lastLogo != null) {
                $storage = Storage::disk('public');
                if($storage->exists($lastLogo)) $storage->delete($lastLogo);
            }

            $logoPath = $this->imageUpload($request->file('logo'));
            $store->logo = $logoPath;
            $store->update();
        }

        session()->flash('success', 'Dados alterados com sucesso!');
        return redirect()->route('admin.dashboard');

    }
}
