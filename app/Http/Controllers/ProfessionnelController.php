<?php

namespace App\Http\Controllers;

use App\Http\Requests\{ProfessionnelRequest,};
use App\Models\{Competence, Metier, Professionnel,};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request, $slug = null)
    {

        if ($request->input('search')) {
            //Version ChatGPT
//            $professionnels = Professionnel::whereRaw("concat_ws(' ', prenom, nom) LIKE ?", ['%' . $request->input('search') . '%'])
//                ->orderBy('prenom')
//                ->paginate(5);
            //Version Thierry
            $professionnels = Professionnel::where(DB::raw('CONCAT(prenom, " ", nom)'), 'LIKE', '%' . $request->input('search') . '%')
                ->orderBy('prenom')
                ->paginate(5);

        } elseif ($request->input('comp')) {
            $comp = $request->input('comp');
            $professionnels = Professionnel::whereIn('id', function ($query) use ($comp) {
                $query->select('professionnel_id')
                    ->from('competence_professionnel')
                    ->whereIn('competence_id', function ($subquery) use ($comp) {
                        $subquery->select('id')
                            ->from('competences')
                            ->where('intitule', 'LIKE', '%' . $comp . '%');
                    });
            })->paginate(5);


        }else {
            $professionnels = $slug ? Metier::where('slug', $slug)->firstOrFail()->professionnels()->paginate(5) : Professionnel::paginate(5);
        }

        //Pour alimentation de la zone Select (Tous les métiers)
        $metiers = Metier::all();

        $data = [
            'title' => 'Les professionnels de la ' . config('app.name'),
            'description' => 'Retrouver toutes les professionnels de la ' . config('app.name'),
            'professionnels' => $professionnels,
            'metiers' => $metiers,
            'slug' => $slug,
            'search' => $request->input('search') ?: '',
            'comp' => $request->input('comp') ?: '',

        ];

        return view('professionnels.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $professionnelRequest
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessionnelRequest $request)
    {
        $validationData = $request->all();
        $validationData['domaine'] = implode(',', $request->input('domaine'));

        $pdf = $request->file('pdf');
        if ($pdf) {
            // Génère le nouveau nom de fichier
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
            $date = date('dmY');
            $extension = $pdf->getClientOriginalExtension();
            $newFilename = $prenom . '_' . $nom . '_' . $date . '.' . $extension;

            // Stocke le fichier PDF dans le dossier "pdf" de votre espace de stockage public
            $pdfPath = $pdf->storeAs('pdf', $newFilename, 'public');

            // Ajoute le nom de fichier PDF au champ "pdf" du tableau $validationData
            $validationData['pdf'] = $newFilename;
        }

        $newProfessionnel = Professionnel::create($validationData);
        $newProfessionnel->competences()->attach($request->comp);

        $info = "Le professionnel a été créé avec succès";
        return redirect()->route('professionnels.index')->withInformation($info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $competences = Competence::orderBy('intitule')->get();
        $metiers = Metier::orderBy('libelle')->get();

        $data = [
            'title' => 'Les professionnels de la ' . config('app.name'),
            'description' => 'Retrouver toutes les professionnels de la ' . config('app.name'),
            'metiers' => $metiers,
            'competences' => $competences,
            'search' => '',
        ];

        return view('professionnels.create', $data);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(professionnel $professionnel)
    {
        $professionnel->domaine = explode(',', $professionnel->domaine);
        $pdfPath = $professionnel->pdf ? asset('storage/pdf/' . $professionnel->pdf) : null;
        $data = [
            'title' => 'Les professionnels de la ' . config('app.name'),
            'description' => 'Retrouver toutes les professionnels de la ' . config('app.name'),
            'professionnel' => $professionnel,
            'search' => '',
            'pdfPath' => $pdfPath,
        ];

        return view('professionnels.show', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Professionnel $professionnel)
    {
        $professionnel->domaine = explode(',', $professionnel->domaine);
        $metiers = Metier::orderBy('libelle')->get();
        $competences = Competence::orderBy('intitule')->get();
        $pdfPath = $professionnel->pdf ? asset('storage/pdf/' . $professionnel->pdf) : null;

        $data = [
            'title' => 'Les professionnels de la ' . config('app.name'),
            'description' => 'Retrouver toutes les professionnels de la ' . config('app.name'),
            'professionnel' => $professionnel,
            'metiers' => $metiers,
            'metier' => $professionnel->metier->libelle,
            'competences' => $competences,
            'search' => '',
            'pdfPath' => $pdfPath,
        ];

        return view('professionnels.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, professionnel $professionnel)
    {
        // Créez une instance de ProfessionnelRequest et validez la requête
        $professionnelRequest = new ProfessionnelRequest();
        $request->validate($professionnelRequest->rules());

        $validationData = $request->all();
        $validationData['domaine'] = implode(',', $request->input('domaine'));

        $pdf = $request->file('pdf');
        if ($pdf) {
            if ($professionnel->pdf) {
                Storage::disk('public')->delete('pdf/' . $professionnel->pdf);
            }
            // Génère le nouveau nom de fichier
            $nom = $professionnel->nom;
            $prenom = $professionnel->prenom;
            $date = date('dmY');
            $extension = $pdf->getClientOriginalExtension();
            $newFilename = $prenom . '_' . $nom . '_' . $date . '.' . $extension;

            // Stocke le fichier PDF dans le dossier "pdf" de votre espace de stockage public
            $pdfPath = $pdf->storeAs('pdf', $newFilename, 'public');

            // Met à jour le champ "pdf" du modèle Professionnel avec le nouveau nom de fichier
            $validationData['pdf'] = $newFilename;
        }

        $professionnel->update($validationData);
        $professionnel->competences()->sync($request->comp);

        $info = "Le professionnel a été modifié avec succès";
        return redirect()->route('professionnels.index')->withInformation($info);
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(professionnel $professionnel)
    {
        unlink('storage/pdf/' . $professionnel->pdf);
        $professionnel->delete();
        $info = "Le professionnel a été supprimé avec succès";
        return redirect()->route('professionnels.index')->withInformation($info);
    }




}
