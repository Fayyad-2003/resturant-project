<?php

namespace App\Http\Requests\Admin\Coupon;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CouponUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $couponId = $this->route('coupon');

        return [
            'name' => ['required', 'unique:coupons,name,' . $couponId],
            'code' => ['required', 'unique:coupons,code,' . $couponId],
            'quantity' => ['required', 'numeric', 'min:1'],
            'min_purchase_amount' => ['required', 'numeric', 'min:0'],
            'expire_date' => ['required', 'date'],
            'discount_type' => ['required', 'in:percent,amount'],
            'discount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,deactive'],
        ];
    }
}
