<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
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
           'title' => ['required'],
           'alt' => ['required']
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['error' => $errors], 400);
    }
}
