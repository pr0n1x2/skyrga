<?php

namespace App\Randomizer;

use App\Post;
use App\Target;
use Mikemike\Spinner\Spinner;

class ArticleBuilder
{
    const PARAGRAPH = 0;
    const HEADING = 1;

    private $post;
    private $city;
    private $state;
    private $state_shortcode;
    private $url;
    private $common_anchor;
    private $main_anchor;
    private $spinner;
    private $paragraphs = [];
    private $images = [];
    private $videos = [];

    private $isUseLinksInArticle = false;
    private $isUseCommonLinks = false;
    private $isUseMainLinks = false;
    private $isUseImages = false;
    private $isUseVideos = false;

    private $paragraphFrame;
    private $headingFrame;
    private $linkFrame;
    private $imageFrame;
    private $videoFrame;

    private $paragraphLink;

    public function __construct(Post $post, $city = null, $state = null, $state_shortcode = null, Target $target = null)
    {
        $this->post = $post;
        $this->city = $city;
        $this->state = $state;
        $this->state_shortcode = $state_shortcode;

        if (!is_null($target)) {
            $this->isUseImages = (bool)$target->project->is_use_images;
            $this->isUseVideos = (bool)$target->project->is_use_videos;
            $this->isUseLinksInArticle = (bool)$target->project->is_use_link_from_article;
            $this->isUseCommonLinks = (bool)$target->project->is_use_general_anchors;
            $this->isUseMainLinks = (bool)$target->project->is_use_main_anchors;
            $this->paragraphFrame = $target->project->paragraph_frame;
            $this->headingFrame = $target->project->heading_frame;
            $this->linkFrame = $target->project->link_frame;
            $this->imageFrame = $target->project->image_frame;
            $this->videoFrame = $target->project->video_frame;
            $this->paragraphLink = $target->project->paragraph_link;
            $this->images = $target->profile->images;
            $this->videos = $target->profile->videos;
            $this->url = $target->profile->domain;
            $this->common_anchor = $target->profile->anchor;
            $this->main_anchor = $target->profile->main_anchor;
        }

        $this->spinner = new Spinner();

        $this->dividedIntoParagraphs();
    }

    public function useLinksInArticle($isUseLinksInArticle)
    {
        $this->isUseLinksInArticle = $isUseLinksInArticle;
    }

    public function useCommonLinks($isUseCommonLinks)
    {
        $this->isUseCommonLinks = $isUseCommonLinks;
    }

    public function useMainLinks($isUseMainLinks)
    {
        $this->isUseMainLinks = $isUseMainLinks;
    }

    public function useImages($isUseImages)
    {
        $this->isUseImages = $isUseImages;
    }

    public function useVideos($isUseVideos)
    {
        $this->isUseVideos = $isUseVideos;
    }

    public function getArticle($useParagraphIndents = false)
    {
        $paragraphs = $this->paragraphs;
        $countImages = 0;
        $article = '';

        if ($this->isUseImages) {
            $countImages = $this->insertImages($paragraphs);
        }

        $this->prepareParagraphHtml($paragraphs);

        if ($this->isUseVideos) {
            $paragraphs = $this->insertVideo($paragraphs, $countImages);
        }

        $this->insertLinksInArticle($paragraphs);

        if ($this->isUseCommonLinks) {
            $this->addAdditionalParagraphWithLink($paragraphs, $this->common_anchor);
        }

        if ($this->isUseMainLinks) {
            $this->addAdditionalParagraphWithLink($paragraphs, $this->main_anchor);
        }

        $paragraphsCount = count($paragraphs);

        for ($i = 0; $i < $paragraphsCount; $i++) {
            $article .= $paragraphs[$i]['html'] . "\r\n";

            if ($useParagraphIndents) {
                if ($i != $paragraphsCount - 1) {
                    $article .= "\r\n";
                }
            }
        }

        return $article;
    }

    public function getCommonLinkParagraph()
    {
        return $this->generateAdditionalParagraphWithLink($this->common_anchor);
    }

    public function getMainLinkParagraph()
    {
        return $this->generateAdditionalParagraphWithLink($this->main_anchor);
    }

