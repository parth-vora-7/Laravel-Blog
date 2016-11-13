<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $blog = $this->route('blog');

        if(!$blog) return true;

        if(Auth::user()->can('update', $blog)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $blog = $this->route('blog');
        $blog_id = ($blog) ? $blog->id : null;
        
        return [
        'title' => ['required', 'min:5', 'max:255', Rule::unique('blogs')->ignore($blog_id, '_id')],
        'text' => 'required|min:5|max:3000',
        'published_on' => 'required|date',
        'blog_image' => (!$blog) ? 'required|image' : 'image'
        ];
    }
}