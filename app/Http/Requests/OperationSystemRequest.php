<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 5/18/2019
 * Time: 2:52 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class OperationSystemRequest extends FormRequest
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

            return $this->createRules();

        }elseif($this->isMethod('put')){

            return $this->updateRules();

        }
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