    public function getTitle()
    {
        if (empty($this->post->title)) {
            return '';
        }

        return $this->correctSentences($this->replaceCity($this->getSpunText($this->post->title)), self::HEADING);
    }

    public function getFirstParagraph($isUseTags = true)
    {
        $paragraph = '';

        for ($i = 0; $i < count($this->paragraphs); $i++) {
            if ($this->paragraphs[$i]['type'] == self::PARAGRAPH) {
                $paragraph = $this->paragraphs[$i]['html'];
                break;
            }
        }

        return $paragraph;
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

        if (!empty($this->post->text)) {
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
                $this->paragraphs[$i]['html'] = $this->replaceCity($this->paragraphs[$i]['html']);
            }
        }
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

    private function replaceState($text)
    {
        return str_replace('%STATE%', $this->state, $text);
    }

    private function replaceStateShortCode($text)
    {
        return str_replace('%STATE SHORTCODE%', $this->state_shortcode, $text);
    }

    private function insertImages(&$paragraphs)
    {
        $countImages = 0;

        if (count($this->images)) {
            $images = $this->images->toArray();
            $pIndexes = [];
            $minParagraphs = 10;

            for ($i = 0; $i < count($paragraphs); $i++) {
                if ($paragraphs[$i]['type'] == self::PARAGRAPH) {
                    $pIndexes[] = $i;
                }
            }

            $countParagraphs = count($pIndexes);

            if (!$this->isUseVideos && $countParagraphs > $minParagraphs) {
                $countImages = 2;
            } else {
                if ($countParagraphs < $minParagraphs) {
                    $countImages = 1;
                } else {
                    $countImages = rand(1, 2);
                }
            }

            $firstPos = (int)floor($countParagraphs / 2);

            if ($countImages == 2) {
                $firstPos = (int)floor($firstPos / 2);
            }

            $firstPos = rand(0, $firstPos - 1);
            $secondPos = false;

            if ($countImages == 2) {
                $secondPos = rand($firstPos + 4, $countParagraphs - 3);
            }

            $image = $this->prepareImageHtml($images[rand(0, count($images) - 1)]);
            $paragraphs[$pIndexes[$firstPos]]['html'] = $image . ' ' . $paragraphs[$pIndexes[$firstPos]]['html'];

            if ($secondPos) {
                $image = $this->prepareImageHtml($images[rand(0, count($images) - 1)]);
                $paragraphs[$pIndexes[$secondPos]]['html'] = $image . ' ' . $paragraphs[$pIndexes[$secondPos]]['html'];
            }
        }

        return $countImages;
    }

    private function prepareImageHtml($image)
    {
        if (!is_null($this->imageFrame)) {
            $html = $this->imageFrame;
        } else {
            $html = '<img src="%IMAGE%" alt="%ALT%">';
        }

        $alt = $this->correctSentences($this->getSpunText($image['alt']), self::HEADING);
        $html = str_replace(['%IMAGE%', '%ALT%'], [$image['url'], $alt], $html);

        return $html;
    }

    private function prepareParagraphHtml(&$paragraphs)
    {
        $pStartFrame = '';
        $pEndFrame = '';
        $hStartFrame = '';
        $hEndFrame = '';

        if (!is_null($this->paragraphFrame)) {
            $array = explode("|", $this->paragraphFrame);
            $pStartFrame = $array[0];
            $pEndFrame = $array[1];
        }

        if (!is_null($this->headingFrame)) {
            $array = explode("|", $this->headingFrame);
            $hStartFrame = $array[0];
            $hEndFrame = $array[1];
        }

        for ($i = 0; $i < count($paragraphs); $i++) {
            if ($paragraphs[$i]['type'] == self::PARAGRAPH) {
                $paragraphs[$i]['html'] = $pStartFrame . $paragraphs[$i]['html'] . $pEndFrame;
            } else {
                $paragraphs[$i]['html'] = $hStartFrame . $paragraphs[$i]['html'] . $hEndFrame;
            }
        }
    }

