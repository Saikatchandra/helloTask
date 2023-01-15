<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\StoreCompany;
use Image;
use File;
use Session;

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
                if (isset($image->logo)){
                    // dd($image);
                    return '<img src="'.url('/companyImage/'.$image->logo).'" border="0" width="40" class="img-rounded" align="center" />';
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
            // $company = Company::create($input);
            $company = new Company();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            $company->save();
            
            if ($request->hasFile('logo')) {
                $originalName = $request->logo->getClientOriginalName();
                $uniqueImageName =  $company->name.$originalName;
                $image = Image::make($request->logo);
            $image->save(public_path().'/companyImage/'.$uniqueImageName);
            $company->logo = $uniqueImageName;
            $company->save();
        }
        return  back()->with('success', 'company created successfully.');
    }else{
            // dd($input);

            $company = Company::where('id',$id)->first();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->website = $request->website;
            $company->save();
            
            if ($request->hasFile('logo')) {
                if(isset($company->logo)){
                    $file_path = public_path() . '/companyImage/' . $company->logo;
                    File::delete($file_path);
                }
                $originalName = $request->logo->getClientOriginalName();
                $uniqueImageName =  $company->name.$originalName;
                $image = Image::make($request->logo);
            $image->save(public_path().'/companyImage/'.$uniqueImageName);
            $company->logo = $uniqueImageName;
            $company->save();
        }
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
        $company = Company::where('id',$id)->first();
        return view('company.edit',compact('company'));
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
    public function destroy(Request $request)
    {
        // dd($request->all());
        // $product = C::where('productId', $request->productId)->first();
        $company = Company::where('id',$request->companyId)->first();
        // dd($company);
        if(isset($company->logo)){
            $file_path = public_path() . '/companyImage/' . $company->logo;
            File::delete($file_path);
        }
        $company->delete();
        return response()->json();

     
    }
}
