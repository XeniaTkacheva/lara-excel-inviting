<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTenantRequest;
use App\Http\Requests\StoreTenantRequest;
use App\Models\User;
use App\Notifications\TenantInviteNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = User::where('role_id', 2)->get();
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTenantRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTenantRequest $request)
    {
        $user = User::create($request->validated()
            + ['role_id' => 2, 'password' => 'secret']);

        $url = URL::signedRoute('invitation', $user);

        $user->notify(new TenantInviteNotification($url));

        return redirect()->route('tenants.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $tenant
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTenantRequest $request
     * @param User $tenant
     * @return RedirectResponse
     */
    public function update(UpdateTenantRequest $request, User $tenant)
    {
        $tenant->update($request->validated());

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $tenant
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $tenant)
    {
        $tenant->delete();

        return redirect()->route('tenants.index');
    }

    /**
     *
     * @param User $user
     * @return RedirectResponse
     */
    protected function invitation(User $user)
    {
        if (!request()->hasValidSignature() || $user->password != 'secret') {
            abort(401);
        }
        $user->update(['email_verified_at' => 'now']);

        auth()->login($user);

        return redirect()->route('home');
    }
}
