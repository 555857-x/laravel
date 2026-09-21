<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|max:200',
                'description' => 'required',
            ],
            [
                'title.required' => 'Judul project wajib diisi.',
                'title.max' => 'Judul project maksimal 200 karakter.',
                'description.required' => 'Deskripsi project wajib diisi.',
            ]
        );

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}