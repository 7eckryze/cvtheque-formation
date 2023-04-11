<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompetenceRequest;
use App\Models\{Competence,};
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Différentes manières de récupérer les données
        //$competences = Competence::all();
        //$competences = Competence::get();
        //$competences = Competence::all('intitule');
        //$competences = Competence::orderBy('intitule', 'desc')->get();
        //$competences = Competence::orderByDesc('id')->get();
        //$competences = Competence::where('intitule', '=', 'scrum')->get();
        //$competences = Competence::where('created_at', '>=', '2020-05-02')->get();
        //$competences = Competence::where('intitule', 'LIKE', '%sql')->get();

        //Différentes manières de limiter le nombre de résultats, mais le résultat est le même
        //$competences = Competence::orderBy('intitule', 'desc')->take(5)->get();
        //$competences = Competence::orderBy('intitule', 'desc')->limit(5)->get();

        //$competences = Competence::count();
        //dd($competences); //dump and die

        //1ʳᵉ façon de récupérer les données
        //$competences = Competence::get();
        //return view('competences.index', compact('competences'));

        //2ᵉ façon de récupérer les données
        if ($request->input('search')) {
            $competences = Competence::where('intitule', 'LIKE', '%' . $request->input('search') . '%')->orderBy('intitule')->paginate(5);
        } else {
            $competences = Competence::orderBy('intitule')->paginate(5);
        }

        $data = [
            'title' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Retrouver toutes les compétences de la ' . config('app.name'),
            'competences' => $competences,
            'search' => $request->input('search') ?: '',
            ];

        return view('competences.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        // FORMULAIRE VIERGE
        $data = [
            'title' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Retrouver toutes les compétences de la ' . config('app.name'),
            'search' => '',
        ];

        return view('competences.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompetenceRequest $competenceRequest)
    {
        // INSERT
        //echo 'store';
        $competenceValidees = $competenceRequest->all();
        //dd($competenceValidees);
        Competence::create($competenceValidees);
        $info = "La compétence a été créée avec succès";
        return redirect()->route('competences.index')->withInformation($info);
    }

    /**
     * Display the specified resource.
     *
     * @param object $competence
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Competence $competence)
    {
        //dd($competence);

        $data = [
            'title' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Retrouver toutes les compétences de la ' . config('app.name'),
            'competence' => $competence,
        'search' => '',
        ];


        return view('competences.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param object $competence
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Competence $competence)
    {

        $data = [
            'title' => 'Les compétences de la ' . config('app.name'),
            'description' => 'Retrouver toutes les compétences de la ' . config('app.name'),
            'competence' => $competence,
            'search' => '',
        ];

        return view('competences.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Object CompetenceRequest
     * @param object $competence
     * @return \Illuminate\Http\Response
     */
    public function update(CompetenceRequest $competenceRequest, Competence $competence)
    {
        $competenceValidees = $competenceRequest->all();
        $competence->update($competenceValidees);
        $info = "La compétence a été modifié avec succès";
        return redirect()->route('competences.index')->withInformation($info);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param object $competence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competence $competence)
    {
        $competence->delete();
        $info = "La compétence a été supprimé avec succès";
        return back()->withInformation($info);
    }

}
