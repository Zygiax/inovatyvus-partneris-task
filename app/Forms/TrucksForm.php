<?php

namespace App\Forms;

use App\Models\Truck;
use App\Models\TruckMake;
use App\Rules\twoWords;
use Kris\LaravelFormBuilder\Form;
use Carbon\Carbon;

class TrucksForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('truckMakeId', 'select', [
                'choices' => ['1' => 'Volvo', '2' => 'VAZ', '3' => 'Mercedes', '4' => 'GAZ'],
                'label' => 'Truck Make'
            ])
            ->add('yearOfManufacture', 'number', [
                'rules' => 'required|integer|between:1900,' . Carbon::now()->year,
                'label' => 'Manufacture year'
            ])
            ->add('ownerNameAndSurname', 'text', [
                'rules' => ['required', new TwoWords()],
                'label' => 'Owner name & surname'
            ])
            ->add('ownersCount', 'number', [
                'rules' => 'nullable|numeric',
                'label' => 'Owner count'
            ])
            ->add('comment', 'textarea', [
                'rules' => 'nullable',
                'label' => 'Comment'
            ])
            ->add('submit', 'submit', ['label' => 'Submit']);
    }
}
