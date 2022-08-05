<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\BaseUser;
use App\Models\State;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class
PharmacyController extends BaseUser
{

    /**
     * @throws AuthorizationException
     */
    public function index(): View|Factory|Application
    {
        $this->authorize('view', new User());
        $states = State::all();
        $pharmacies = User::type('Pharmacy')->get();

        return view('pages.pharmacy.pharmacy', compact('pharmacies'))
            ->with('states', $states);
    }


    public function destroy(User $pharmacy): RedirectResponse
    {
        $pharmacies = $pharmacy->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('pharmacy.index', compact('pharmacies'));
    }

    public function medicines(): JsonResponse
    {
        $user = auth()->user();
        $medicines = $user->medicines;
        return $this->getJsonResponse($medicines, "medicines");
    }


}
