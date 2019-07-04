<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 5/18/2019
 * Time: 2:48 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class VersionRequest extends FormRequest
{
    public function authorize()
    {
        return \Auth::check();
    }
    public function rules()
    {
        if($this->isMethod('post')){

            return $this->createRules();

        }
        if($this->isMethod('put')){

            return $this->updateRules();

        }
    }

    public function createRules(){

        return [
            'version' => 'required',
            'version_path' => 'required'
        ];
    }

    public function updateRules(){

        return [
//            'os_name' => 'required|max:50'
        ];
    }
}