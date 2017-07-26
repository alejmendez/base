<?php 

namespace App\Modules\Base\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
 
class LoginfotoRequest extends FormRequest {
    public function rules() {
        return [
            'usuario' => ['min:4'],
        ];
    }
 
    public function recordar() {
        return $this->get('recordar', 'false') === 'true';
    }
 
    public function credenciales() {
        return $this->only('usuario');
    }
 
    public function authorize() {
        return true;
    }
}