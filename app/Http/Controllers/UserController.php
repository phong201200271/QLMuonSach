<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Jobs\SendMail;
use App\Mail\RegisterMail;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    protected $userRepository;

    /**
     * @param $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getRegister()
    {
        return view('register');
    }

    public function getViewLogin() {
        return view('login');
    }

    public function getViewForgotPassword() {
        return view('forgotPassword');
    }

    public function getView403() {
        return view('error.403');
    }

    public function getViewNoticeVerifyEmail() {
        return view('noticeVerifyEmail');
    }

    public function getViewNoticeForgotPassword() {
        return view('noticeForgotPassword');
    }

    public function getViewResetPassword() {
        return view('resetPassword');
    }

    public function getViewUserInformation() {
        return view('userInformation');
    }

    public function register(Request $request) {
        try {
            $validation = Validator::make($request->all(),[
                'name' => 'required',
                'mail' => 'required|email',
                'address' => 'required',
                'password' => ['required',Password::min(8)->mixedCase()->numbers()->symbols()],
                'confirmPassword' => 'required'
            ],[
                'name.required' => @trans('message.nameRequired'),

                'mail.required' => @trans('message.mailRequired'),
                'mail.email' => @trans('message.mailEmail'),

                'address.required' => @trans('message.addressRequired'),

                'password.required' => @trans('message.passwordRequired'),

                'confirmPassword.required' => @trans('message.confirmPasswordRequired'),
            ]);

            if ($request->input('password') !== $request->input('confirmPassword')) {
                $validation->errors()->add('confirmPassword',@trans('message.passwordNotMatch'));
            }

            $checkEmailExist = $this->userRepository->getUserByMail($request->input('mail'));
            if ($checkEmailExist->isNotEmpty()) {
                $validation->errors()->add('mail',@trans('message.mailExist'));
            }

            if (count($validation->errors()) > 0) {
                return view('register',['error'=>$validation->errors()]);
            }

            $user = new User();

            $user->name = $request->input('name');
            $user->mail = $request->input('mail');
            $user->password = bcrypt($request->input('password'));
            $user->address = $request->input('address');
            $user->remember_token = Str::random(40);
            $user->status = User::statusInactive;

            $userRegister = $this->userRepository->add($user);

            $url = url('/verify/email/'.$user->remember_token);

            $this->dispatch(new SendMail($userRegister,'verifyAccount',$url));

            return redirect()->route('noticeVerifyEmail')->with('user',$user);
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function verifyEmail($token) {
        try {
            $user = $this->userRepository->getUserByToken($token);
            if ($user) {
                $user[0]->status = User::statusNormal;
                $user[0]->remember_token = '';
                $this->userRepository->update($user[0]);
                return redirect('login')->with('success',@trans('message.activeAccountSuccessfully'));
            }else {
                return view('error.404');
            }
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function resendVerifyEmail(Request $request) {
        try {
            $user = $this->userRepository->getUserByMail($request->input('mail'))[0];
            if ($user) {
                $user->remember_token = Str::random(40);
                $this->userRepository->update($user);

                $url = url('/verify/email/'.$user->remember_token);

                $this->dispatch(new SendMail($user,'verifyAccount',$url));

                return back()->with(['user'=>$user,'success'=>@trans('message.resendVerifyEmailSuccessfully')]);
            }
            else {
                return view('404');
            }
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function forgotPassword(Request $request) {
        try {
            $user = $this->userRepository->getUserByMail($request->input('mail'))[0];
            if (!$user) {
                return back()->with('userNotExist',@trans('message.userNotExist'));
            }
            $user->remember_token = Str::random(40);
            $this->userRepository->update($user);

            $url = route('redirectToPageResetPassword',['token'=>$user->remember_token]);
            $this->dispatch(new SendMail($user,'forgotPassword',$url));

            return redirect()->route('noticeForgotPassword')->with('user',$user);
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function redirectToPageResetPassword($token) {
        try {
            $user = $this->userRepository->getUserByToken($token)[0];
            if ($user) {
                return redirect()->route('resetPassword')->with(['user'=>$user,'token'=>$token]);
            }
            else {
                return view('404');
            }
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function resetPassword(Request $request) {
        try {
            $validation = Validator::make($request->all(),[
                'password' => 'required',
                'confirmPassword' => 'required'
            ], [
                'password.required' => @trans('message.passwordRequired'),

                'confirmPassword.required' => @trans('message.confirmPasswordRequired')
            ]);

            if ($request->input('password') !== $request->input('confirmPassword')) {
                $validation->errors()->add('confirmPassword',@trans('message.passwordNotMatch'));
            }

            if (count($validation->errors()) > 0) {
                return back()->with('errorValidate',$validation->errors());
            }

            $user = $this->userRepository->getUserByToken($request->input('token'))[0];

            if ($user) {
                $user->password = bcrypt($request->input('password'));
                $user->remember_token = '';
                $this->userRepository->update($user);
                return redirect()->route('login')->with('success',@trans('message.resetPasswordSuccessfully'));
            }
            else {
                return view('404');
            }
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function resendResetPassword(Request $request) {
        try {
            $user = $this->userRepository->getUserByMail($request->input('mail'))[0];
            if ($user) {
                $user->remember_token = Str::random(40);
                $this->userRepository->update($user);

                $url = route('redirectToPageResetPassword',['token'=>$user->remember_token]);
                $this->dispatch(new SendMail($user,'forgotPassword',$url));

                return back()->with(['user'=>$user,'success'=>@trans('message.resendResetPasswordSuccessfully')]);
            }
            else {
                return view('404');
            }
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function getAllUser() {
        try {
            $users = $this->userRepository->getAllUser();
            return $users;
        }catch (\Exception $e) {
            return response()->json(['error'=>$e]);
        }
    }

    public function showAllUser() {
        try {
            $users = $this->userRepository->getAllUser();
            return view('admin.manageUser',['users'=>$users]);
        }catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    public function editProfile(Request $request) {
        try {
            $validation = Validator::make($request->all(),[
                'name' => 'required',
                'dob' => 'required|date_format:d/m/Y',
                'address' => 'required'
            ],[
                'name.required' => @trans('message.nameRequired'),

                'dob.required' => @trans('message.dobRequired'),
                'dob.date_format' => @trans('message.dobDateFormat'),

                'address.required' => @trans('message.addressRequired')
            ]);

            if ($validation->fails()) {
                return response()->json(['errorValidate'=>$validation->errors()]);
            }

            $user = $this->userRepository->find($request->input('userId'));

            $user->name = $request->input('name');

            $dob = Carbon::createFromFormat('d/m/Y',$request->input('dob'))->format('Y/m/d');
            $user->dob = $dob;

            $user->address = $request->input('address');

            $this->userRepository->update($user);

            \session()->put('user',$user);

            return response()->json(['success'=>@trans('message.updateInformationSuccessfully')]);
        }catch (\Exception $e) {
            return response()->json(['error'=>$e]);
        }
    }

    public function lockUser(Request $request) {
        try {
            $user = $this->userRepository->find($request->input('id'));

            $user->status = User::statusLock;

            $this->userRepository->update($user);

            return response()->json(['success'=>@trans('message.lockUserSuccessfully')]);
        }catch (\Exception $e) {
            return response()->json(['error'=>$e]);
        }
    }

    public function unlockUser(Request $request) {
        try {
            $user = $this->userRepository->find($request->input('id'));

            $user->status = User::statusNormal;

            $this->userRepository->update($user);

            return response()->json(['success'=>@trans('message.unlockUserSuccessfully')]);
        }catch (\Exception $e) {
            return response()->json(['error'=>$e]);
        }
    }

    public function filterUser(Request $request) {
        try {
            $resultFilter = $this->userRepository->filterUser($request->all());
            return $resultFilter;
        }catch (\Exception $e) {
            return response()->json(['error'=>$e]);
        }
    }
}
