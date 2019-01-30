<?php

namespace App\Randomizer;

use App\Post;
use App\Project;
use Mikemike\Spinner\Spinner;

class ArticleBuilder
{
    const PARAGRAPH = 0;
    const HEADING = 1;

    private $post;
    private $city;
    private $project;
    private $spinner;
    private $paragraphs = [];
    private $isUseLinks = true;

    public function __construct(Post $post, $city = null, Project $project = null)
    {
        $this->post = $post;
        $this->city = $city;
        $this->project = $project;
        $this->spinner = new Spinner();
    }

    public function useLinks($isUse)
    {
        $this->isUseLinks = $isUse;
    }

    public function getArticle()
    {
        $this->dividedIntoParagraphs();
    }

    private function dividedIntoParagraphs()
    {
        $separators = ["\r\n\r\n", "\n\n", "\r\r"];

        if (strpos($this->post->text, $separators[0]) !== false) {
            $separator = $separators[0];
        } elseif (strpos($this->post->text, $separators[1]) !== false) {
            $separator = $separators[1];
        } else {
            $separator = $separators[2];
        }

        $paragraphs = explode($separator, $this->post->text);

        for ($i = 0; $i < count($paragraphs); $i++) {
            $type = self::PARAGRAPH;

            if ($paragraphs[$i]{0} == '+') {
                $type = self::HEADING;
                $paragraphs[$i] = substr($paragraphs[$i], 1);
            }

            $this->paragraphs[] = ['html' => $paragraphs[$i], 'type' => $type];
        }

        for ($i = 0; $i < count($this->paragraphs); $i++) {
            $this->paragraphs[$i]['html'] = $this->getSpunText($this->paragraphs[$i]['html']);
            $this->paragraphs[$i]['html'] = $this->correctSentences(
                $this->paragraphs[$i]['html'],
                $this->paragraphs[$i]['type']
            );
//            $this->paragraphs[$i] = $this->replaceCity($this->paragraphs[$i]);
        }
//        HeidiSQL
        dd($this->paragraphs);
    }

    private function getSpunText($text)
    {
        $text = trim($this->spinner->process($text));
        $text = preg_replace("/\s{2,}/", " ", $text);

        return $text;
    }

    private function correctSentences($paragraph, $type)
    {
        $sentences = explode(".", $paragraph);

        for ($i = 0; $i < count($sentences); $i++) {
            $sentences[$i] = ucfirst(trim($sentences[$i]));
        }

        $paragraph = trim(implode(". ", $sentences));
        $length = strlen($paragraph);

        if ($type == self::PARAGRAPH) {
            if ($paragraph{$length - 1} != '.') {
                $paragraph .= '.';
            }
        } else {
            if ($paragraph{$length - 1} == '.') {
                $paragraph = substr($paragraph, 0, -1);
            }
        }

        return $paragraph;
    }

    private function replaceCity($text)
    {
        return str_replace('%CITY%', $this->city, $text);
    }
}
