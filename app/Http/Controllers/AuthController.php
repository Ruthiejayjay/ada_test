<?php

namespace App\Http\Controllers;

use App\Enums\UserCountry;
use App\Http\Requests\StoreBillingRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Paymentdetails;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    public function index()
    {
        return User::all();
    }
    public function signup(StoreUserRequest $request)
    {
        try {

            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);

            $user = new User($validated);
            $user->save();
            $data = ['data' => $user, 'message' => 'User Created Successfully', 'success' => true];
            return response()->json($data, 201);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'User Not Created', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8)]
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['code' => 403, 'message' => 'invalid credentials'], 403);
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();

        return $user->createToken('auth_token')->plainTextToken;
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $user = User::find($id);
            $user->update($request->all());
            $data = ['data' => $user, 'message' => 'User Updated Successfully', 'success' => true];
            return response()->json($data, 200);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'User Not Updated', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
        }
    }

    public function show(User $user)
    {
        $user->load('events');
        return $user;
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message'=>'Deleted'], 200);
    }

    public function billing(StoreBillingRequest $request)
    {
        try {
            $details =  [
                'cvv' => $request->cvv,
                'card_number' => $request->card_number,
                'expriy_date' => $request->expiry_date,
            ];
            if (Paymentdetails::find(auth()->id())) {
                return response()->json(['message' => 'Already Exists'], 400);
            }
            $billingDetails = new Paymentdetails($request->validated());
            $billingDetails->token = Crypt::encryptString(json_encode($details));
            $billingDetails->user_id = auth()->id();
            $billingDetails->save();
            $data = ['data' => $billingDetails, 'message' => 'Billing Created Successfully', 'success' => true];
            return response()->json($data, 201);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'Billing Not Created', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
        }
    }

    public function getBilling($user)
    {
        try {

            $details =  Paymentdetails::find($user);
            $decrypted = Crypt::decryptString($details->token);
            $data = ['data' => json_decode($decrypted), 'message' => 'Billing Retrived Successfully', 'success' => true];
            return response()->json($data, 200);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'Billing Not Retrived', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
        }
    }
}
