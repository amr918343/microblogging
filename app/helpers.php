<?php

use App\Enums\ResponseMethodEnum;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\{
    DB,
    Storage
};

function generalApiResponse(
    ResponseMethodEnum $method,
    $resource = null,
    $dataPassed = null,
    $customMessage = null,
    $customStatusMsg = 'success',
    $customStatus = 200,
    $additionalData = null
) {
    return match ($method) {
        ResponseMethodEnum::CUSTOM_SINGLE => !is_null($additionalData) ? $resource::make($dataPassed)->additional(['status' => $customStatusMsg, 'message' => $customMessage, 'additionalData' => $additionalData], $customStatus) : $resource::make($dataPassed)->additional(['status' => $customStatusMsg, 'message' => $customMessage], $customStatus),

        ResponseMethodEnum::CUSTOM_COLLECTION => !is_null($additionalData) ? $resource::collection($dataPassed)->additional(['status' => $customStatusMsg, 'message' => $customMessage, 'additionalData' => $additionalData], $customStatus) : $resource::collection($dataPassed)->additional(['status' => $customStatusMsg, 'message' => $customMessage], $customStatus),

        ResponseMethodEnum::CUSTOM => !is_null($additionalData) ? response()->json(['status' => $customStatusMsg, 'data' => $dataPassed, 'message' => $customMessage, 'additionalData' => $additionalData], $customStatus) : response()->json(['status' => $customStatusMsg, 'data' => $dataPassed, 'message' => $customMessage], $customStatus),

        default => throw new InvalidArgumentException('Invalid response method'),
    };
}

function runSeeder($plural, $singular, $model, $hasImg = false, $hasFile = false, $imgExtension = '.png', $fileExtension = null, $imageField = 'image', $fileField = 'file'): void
{
        // Delete plural storage directory
        Storage::disk('public')->deleteDirectory('images/' . $plural);
        Storage::disk('public')->deleteDirectory('files/' . $plural);

        // Delete old data
        DB::table($plural)->delete();

        // Fetch data from json file
        $$plural = json_decode(file_get_contents(database_path('data/' . $plural . '.json')), true);

        foreach ($$plural as $$singular) {
            $data = $$singular;

            if ($hasImg) {
                $imageName = str_replace($imgExtension, '', str_replace('assets/images/' . $plural . '/', '', $$singular[$imageField]));

                ${$singular . 'Img'} = new UploadedFile(public_path($$singular[$imageField]), $imageName);

                $imgData = [
                    $imageField => Storage::disk('public')->putFile('images/' . $plural, ${$singular . 'Img'})
                ];

                $data = array_except($$singular, $imageField) + $imgData;
            }

            if($hasFile) {
                $fileName = str_replace($fileExtension, '', str_replace('assets/files/' . $plural, '', $$singular[$fileField]));

                ${$singular . 'File'} = new UploadedFile(public_path($$singular[$fileField]), $fileName);

                $fileData = [
                    $fileField => Storage::disk('public')->putFile('files/' . $plural, ${$singular . 'File'})
                ];

                $data = array_except($data, $fileField) + $fileData;
            }

            $model::create($data);
        }
}
