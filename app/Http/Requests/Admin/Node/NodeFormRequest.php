<?php

namespace MantaCil\Http\Requests\Admin\Node;

use MantaCil\Rules\Fqdn;
use MantaCil\Models\Node;
use MantaCil\Http\Requests\Admin\AdminFormRequest;

class NodeFormRequest extends AdminFormRequest
{
    /**
     * Get rules to apply to data in this request.
     */
    public function rules(): array
    {
        if ($this->method() === 'PATCH') {
            return Node::getRulesForUpdate($this->route()->parameter('node'));
        }

        $data = Node::getRules();
        $data['fqdn'][] = Fqdn::make('scheme');

        return $data;
    }
}
