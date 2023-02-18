<?php

namespace App\Http\Controllers;

use App\Http\Requests\Speaker\StoreRequest;
use App\Http\Requests\Speaker\UpdateRequest;
use App\Http\Requests\UpdateSpeakerRequest;
use App\Speaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SpeakerController extends Controller
{
    public function index()
    {
        $speakers = Auth::user()->speakers->sortByDesc('id');
        return view('speakers.index', compact('speakers'));
    }

    public function create()
    {
        return view('speakers.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->applyAvatar($validated);
            Auth::user()->speakers()->create($validated);
            return redirect()->route('speakers.index')->with('message', 'Speaker successfully created');
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->route('speakers.index')->with('error-message', 'Something error please retry again!');
        }
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

    public function update(StoreRequest $request, Speaker $speaker)
    {
        try {
            $validated = $request->validated();
            $this->applyAvatar($validated);
            $speaker->update($validated);
            return redirect()->route('speakers.index')->with('message', 'Speaker successfully updated');
        } catch (\Throwable $e) {
            return redirect()->route('speakers.index')->with('error-message', 'Something error please retry again!');
        }
    }

    public function destroy(Speaker $speaker)
    {
        try {
            $isAlready = Speaker::isAlready($speaker);
            if ($isAlready) {
                return redirect()->route('speakers.index')->with('error-message', 'This speaker is used');
            }
            $speaker->delete();
            if (config('constants.common.default_avatar_image') != $speaker->getAttribute('avatar')) {
                File::delete($speaker->getAttribute('avatar'));
            }
            return redirect()->route('speakers.index')->with('message', 'Speaker successfully deleted');
        } catch (\Throwable $e) {
            return redirect()->route('speakers.index')->with('error-message', 'Something error please retry again!');
        }
    }

    public function applyAvatar(&$validated)
    {
        if (!empty($validated['avatar'])) {
            $store_path = 'images\avatar';
            $full_path = public_path($store_path);
            $image_path = $this->uploadAvatar($validated['avatar'], $full_path);
            $validated['avatar'] = $store_path . "\\" . $image_path;
        }
    }

    public function removeAvatar(Speaker $speaker)
    {
        try {
            $avatarUrl = $speaker->getAttribute('avatar');
            if (config('constants.common.default_avatar_image') != $avatarUrl && !empty($avatarUrl)) {
                $speaker->update(['avatar' => null]);
                File::delete($avatarUrl);
                return redirect()->route('speakers.edit', $speaker)->with('message', 'Remove Avatar Success');
            }
            return redirect()->route('speakers.index')->with('error-message', 'Something error please retry again!');
        } catch (\Throwable $e) {
            return redirect()->route('speakers.index')->with('error-message', 'Something error please retry again!');
        }
    }
}
