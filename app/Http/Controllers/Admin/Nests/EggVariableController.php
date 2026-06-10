<?php

namespace MantaCil\Http\Controllers\Admin\Nests;

use Illuminate\View\View;
use MantaCil\Models\Egg;
use MantaCil\Models\EggVariable;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use MantaCil\Http\Controllers\Controller;
use MantaCil\Contracts\Repository\EggRepositoryInterface;
use MantaCil\Services\Eggs\Variables\VariableUpdateService;
use MantaCil\Http\Requests\Admin\Egg\EggVariableFormRequest;
use MantaCil\Services\Eggs\Variables\VariableCreationService;
use MantaCil\Contracts\Repository\EggVariableRepositoryInterface;

class EggVariableController extends Controller
{
    /**
     * EggVariableController constructor.
     */
    public function __construct(
        protected AlertsMessageBag $alert,
        protected VariableCreationService $creationService,
        protected VariableUpdateService $updateService,
        protected EggRepositoryInterface $repository,
        protected EggVariableRepositoryInterface $variableRepository,
        protected ViewFactory $view,
    ) {
    }

    /**
     * Handle request to view the variables attached to an Egg.
     *
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function view(int $egg): View
    {
        $egg = $this->repository->getWithVariables($egg);

        return view('admin.eggs.variables', ['egg' => $egg]);
    }

    /**
     * Handle a request to create a new Egg variable.
     *
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     * @throws \MantaCil\Exceptions\Service\Egg\Variable\BadValidationRuleException
     * @throws \MantaCil\Exceptions\Service\Egg\Variable\ReservedVariableNameException
     */
    public function store(EggVariableFormRequest $request, Egg $egg): RedirectResponse
    {
        $this->creationService->handle($egg->id, $request->normalize());
        $this->alert->success(trans('admin/nests.variables.notices.variable_created'))->flash();

        return redirect()->route('admin.nests.egg.variables', $egg->id);
    }

    /**
     * Handle a request to update an existing Egg variable.
     *
     * @throws \MantaCil\Exceptions\DisplayException
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     * @throws \MantaCil\Exceptions\Service\Egg\Variable\ReservedVariableNameException
     */
    public function update(EggVariableFormRequest $request, Egg $egg, EggVariable $variable): RedirectResponse
    {
        $this->updateService->handle($variable, $request->normalize());
        $this->alert->success(trans('admin/nests.variables.notices.variable_updated', [
            'variable' => htmlspecialchars($variable->name),
        ]))->flash();

        return redirect()->route('admin.nests.egg.variables', $egg->id);
    }

    /**
     * Handle a request to delete an existing Egg variable from the Panel.
     */
    public function destroy(int $egg, EggVariable $variable): RedirectResponse
    {
        $this->variableRepository->delete($variable->id);
        $this->alert->success(trans('admin/nests.variables.notices.variable_deleted', [
            'variable' => htmlspecialchars($variable->name),
        ]))->flash();

        return redirect()->route('admin.nests.egg.variables', $egg);
    }
}
