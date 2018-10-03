<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Http\Requests\UpdateProfileRequest;

class ProfileSettingsController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        /** @var \CreadoresIndie\Models\User $user */
        $user = auth()->user();

        $user->name = $request->name;

        if($user->username != $request->username) {
            $user->username = $request->username;
        }

        if($user->email != $request->email) {
            $user->email = $request->email;
        }

        if($request->has('password') && !is_null($request->password)) {
            $user->password = $request->password;
        }

        if($request->hasFile('avatar')) {
            $user->uploadImage($request->file('avatar'), 'avatar');
        }

        if ($user->save()) {
            return redirect()->back()->with([
                'message' => 'Los datos de tu cuenta han sido actualizados correctamente.',
                'message_type' => 'is-success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => 'Ocurrío un problema al actualizar los datos de tu cuenta, intenta nuevamente.',
                'message_type' => 'is-danger'
            ]);
        }
    }
}
