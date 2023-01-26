<?php

declare(strict_types=1);

namespace Apps\Web\Controllers;

use Apps\Core\AbstractClasses\AbstractController;
use Apps\Services\Equifax\Api;
use Apps\Web\Services\Archive;
use Apps\Web\Services\File;
use Apps\Web\Services\Signaiter;

/**
 * Класс HistoryController
 * @version 0.0.1
 * @package Apps\Web\Controllers
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
final class HistoryController extends AbstractController
{

    public function postSendAction()
    {
        $dir = 'inbox';
        $api = new Api();
        $auth = $api->getToken();
        $file = (new File)->run();
        $zipArchive = (new Archive($file))->create();
        $enc = (new Signaiter($zipArchive->file->realPath))->sign()->encrypt();
        $data = $api->send($enc, $auth->token, $dir);
        $data['uid'] = $api->getUid(basename($file));
        if (isset($data['code']) and isset($data['message'])) {
            header('HTTP/1.1 ' . $data['code'] . ' ' . $data['message']);
            if ($data['code'] >= 200 and $data['code'] <= 300) {
                $data['error'] = false;
            } else {
                $data['error'] = $data['code'] . ' ' . $data['message'];
            }
            return (object)$data;
        }
        return false;
    }

    public function getResultAction()
    {
        $api = new Api();
        $auth = $api->getToken();
        $files = $api->getResultReport($auth->token, 'outbox');
        $data = [];
        if ($files and is_array($files)) {
            foreach ($files as $file) {
                $xml = $api->loadFile($auth->token, $file, 'sgn');
                if ($xml and $info = $api->parseXml($xml)) {
                    $data[$info->file_name] = $info;
                }
            }
        }
        return (object)$data;
    }

}
