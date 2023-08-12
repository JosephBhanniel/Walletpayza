<?php

namespace App\Actions\Fortify;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreateNewCompanies;
use Laravel\Jetstream\Jetstream;

class CreateNewCompany implements CreateNewCompanies
{


    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Company
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:company'],
        ])->validate();

        return Company::create([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);
    }

  



}
