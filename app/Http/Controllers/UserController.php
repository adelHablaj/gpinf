<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('users.index', [ 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('nom', 'id');
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->avatar = 'admin-default-avatar.png';

        try {
            DB::beginTransaction();
            $user->save();
            $roles = Role::pluck('nom', 'id');
            DB::commit();
            return redirect()->route('users.edit', ['roles' => $roles, 'user' =>$user])->with(['message' => ['seccess', __('User Successfully created')]]);
        } catch (Throwable $th){
            DB::rollBack();
            return redirect()->back()->with('error', __('User can not be Created'));


        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        $roles = Role::pluck('nom', 'id');
        if ($user) {
            unset($user['password']);
            unset($user['remember_token']);
            return view('users.edit', ['user'=> $user, 'roles'=> $roles]);
        }else {
            return redirect()->route('users.create', ['roles'=> $roles]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;

            try {
                $user->update();
                return redirect()->back()->withInput()->with('success', __('User successfully Updated'));
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->withInput()->with(['message' => [$th, 'error'=> __('User can not be Updated')]]);
            }

        } else{
            return redirect()->back()->withInput()->with('error', __('User can not be Found'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyUserRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($user && $request->suppvalidation === '1') {
            try {
                $user->delete();
                return redirect()->route('users.index')->with('success', __('The selected User is DELETED successfully'));
            } catch (\Throwable $th) {
                //throw $th;
                return redirect()->back()->with('error', __('Cannot DELETE the selected User'));
            }
        }else {
            return redirect()->back()->with('error', __('Selected User can not be found'));
        }
    }

    public function print($id, $doc)
    {
        try {
            $user = User::findOrFail($id);
            $pdf = PDF::loadView('users.'.$doc, ['user'=> $user]);
            return $pdf->stream($user->id.'-'.$user->name.'-'.$doc.'.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadavatar(UpdateAvatarRequest $request)
    {
        try {
            $user = User::findOrFail($request->user_id);

            // dd($request);
            $medias = $user->getMedia('');
            if(count($medias) > 0){
                foreach ($medias as $key => $md) {
                    if (isset($medias[$key])) {
                        $medias[$key]->delete();
                    }
                }
            };
            // $path = $medias[0]->getUrl();
            DB::beginTransaction();
            $media = $user
                ->addMediaFromRequest('avatar')
                ->sanitizingFileName(function($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' ','@', '_', '^'], '-', $fileName));
                 })
                ->toMediaCollection('','admin_images');

            file_exists($media->getPath(''))?unlink($media->getPath('')):null;

            $filePath = str_replace(public_path(DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR),'',$media->getPath('profile'));
            // dd($filePath);
            $user
                ->fill(['avatar' => $filePath])
                ->update();

            DB::commit();

            return response()->json([$filePath,'message' => [__('Photo successfully Updated!')]]);

        } catch (\Throwable $th) {

            DB::rollBack();

            response()->json(['message' => [$th,'error', __('Photo Cannot be Updated please try again!')]]);

        }

        // dd($eleve->getMediaUrl('images'));

    }
}
