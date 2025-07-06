<?php

namespace App\Imports;

use App\Models\Application;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ApplicationImport implements
    ToModel,
    WithHeadingRow,
    WithBatchInserts,
    WithChunkReading
{
    use SkipsErrors;

    private $countries;

    public function __construct()
    {
        // Cache countries once to avoid repeated queries
        $this->countries = Country::pluck('code', 'name_ar')->toArray();
    }

    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip rows that don't have required fields
        if (empty($row['First Name']) || empty($row['last_name'])) {
            return null;
        }

        return new Application([
            'first_name'     => $row['First Name'],
            'middle_name'    => $row['Middle Name'] ?? null,
            'last_name'      => $row['Last Name'],
            'gender'        => $this->mapGender($row['Gender'] ?? null),
            'nationality'   => $this->countries[$row['Nationality'] ?? null] ?? null,
            'address'       => $row['Address'] ?? null,
            'phone_number'  => $row['Phone Number'] ?? null,
            'email_address' => $row['Email Address'] ?? null,
            'birth_date'    => $this->parseDate($row['Birth Date'] ?? null),
            'passport_id'   => $row['Passport'] ?? null,
        ]);
    }

    // public function rules(): array
    // {
    //     return [
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'gender' => 'nullable|in:male,female',
    //         'nationality' => 'nullable|string|max:255',
    //         'email_address' => 'nullable|email|max:255',
    //         'birth_date' => 'nullable|date_format:Y-m-d',
    //         'passport_id' => 'nullable|string|max:255|unique:applications,passport_id',
    //     ];
    // }

    public function batchSize(): int
    {
        return 500; // Process 500 rows at a time
    }

    public function chunkSize(): int
    {
        return 1000; // Read 1000 rows at a time from the file
    }

    protected function mapGender(?string $gender): ?string
    {
        if (empty($gender)) {
            return null;
        }

        $gender = strtolower(trim($gender));

        return in_array($gender, ['ذكر', 'انثي']) ? $gender : null;
    }

    protected function parseDate(?string $date): ?string
    {
        if (empty($date)) {
            return null;
        }

        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
