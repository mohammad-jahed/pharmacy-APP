<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Users\NearestPharmaciesRequest;
use App\Http\Requests\Users\PharmacyFilterRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserControllerController extends BaseUserController
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        $users = User::type('User')->get();
        return view('pages.Users.users', compact('users'));
    }


    public function destroy(User $user): RedirectResponse
    {
        $users = $user->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('users.index', compact('users'));
    }

    /**
     * @throws AuthorizationException
     */
    public function theNearestPharmacies(NearestPharmaciesRequest $request): JsonResponse
    {
        /**
         * @var array $result;
         */
        $this->authorize('nearestPharmacies', User::class);
        $data = $request->validated();
        foreach ($data['medicines'] as $medicineData) {
            $pharmacies = User::query()->whereHas('medicines', function (Builder $builder) use ($medicineData, $data) {
                $builder->where('name_' . app()->getLocale(), 'like', "%$medicineData%")->whereHas('users', function (Builder $builder) use ($data) {
                    $builder->whereHas('address', function (Builder $builder) use ($data) {
                        $builder->where('area_id', $data['area_id']);
                    });
                });
            })->get();

            $response = [
                'medicine' => $medicineData,
                'The Nearest Pharmacies' => $pharmacies
            ];
            $result[] = $response;
        }

        return self::getJsonResponse($result, "the nearest pharmacies");
    }

    /**
     * @throws AuthorizationException
     */
    public function userFilter(PharmacyFilterRequest $request): JsonResponse
    {
        $this->authorize('viewAny',User::class);
        $data = $request->validated();

        /** @var User $pharmacies */
        if (isset($data['state_name'])) {
            $pharmacies = User::type('User')->whereHas('address',
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
            $pharmacies = User::type('User')->whereHas('address',
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
            $pharmacies = User::type('User')->whereHas('address',
                function (Builder $builder) use ($data) {
                    $builder->whereHas('area',
                        function (Builder $builder) use ($data) {
                            $builder->where('name_' . app()->getLocale(), $data['area_name']);
                        }
                    );
                }
            )->get();
        }
        return self::getJsonResponse($pharmacies,'users');
    }


}
