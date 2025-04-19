<?php

namespace App\Http\Controllers;

use App\Models\OrganizationPackage;
use App\Http\Controllers\Controller;
use App\Models\OrganizationPackageTemplate;
use App\Http\Requests\StoreOrganizationPackageRequest;
use App\Http\Requests\UpdateOrganizationPackageRequest;
use App\Models\InvoiceTemplate;

class OrganizationPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'packages' => OrganizationPackage::get(),
        ];
        return view('admin.organization-package.list-organization-package', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'invoiceTemplates' => InvoiceTemplate::get(),
        ];
        return view('admin.organization-package.create-organization-package',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrganizationPackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrganizationPackageRequest $request)
    {
        $validatedData = $request->validated();
        $organizationPackage = OrganizationPackage::create($validatedData);
        $get_id = $organizationPackage->id;
        $tamp_names = $request->template;

        foreach ($tamp_names as  $tamp_name) {
            OrganizationPackageTemplate::create([
                'organizationPackageId' => $get_id,
                'template' => $tamp_name,
                'company' => 'not company'
            ]);
        }
        return redirect()->back()->with('message', 'Successfully create organization Package.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrganizationPackage  $organizationPackage
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationPackage $organizationPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrganizationPackage  $organizationPackage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $organizationPackage = OrganizationPackage::findOrFail($id);
        $templats = OrganizationPackageTemplate::where('organizationPackageId', $id)->get();
        $invoiceTemplates = InvoiceTemplate::get();

        return view('admin.organization-package.edit-organization-package', compact('organizationPackage','invoiceTemplates','templats' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrganizationPackageRequest  $request
     * @param  \App\Models\OrganizationPackage  $organizationPackage
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrganizationPackageRequest $request, $id)
    {
        $get_id = $id;
        $organizationPackage = OrganizationPackage::find($get_id);
        $organizationPackage->organizationPackageName = $request->organizationPackageName;
        $organizationPackage->organizationPackageDuration = $request->organizationPackageDuration;
        $organizationPackage->price = $request->price;
        $organizationPackage->organizationPackageQuantity = $request->organizationPackageQuantity;
        $organizationPackage->limitBillGenerate = $request->limitBillGenerate;
        $organizationPackage->organizationEmployeeLimitation = $request->organizationEmployeeLimitation;
        $organizationPackage->save();

        $tamp_names = $request->template;
        OrganizationPackageTemplate::where('organizationPackageId', $get_id)->delete();
        foreach ($tamp_names as  $tamp_name) {
            OrganizationPackageTemplate::create([
                'organizationPackageId' => $get_id,
                'template' => $tamp_name,
                'company' => 'not company'
            ]);
        }
        return redirect()->back()->with('message', 'Successfully Update Organization Package.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrganizationPackage  $organizationPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriptionPackage = OrganizationPackage::findOrFail($id);
        $subscriptionPackage->delete();
        OrganizationPackageTemplate::where('organizationPackageId', $id)->delete();
        return redirect()->back()->with('message', 'Successfully Delete Organization Package.');
    }
}
