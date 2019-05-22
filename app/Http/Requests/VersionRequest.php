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
            'os_name' => 'max:50',
        ];
    }

    public function createRules(){

        return [
            'os_name' => 'required|max:50'
        ];
    }

    public function updateRules(){

        return [
            'os_name' => 'required|max:50'
        ];
    }
}