<?php

declare(strict_types=1);

namespace App\Livewire\Forms\People;

use App\Rules\DobValid;
use App\Rules\YobValid;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FatherForm extends Form
{
    // -----------------------------------------------------------------------
    public $person = null;

    // -----------------------------------------------------------------------
    public $firstname = null;

    public $surname = null;

    public $birthname = null;

    public $nickname = null;

    #[Validate]
    public $yob = null;

    #[Validate]
    public $dob = null;

    public $pob = null;

    public $photo = null;

    // -----------------------------------------------------------------------
    public $person_id = null;

    // -----------------------------------------------------------------------
    public function rules(): array
    {
        return $rules = [
            'firstname' => ['nullable', 'string', 'max:255'],
            'surname'   => ['nullable', 'string', 'max:255', 'required_without:person_id'],
            'birthname' => ['nullable', 'string', 'max:255'],
            'nickname'  => ['nullable', 'string', 'max:255'],

            'yob' => [
                'nullable',
                'integer',
                'min:1',
                'max:' . date('Y'),
                new YobValid,
            ],
            'dob' => [
                'nullable',
                'date_format:Y-m-d',
                'before_or_equal:today',
                new DobValid,
            ],
            'pob' => ['nullable', 'string', 'max:255'],

            'photo' => ['nullable', 'string', 'max:255'],

            // -----------------------------------------------------------------------
            'person_id' => ['nullable', 'integer', 'required_without:surname'],
        ];
    }

    public function messages(): array
    {
        return [
            'surname.required_without'   => __('validation.surname.required_without'),
            'person_id.required_without' => __('validation.person_id.required_without'),
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'firstname' => __('person.firstname'),
            'surname'   => __('person.surname'),
            'birthname' => __('person.birthname'),
            'nickname'  => __('person.nickname'),

            'yob' => __('person.yob'),
            'dob' => __('person.dob'),
            'pob' => __('person.pob'),

            'photo' => __('person.photo'),

            'person_id' => __('person.person'),
        ];
    }
}
