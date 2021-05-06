<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class TruckController extends Controller
{
    public function index(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\TrucksForm::class, [
            'method' => 'POST',
            'url' => route('store')
        ]);

        return view('welcome', compact('form'));
    }
    public function store(Request $request, FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\TrucksForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $truck = new Truck();
        $truck->trucks_make_id = $request->truckMakeId;
        $truck->year_of_manufacture = $request->yearOfManufacture;
        $truck->owner_name_and_surname = $request->ownerNameAndSurname;
        $truck->owners_count = $request->ownersCount;
        $truck->comment = $request->comment;
        $truck->save();

        return redirect()->back()->with('success', 'Successful!');
    }
}
