<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpeakerRequest;
use App\Http\Requests\UpdateSpeakerRequest;
use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mockery\Exception;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $speakers = Speaker::all();
        return view('speakers.index', compact('speakers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('speakers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSpeakerRequest $request)
    {
        $validated = $request->validated();
        $store_path = 'images\avatar';
        $full_path = public_path($store_path);
        $image_path = $this->uploadAvatar($validated['avatar'], $full_path);
        $validated['avatar'] = $store_path . "\\" . $image_path;
        Speaker::create($validated);
        return redirect()->route('speakers.index')->with('message', 'Speaker successfully created');
    }

    protected function uploadAvatar($imageClass, $full_path)
    {
        $image_name = time() . '.' . $imageClass->getClientOriginalExtension();
        $imageClass->move($full_path, $image_name);
        return $image_name;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Speaker $speaker
     * @return \Illuminate\Http\Response
     */
    public function show(Speaker $speaker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Speaker $speaker
     * @return \Illuminate\Http\Response
     */
    public function edit(Speaker $speaker)
    {
        //
        return view('speakers.edit', compact('speaker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Speaker $speaker
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpeakerRequest $request, Speaker $speaker)
    {
        //
        $validated = $request->validated();
        if (isset($validated['avatar'])) {
            $store_path = 'images\avatar';
            $full_path = public_path($store_path);
            $image_path = $this->uploadAvatar($validated['avatar'], $full_path);
            $validated['avatar'] = $store_path . "\\" . $image_path;
        }

        $speaker->update($validated);
        return redirect()->route('speakers.index')->with('message', 'Speaker successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Speaker $speaker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speaker $speaker)
    {
        //
        $isExist = $speaker->sessionSpeakers()->count();
        if ($isExist) {
            return redirect()->route('speakers.index')->with('error-message', 'This speaker is used');
        }

        $speaker->delete();
        File::delete($speaker->avatar);
        return redirect()->route('speakers.index')->with('message', 'Speaker successfully deleted');


    }
}
