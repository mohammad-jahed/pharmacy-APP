<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\AuthRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\WorkTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use function auth;
use function response;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(AuthRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (! $token = auth('api')->attempt($data)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $file_name = null;
        if($request->hasFile('imagePath')){
            $request->file('imagePath')->store('public/images');
            $file_name = $request->file('imagePath')->hashName();
        }
        $data['imagePath'] = $file_name;
        //$data['password'] = Hash::make($data['password']);
        $user = User::query()->create($data);
        $data['user_id'] = $user->id;
        Address::query()->create($data);
        //WorkTime::query()->create($data);
        $role = Role::query()->where('name', 'like', 'User')->get();
        $user->assignRole($role);
        return $this->getJsonResponse($user,'User successfully registered');
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('api')->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->createNewToken(auth('api')->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function userProfile(): JsonResponse
    {
        return response()->json(auth('api')->user());
    }
    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function createNewToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory($token)->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }
}
