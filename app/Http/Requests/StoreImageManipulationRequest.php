<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreImageManipulationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'image' => ['required'],
            'w' => ['required', 'regex:/^\d+(\.\d+)?%?$/'], // 50 50%, 50.26673 50.123%,
            'h' => 'regex:/^\d+(\.\d+)?%?$/',
            'album_id' => 'exists:\App\Models\Album, id',
        ];

        $image = $this->post('image');
        var_dump($image);
        if($image && $image instanceof UploadedFile){
            $rules['image'][] = 'image';
        }else{
            $rules['image'][] = 'url';
        }

        // echo '<pre>';
        dd($rules);
        // echo '</pre>';

        return $rules;

    }
}
