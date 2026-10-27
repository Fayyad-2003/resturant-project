<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of contact info cards.
     */
    public function index()
    {
        $contactInfos = ContactInfo::all();
        return view('admin.contact-info.index', compact('contactInfos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contactInfo = ContactInfo::findOrFail($id);
        return view('admin.contact-info.edit', compact('contactInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'info_1' => ['nullable', 'string', 'max:255'],
            'info_2' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        $contactInfo = ContactInfo::findOrFail($id);
        $contactInfo->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'info_1' => $request->info_1,
            'info_2' => $request->info_2,
            'status' => $request->status,
        ]);

        toastr()->success('Contact info card updated successfully!');
        return redirect()->route('admin.contact-info.index');
    }
}

