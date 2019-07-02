<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangelogRequest extends FormRequest
{
    public function authorize() {
        return \Auth::check();
    }

    public function rules() {
        if($this->isMethod('post')){
            return $this->createRules();
        } elseif($this->isMethod('put')){
            return $this->updateRules();
        }
    }

    public function createRules(){
        return [
            'version' => 'required|max:20',
            'changelog' => 'required'
        ];
    }

    public function updateRules(){
        return [
            'version' => 'required|max:20',
            'changelog' => 'required'
        ];
    }
}
