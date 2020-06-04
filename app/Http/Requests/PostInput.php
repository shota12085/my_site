<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostInput extends FormRequest
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
            'title'   => ['required','min:1','max:100'],
            'content' => ['required','min:1','max:800'],
            'user_id' => ['required','numeric'],
        ];
    }

    public function messages(){
        return [
            'title.required'  => 'タイトルを入力してください',
            'title.min'       => 'タイトルは1文字以上でお願いします',
            'title.max'       => 'タイトルは100字以内でお願いします',
            'content.required'=> '内容を入力してください',
            'content.min'     => '内容は1字以上でお願いします',
            'content.max'     => '文字数は800字以内でお願いします',
            'user_id.required'=> 'ログイン処理をしてください'
        ];
    }
}
