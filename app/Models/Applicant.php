<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile_number',
        'previous_institution',
        'date_of_birth'
    ];
    // Add a boot method to define validation rules
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($applicant) {
            $applicant->validate();
        });
    }

    // Define the validation rules
    public function rules()
    {
        return [
            'name' => 'required|string',
            'mobile_number' => 'required|digits:11',
            'previous_institution' => 'required|string',
            'date_of_birth' => 'required|date'
        ];
    }

    // Validate the model attributes against the rules
    public function validate()
    {
        $validator = \Validator::make($this->attributes, $this->rules());

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }
}
