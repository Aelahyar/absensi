<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        return view('layout.admin.semester', compact('semesters'));
    }

    public function store(Request $request)
    {
        Semester::create([
            'semester' => $request->semester,
            'status' => 1,
        ]);
        return redirect()->back()->with('success', 'Semester ditambahkan');
    }

    public function update(Request $request, $id_semester)
    {
        Semester::findOrFail($id_semester)->update([
            'semester' => $request->semester
        ]);
        return redirect()->back()->with('success', 'Semester diperbarui');
    }

    public function destroy($id_semester)
    {
        Semester::destroy($id_semester);
        return redirect()->back()->with('success', 'Semester dihapus');
    }

    public function setStatus($id_semester, $status)
    {
        Semester::where('id_semester', $id_semester)->update(['status' => $status]);
        return redirect()->back()->with('success', 'Status diperbarui');
    }
}
