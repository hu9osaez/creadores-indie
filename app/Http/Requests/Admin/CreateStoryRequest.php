<?php namespace CreadoresIndie\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateStoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAn('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required|string|exists:users,username',
            'title' => 'required|string',
            'body' => 'required|string',
            'start_date' => 'required|date',
            'mrr' => 'nullable|string',
        ];
    }
}
