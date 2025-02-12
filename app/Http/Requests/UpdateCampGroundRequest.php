<?php

namespace App\Http\Requests;

use App\Models\CampGround;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCampGroundRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|ulid',
            'name' => [
                'required',
                'string',
                function (string $attribute, mixed $value, Closure $fail) {
                    $camp_ground = CampGround::where('name', $value)->first();

                    if (!is_null($camp_ground) && $camp_ground->id !== $this->input('id')) {
                        $fail('Name must be a unique');
                    }
                }
            ],
            'address' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|file|mimes:jpeg,png,jpg',
            'status' => 'required|string',
            'location' => 'required|string',
            'elevation' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.required' => 'ID is required',
            'id.ulid' => 'ID must be a ulid',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'address.required' => 'Address is required',
            'address.string' => 'Address must be a string',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'image.required' => 'Image is required',
            'image.file' => 'Image must be an image file',
            'image.mimes' => 'Image must be an jpeg or png',
            'status.required' => 'Status is required',
            'status.string' => 'Status must be a string',
            'location.required' => 'Location is required',
            'location.string' => 'Location must be a string',
            'elevation.required' => 'Elevation is required',
            'elevation.numeric' => 'Elevation must be a number',
        ];
    }
}
