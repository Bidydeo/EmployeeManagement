<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Client;
use App\Models\Company;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    public function index()
{
    $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            $projects = Project::all();
        } 
        else {
            $projects = $user->employee?->projects() ?? collect();
        }
    return view('projects.index', compact('projects'));
}
public function create()
{
    $clients = Client::pluck('name', 'id');
    $companies = Company::pluck('company_name', 'id');
    
        return view('projects.create', [
            'clients' => $clients,
            'companies' => $companies,
                                        ]);
}

public function store(Request $request)
{
    $request->validate([
        'name'=>'required|string|max:255',
        'client_id'=>'required',
        'company_id'=>'required',
    ]);
    $slug=Str::slug($request->name);
    $data = $request->all();
    $data['slug'] = $slug;
    Project::create($data);
                    // Normalizează numele proiectului pentru a-l folosi în calea fișierului
                    $slug = Str::slug($request->name);
                    // Specifică disk-ul 'project-files'
                    $disk = Storage::disk('project-files');
                    // Creează directorul principal pentru proiect
                    $rootDirectoryPath = $slug;
                    $disk->makeDirectory($rootDirectoryPath);
                    // Subdirectoare și fișiere predefinite
                    $subdirectories = [
                    '00. Registru' => [
                        'readme.txt' => 'Registrul de corespondenta al proiectului: ' . $request->name,
                    ],
                    '01.Documentatie' => [
                        'readme.txt' => 'Documentatia initiala a proiectului: ' . $request->name,
                    ],
                    '02.Management' => [
                        'readme.txt' => 'Managementul proiectului: ' . $request->name,
                    ],
                    '04.Contracte' => [
                        'readme.txt' => 'Contractele proiectului: ' . $request->name,
                    ],
                    '05.Proiect' => [
                        'readme.txt' => 'Planurile pe specialitati ale proiectului: ' . $request->name,
                    ],
                    '06.Calitate' => [
                        'readme.txt' => 'Documentele de calitate ale proiectului: ' . $request->name,
                    ],
                    '07.Oferte' => [
                        'readme.txt' => 'Oferte pe specialitati ale proiectului: ' . $request->name,
                    ],
                    '08.Comenzi' => [
                        'readme.txt' => 'OComenzi ale proiectului: ' . $request->name,
                    ],
                    '09.SSM' => [
                        'readme.txt' => 'SSM-ul proiectului: ' . $request->name,
                    ],
                    '10.Organizare de satier' => [
                        'readme.txt' => 'Organizarea de santier a proiectului: ' . $request->name,
                    ],
                    '11.Situatii de lurari' => [
                        'readme.txt' => 'Situatii de lucrari ale proiectului: ' . $request->name,
                    ],
                ];
                // Creează subdirectoare și fișierele respective
                foreach ($subdirectories as $subdir => $files) {
                    // Creează subdirectorul
                    $subdirPath = $rootDirectoryPath . '/' . $subdir;
                    $disk->makeDirectory($subdirPath);

                    // Creează fișierele în subdirectorul respectiv
                    foreach ($files as $filename => $content) {
                        $filePath = $subdirPath . '/' . $filename;
                        $disk->put($filePath, $content);
                    }
                }
                // // Verifică structura creată
                // dd($subdirectories);
    return redirect()->route('projects_index')
        ->with('success', 'Proiectul a fost creat cu succes!');
}

public function edit(Project $project)
    {
        $clients = Client::pluck('name', 'id');
        $companies = Company::pluck('company_name', 'id');
        $teams = Team::pluck('name', 'id');
        $selectedTeams = $project->teams()->pluck('team_id')->toArray();
        $description =$project->description;
        $projectleader=$project->projectleader;
        $status=$project->status;
        $budget=$project->budget;
        $spending=$project->spending;
        $duration=$project->duration;
        
    return view('projects.edit', [
            'clients' => $clients,
            'companies' => $companies,
            'teams'=>$teams,
            'project'=>$project,
            'selectedTeams'=>$selectedTeams,
            'description'=>$description,
            'projectleader'=>$projectleader,
            'status' =>$status,
            'budget' =>$budget,
            'spending' =>$spending,
            'duration' =>$duration,
                                        ]);
    }

    public function update(Request $request, Project $project)
{
$request->validate([
    'name' => 'required|string|max:255',
    'client_id' => 'required',
    'company_id' => 'required',
    'team_id' => 'array',
    'description'=>'required',
    'projectleader'=>'required',
    'status' => 'required|in:Not Started,On Hold,Canceled,In Progress,Completed',
]);

// Actualizați detaliile proiectului
$project->update([
    'name' => $request->input('name'),
    'client_id' => $request->input('client_id'),
    'company_id' => $request->input('company_id'),
    'description'=>$request->input('description'),
    'projectleader'=>$request->input('projectleader'),
    'status'=>$request->input('status'),

    // Nu este necesar să actualizezi 'team_id' aici, deoarece este gestionat mai jos
]);
// Actualizați echipele asociate proiectului
$selectedTeams = $request->input('team_id'); // ID-urile echipelor selectate din formular

$project->teams()->detach();
if ($selectedTeams !== null) {
    foreach ($selectedTeams as $teamId) {       
       // Sincronizează echipele selectate cu proiectul
$project->teams()->sync($selectedTeams);
    }
}

return redirect()->route('project_edit',$project) // Asigură-te că numele rutei este corect
    ->with('success', 'Proiectul a fost actualizat cu succes!');
}