    private function insertVideo($paragraphs, $countImages)
    {
        if (count($this->videos)) {
            $videos = $this->videos->toArray();
            $pStartFrame = '';
            $pEndFrame = '';

            if (!is_null($this->paragraphFrame)) {
                $array = explode("|", $this->paragraphFrame);
                $pStartFrame = $array[0];
                $pEndFrame = $array[1];
            }

            if (!is_null($this->videoFrame)) {
                $video = $this->videoFrame;
            } else {
                $video = '<iframe width="560" height="315" src="https://www.youtube.com/embed/%VIDEO%" ' .
                    'frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" ' .
                    'allowfullscreen></iframe>';
            }

            $video = str_replace('%VIDEO%', $videos[rand(0, count($videos) - 1)]['url'], $video);

            if ($countImages == 2) {
                $arr['html'] = $pStartFrame . $video . $pEndFrame;
                $arr['type'] = self::PARAGRAPH;

                $paragraphs[] = $arr;
            } else {
                $pIndexes = [];

                for ($i = 0; $i < count($paragraphs); $i++) {
                    if ($paragraphs[$i]['type'] == self::PARAGRAPH) {
                        $pIndexes[] = $i;
                    }
                }

                $countParagraphs = count($pIndexes);
                $index = rand((int)floor($countParagraphs / 2), $countParagraphs - 1);

                $newParagraphs = [];

                for ($i = 0; $i < count($paragraphs); $i++) {
                    $newParagraphs[] = $paragraphs[$i];

                    if ($pIndexes[$index] == $i) {
                        $arr['html'] = $pStartFrame . $video . $pEndFrame;
                        $arr['type'] = self::PARAGRAPH;

                        $newParagraphs[] = $arr;
                    }
                }

                $paragraphs = $newParagraphs;
            }
        }

        return $paragraphs;
    }

    private function insertLinksInArticle(&$paragraphs)
    {
        $linkPosition = (int)$this->paragraphLink;

        if (empty($linkPosition)) {
            $linkPosition = rand(1, 4);
        }

        for ($i = 1; $i < 5; $i++) {
            if (isset($this->post->{"anchor{$i}"}) && !empty($this->post->{"anchor{$i}"})) {
                $anchor = $this->replaceCity(
                    $this->replaceState(
                        $this->replaceStateShortCode(
                            $this->getSpunText($this->post->{"anchor{$i}"})
                        )
                    )
                );

                if ($i == $linkPosition && $this->isUseLinksInArticle) {
                    $anchor = $this->createLink($anchor);
                }

                $label = "%ANCHOR{$i}%";

                for ($j = 0; $j < count($paragraphs); $j++) {
                    $paragraphs[$j] = str_replace($label, $anchor, $paragraphs[$j]);
                }
            }
        }
    }

    private function createLink($text)
    {
        if (!is_null($this->linkFrame)) {
            $array = explode("|", $this->linkFrame);
            $lStartFrame = str_replace('%URL%', $this->url, $array[0]);
            $lEndFrame = $array[1];
        } else {
            $lStartFrame = "<a href=\"{$this->url}\">";
            $lEndFrame = "</a>";
        }

        if (strpos($text, '%LINK%') === false) {
            $link = $lStartFrame . $text . $lEndFrame;
        } else {
            $link = str_replace(['%LINK%', '%/LINK%'], [$lStartFrame, $lEndFrame], $text);
        }

        return $link;
    }

    private function addAdditionalParagraphWithLink(&$paragraphs, $text)
    {
        $pStartFrame = '';
        $pEndFrame = '';

        $paragraph = $this->createLink(
            $this->replaceCity(
                $this->replaceState(
                    $this->replaceStateShortCode(
                        $this->getSpunText($text)
                    )
                )
            )
        );

        if (!is_null($this->paragraphFrame)) {
            $array = explode("|", $this->paragraphFrame);
            $pStartFrame = $array[0];
            $pEndFrame = $array[1];
        }

        $newParagraph[] = ['html' => $pStartFrame . $paragraph . $pEndFrame, 'type' => self::PARAGRAPH];
        array_splice($paragraphs, rand(1, count($paragraphs) - 1), 0, $newParagraph);
    }

    private function generateAdditionalParagraphWithLink($text)
    {
        $paragraph = $this->createLink(
            $this->replaceCity(
                $this->replaceState(
                    $this->replaceStateShortCode(
                        $this->getSpunText($text)
                    )
                )
            )
        );

        return $paragraph;
    }
}
