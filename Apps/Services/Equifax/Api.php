<?php

declare(strict_types=1);

namespace Apps\Services\Equifax;

use Apps\Core\Config\Config;
use Apps\Services\CryptoPro\Curl\Curl;
use Apps\Web\Services\Scorings;
use RuntimeException;
use stdClass;

/**
 * Класс Api
 * @version 0.0.1
 * @package Apps\Services\Equifax
 * @generated Зорин Алексей, please DO NOT EDIT!
 * @author Зорин Алексей <zorinalexey59292@gmail.com>
 * @copyright 2022 разработчик Зорин Алексей Евгеньевич.
 */
final class Api
{

    const mainUrl = 'https://bki-file.scoring.ru';
    const testUrl = 'https://bki-file-test.scoring.ru';

    private string $tmpDir = ROOT . 'tmp' . SEP . 'tokens' . SEP;
    private ?string $outFile = null;
    private string $dumpFile = "";
    private ?string $resultReportDir = null;
    private string $url = "";
    private ?string $autFile = null;

    public function __construct()
    {
        $this->resultReportDir = ROOT . 'private' . SEP . 'file' . SEP . date('d.m.Y') . SEP;
        $this->config = (new Config('equifax'));
        if ($this->config->test) {
            $testConfig = new Config('test-equifax-auth');
            $this->config->username = $testConfig->username;
            $this->config->password = $testConfig->password;
            $this->url = self::testUrl;
            $this->autFile = ROOT . 'config' . SEP . 'test-equifax-auth.json';
        } else {
            $this->url = self::mainUrl;
            $this->autFile = ROOT . 'config' . SEP . 'equifax-auth.json';
        }
        $this->tmpDir .= date('d.m.Y') . SEP;
        if (!is_dir($this->tmpDir)) {
            if (!mkdir($concurrentDirectory = $this->tmpDir, 0777, true) && !is_dir($concurrentDirectory)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
    }

    public function getToken(): stdClass
    {
        $authData = (object)[
            'username' => $this->config->username,
            'password' => $this->config->password
        ];
        $this->outFile = $this->tmpDir . 'token.txt';
        $this->dumpFile = $this->tmpDir . 'token-dump.dump';
        $command = "sudo -u www-data " . Curl::$cryptoCurl .
            ' -X POST -E ' . $this->config->certSha1 . ' ' . $this->url . '/api/auth/get' .
            ' -o ' . $this->outFile . ' -v --trace-ascii ' . $this->dumpFile .
            ' --header "Content-Type: Application/json" '
            . '--data-binary @' . $this->autFile;
        exec($command);
        if (is_file($this->outFile)) {
            $authData->token = file_get_contents($this->outFile);
            unlink($this->outFile);
            unlink($this->dumpFile);
        } else {
            $authData->token = '';
        }
        return $authData;
    }

    public function send($file, string $token, string $dir = 'inbox')
    {
        $data = [];
        $this->tmpDir = dirname($file->file) . SEP;
        $this->outFile = dirname($this->outFile) . SEP . time() . '.txt';
        $this->dumpFile = dirname($this->dumpFile) . SEP . time() . '.dump';
        $command = $file->binPatch . 'curl -X POST ' .
            $this->url . '/api/resource/' . $dir . '/' . basename($file->file) .
            ' -E ' . $this->config->certSha1 . ' --header "Authorization: Bearer ' . $token . '"' .
            ' -o ' . $this->outFile . ' -v --trace-ascii ' . $this->dumpFile .
            ' --data-binary @' . $file->file;
        exec($command);
        if (is_file($this->outFile)) {
            preg_match('~(?<code>\d+) (?<message>\w+)~ui', file_get_contents($this->outFile), $data);
            foreach ($data as $key => $value) {
                if (is_int($key)) {
                    unset($data[$key], $value);
                }
            }
            unlink($this->outFile);
            unlink($this->dumpFile);
        }
        return $data;
    }

    public function getResultReport(string $token, string $dir = 'outbox')
    {
        $tmpDir = $this->resultReportDir;
        $this->outFile = $tmpDir . time() . rand() . '.txt';
        $this->dumpFile = $tmpDir . time() . rand() . '.dump';
        if (!is_dir($tmpDir)) {
            if (!mkdir($tmpDir, 0777, true) && !is_dir($tmpDir)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $tmpDir));
            }
        }
        $config = (new Config('equifax'));
        $command = 'sudo -u www-data ' . Curl::$cryptoCurl . ' -X GET ' .
            $this->url . '/api/resource/' . $dir . ' -E ' . $config->certSha1 .
            ' --header "Authorization: Bearer ' . $token . '"' .
            ' -o ' . $this->outFile . ' -v --trace-ascii ' . $this->dumpFile;
        exec($command);
        $data = [];
        if (file_exists($this->outFile)) {
            $files = json_decode(file_get_contents($this->outFile));
            if (isset($files->items)) {
                foreach ($files->items as $file) {
                    if (!$file->isDir and $this->getFileByDateInterval($file)) {
                        $data[] = $file;
                    }
                }
            }
        }
        return $data;
    }