public function destroy(Project $project)
{
    $project->delete();

    return redirect()->route('projects_index')
        ->with('success', 'Proiectul a fost șters cu succes!');
}
public function detail(Project $project)
    {
        $clients = Client::pluck('name', 'id');
        $companies = Company::pluck('company_name', 'id');
        $teams = Team::pluck('name', 'id');
        // $selectedTeams = $project->teams()->pluck('team_id')->toArray();

    return view('projects.details', [
            'clients' => $clients,
            'companies' => $companies,
            // 'teams'=>$teams,
            'project'=>$project,
            // 'selectedTeams'=>$selectedTeams,
                                        ]);
    }
    public function updateBudget(Request $request, $id)
        {
            // Validare
            $validated = $request->validate([
                'budget' => 'required|numeric|min:0',
                'spending' => 'required|numeric|min:0',
                'duration' => 'required|integer|min:0',
            ]);

            // Găsește proiectul și actualizează datele
            $project = Project::findOrFail($id);
            $project->budget = $validated['budget'];
            $project->spending = $validated['spending'];
            $project->duration = $validated['duration'];
            $project->save();

            // Redirecționează cu un mesaj de succes
            return redirect()->route('project_edit', $id)->with('success', 'Budget updated successfully.');
        }

        public function updateFiles(Request $request, $id)
        {
            $project = Project::findOrFail($id);
        
            // Validare fișiere
            $request->validate([
                'new_files.*' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048', // Exemplu pentru fișiere de tip imagine, PDF și documente Microsoft Office cu dimensiune maximă de 2MB
            ]);
        
            // Procesare fișiere încărcate
            if ($request->hasFile('new_files')) {
                foreach ($request->file('new_files') as $file) {
                    $path = $file->store('public/project_files/'.Str::slug($project->name)); // Salvează fișierul în directorul de stocare
        
                    // Obține tipul MIME al fișierului
                    $mime = $file->getMimeType();
        
                    // Creează un nou record în baza de date pentru fiecare fișier
                    $project->files()->create([
                        'name' => $file->getClientOriginalName(),
                        'size' => $file->getSize() / 1024, // Dimensiunea în KB
                        'mime_type' => $mime, // Tipul MIME
                        'path' => $path,
                    ]);
                }
            }
        
            // Redirecționează cu un mesaj de succes
            return redirect()->back()->with('success', 'Files uploaded successfully.');
        }         
        public function file_manager(Project $project, $path = '')
        {
            // Utilize the 'project-files' disk configured for project files
            $disk = Storage::disk('project-files');
        
            // Set the base path to the project slug (root directory)
            $basePath = str_replace(' ', '-', $project->slug); // Safe project directory name
        
            // Set the safePath to include only the project slug as the root
            // and append the provided path directly
            $safePath = trim($basePath . '/' . trim($path, '/'), '/');

            // Prevent access to invalid or malicious paths
            if (strpos($path, '..') !== false || strpos($path, '\\') !== false || strpos($path, '//') !== false) {
                abort(403, 'Access denied.');
            }
        
            // Fetch directories and files specific to the current project directory
            $directories = $disk->directories($safePath);
            $files = $disk->files($safePath);
        
            // Return the view with the relevant data
            return view('projects.file-manager', compact('directories', 'files', 'path', 'project'));
        }
        

    public function show($path)
        {
            if (Storage::exists($path)) {
                // Returnează conținutul fișierului, poți modifica header-ul dacă e necesar
                return response(Storage::get($path))->header('Content-Type', Storage::mimeType($path));
            }
            return abort(404, 'Fișierul nu a fost găsit.');
        }
    public function createDirectory(Request $request, Project $project)
        {
            // Validează cererea
            $request->validate([
                'path' => 'required|string',
                'directory_name' => 'required|string'
            ]);
            $path = $request->input('path');
            $directoryName = $request->input('directory_name');
            // Asigură-te că calea este sigură
            $fullPath = trim( $path.'/'. $directoryName, '/');
            // Creează directorul nou
            if (Storage::disk('project-files')->makeDirectory($fullPath)) {
                return redirect()->route('project_file-manager.index', ['project' => $project->id,'path' => $path])
                                ->with('success', 'Directorul a fost creat cu succes!');
            } else {
                return redirect()->route('project_file-manager.index', ['project' => $project->id,'path' => $path])
                                ->with('error', 'A apărut o eroare la crearea directorului.');
            }
        }
}
