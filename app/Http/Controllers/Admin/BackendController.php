<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class BackendController extends Controller
{
    public function userlist(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }
    public function userDestroy(User $User): RedirectResponse
    {
        $User->delete();
        return Redirect::route('admin.users')->with('status', 'user-updated');
    }
    
    public function userEdit(User $User)
    {
        return view('admin.users.edit', compact('User'));
    }
    public function userUpdate(Request $request, User $User)
    {
        $User->name = $request->name;
        $User->email = $request->email;
        $User->store_name = $request->store_name;
        $User->store_description = $request->store_description;
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('profile'), $imageName);
            $User->profile_pic = $imageName; // Save the image URL to the product
        }
        $User->save();
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }
    public function category(){
        $categories = Category::all();
        return view('admin.category.categoryview',compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($category, 200);
    }
 
    public function profile(Request $request)
    {
       
        return view('admin.profile', [
            'user' => $request->user(),
        ]);
    }
    public function profileupdate(ProfileUpdateRequest $request)
    {
        $user = $request->user();

        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('profile_pic')) {
            if ($user->profile_pic && file_exists(public_path('profile/'.$user->profile_pic))) {
                unlink(public_path('profile/'.$user->profile_pic));
            }

            $image = $request->file('profile_pic');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile'), $imageName);

            $user->profile_pic = $imageName;
        }

        $user->save();

        return Redirect::route('admin.profile.index')->with('status', 'profile-updated');
    }
    public function passwordUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::route('admin.profile.index')->with('status', 'profile-updated');
    }
 

}
