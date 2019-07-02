<?php
/**
 * Created by PhpStorm.
 * User: Tài Trần
 * Date: 7/1/2019
 * Time: 4:09 PM
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class OurTeamRequest extends FormRequest
{
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
            'name' => 'required|max:50',
            'roll_vi' => 'required|max:255',
            'roll_en' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
    }

    public function updateRules(){

        return [
            'name' => 'required|max:50',
            'roll_vi' => 'required|max:255',
            'roll_en' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ];
    }
}