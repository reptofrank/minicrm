<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use App\Http\Resources\Company as CompanyResource;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Show companies.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanyResource::collection(Company::paginate(5));
    }

    /**
     * Create new company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('admin');

        $data = $request->all();

        $user = $this->createUser($data, 'company');

        $company = $user->company()->create($data);

        return response()->json($company, 201, ['Location' => route('companies.show', ['company' => $company->id])]);
    }

    /**
     * Get specified company.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->authorize('admin');

        $company->name = $request->input('name');
        $company->logo = $request->input('logo');
        $company->url = $request->input('url');
        $company->save();

        return response()->json($company);
    }

    /**
     * Delete company
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('admin');

        $company->user->delete();
        Employee::where('company_id', $company->id)->delete();
        $company->delete();

        return response(null, 204);
    }
}
