<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetierRequest;
use Illuminate\Http\Request;
use App\Models\{Metier,};

class MetierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metiers = Metier::paginate(5);
        $data = [
            'title' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retrouver tous les métiers de la ' . config('app.name'),
            'metiers' => $metiers,
            'search' => '',
        ];

        return view('metiers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retrouver tous les métiers de la ' . config('app.name'),
            'search' => '',
        ];

        return view('metiers.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetierRequest $metierRequest)
    {
        $metierValidees = $metierRequest->all();
        Metier::create($metierValidees);
        $info = "La compétence a été créée avec succès";
        return redirect()->route('metiers.index')->withInformation($info);
    }

    /**
     * Display the specified resource.
     *
     * @param  object $metier
     * @return \Illuminate\Http\Response
     */
    public function show(Metier $metier)
    {
        $data = [
            'title' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retrouver tous les métiers de la ' . config('app.name'),
            'metier' => $metier,
            'search' => '',
        ];

        return view('metiers.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  object $metier
     * @return \Illuminate\Http\Response
     */
    public function edit(Metier $metier)
    {
        $data = [
            'title' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retrouver tous les métiers de la ' . config('app.name'),
            'metier' => $metier,
            'search' => '',
        ];

        return view('metiers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  object MetierRequest
     * @param  object $metier
     * @return \Illuminate\Http\Response
     */
    public function update(MetierRequest $metierRequest, Metier $metier)
    {
        $metierValidees = $metierRequest->all();
        $metier->update($metierValidees);
        $info = "Le métier a été modifié avec succès";
        return redirect()->route('metiers.index')->withInformation($info);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object $metier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metier $metier)
    {

        $metier->delete();
        $info = "Le métier a été supprimé avec succès";
        return redirect()->route('metiers.index')->withInformation($info);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object $metier
     * @return \Illuminate\Http\Response
     */
    public function delete (Metier $metier)
    {
        $data = [
            'title' => 'Les métiers de la ' . config('app.name'),
            'description' => 'Retrouver tous les métiers de la ' . config('app.name'),
            'metier' => $metier,
            'search' => '',
        ];

        return view('metiers.delete', $data);


    }
}
