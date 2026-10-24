<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Pilihan jumlah data per halaman.
    private const PER_PAGE_OPTIONS = [5, 10, 25];

    public function index(Request $request)
    {
        $perPage = $this->perPage($request);
        $status = $request->query('status', '');

        // Filter status memakai local scope sebelum paginate.
        $query = Project::query();

        if ($status === 'published') {
            $query->published();
        } elseif ($status === 'draft') {
            $query->draft();
        }

        $projects = $query->latest()->paginate($perPage)->withQueryString();

        // Retrieving aggregates: hasil berupa angka, bukan model.
        $totalProjects = Project::count();
        $totalPublished = Project::published()->count();
        $totalToday = Project::today()->count();
        $totalTrash = Project::onlyTrashed()->count();
        $totalBudget = Project::sum('budget');
        $maxId = Project::max('id');
        $latestProject = Project::latest()->first();

        return view('projects.index', compact(
            'projects',
            'status',
            'perPage',
            'totalProjects',
            'totalPublished',
            'totalToday',
            'totalTrash',
            'totalBudget',
            'maxId',
            'latestProject',
        ));
    }

    public function search(Request $request)
    {
        $cari = trim((string) $request->query('kata', ''));

        if ($cari === '') {
            return redirect()->route('projects.index');
        }

        $perPage = $this->perPage($request);

        // withQueryString menjaga kata kunci saat pindah halaman.
        $projects = Project::search($cari)
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        $jumlahProject = $projects->total();

        return view('projects.search', compact('projects', 'cari', 'jumlahProject', 'perPage'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        // Aman: hanya field yang sudah divalidasi yang disimpan.
        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    public function show($id)
    {
        // findOrFail otomatis memberi halaman 404 jika data tidak ada.
        $project = Project::findOrFail($id);

        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        $project = Project::findOrFail($id);
        $project->fill($validated);

        // isDirty mengecek apakah ada kolom yang benar-benar berubah.
        if (! $project->isDirty()) {
            return redirect()
                ->route('projects.show', $project->id)
                ->with('info', 'Tidak ada perubahan data.');
        }

        $project->save();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Soft delete: data hanya ditandai deleted_at, masih bisa dipulihkan.
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project dipindahkan ke trash.');
    }

    public function trash()
    {
        $projects = Project::onlyTrashed()
            ->latest('deleted_at')
            ->paginate(10);

        return view('projects.trash', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()
            ->route('projects.trash')
            ->with('success', 'Project berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()
            ->route('projects.trash')
            ->with('success', 'Project dihapus permanen.');
    }

    // Aturan validasi untuk store dan update.
    private function rules(): array
    {
        return [
            'title' => 'required|string|min:5|max:200',
            'description' => 'required|string|min:10',
            'status' => 'required|in:draft,published',
            'started_at' => 'nullable|date',
            'budget' => 'nullable|integer|min:0',
        ];
    }

    // Pesan validasi dalam Bahasa Indonesia.
    private function messages(): array
    {
        return [
            'title.required' => 'Judul project wajib diisi.',
            'title.min' => 'Judul project minimal 5 karakter.',
            'title.max' => 'Judul project maksimal 200 karakter.',
            'description.required' => 'Deskripsi project wajib diisi.',
            'description.min' => 'Deskripsi project minimal 10 karakter.',
            'status.required' => 'Status project wajib dipilih.',
            'status.in' => 'Status hanya boleh draft atau published.',
            'started_at.date' => 'Tanggal mulai tidak valid.',
            'budget.integer' => 'Anggaran harus berupa angka.',
            'budget.min' => 'Anggaran tidak boleh negatif.',
        ];
    }

    // Jumlah data per halaman dari ?per_page, hanya 5, 10, atau 25.
    private function perPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', 10);

        return in_array($perPage, self::PER_PAGE_OPTIONS, true) ? $perPage : 10;
    }
}
