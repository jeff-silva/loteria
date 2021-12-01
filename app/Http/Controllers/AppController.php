<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

/*
Route::get('aaa/search', 'App\Http\Controllers\AaaController@search');
Route::get('aaa/find/{id}', 'App\Http\Controllers\AaaController@find');
Route::post('aaa/save', 'App\Http\Controllers\AaaController@save');
Route::post('aaa/valid', 'App\Http\Controllers\AaaController@valid');
Route::post('aaa/remove', 'App\Http\Controllers\AaaController@remove');
Route::get('aaa/clone/{id}', 'App\Http\Controllers\AaaController@clone');
Route::get('aaa/export', 'App\Http\Controllers\AaaController@export');
*/

class AppController extends \App\Http\Controllers\Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'test',
                'login',
                'register',
                'endpoints',
                'passwordResetStart',
                'passwordResetChange',
            ],
        ]);
    }

    public function test() {
        $user = \App\Models\User::find(1);
        return (new \App\Mail\UserWelcome($user))->sendTo('jeff@grr.la');
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register()
    {
        // dd('teste');
        // return request()->all();
        return (new \App\Models\User)->create(request()->all());
    }

    public function endpoints() {
        $routes = [];
        foreach (\Route::getRoutes()->getIterator() as $route){
            if (strpos($route->uri, 'api') !== false) {
                $routes[] = [
                    'uri' => $route->uri,
                    'parameters' => ($route->parameterNames? $route->parameterNames: []),
                    'methods' => $route->methods,
                ];
            }
        }
        return $routes;
    }

    public function passwordResetStart() {
        $user = \App\Models\User::where('email', request('email'))->first();
        if (! $user) throw new \Exception('Usuário não encontrado');
        return $user->passwordResetStart();
    }

    public function passwordResetChange() {
        $user = \App\Models\User::where([
            'email' => request('email'),
            'remember_token' => request('token'),
        ])->first();

        if (! $user) throw new \Exception('Usuário não encontrado ou token incorreto');
        $user->remember_token = null;
        $user->password = request('password');
        $user->save();

        return $user;
    }

    public function emailTest() {
        return \App\Utils::email(request('to'), request('subject'), request('body'));
    }

    public function emailsTemplates() {
        $files = \File::allFiles(app_path('Mail'));
        
        return array_filter(array_map(function($file) {
            if ($file->isDir()) return false;

            $namespace = "\App\Mail\\". $file->getFilenameWithoutExtension();
            $class = app($namespace);

            $item['id'] = $file->getFilenameWithoutExtension();
            $item['subject_key'] = "email.templates.{$item['id']}.subject";
            $item['subject'] = $class->getSubject();
            $item['template_key'] = "email.templates.{$item['id']}.template";
            $item['template'] = $class->getTemplate();
            $item['params'] = $class->getParams();

            return $item;
        }, $files));
    }
}