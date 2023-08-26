<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class SectiomController extends Controller
{
    public function __construct() {
        $this->middleware('permission:section-list', ['only' => ['index']]);
        $this->middleware('permission:section-create', ['only' => ['store']]);
        $this->middleware('permission:section-edit', ['only' => ['update']]);
        $this->middleware('permission:section-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $sections = Section::all();

        $section_num = Section::get()->count();

        return view("sections.index", compact("sections","section_num"));
    }

    public function create()
    {

    }

    public function store(SectionRequest $request)
    {

        Section::create([
            "section_name" => $request->section_name,
            "description" => $request->description,
            "user_id" => auth()->user()->id,
        ]);

        session()->flash("success_create", " تم اضافة ".$request->section_name." لقسم بنجاح ");
        return redirect()->back();

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(SectionRequest $request)
    {
        Section::findOrFail($request->id)->update([
            "section_name" => $request->section_name,
            "description" => $request->description,
            "user_id" => auth()->user()->id,
        ]);
        session()->flash('edit_success','تم تعديل بجاح');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $section = Section::find($request->id);
        $section->delete();

        session()->flash("delete_success","تم الحدف بنجاح");
        return redirect()->back();
    }

    public function getProductBasedSection( $sectionId){

        $prods =DB::table('products')->where('section_id','=',$sectionId)->pluck('id','product_name');
        return json_encode($prods);
    }


}
