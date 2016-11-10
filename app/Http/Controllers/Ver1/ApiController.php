<?php

namespace App\Http\Controllers\Ver1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ver1\User;

class ApiController extends Controller
{
    /**
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function get_key(Request $request)
    {
        if ($request->has('browser_name') && $request->input('browser_name') != '') {
            $user = new User;
            $user->browser_name = $request->input('browser_name');
            $user->generateKey()->save();
            return response()->json([
                'user_key' => $user->user_key
            ]);
        }
        return response('bad request', 400);
    }
}
