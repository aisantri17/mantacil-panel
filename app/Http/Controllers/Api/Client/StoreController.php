<?php

namespace MantaCil\Http\Controllers\Api\Client;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use MantaCil\Http\Controllers\Controller;
use MantaCil\Models\User;
use MantaCil\Models\Server;
use MantaCil\Services\Servers\ServerCreationService;
use MantaCil\Models\Node;
use MantaCil\Models\Allocation;
use MantaCil\Models\Egg;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    private $pakasirSlug;
    private $pakasirKey;

    public function __construct(private ServerCreationService $creationService)
    {
        $this->pakasirSlug = env('PAKASIR_SLUG', 'ota-store');
        $this->pakasirKey = env('PAKASIR_API_KEY', 'jdRFkm9Ko8r7xQQEO5M3ykjAUdXq2o3w');
    }

    public function checkout(Request $request): JsonResponse
    {
        $user = $request->user();
        
        $payload = [
            'project' => $this->pakasirSlug,
            'api_key' => $this->pakasirKey,
            'amount' => 5000,
            'buyer_username' => $user->username,
            'buyer_password' => 'MantaCil-Store'
        ];

        $response = Http::post('https://app.pakasir.com/api/transactioncreate/qris', $payload);

        if ($response->successful() && isset($response['data'])) {
            return new JsonResponse([
                'success' => true,
                'order_id' => $response['data']['order_id'],
                'qris_payload' => $response['data']['qris_payload'],
                'amount' => $response['data']['amount']
            ]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Gagal membuat tagihan QRIS.'], 500);
    }

    public function checkStatus(Request $request, $orderId): JsonResponse
    {
        $user = $request->user();
        
        $url = "https://app.pakasir.com/api/transactiondetail?project={$this->pakasirSlug}&amount=5000&order_id={$orderId}&api_key={$this->pakasirKey}";
        $response = Http::get($url);

        if ($response->successful()) {
            $status = strtolower($response['transaction']['status'] ?? 'pending');
            
            if (in_array($status, ['completed', 'success', 'paid', 'settlement', 'sukses', 'berhasil'])) {
                // Pembayaran sukses, buat server!
                try {
                    $this->provisionServer($user);
                    return new JsonResponse(['success' => true, 'status' => 'paid']);
                } catch (\Exception $e) {
                    return new JsonResponse(['success' => false, 'message' => 'Pembayaran sukses, tapi gagal membuat server: ' . $e->getMessage()], 500);
                }
            }

            return new JsonResponse(['success' => true, 'status' => $status]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Gagal mengecek status.'], 500);
    }

    private function provisionServer(User $user)
    {
        // Cari Node yang aktif
        $node = Node::first();
        if (!$node) throw new \Exception('Tidak ada Node aktif.');

        // Cari Allocation yang kosong
        $allocation = Allocation::where('node_id', $node->id)->whereNull('server_id')->first();
        if (!$allocation) throw new \Exception('Tidak ada port yang tersedia.');

        // Cari Egg Bot WhatsApp (jika ada), atau Egg pertama
        $egg = Egg::where('name', 'like', '%whatsapp%')->orWhere('name', 'like', '%bot%')->first();
        if (!$egg) $egg = Egg::first();

        $data = [
            'name' => 'Bot WA - ' . $user->username,
            'owner_id' => $user->id,
            'node_id' => $node->id,
            'allocation_id' => $allocation->id,
            'egg_id' => $egg->id,
            'memory' => 512,
            'swap' => 0,
            'disk' => 1024,
            'io' => 500,
            'cpu' => 100,
            'threads' => null,
            'image' => $egg->docker_images[0] ?? 'ghcr.io/pterodactyl/yolks:nodejs_18',
            'startup' => $egg->startup,
            'environment' => [],
            'start_on_completion' => true,
        ];

        $this->creationService->handle($data);
    }
}
