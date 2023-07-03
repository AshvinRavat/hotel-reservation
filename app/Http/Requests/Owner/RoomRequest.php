<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RoomRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $imageRequiredValidation = $this->imageRequiredValidation();

        return [
            'hotel_id' => ['required'],
            'category_id' => ['required'],
            'room_number' => ['required', 'string', 'max:12', 'regex:/^([a-zA-Z0-9 \']*)$/', 'unique:rooms,room_number'],
            "price" => ['required', 'integer'],
            "max_occupancy" => ['required', 'integer'],
            "description" => ['nullable', 'max:255'],
            "image" => [$imageRequiredValidation, 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function imageRequiredValidation()
    {
        $currentRouteName = Route::currentRouteName();
        return $currentRouteName == 'owner.room_store' ? 'required' : 'nullable';
    }
}
