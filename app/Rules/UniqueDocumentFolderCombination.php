<?php

namespace App\Rules;

use Closure;
use App\Models\DocumentsFolder;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueDocumentFolderCombination implements ValidationRule
/**
 * Validates that the combination of document_id and folder_id is unique.
 *
 * @param string $attribute The attribute being validated.
 * @param array $value The value being validated. Contains keys for 'document_id' and 'folder_id'.
 * @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail The callback to fail validation.
 */
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!is_array($value) || !array_key_exists('document_id', $value) || !array_key_exists('folder_id', $value)) {
            // If the value is not an array or does not have the required keys, fail validation
            $fail('Invalid input format for document_id and folder_id.');
            return;
        }

        // Check if the combination of document_id and folder_id already exists
        if (DocumentsFolder::where('document_id', $value['document_id'])
            ->where('folder_id', $value['folder_id'])->exists()
        ) {
            $fail('The combination of document_id and folder_id already exists.');
        }
    }
}