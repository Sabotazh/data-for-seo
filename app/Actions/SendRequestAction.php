<?php

namespace App\Actions;

use App\Models\Dataforseo;
use Exception;

class SendRequestAction
{
    public function sendPostRequest(string $parameter, string $target_domains, string|null $excluded_targets): void
    {
        $info['http_code'] = 500;

        $targets = '{';
        $exclude_targets = '[';

        foreach (explode(',', $target_domains) as $key => $target_domain) {
            $targets = $targets . '"' . $key + 1 . '":"' . trim($target_domain) . '", ';
        }

        if (!is_null($excluded_targets)) {
            foreach (explode(',', $excluded_targets) as $key => $excluded_target) {
                $exclude_targets = $exclude_targets . '"' . $key + 1 . '":"' . trim($excluded_target) . '", ';
            }
        }

        $targets = rtrim($targets, ", ");
        $targets = $targets . '}';

        $exclude_targets = rtrim($exclude_targets, ", ");
        $exclude_targets = $exclude_targets . ']';

        try {
            $ch = curl_init();

            curl_setopt_array($ch, array(
                CURLOPT_URL => 'https://api.dataforseo.com/v3/backlinks/domain_intersection/live',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '[{
                    "targets":' . $targets . ',
                    "exclude_targets":' . $exclude_targets . ',
                    "limit":10,
                    "exclude_internal_backlinks":true,
                    "order_by":["1.rank,asc"]
                }]',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Basic Y2hhbGxlbmdlcjEwM0BkYXRhZm9yc2VvLmNvbTo0MTE3ZWI4OWFjNTM5YTEw',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($ch);

            if (!curl_errno($ch)) {
                $info = curl_getinfo($ch);
            }

            curl_close($ch);

            switch ($info['http_code']) {
                case 200:
                    (new StoreResponseAction())->saveResponse($parameter, json_decode($response, true));
                    break;
                case 500:
                    Dataforseo::query()->firstOrCreate([
                        'parameter' => $parameter,
                        'original_response' => $response
                    ]);
                    break;
            }
        } catch (Exception $exception) {
            Info($exception->getMessage());
        }
    }
}
