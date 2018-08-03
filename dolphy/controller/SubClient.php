<?php
/**
 * Created by PhpStorm.
 * User: dol
 * Date: 18-8-2
 * Time: 上午10:57
 */

include 'MQTTClient.php';

class SubClient extends MQTTClient
{
    public function sub() {
        $this->client->subscribe($this->topic, 1);

        do {
            $this->client->loop();
            sleep(1);

            //todo 每隔1分 curl api 告诉Frankie保活状态
            $time = time();
            if ($time%60 == 0) {
//                $sub_file = fopen("msg.txt", "a");
//                $txt = "every 60 second   ". date('Y-m-d H:i:s'."\n");
//                fwrite($sub_file, $txt);
//                fclose($sub_file);
            }

        } while(!$this->close);

        $this->client->disconnect();
        unset($this->client);
    }
}