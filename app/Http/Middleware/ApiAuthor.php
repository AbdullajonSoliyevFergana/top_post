<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Closure;
use Illuminate\Http\Request;

class ApiAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $main_controller = new Controller();
        $author = Author::where('token', $main_controller->getToken())->where('status', 'active')->first();

        if ($author !== null) {
            $request->author = $author;
            return $next($request);
        }

        return $main_controller->sendResponse(null, false, "Avtor topilmadi!", 1);
    }
}
