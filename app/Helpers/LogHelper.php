<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class LogHelper
{
    public static $ext = 'log';
    const DEFAULT_LOG = 'global';
    const DEFAULT_LOG_PATH_LIMIT = 6;
    const DEFAULT_FORMAT_DATE = 'Y-m-d';
    const DEFAULT_FORMAT_DATE_TIME = 'Y-m-d\TH:i:s\Z';

    public static function write($data = null, $key = null)
    {
        $filePath = static::getLogStoragePath();
        $prefix = static::getPrefixLog($key);
        $data = static::formatInputDataLog($data);
        $methodList = static::getActionMethodList();
        $methodLog = "$prefix:: METHOD: " . implode(' ', $methodList);
        $dataLog = "$prefix:: DATA: $data";
        $textLog = "$methodLog\n$dataLog\n";
        Storage::disk('log')->append($filePath, $textLog);
    }

    protected static function getLogStoragePath(): string
    {
        $suffix = static::DEFAULT_LOG;
        $organizer = auth('organizer')->user();
        $date = date(static::DEFAULT_FORMAT_DATE);
        if ($organizer) {
            $suffix = 'organizer-' . $organizer['id'];
        }
        $fileName = "$date-$suffix." . static::$ext;
        return "$fileName";
    }

    protected static function getPrefixLog($key = null): string
    {
        $prefix = "PID" . getmygid() . "::DATE:" . gmdate(static::DEFAULT_FORMAT_DATE_TIME);
        if (!empty($key)) {
            $prefix .= "-$key";
        }
        return $prefix;
    }

    protected static function formatInputDataLog($data)
    {
        if ($data instanceof \Throwable) {
            return "EXCEPTION::" . $data->getCode() . "::" . $data->getMessage();
        }
        if (is_array($data)) {
            return json_encode($data);
        }
        if (!is_string($data)) {
            try {
                $data = var_export($data, true);
            } catch (\Throwable $e) {
                $data = var_export($e);
            }
            return json_encode($data);
        }
        return $data;
    }

    protected static function getActionMethodList()
    {
        $getActionLogPaths = debug_backtrace(2, static::DEFAULT_LOG_PATH_LIMIT);
        $methodList = [];
        if (!empty($getActionLogPaths)) {
            foreach ($getActionLogPaths as $key => $actionLogPath) {
                $class = @$actionLogPath['class'] ?: '';
                $function = @$actionLogPath['function'] ?: '';
                $type = @$actionLogPath['type'] ?: '';
                if ($class && strpos(static::class, $class) !== false) {
                    continue;
                }
                $methodText = "$class->$function";
                $line = @$getActionLogPaths[$key - 1]['line'];
                if (!empty($line)) {
                    $methodText .= "->$line";
                }
                $methodList[] = $methodText;
            }
        }
        return $methodList;
    }
}
