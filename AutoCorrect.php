<?php namespace Naux;

class AutoCorrect
{
    private $dicts = null;

    public function __construct()
    {
        $this->dicts = include __DIR__.'/dicts.php';
    }

    public function convert($content)
    {
        $content = $this->auto_space($content);

        return $this->auto_correct($content);
    }

    public function auto_space($content)
    {
        $content = preg_replace('~(\p{Han})([a-zA-Z0-9\p{Ps}])(?![^<]*>)~u', '\1 \2', $content);
        $content = preg_replace('~([a-zA-Z0-9\p{Pe}])(\p{Han})(?![^<]*>)~u', '\1 \2', $content);
        $content = preg_replace('~([!?‽:;,.])(\p{Han})~u', '\1 \2', $content);
        $content = preg_replace('~(\p{Han})(<[a-zA-Z]+?.*?>)~u', '\1 \2', $content);
        $content = preg_replace('~(\p{Han})(<\/[a-zA-Z]+>)~u', '\1\2 ', $content);
        $content = preg_replace('~(<\/[a-zA-Z]+>)(\p{Han})~u', '\1 \2', $content);
        $content = preg_replace('~(<[a-zA-Z]+?.*?>)(\p{Han})~u', ' \1\2', $content);

        return $content;
    }

    public function auto_correct($content)
    {
        foreach ($this->dicts as $from => $to) {
            $content = str_ireplace($from, $to, $content);
        }

        return $content;
    }
}
