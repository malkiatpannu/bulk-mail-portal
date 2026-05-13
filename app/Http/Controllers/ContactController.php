<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Imports\ContactsImport;
use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    /**
     * Display contacts listing.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $contacts = Contact::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(2)
            ->withQueryString();

        return view('contacts.index', compact(
            'contacts',
            'search'
        ));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store contact.
     */
    public function store(StoreContactRequest $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'custom_fields' => $this->formatCustomFields($request),
        ]);

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update contact.
     */
    public function update(
        UpdateContactRequest $request,
        Contact $contact
    ) {
        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'custom_fields' => $this->formatCustomFields($request),
        ]);

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Delete contact.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    /**
     * Import contacts from CSV/Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:csv,xlsx,xls'],
        ]);

        Excel::import(
            new ContactsImport,
            $request->file('file')
        );

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contacts imported successfully.');
    }

    /**
     * Format dynamic fields.
     */
    private function formatCustomFields(Request $request): array
    {
        return array_filter([
            'company' => $request->company,
            'city' => $request->city,
        ]);
    }
}