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
        $truck->owners_count = !$request->ownersCount ? $request->ownersCount : null;
        $truck->comment = !$request->comment ? $request->comment : null;
        $truck->save();

        return redirect()->back()->with('success', 'Successful!');
    }
    public function tableView(Request $request)
    {
        return view('table');
    }
    public function table(Request $request)
    {
        $response['data'] = [];
        $data = \App\Models\Truck::query()->join('trucks_make', 'trucks_make.id', '=' , 'trucks.trucks_make_id')->select('trucks.*', 'trucks_make.name');

        if (count($request->order) > 0)
        {
            $direction = $request->order[0]['dir'];
            ($direction == 'asc') ? $ascending = true : $ascending = false;
            $column = 'trucks.id';

            if ($request->order[0]['column'] == "1")
            {
                $column = 'trucks_make.name';
            }
            else if ($request->order[0]['column'] == "2")
            {
                $column = 'trucks.year_of_manufacture';
            }
            else if ($request->order[0]['column'] == "3")
            {
                $column = 'trucks.owner_name_and_surname';
            }
            else if ($request->order[0]['column'] == "4")
            {
                $column = 'trucks.owners_count';
            }
            $data = $data->orderBy($column, $ascending ? 'asc' : 'desc');
        }

        if ($request->search['value'] != '')
        {
            $data = $data->where('trucks.year_of_manufacture','LIKE',"%{$request->search['value']}%")
                ->orWhere('trucks.owner_name_and_surname','LIKE',"%{$request->search['value']}%")
                ->orWhere('trucks.owners_count','LIKE',"%{$request->search['value']}%")
                ->orWhere('trucks_make.name','LIKE',"%{$request->search['value']}%");
        }

        $data = $data->get();
        $dataCount = count($data);
        foreach($data as $d)
        {
            $tableData = [];
            $tableData[] = $d->id;
            $tableData[] = $d->make->name;
            $tableData[] = $d->year_of_manufacture;
            $tableData[] = $d->owner_name_and_surname;
            $tableData[] = !$d->owners_count ? '-' : $d->owners_count;
            $tableData[] = !$d->comment ? '-' : $d->comment;
            $response['data'][] = $tableData;
        }
        $response['success'] = true;
        $response['draw'] = $request->draw;
        $response['recordsTotal'] = $dataCount;
        $response['recordsFiltered'] = $dataCount;
        return response()->json($response);
    }
}

