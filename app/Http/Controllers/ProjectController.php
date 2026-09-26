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
                'title' => 'required|string|min:5|max:200',
                'description' => 'required|string|min:10',
            ],
            [
                'title.required' => 'Judul project wajib diisi.',
                'title.min' => 'Judul project minimal 5 karakter.',
                'title.max' => 'Judul project maksimal 200 karakter.',
                'description.required' => 'Deskripsi project wajib diisi.',
                'description.min' => 'Deskripsi project minimal 10 karakter.',
            ]
        );

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate(
            [
                'title' => 'required|string|min:5|max:200',
                'description' => 'required|string|min:10',
            ],
            [
                'title.required' => 'Judul project wajib diisi.',
                'title.min' => 'Judul project minimal 5 karakter.',
                'title.max' => 'Judul project maksimal 200 karakter.',
                'description.required' => 'Deskripsi project wajib diisi.',
                'description.min' => 'Deskripsi project minimal 10 karakter.',
            ]
        );

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }
}