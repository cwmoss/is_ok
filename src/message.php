<?php

namespace is_ok;

class message {

    public array $msg = [
        'empty' => "{name} darf nicht leer sein",
        'blank' => "{name} darf nicht leer sein",
        'min' => '{name} ist zu klein (min. {val})',
        'max' => '{name} ist zu groß (max. {val})',
        'taken' => "{name} ist bereits in Benutzung",
        'invalid' => "{name} ist ungültig",
        'too-long' => "{name} ist zu lang (maximal {val} Zeichen)",
        'too-short' => "{name} ist zu kurz (mind. {val} Zeichen)",
        'wrong-length' => "{name} hat die falsche Länge. (sollen {val} zeichen sein)",
        'not-a-number' => "{name} ist keine Zahl.",
        'accepted' => "{name} muß zugestimmt werden",
        'inclusion' => "{name} ist nicht in der Liste der erlaubten Werte",
        'exclusion' => "{name} ist reserviert.",
        'confirmation' => "{name} stimmt nicht überein.",
        'not-past' => "{name} muss in der Vergangenheit liegen",
        'not-future' => "{name} muss in der Zukunft liegen",
        'date-before' => "{name} muss vor {val} liegen",
        'date-after' => "{name} muss nach {val} liegen",
        'too-young' => "Das Mindestalter beträgt {val} Jahre",
        'too-old' => "Das Höchstalter beträgt {val} Jahre",
        'not-this-year' => '{name} muss in diesem Jahr liegen'
    ];


    public function get_message($default, $e, $opts, $vals = []) {
        $replacements = [
            'name' => $opts['name'] ?? null,
            'yourval' => htmlspecialchars($opts['__'] ?? ''),
            'val' => ""
        ];
        if ($vals && !is_array($vals)) {
            $replacements['val'] = $vals;
        }
        if (!$replacements['name']) {
            $replacements['name'] = ucfirst($e);
        }
        $msg = $opts['msg_' . $default] ?? null;
        if (!$msg) {
            $msg = $opts['msg'] ?? null;
        }
        if (!$msg) {
            $msg = $this->msg[$default] ?? '';
        }

        return self::format_message($msg, $replacements);
    }

    public static function format_message($msg, $replacements = []) {
        $rep = [];
        foreach ($replacements as $k => $v) {
            $rep['{' . $k . '}'] = $v;
        }
        return str_replace(array_keys($rep), $rep, $msg);
    }
}
