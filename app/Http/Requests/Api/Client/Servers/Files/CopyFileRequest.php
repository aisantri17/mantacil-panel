<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Files;

use MantaCil\Models\Permission;
use MantaCil\Contracts\Http\ClientPermissionsRequest;
use MantaCil\Http\Requests\Api\Client\ClientApiRequest;

class CopyFileRequest extends ClientApiRequest implements ClientPermissionsRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_CREATE;
    }

    public function rules(): array
    {
        return [
            'location' => 'required|string',
        ];
    }
}
