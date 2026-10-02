<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255', 'unique:products,name'],
            'category_id' => ['required', 'exists:categories,id'],
            'main_image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,webp', 'max:2048'],
            'short_description' => ['required', 'string', 'max:500'],
            'long_description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'offer_price' => ['nullable', 'numeric', 'min:0', 'max:999999.99', 'lt:price'],
            'sku' => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'status' => ['required', 'boolean'],
            'show_at_home' => ['nullable', 'boolean'],
            'seo_title' => ['nullable', 'string', 'max:60'],
            'seo_description' => ['nullable', 'string', 'max:160'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.unique' => 'A product with this name already exists.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category is invalid.',
            'main_image.required' => 'Product image is required.',
            'main_image.image' => 'The file must be an image.',
            'main_image.mimes' => 'Image must be: jpeg, jpg, png, gif, or webp.',
            'main_image.max' => 'Image size must not exceed 2MB.',
            'short_description.required' => 'Short description is required.',
            'short_description.max' => 'Short description must not exceed 500 characters.',
            'long_description.required' => 'Full description is required.',
            'price.required' => 'Regular price is required.',
            'price.numeric' => 'Price must be a valid number.',
            'price.min' => 'Price must be at least 0.',
            'offer_price.numeric' => 'Offer price must be a valid number.',
            'offer_price.lt' => 'Offer price must be less than regular price.',
            'sku.unique' => 'A product with this SKU already exists.',
            'status.required' => 'Please select a status.',
            'seo_title.max' => 'SEO title must not exceed 60 characters.',
            'seo_description.max' => 'SEO description must not exceed 160 characters.',
        ];
    }
}
