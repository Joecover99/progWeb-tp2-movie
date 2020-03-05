<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Movie;
use Illuminate\Validation\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PostMovieRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:255',
            'release_year' => 'required|integer',
            'length' => 'required|integer|min:0',
            'description' => 'required',
            'rating' => [
                Rule::in(Movie::ratingEnum)
            ],
            'language_id' => [
                'required',
                'integer',
                Rule::exists('languages', 'id')
            ],
            'special_features' => [
                'nullable',
                Rule::in(Movie::specialFeatures)
            ],
            'image' => [
                'nullable'
                //nothing
            ]
        ];
    }

    public function withValidator(Validator $validator) {
        if($validator->fails()) {
            // throw new HttpException(400, $validator->errors());
        }
    }
}
