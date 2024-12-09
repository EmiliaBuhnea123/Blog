<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    protected function handleAvatar($avatar)
    {
        if ($avatar) {
            $path = $avatar->store('avatars', 'public');
            return $path; 
        }
        return null; 
    }

    public function create()
    {
        return view('pages.profile.create');
    }

    public function store(ProfileRequest $request){
        $validatedData = $request->validated();

        $avatarPath = null;
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $avatarPath = $this->handleAvatar($request->file('avatar'));
        }

       Profile::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'avatar' => $avatarPath, 
            'user_id' => auth()->user()->id, 
        ]);

        return redirect()->route('home')->with('status', 'Profilul a fost creat cu succes!');

    }

    public function show($id)
    {

        $profiles = Profile::where('user_id', $id)->firstOrFail();

        if (Gate::denies('view-profile', $profiles)) {
            abort(403, 'Nu ai permisiunea să accesezi acest profil.');
        }

        return view('pages.profile.show', [
            'profiles' => $profiles,
        ]);
    }

    public function edit(int $id)
    {
        $profile = Profile::findOrFail($id);

        $this->authorize('update', $profile);

        return view('pages.profile.edit', [
            'profile' => $profile,
        ]);
    }

    public function update(ProfileRequest $request, $id)
    {
        $validateData = $request->validated();

        $profile = Profile::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $this->authorize('update', $profile);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validateData['avatar'] = $path;
        }
    
        $profile->update($validateData);
        session()->flash('success', 'Profilul a fost editat cu succes!');
        return redirect()->route('profile.show', ['id' => auth()->user()->id]);
    }

}
