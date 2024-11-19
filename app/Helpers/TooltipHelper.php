<?php

namespace App\Helpers;

/**
 * Class TooltipHelper
 *
 * A helper class for generating HTML tooltips for list items.
 */
class TooltipHelper
{
    /**
     * Generates tooltip HTML for a list of items with a badge showing the count of remaining items.
     *
     * @param  string  $firstItem  The first item to display outside the tooltip.
     * @param  array  $remainingItems  The remaining items to display inside the tooltip.
     * @param  string  $tooltipClass  The CSS class to apply to the tooltip container.
     * @return string The generated HTML for the tooltip.
     */
    public static function generateTooltip(string $firstItem, array $remainingItems, string $tooltipClass = 'tooltip-list'): string
    {
        $remainingCount = count($remainingItems);

        if ($remainingCount === 0) {
            return $firstItem;
        }

        $tooltipContent = collect($remainingItems)->map(fn ($item) => "<li>{$item}</li>")->implode('');

        return "<span class='{$tooltipClass}'>
                    {$firstItem}
                    <span class='badge badge-brownbubble'>+{$remainingCount}</span>
                    <div class='{$tooltipClass}-content'>
                        <ul>{$tooltipContent}</ul>
                    </div>
                </span>";
    }

    /**
     * Generates a tooltip for a single truncated text item.
     *
     * @param  string  $truncatedText  The truncated text to display.
     * @param  string  $fullText  The full text to show in the tooltip.
     * @param  string  $tooltipClass  The CSS class for the tooltip.
     * @return string The generated HTML for the tooltip.
     */
    public static function generateSingleItemTooltip(string $truncatedText, string $fullText, string $tooltipClass = 'tooltip-single'): string
    {
        // Escape HTML to prevent XSS attacks
        $escapedFullText = htmlspecialchars($fullText);

        return "<span class='{$tooltipClass}' data-bs-toggle='tooltip' title='{$escapedFullText}'>
                    {$truncatedText}
                </span>";
    }
}
