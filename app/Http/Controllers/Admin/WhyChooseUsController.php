<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WhyChooseUsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WhyChooseUs\WhyChooseUsCreateRequest;
use App\Models\SectionTitle;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WhyChooseUsDataTable $datatable)
    {
        $sectionTitlesKeys = ['why_choose_us_top_title', 'why_choose_us_main_title', 'why_choose_us_sub_title'];
        $sectionTitles = SectionTitle::whereIn('key', $sectionTitlesKeys)->pluck('value', 'key');
        return $datatable->render('admin.why-choose-us.index', compact('sectionTitles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.why-choose-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhyChooseUsCreateRequest $request): RedirectResponse
    {
        WhyChooseUs::create($request->validated());
        toastr()->success('Create Succefully');

        return to_route('admin.why-choose-us.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $item = WhyChooseUs::findOrFail($id);
        return view('admin.why-choose-us.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WhyChooseUsCreateRequest $request, string $id): RedirectResponse
    {
        $item = WhyChooseUs::findOrFail($id);
        $item->update($request->validated());
        toastr()->success('Updated Successfully');

        return to_route('admin.why-choose-us.index');
    }

    public function updateSectionTitles(Request $request)
    {
        $request->validate([
            'why_choose_us_top_title' => ['max:255'],
            'why_choose_us_main_title' => ['max:255'],
            'why_choose_us_sub_title' => ['max:500'],
        ]);

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_us_top_title'],
            ['value' => $request->why_choose_us_top_title]
        );

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_us_main_title'],
            ['value' => $request->why_choose_us_main_title]
        );

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_us_sub_title'],
            ['value' => $request->why_choose_us_sub_title]
        );

        toastr()->success('Section Titles Was Updated Succefully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $item = WhyChooseUs::findOrFail($id);
            $item->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Item deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete item'
            ], 500);
        }
    }
}
