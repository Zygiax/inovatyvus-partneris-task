<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use function Couchbase\defaultDecoder;

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
        $truck->owners_count = $request->ownersCount ? $request->ownersCount : null;
        $truck->comment = $request->comment ? $request->comment : null;
        $truck->save();

        return redirect()->back()->with('success', 'Successful!');
    }
    public function table(Request $request)
    {
        $data = \App\Models\Truck::query()->join('trucks_make', 'trucks_make.id', '=' , 'trucks.trucks_make_id')->select('trucks.*', 'trucks_make.name');

        if ($request->order != null)
        {
            $ascending = true;
            if ($request->order == 1)
            {
                $column = 'trucks_make.name';
            }
            else if ($request->order == 2)
            {
                $column = 'trucks.year_of_manufacture';
            }
            else if ($request->order == 3)
            {
                $column = 'trucks.owner_name_and_surname';
            }
            else if ($request->order == 4)
            {
                $column = 'trucks.owners_count';
            }
            $data = $data->orderBy($column, $request->direction);
        }

        if ($request->search != '')
        {
            $data = $data->where('trucks.year_of_manufacture','LIKE',"%{$request->search}%")
                ->orWhere('trucks.owner_name_and_surname','LIKE',"%{$request->search}%")
                ->orWhere('trucks.owners_count','LIKE',"%{$request->search}%")
                ->orWhere('trucks_make.name','LIKE',"%{$request->search}%");
        }

        $data = $data->get();
        $dataCount = count($data);
        return view('table', compact('data'));
    }
}