    private function getFileByDateInterval(stdClass $file): bool
    {
        $interval = new GetDateInterval();
        $fileDate = strtotime(preg_replace(
                '~^(.+)_FCH_(\d{4})(\d{2})(\d{2})_(\d{4})\.XML(.+)?$~ui',
                '$4.$3.$2',
                $file->path)
        );
        if ($fileDate >= $interval->getStartDate() and $fileDate <= $interval->getEndDate()) {
            return true;
        }
        return false;
    }

    public function loadFile(string $token, stdClass $file, string $ext = 'sgn')
    {
        $xml = '';
        if ($file->extension === '.' . $ext) {
            $config = (new Config('equifax'));
            $tmpDir = $this->resultReportDir;
            $this->outFile = $tmpDir . $file->path;
            $this->dumpFile = $tmpDir . time() . rand() . '.dump';
            if (!is_dir(dirname($this->outFile))) {
                if (!mkdir($concurrentDirectory = dirname($this->outFile), 0777, true) && !is_dir($concurrentDirectory)) {
                    throw new RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
                }
            }
            $command = 'sudo -u www-data ' . Curl::$cryptoCurl . ' -X GET ' .
                $this->url . '/api/download/' . $file->path . ' -E ' . $config->certSha1 .
                ' --header "Authorization: Bearer ' . $token . '"' .
                ' -o ' . $this->outFile . ' -v --trace-ascii ' . $this->dumpFile;
            exec($command);
            if (file_exists($this->outFile)) {
                $xml = $this->outFile;
            }
        }
        return $xml;
    }

    public function parseXml(string $signFile)
    {
        $report = new stdClass();
        $report->error = [];
        preg_match('~(.+)\/outbox\/(?<fileName>(\w+)\.XML)(.+)~ui', $signFile, $matches);
        if (isset($matches['fileName'])) {
            $fileName = $matches['fileName'];
            $xml = Scorings::getXml(file_get_contents($signFile), '<?xml', '</log>');
            $report->file_name = $fileName;
            $report->uid = $this->getUid($fileName);
            if (isset($xml->control->error)) {
                foreach ($xml->control->error as $error) {
                    $errorData['message'] = (string)$error;
                    foreach (((array)$error)['@attributes'] as $key => $value) {
                        $errorData[$key] = (string)$value;
                    }
                    $report->error[] = $errorData;
                }
            }
            $report->reg_file_info = (object)[
                'received_date' => (string)$xml->date,
                'file_reg_date' => (string)$xml->file_reg_date,
                'file_reg_num' => (string)$xml->file_reg_num,
            ];
            $report->send_file_info = (object)[
                'receive_time' => (string)$xml->processing->receive_time,
                'file_number' => (string)$xml->processing->file_reg_num,
                'formation_date' => (string)$xml->processing->date,
            ];
            return $report;
        }
        return false;
    }

    public function getUid(string $string)
    {
        return mb_strtolower(
            preg_replace(
                '~^(\w{8})(\w{4})(\w{4})(\w{4})(\w{12})~ui',
                '$1-$2-$3-$4-$5',
                md5(mb_strtoupper($string))
            )
        );
    }

}
