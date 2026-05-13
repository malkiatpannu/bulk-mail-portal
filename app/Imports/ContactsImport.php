<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements
    ToCollection,
    WithHeadingRow
{
    /**
     * Import contacts.
     */
    public function collection(Collection $rows): void
    {
        foreach ($rows as $row) {

            if (empty($row['email'])) {
                continue;
            }

            Contact::updateOrCreate(
                [
                    'email' => $row['email'],
                ],
                [
                    'name' => $row['name'] ?? '',
                    'phone' => $row['phone'] ?? null,

                    'custom_fields' => [
                        'company' => $row['company'] ?? null,
                        'city' => $row['city'] ?? null,
                    ],
                ]
            );
        }
    }
}