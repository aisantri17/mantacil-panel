<?php

namespace MantaCil\Http\Requests\Api\Client\Servers\Files;

use MantaCil\Models\Permission;
use MantaCil\Http\Requests\Api\Client\ClientApiRequest;

class UploadFileRequest extends ClientApiRequest
{
    public function permission(): string
    {
        return Permission::ACTION_FILE_CREATE;
    }
}
