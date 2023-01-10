<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\StoreCompany;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        return view('company.index',compact('company'));
    }

    public function getCompany(){
        $company = Company::all();
        return datatables()->of($company)
            ->addColumn('image', function($image) {
                if (isset($image->imageLink)){
                    return '<img src="'.url('public/categoryImage/'.$image->imageLink).'" border="0" width="40" class="img-rounded" align="center" />';
                }else{
                    return 'No image';
                }
            })
            ->rawColumns(['image'])
            ->setRowAttr([
                'align'=>'center',
            ])->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('company.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request, $id=0)
    {
        $input = $request->all();
        if($id == 0){
            $company = Company::create($input);
            return  back()->with('success', 'company created successfully.');
        }else{
            $company = Company::where('id',$id)->first();
            $company->update($input);
            return  back()->with('success', 'company update successfully.');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
