<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlaylistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'thumbnail' => [Rule::requiredIf($this->routeIs('playlists.store')), 'mimes:jpeg,jpg,png', 'max:2048'],
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required'
        ];
    }
}
