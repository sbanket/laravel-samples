<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Transformer\UserEntityToTransformer;
use App\Http\Controllers\Controller;
use App\Service\UserService;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Auth
 */
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var UserEntityToTransformer
     */
    protected $transformer;

    /**
     * Create a new controller instance.
     *
     * @param UserService             $userService
     * @param UserEntityToTransformer $transformer
     */
    public function __construct(UserService $userService, UserEntityToTransformer $transformer)
    {
        $this->userService = $userService;
        $this->transformer = $transformer;
        $this->middleware('guest');
    }

    /**
     * @param Request     $request
     * @param null|string $token
     *
     * @return $this
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('app/auth/password/reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param  CanResetPassword|User $user
     * @param  string                $password
     *
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $userDto = $this->transformer->fromEntity($user);
        $this->userService->updatePassword($userDto, $password);
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  string $response
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse($response)
    {
        flash()->success(trans($response));

        return redirect($this->redirectPath());
    }
}
