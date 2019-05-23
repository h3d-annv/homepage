<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VrGalleryRequest extends FormRequest
{
    public function authorize()
    {
        return \Auth::check();
    }

    public function rules()
    {
        if($this->isMethod('post')){

            return $this->createRules();

        }elseif($this->isMethod('put')){

            return $this->updateRules();

        }
    }

    public function createRules(){

        return [
            'link' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
    }

    public function updateRules(){

        return [
            'link' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
    }
}