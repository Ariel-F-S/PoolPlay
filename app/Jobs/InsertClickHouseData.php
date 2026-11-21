<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Tinderbox\Clickhouse\Server;
use Tinderbox\Clickhouse\ServerProvider;
use Tinderbox\Clickhouse\Client;

class InsertClickHouseData implements ShouldQueue
{
    use Queueable;

    public function handle(): void
    {
        $server = new Server(
            env('CLICKHOUSE_HOST', '127.0.0.1'),
            env('CLICKHOUSE_PORT', 8123),
            env('CLICKHOUSE_DATABASE', 'school'),
            env('CLICKHOUSE_USERNAME', 'default'),
            env('CLICKHOUSE_PASSWORD', '')
        );
        $client = new Client((new ServerProvider())->addServer($server));

        $data = [
            [1, 'John Doe', 15, 10],
            [2, 'Jane Smith', 14, 9]
        ];

        foreach ($data as $row) {
            $client->writeOne("INSERT INTO school.students (id, name, age, grade) VALUES ({$row[0]}, '{$row[1]}', {$row[2]}, {$row[3]})");
        }
    }
}