<?php

namespace App\Actions;

use App\Models\Dataforseo;

class StoreResponseAction
{
    public function saveResponse(string $parameter, array $response): void
    {
        if (20000 === $response['status_code']) {
            foreach ($response['tasks'][0]['data']['targets'] as $target) {
                $referring_domain = $rank = $backlinks = [];

                $excluded_target = empty($response['tasks'][0]['data']['exclude_targets'])
                    ? null
                    : json_encode($response['tasks'][0]['data']['exclude_targets']);

                foreach ($response['tasks'][0]['result'][0]['items'] as $item) {
                    $referring_domain[] = $item['domain_intersection']['1']['target'];
                    $rank[] = $item['domain_intersection']['1']['rank'];
                    $backlinks[] = $item['domain_intersection']['1']['backlinks'];
                }

                $input = [
                    'excluded_target' => $excluded_target,
                    'referring_domain' => json_encode($referring_domain),
                    'rank' => json_encode($rank),
                    'backlinks' => json_encode($backlinks),
                    'parameter' => $parameter,
                    'original_response' => json_encode($response)
                ];

                Dataforseo::query()->updateOrCreate(['target_domain' => $target], $input);
            }
        } else {
            Dataforseo::query()->firstOrCreate([
                'parameter' => $parameter,
                'original_response' => json_encode($response)
            ]);
        }
    }
}
