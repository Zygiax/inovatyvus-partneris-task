<?php

namespace App\Forms;

use App\Rules\twoWords;
use Kris\LaravelFormBuilder\Form;
use Carbon\Carbon;

class TrucksForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('truckMakeId', 'select', [
                'choices' => ['0' => 'Volvo', '1' => 'VAZ', '2' => 'Mercedes', '3' => 'GAZ']
            ])
            ->add('yearOfManufacture', 'number', [
                'rules' => 'required|integer|between:1900,' . Carbon::now()->year
            ])
            ->add('ownerNameAndSurname', 'text', [
                'rules' => ['required', new twoWords()]
            ])
            ->add('ownersCount', 'number', [
                'rules' => 'nullable|numeric'
            ])
            ->add('comment', 'textarea', [
                'rules' => 'nullable'
            ])
            ->add('submit', 'submit', ['label' => 'Submit']);
    }
}
