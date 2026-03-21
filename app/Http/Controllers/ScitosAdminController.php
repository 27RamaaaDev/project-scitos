<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ScitosAdminController extends Controller
{
    public function storeClassroomTask(Request $request): RedirectResponse
    {
        if (data_get($request->session()->get('scitos_auth'), 'role') !== 'admin') {
            abort(403);
        }

        $adminRole = data_get($request->session()->get('scitos_auth'), 'admin_role', 'admin');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'division' => ['required', 'string', 'max:120'],
            'task_type' => ['required', 'in:text,material,quiz'],
            'topic' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:2000'],
            'due_date' => ['nullable', 'date'],
            'score' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'attachment' => ['nullable', 'file', 'max:30720', 'mimes:pdf,png,jpg,jpeg,webp,mp4,mov,webm,doc,docx,ppt,pptx'],
        ]);

        if ($validated['task_type'] === 'quiz' && $adminRole !== 'executive') {
            return back()
                ->withErrors([
                    'task_type' => 'Quiz dengan skor hanya bisa dibuat oleh Executive Admin.',
                ])
                ->withInput();
        }

        $attachments = [];

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $storedPath = $file->store('classroom-assets', 'public');

            $attachments[] = [
                'label' => $file->getClientOriginalName(),
                'type' => strtoupper($file->getClientOriginalExtension()),
                'path' => 'storage/' . $storedPath,
                'mime' => $file->getClientMimeType(),
            ];
        }

        $customTasks = $request->session()->get('scitos_classroom.custom_tasks', []);

        array_unshift($customTasks, [
            'id' => 'custom-' . Str::uuid(),
            'title' => $validated['title'],
            'division' => $validated['division'],
            'coordinator' => data_get($request->session()->get('scitos_auth'), 'name'),
            'status' => 'Published',
            'task_type' => $validated['task_type'],
            'topic' => $validated['topic'],
            'deadline' => $validated['due_date']
                ? 'Deadline ' . date('d M Y', strtotime($validated['due_date']))
                : 'Tanpa deadline',
            'due_date' => $validated['due_date'] ?? null,
            'format' => $validated['task_type'] === 'quiz' ? 'Quiz interaktif' : 'Instruksi tugas',
            'score' => $validated['task_type'] === 'quiz' ? ($validated['score'] ?? 100) : null,
            'summary' => $validated['description'],
            'attachments' => $attachments,
            'created_by_role' => $adminRole,
        ]);

        $request->session()->put('scitos_classroom.custom_tasks', $customTasks);

        return redirect()
            ->route('admin.panel')
            ->withFragment('classroom-control')
            ->with('status', 'Tugas classroom berhasil ditambahkan ke panel dan stream classroom.');
    }
}
