<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplateRequest;
use App\Http\Requests\UpdateTemplateRequest;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * List templates.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $templates = Template::query()
            ->when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('templates.index', compact(
            'templates',
            'search'
        ));
    }

    /**
     * Create form.
     */
    public function create()
    {
        return view('templates.create');
    }

    /**
     * Store template.
     */
    public function store(StoreTemplateRequest $request)
    {
        Template::create($request->validated());

        return redirect()
            ->route('templates.index')
            ->with('success', 'Template created successfully.');
    }

    /**
     * Edit form.
     */
    public function edit(Template $template)
    {
        return view('templates.edit', compact('template'));
    }

    /**
     * Update template.
     */
    public function update(
        UpdateTemplateRequest $request,
        Template $template
    ) {
        $template->update($request->validated());

        return redirect()
            ->route('templates.index')
            ->with('success', 'Template updated successfully.');
    }

    /**
     * Delete template.
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()
            ->route('templates.index')
            ->with('success', 'Template deleted successfully.');
    }

    /**
     * Preview template.
     */
    public function preview(Template $template)
    {
        $sampleData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'company' => 'ABC Ltd',
            'city' => 'Mohali',
        ];

        $subject = $this->parsePlaceholders(
            $template->subject,
            $sampleData
        );

        $body = $this->parsePlaceholders(
            $template->body,
            $sampleData
        );

        return view('templates.preview', compact(
            'template',
            'subject',
            'body'
        ));
    }

    /**
     * Replace placeholders.
     */
    private function parsePlaceholders(
        string $content,
        array $data
    ): string {

        foreach ($data as $key => $value) {

            $content = str_replace(
                '{{'.$key.'}}',
                $value,
                $content
            );
        }

        return $content;
    }
}