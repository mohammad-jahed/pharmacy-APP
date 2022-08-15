<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\BaseUser;
use App\Http\Requests\Users\PharmacyFilterRequest;
use App\Models\State;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
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

    public function allPharmacies(): JsonResponse
    {
        $pharmacies = User::type('Pharmacy')->with('address')->get();
        return self::getJsonResponse($pharmacies,'pharmacies');
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


    /**
     * @throws AuthorizationException
     */
    public function pharmacyFilter(PharmacyFilterRequest $request): JsonResponse
    {
        $this->authorize('viewAny',User::class);
        $data = $request->validated();

        /** @var User $pharmacies */
        if (isset($data['state_name'])) {
            $pharmacies = User::type('Pharmacy')->whereHas('address',
                function (Builder $builder) use ($data) {
                    $builder->whereHas('state',
                        function (Builder $builder) use ($data) {
                            $builder->where('name_' . app()->getLocale(), $data['state_name']);
                        }
                    );
                }
            )->get();

        }
        if (isset($data['city_name'])) {
            $pharmacies = User::type('Pharmacy')->whereHas('address',
                function (Builder $builder) use ($data) {
                    $builder->whereHas('city',
                        function (Builder $builder) use ($data) {
                            $builder->where('name_' . app()->getLocale(), $data['city_name']);
                        }
                    );
                }
            )->get();
        }
        if (isset($data['area_name'])) {
            $pharmacies = User::type('Pharmacy')->whereHas('address',
                function (Builder $builder) use ($data) {
                    $builder->whereHas('area',
                        function (Builder $builder) use ($data) {
                            $builder->where('name_' . app()->getLocale(), $data['area_name']);
                        }
                    );
                }
            )->get();
        }
        if (isset($data['street'])) {
            $pharmacies = User::type('Pharmacy')->whereHas('address',
                function (Builder $builder) use ($data) {
                    $builder->where('street', $data['street']);
                }
            )->get();
        }
        if(isset($data['day_off'])){
            $pharmacies = User::type('Pharmacy')->whereHas('workTime',
                fn(Builder $builder)=> $builder->where('day',$data['day_off'])
            )->get();
        }
        return self::getJsonResponse($pharmacies,'pharmacies');
    }


}
