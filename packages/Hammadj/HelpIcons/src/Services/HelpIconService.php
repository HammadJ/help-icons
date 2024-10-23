<?php

namespace Hammadj\HelpIcons\Services;

use Illuminate\Support\Facades\Cache;
use Hammadj\HelpIcons\Models\FormHelp;
use Hammadj\HelpIcons\Models\Icon;

class HelpIconService
{
    /**
     * Get all help icons for a specific form.
     *
     * @param int $formId
     * @return array
     */
    public function getHelpIconsForForm(int $formId): array
    {
        $cacheKey = 'help_icons_form_' . $formId;

        return Cache::remember($cacheKey, 60 * 60, function () use ($formId) {
            return $this->fetchHelpIcons($formId);
        });
    }

    /**
     * Fetch help icons from the database for the form.
     *
     * @param int $formId
     * @return array
     */
    private function fetchHelpIcons(int $formId): array
    {
        $helpIcons = FormHelp::with('icon')
            ->where('form_id', $formId)
            ->get()
            ->map(function ($help) {
                return [
                    'form_field_id' => $help->form_field_id,
                    'form_help_text' => $help->form_help_text,
                    'icon' => [
                        'code_svg' => $help->icon->code_svg ?? '<svg></svg>'
                    ],
                ];
            })
            ->toArray();

        return $helpIcons;
    }

    /**
     * Clear the cached help icons for a specific form.
     *
     * @param int $formId
     * @return void
     */
    public function clearCache(int $formId): void
    {
        $cacheKey = 'help_icons_form_' . $formId;
        Cache::forget($cacheKey);
    }
}
