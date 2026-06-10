<?php

namespace MantaCil\Http\Controllers\Admin\Nests;

use Illuminate\View\View;
use MantaCil\Models\Egg;
use Illuminate\Http\RedirectResponse;
use Prologue\Alerts\AlertsMessageBag;
use Illuminate\View\Factory as ViewFactory;
use MantaCil\Http\Controllers\Controller;
use MantaCil\Services\Eggs\EggUpdateService;
use MantaCil\Services\Eggs\EggCreationService;
use MantaCil\Services\Eggs\EggDeletionService;
use MantaCil\Http\Requests\Admin\Egg\EggFormRequest;
use MantaCil\Contracts\Repository\EggRepositoryInterface;
use MantaCil\Contracts\Repository\NestRepositoryInterface;

class EggController extends Controller
{
    /**
     * EggController constructor.
     */
    public function __construct(
        protected AlertsMessageBag $alert,
        protected EggCreationService $creationService,
        protected EggDeletionService $deletionService,
        protected EggRepositoryInterface $repository,
        protected EggUpdateService $updateService,
        protected NestRepositoryInterface $nestRepository,
        protected ViewFactory $view,
    ) {
    }

    /**
     * Handle a request to display the Egg creation page.
     *
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     */
    public function create(): View
    {
        $nests = $this->nestRepository->getWithEggs();
        \JavaScript::put(['nests' => $nests->keyBy('id')]);

        return view('admin.eggs.new', ['nests' => $nests]);
    }

    /**
     * Handle request to store a new Egg.
     *
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     * @throws \MantaCil\Exceptions\Service\Egg\NoParentConfigurationFoundException
     */
    public function store(EggFormRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['docker_images'] = $this->normalizeDockerImages($data['docker_images'] ?? null);

        $egg = $this->creationService->handle($data);
        $this->alert->success(trans('admin/nests.eggs.notices.egg_created'))->flash();

        return redirect()->route('admin.nests.egg.view', $egg->id);
    }

    /**
     * Handle request to view a single Egg.
     */
    public function view(Egg $egg): View
    {
        return view('admin.eggs.view', [
            'egg' => $egg,
            'images' => array_map(
                fn ($key, $value) => $key === $value ? $value : "$key|$value",
                array_keys($egg->docker_images),
                $egg->docker_images,
            ),
        ]);
    }

    /**
     * Handle request to update an Egg.
     *
     * @throws \MantaCil\Exceptions\Model\DataValidationException
     * @throws \MantaCil\Exceptions\Repository\RecordNotFoundException
     * @throws \MantaCil\Exceptions\Service\Egg\NoParentConfigurationFoundException
     */
    public function update(EggFormRequest $request, Egg $egg): RedirectResponse
    {
        $data = $request->validated();
        $data['docker_images'] = $this->normalizeDockerImages($data['docker_images'] ?? null);

        $this->updateService->handle($egg, $data);
        $this->alert->success(trans('admin/nests.eggs.notices.updated'))->flash();

        return redirect()->route('admin.nests.egg.view', $egg->id);
    }

    /**
     * Handle request to destroy an egg.
     *
     * @throws \MantaCil\Exceptions\Service\Egg\HasChildrenException
     * @throws \MantaCil\Exceptions\Service\HasActiveServersException
     */
    public function destroy(Egg $egg): RedirectResponse
    {
        $this->deletionService->handle($egg->id);
        $this->alert->success(trans('admin/nests.eggs.notices.deleted'))->flash();

        return redirect()->route('admin.nests.view', $egg->nest_id);
    }

    /**
     * Normalizes a string of docker image data into the expected egg format.
     */
    protected function normalizeDockerImages(?string $input = null): array
    {
        $data = array_map(fn ($value) => trim($value), explode("\n", $input ?? ''));

        $images = [];
        // Iterate over the image data provided and convert it into a name => image
        // pairing that is used to improve the display on the front-end.
        foreach ($data as $value) {
            $parts = explode('|', $value, 2);
            $images[$parts[0]] = empty($parts[1]) ? $parts[0] : $parts[1];
        }

        return $images;
    }
}
