<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $memberId = $this->route('member')->id ?? $this->route('member');

        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes', //Request ထဲမှာ email field ပါလာတဲ့အခါမှာပဲ စစ်ပါ ဆိုတဲ့အဓိပ္ပါယ်။
                'required',
                'email',
                Rule::unique('members', 'email')->ignore($memberId)
                //members table ထဲက email column ကို စစ်ပြီးထပ်တူမရှိရပါဘူး။
                //ဒါပေမဲ့ $memberId နဲ့တူတဲ့ record ကိုတော့ စစ်မယ်မဟုတ်။ တူတဲ့ email မရှိရ, ကိုယ့်ဟောင်း email ကိုမစစ်
            ],
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'membership_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:active,inactive',
        ];
    }
}
