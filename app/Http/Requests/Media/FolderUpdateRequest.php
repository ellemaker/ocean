<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class FolderUpdateRequest extends FormRequest
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
        $parent = $this->request->get('parent');

        return [
            'name' => [
                'required',
                Rule::unique('media_folders')->where(function ($query) use ($parent) {
                    return $query->where('parent', $parent);
                })
            ]
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['error' => $errors], 400);
    }
}
