<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Story;

class MaxNotes implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $story = Story::find($value);

        if ($story && $story->notes()->count() >= 10) {
            $fail('This story already has the maximum of 10 notes.');
        }
    }
}
