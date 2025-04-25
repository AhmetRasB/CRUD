<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\File;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::when($request->search, function($query) use ($request) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('bank_account_number', 'like', "%{$search}%");
            });
        })->orderBy('id', $request->has('order') && $request->order == 'asc' ? 'ASC' : 'DESC')->paginate(10);

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {
        $customer = new Customer();


        if($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->store('', 'public');
            $filePath = '/uploads/'.$fileName;
            $customer->image = $filePath;
        } else {
            $customer->image = '/default-images/avatar.png';
        }
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->email = $request->input('email');
        $customer->phone = $request->input('phone');
        $customer->bank_account_number = $request->input('bank_account_number');
        $customer->about = $request->input('about');
        $customer->save();

        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, string $id)
    {
        //
        $customer = Customer::findOrFail($id);


        if($request->hasFile('image')) {
            // delete old image
            if ($customer->image != '/default-images/avatar.png') {
                File::delete(public_path($customer->image));
            }
            $image = $request->file('image');
            $fileName = $image->store('', 'public');
            $filePath = '/uploads/'.$fileName;
            $customer->image = $filePath;
        } else {
            $customer->image = '/default-images/avatar.png';
        }
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        // $customer->email = $request->input('email'); // email güncellenmiyor
        $customer->phone = $request->input('phone');
        $customer->bank_account_number = $request->input('bank_account_number');
        $customer->about = $request->input('about');
        $customer->save();

        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        File::delete(public_path($customer->image));
        $customer->delete();
        return redirect()->route('customer.index');
    }
}
