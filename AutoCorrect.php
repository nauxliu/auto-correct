<?php namespace Naux;

class AutoCorrect
{
    private $dicts = null;

    public function __construct()
    {
        $this->dicts = include __DIR__.'/dicts.php';
    }

    public function withDict($dicts)
    {
        $this->dicts = array_merge($this->dicts, $dicts);

        return $this;
    }

    public function convert($content)
    {
        $content = $this->auto_space($content);

        return $this->auto_correct($content);
    }

    public function auto_space($content)
    {
        $content = preg_replace('~((?![年月日号])\p{Han})([a-zA-Z0-9+$@#\[\(\/‘“])~u', '\1 \2', $content);
        $content = preg_replace('~([a-zA-Z0-9+$’”\]\)@#!\/]|[\d[年月日]]{2,})((?![年月日号])\p{Han})~u', '\1 \2', $content);
        # Fix () [] near the English and number
        $content = preg_replace('~([a-zA-Z0-9]+)([\[\(‘“])~u', '\1 \2', $content);
        $content = preg_replace('~([\)\]’”])([a-zA-Z0-9]+)~u', '\1 \2', $content);

        return $content;
    }

    public function auto_correct($content)
    {
        foreach ($this->dicts as $from => $to) {
            $content = preg_replace("/(?<!\.|[a-z]){$from}(?!\.|[a-z])/i", $to, $content);
        }

        return $content;
    }
}
