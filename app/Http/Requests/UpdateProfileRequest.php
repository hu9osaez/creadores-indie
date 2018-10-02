<?php namespace CreadoresIndie\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'username' => 'required|min:3|max:25|regex:/^[A-Za-z0-9\._]+$/',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image',
            'password' => 'nullable|string|min:6'
        ];
    }
}
