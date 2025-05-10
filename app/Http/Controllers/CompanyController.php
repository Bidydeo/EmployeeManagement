<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CompanyController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            $companies = Company::all();
        } else {
            $company = $user->employee->company; // poate fi null sau un obiect
            $companies = $company ? collect([$company]) : collect(); // întotdeauna colecție
        }

        return view('companies.index', compact('companies'));
    }
    public function create()
    {
        $this->authorize('create', Company::class);
        return view('companies.create');
    }
    
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'company_name'=>'required|string|max:255',
            'company_logo'=>'nullable|image|mimes:jpeg,png,jpg,gif,tiff|max:2048', // max = 2MB
            'company_reg_com'=>'required|string|max:255',
            'company_cui'=>'required|string|max:255',
            'company_country'=>'required|string|max:255',
            'company_town'=>'required|string|max:255',
            'company_district'=>'required|string|max:255',
            'company_street_name'=>'required|string|max:255',
            'company_street_no'=>'required|string|max:255',
            'company_email'=>'required|string|max:255',
            'company_phone'=>'required|string|max:255',
            'company_admin'=>'required|string|max:255',
            'domeniu_email'=>'required|string|max:255',
            'website'=>'required|string|max:255',
            'iban'=>'required|string|max:255',
            'bank'=>'required|string|max:255',            
            'bank_address'=>'required|string|max:255',
            'bank_city'=>'required|string|max:255',            
            'bank_swift'=>'required|string|max:255',       
        ]);
        //dd($request);
        //Separă adresa de email pentru a prelua domeniul
        $emailParts = explode('@', $request->input('company_email'));
        $domain = end($emailParts);
        // Adaugă domeniul în cererea de intrare
        $request->merge(['domeniu_email' => $domain]);
        
        $data = $request->all();
        if ($request->hasFile('company_logo')) {
        $file = $request->file('company_logo');
        
        $fileName = time() . '_' . $file->getClientOriginalName(); // nume unic
        $companyFolder = Str::slug($request->company_name);
        $path = $file->storeAs($companyFolder.'/company_logos', $fileName, 'public'); // salvează în storage/app/public/company-name/company_logos
        // Salvăm în baza de date doar calea relativă
        $data['company_logo'] = 'storage/' . $path;
        }
        //Creează compania utilizând toate datele din cerere
        //dd($company_logo);
        
        Company::create($data);

        return redirect()->route('companies_index')
            ->with('success', 'Compania a fost creata cu succes!');
    }
    
    public function edit(Company $company)
        {
            $this->authorize('edit', $company);
            return view('companies.edit', compact('company'));
        }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name'=>'required|string|max:255',
            'company_logo'=>'nullable|image|mimes:jpeg,png,jpg,gif,tiff|max:2048', // max = 2MB,
            'company_reg_com'=>'required|string|max:255',
            'company_cui'=>'required|string|max:255',
            'company_country'=>'required|string|max:255',
            'company_town'=>'required|string|max:255',
            'company_district'=>'required|string|max:255',
            'company_street_name'=>'required|string|max:255',
            'company_street_no'=>'required|string|max:255',
            'company_email'=>'required|string|max:255',
            'company_phone'=>'required|string|max:255',
            'company_admin'=>'required|string|max:255',
            'domeniu_email'=>'required|string|max:255',
            'website'=>'required|string|max:255',
            'iban'=>'required|string|max:255',
            'bank'=>'required|string|max:255',            
            'bank_address'=>'required|string|max:255',
            'bank_city'=>'required|string|max:255',            
            'bank_swift'=>'required|string|max:255',
        ]);
        $data=$request->all();
        // Verificăm dacă s-a urcat o imagine nouă
    if ($request->hasFile('company_logo')) {
        $file = $request->file('company_logo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $companyFolder = Str::slug($request->company_name);

        // Ștergem imaginea veche, dacă există
        if ($company->company_logo && Storage::disk('public')->exists(str_replace('storage/', '', $company->company_logo))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $company->company_logo));
        }

        // Salvăm noua imagine
        $path = $file->storeAs( $companyFolder. '/company_logos', $fileName, 'public');
        $data['company_logo'] = 'storage/' . $path;
    }

        $company->update($data);
    
        return redirect()->route('companies_index')
            ->with('success', 'Compania a fost actualizata cu succes!');
    }
    
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);
        $company->delete();
        return redirect()->route('companies_index')
            ->with('success', 'Compania a fost ștersa cu succes!');
    }
}
