<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentInput extends FormRequest
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
            'comment' => ['required','min:1','max:255'],
            'user_id' => ['required','numeric'],
            'post_id' => ['required','numeric'],
        ];
    }
    public function messages(){
        return [
            'comment.required'=> 'コメントを入力してください',
            'comment.min'     => '内容は1字以上でお願いします',
            'comment.max'     => '冊数は255字以内でお願いします',
            'user_id.required'=> 'ログイン処理をしてください',
            'user_id.required'=> '投稿内容が読み取れません',
        ];
    }
}
