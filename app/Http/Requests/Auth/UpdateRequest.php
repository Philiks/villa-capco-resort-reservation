<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'contact_number' => ['string', 'max:13', 'regex:'.User::CONTACT_NUMBER_REGEX],
            'email' => ['string', 'email', 'max:255'],
            'old_password' => ['nullable', Rules\Password::defaults(), function ($attribute, $value, $fail) {
                $user = auth()->user();
                if (!Hash::check($value, $user->password))
                    $fail('Current password does not match.');
            }],
            'new_password' => ['nullable', 'different:old_password', Rules\Password::defaults()],
        ];
    }
}
