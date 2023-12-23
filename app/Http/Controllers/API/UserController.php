<?php

namespace App\Http\Controllers\API;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\DestroyUserRequest;
use App\Http\Requests\API\User\ShowUserRequest;
use App\Http\Requests\API\User\StoreUserRequest;
use App\Http\Requests\API\User\UpdateUserRequest;
use App\Repository\contracts\UserRepositoryContract;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public UserRepositoryContract $userProvider;
    public function __construct(
        UserRepositoryContract $userProvider
    ) {
        $this->userProvider = $userProvider;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->userProvider->index(),
            200,);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (isset($request->image)) {
            //upload file to storage 
            $imagePath = Helper::uploadUserImage($request->file('image'));
            $data['image'] = $imagePath;
        }

        $record = $this->userProvider->store($data);
        return response()->json(
            $record
            , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ShowUserRequest $request)
    {
        $record = $this->userProvider->show($request->id);
        return response()->json(
            $record
            , 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $data = $request->all(); 

        if (isset($request->image)) {
            if ($request->image != DEFAULT_USER_IMAGE) {
                $old_image = $this->userProvider->show($request->id)->image;
                File::delete(public_path($old_image));
            }
            $imagePath = Helper::uploadUserImage($request->file('image'));
            $data['image'] = $imagePath;
        }

        $isUpdated = $this->userProvider->update($data, $request->id);
        return response()->json(
            $isUpdated
            , 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyUserRequest $request)
    {
        try {
            $imagePath = $this->userProvider->show($request->id)->image;
            $isDeleted = $this->userProvider->destroy($request->id);
            if ($isDeleted) {
                if ($imagePath != DEFAULT_USER_IMAGE) {
                    File::delete(public_path($imagePath));
                }
            }
        } catch (\Throwable $th) {
            $isDeleted = $this->userProvider->destroy($request->id);
        }
        return response()->json(
            $isDeleted ? true : false,
            $isDeleted ? 200 : 404);

    }
}
