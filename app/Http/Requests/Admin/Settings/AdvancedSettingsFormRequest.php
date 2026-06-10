<?php

namespace MantaCil\Http\Requests\Admin\Settings;

use MantaCil\Http\Requests\Admin\AdminFormRequest;

class AdvancedSettingsFormRequest extends AdminFormRequest
{
    /**
     * Return all the rules to apply to this request's data.
     */
    public function rules(): array
    {
        return [
            'recaptcha:enabled' => 'required|in:true,false',
            'recaptcha:secret_key' => 'required|string|max:191',
            'recaptcha:website_key' => 'required|string|max:191',
            'mantacil:guzzle:timeout' => 'required|integer|between:1,60',
            'mantacil:guzzle:connect_timeout' => 'required|integer|between:1,60',
            'mantacil:client_features:allocations:enabled' => 'required|in:true,false',
            'mantacil:client_features:allocations:range_start' => [
                'nullable',
                'required_if:mantacil:client_features:allocations:enabled,true',
                'integer',
                'between:1024,65535',
            ],
            'mantacil:client_features:allocations:range_end' => [
                'nullable',
                'required_if:mantacil:client_features:allocations:enabled,true',
                'integer',
                'between:1024,65535',
                'gt:mantacil:client_features:allocations:range_start',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'recaptcha:enabled' => 'reCAPTCHA Enabled',
            'recaptcha:secret_key' => 'reCAPTCHA Secret Key',
            'recaptcha:website_key' => 'reCAPTCHA Website Key',
            'mantacil:guzzle:timeout' => 'HTTP Request Timeout',
            'mantacil:guzzle:connect_timeout' => 'HTTP Connection Timeout',
            'mantacil:client_features:allocations:enabled' => 'Auto Create Allocations Enabled',
            'mantacil:client_features:allocations:range_start' => 'Starting Port',
            'mantacil:client_features:allocations:range_end' => 'Ending Port',
        ];
    }
}
