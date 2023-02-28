<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Organizer\StoreRequest;
use App\Http\Requests\Organizer\UpdateRequest;
use App\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class OrganizerController extends BaseController
{
    protected $organizerM = null;

    public function __construct()
    {
        parent::__construct();
        $this->organizerM = new Organizer();
    }

    public function index(Request $request)
    {
        $this->prepare($request);
        $limit = $request->get('limit');
        $organizers = $this->organizerM->query()->paginate($limit);
        return view('admin.index', [
            'organizers' => $organizers,
        ]);
    }

    public function edit(Organizer $organizer)
    {
        return view('admin.organizers.edit', [
            'organizer' => $organizer,
        ]);
    }

    public function forceLogin(Organizer $organizer)
    {
        Auth::guard('organizer')->loginUsingId($organizer['id']);
        return redirect()->route('home');
    }

    public function create()
    {
        return view('admin.organizers.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $companyName = $data['name'];
            $slug = str_slug($companyName . '-' . uniqid());
            $data['active'] = !empty($data['active']) ? $data['active'] : 0;
            $data['password_hash'] = bcrypt($data['password']);
            $data['slug'] = $slug;
            unset($data['password']);
            $result = Organizer::query()->create($data);
            if (empty($result)) {
                return back()->withInput()->with('error-message', 'Create new organizer failed');
            }
            return redirect()->route('admin.home')->with('message', 'Organizer successfully created');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error-message', 'Create new organizer failed');
        }
    }


    public function update(UpdateRequest $request, Organizer $organizer)
    {
        try {
            $data = $request->validated();
            $data['active'] = !empty($data['active']) ? $data['active'] : 0;
            if (!empty($data['password'])) {
                $data['password_hash'] = bcrypt($data['password']);
            }
            unset($data['password'], $data['email']);
            $result = $organizer->update($data);
            if (empty($result)) {
                return back()->withInput()->with('error-message', 'Update this organizer failed');
            }
            return redirect()->route('admin.home')->with('message', 'Organizer successfully updated');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error-message', 'Update this organizer failed');
        }
    }

    public function active(Request $request, Organizer $organizer)
    {
        try {
            $active = $request->input('active', 0);
            $active = $active == 'true' ? 1 : 0;
            $data = [
                'active' => $active,
            ];
            $result = $organizer->update($data);
            if (empty($result)) {
                return response()->json(['message' => 'Update failed'], 400);
            }
            return response()->json(['message' => 'Update Successfully']);
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Update failed'], 400);
        }
    }
}
