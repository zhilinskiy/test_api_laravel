<?php

namespace App\Http\Controllers\Ver1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ver1\User;
use App\Models\Ver1\Content;
use App\Models\Ver1\Url;
use App\Http\Requests\Ver1\PostDataCheck;

class ApiController extends Controller
{
    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_key(Request $request)
    {
        if ($request->has('browser_name') && $request->input('browser_name') != '') {
            $user = new User;
            $user->browser_name = $request->input('browser_name');
            $user->generateKey()->save();
            return response()->json([
                'user_key' => $user->user_key,
                //only for test
                'html' => view('partials.key_table')->with('users', App\Models\Ver1\User::all())->render()
            ]);
        }
        return response('bad request', 400);
    }

    /**
     * @param PostDataCheck $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(PostDataCheck $request) {

        $content = Content::firstOrNew([
            'content' => $request->input('content'),
            'js_files' => $request->input('js_files')
        ]);
// The analyse algorithm
        if (!$content->analysed) {
            $content->analyse()->save();
        }
// tracks all URLs visited by a particular user and count statistic
        $user = User::where('user_key', $request->input('user_key'))->first();
        if ($content->safe) {
            $user->count_positiv += 1;
        } else {
            $user->count_negativ += 1;
        }
        $user->save();
//    елси такой урл есть у этого юзерa, ничего не делаем
//    если нету сохраняем новый урл
        $url = $user->urls()->firstOrCreate(['url' => $request->input('url')]);
        $url->safe = $content->safe;
        $url->save();

        return response()->json([
            'analysed' => $content->analysed,
            'safe' => $content->safe,
            //only for test
            'content' => view('partials.content_table')->with('contents', App\Models\Ver1\Content::all())->render(),
            'key' => view('partials.key_table')->with('users', App\Models\Ver1\User::all())->render(),
            'url' => view('partials.url_table')->with('urls', App\Models\Ver1\Url::all())->render()
        ]);
    }
    public function count(Request $request)
    {
        $user = User::where('user_key', $request->input('user_key'))->first();
        return response()->json([
            'count_positiv' => $user->count_positiv,
            'count_negativ' => $user->count_negativ,
            //only for test
        'html' => view('partials.count_table')->with('user', $user)->render()
        ]);
    }
}
