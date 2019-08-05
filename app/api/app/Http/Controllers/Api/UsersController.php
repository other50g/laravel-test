<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Controllers\Api\AppController;

use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Support\Facades\Hash;

class UsersController extends AppController
{
    protected $users;

    public function __construct()
    {
        $this->users = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = $this->users->all();

        return response()->success($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        $request->validated();

        $user = $this->users->create($data);
        return response()->success($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * ログイン処理
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            throw new UnauthorizedException('ログインに失敗しました。', 401);
        }

        $data = [
            'token' => $token,
            'token_type' => 'bearer',
            'expire_in' => auth('api')->factory()->getTTL() * 60,
        ];

        return response()->success($data);
    }
}
