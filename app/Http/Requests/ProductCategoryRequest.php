<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('post')){

            if(strpos($this->route()->action['as'], 'search') !== false){
                return $this->searchRules();
            }
            return $this->createRules();

        }elseif($this->isMethod('put')){

            return $this->updateRules();

        }
    }

    public function searchRules(){

        return [
            'title_vi' => 'max:255',
            'title_en' => 'max:255',
        ];
    }

    public function createRules(){

        return [
            'title_vi' => 'required|max:255',
            'title_en' => 'required|max:255',
            'slug' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
    }

    public function updateRules(){

        return [
            'title_vi' => 'required|max:255',
            'title_en' => 'required|max:255',
            'slug' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
    }
}
