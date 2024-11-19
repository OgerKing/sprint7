<?php

namespace App\Http\Middleware;

use App\Models\WratsUserApplicationHistory;
use Closure;
use Illuminate\Http\Request;

class WratsUserApplicationHistoryLogger
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            return $next($request);
        }

        $userId = auth()->user()->id;
        $parameters = $request->all();

        // Get the first segment of the URL
        $firstSegment = $request->segment(1);

        $paths = config('settings.user.history.paths');

        if (array_key_exists($firstSegment, $paths)) {
            $recordType = $paths[$firstSegment];
        } else {
            $recordType = $paths['default'];
        }

        // Log the visit
        WratsUserApplicationHistory::create([
            'users_id' => $userId,
            'path' => $request->url(),
            'parameters' => json_encode($parameters),
            'record_type' => $recordType,
            'label' => 'Visited Page',
        ]);

        return $next($request);
    }
}
