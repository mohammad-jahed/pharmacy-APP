<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\NearestPharmaciesRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserController extends BaseUser
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


}
