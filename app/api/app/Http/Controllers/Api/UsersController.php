<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Controllers\Api\AppController;

use App\User;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

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

        $request->validated();

        $user = $this->users->create($data);
        return response()->success('追加に成功しました。', $user);
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
        $user = $this->users->all()->find($id);
        if ($user == null) {
            throw new NotFoundResourceException('ユーザーが見つかりませんでした', 404);
        }

        $user->delete();

        return response()->success('削除に成功しました');
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
