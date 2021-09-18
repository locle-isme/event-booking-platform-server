<?php

namespace App\Http\Controllers;

use App\Http\Requests\Speaker\StoreRequest;
use App\Http\Requests\Speaker\UpdateRequest;
use App\Http\Requests\UpdateSpeakerRequest;
use App\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mockery\Exception;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::all();
        return view('speakers.index', compact('speakers'));
    }

    public function create()
    {
        return view('speakers.create');
    }

    public function store(StoreRequest $request)
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

    public function edit(Speaker $speaker)
    {
        return view('speakers.edit', compact('speaker'));
    }

    public function update(UpdateRequest $request, Speaker $speaker)
    {
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

    public function destroy(Speaker $speaker)
    {
        $isExist = $speaker->sessionSpeakers()->count();
        if ($isExist) {
            return redirect()->route('speakers.index')->with('error-message', 'This speaker is used');
        }
        $speaker->delete();
        File::delete($speaker->avatar);
        return redirect()->route('speakers.index')->with('message', 'Speaker successfully deleted');
    }
}
