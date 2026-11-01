<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'min:10'],
            'condition_level' => ['required', Rule::in(Report::CONDITION_LEVELS)],
            'incident_at' => ['required', 'date', 'before_or_equal:now'],
            'area' => ['required', Rule::in(Report::AREAS)],
            'location_detail' => ['nullable', 'string', 'max:255'],
            'latitude' => ['required', 'numeric', 'min:-11', 'max:6'],
            'longitude' => ['required', 'numeric', 'min:95', 'max:141'],
            'evidence' => ['nullable', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ];
    }
}