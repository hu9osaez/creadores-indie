<?php namespace CreadoresIndie\Listeners;

use CreadoresIndie\Events\DiscussionWasCreated;
use Image;

class GenerateSocialPreview
{
    /**
     * Handle the event.
     *
     * @param  DiscussionWasCreated $event
     * @return void
     */
    public function handle(DiscussionWasCreated $event)
    {
        $discussion = $event->discussion;
        $category = $discussion->category;
        $user = $discussion->user;

        $fileName = md5($discussion->encoded_id) . '.png';
        $filePath = 'social-previews/' . $fileName;

        $width = 860;
        $height = 420;
        $centerX = $width / 2;
        $centerY = $height / 2;
        $maxLen = 34;
        $fontSize = 40;
        $fontHeight = 20;

        $textLines = explode('\n', wordwrap($discussion->title, $maxLen));
        $y = $centerY - ((count($textLines) - 1) * $fontHeight);

        $avatar = Image::make(url($user->avatar_url))->resize(35, 35);
        $mask = Image::canvas(50, 50)
            ->circle(45, 25, 25, function ($draw) {
                $draw->background('#fff');
            });
        $avatar->mask($mask, true);

        $image = Image::canvas($width, $height, '#f5f7ff')
            ->encode('png')
            ->rectangle(30, 30, 830, 390, function ($draw) {
                $draw->background('#f5f7ff');
                $draw->border(3, '#f0f3ff');
            })
            ->rectangle($centerX-100, 10, 530, 50,  function ($draw) {
                $draw->background('#f15c41');
            })
            ->text(strtoupper(config('app.name')), $centerX-80, 38, function ($font) {
                $font->file(resource_path('fonts') . '/FiraSans-Bold.ttf');
                $font->size(20);
                $font->color('#ffffff');
            })
            ->text('#' . $category->name, $centerX, 100, function ($font) use($category) {
                $font->file(resource_path('fonts') . '/FiraSans-Bold.ttf');
                $font->size(22);
                $font->color('#4a4a4a');
                $font->align('center');
            })
            ->text($user->username_public, 130, 340, function ($font) {
                $font->file(resource_path('fonts') . '/FiraSans-Bold.ttf');
                $font->size(18);
                $font->color('#4a4a4a');
            })
            ->text($discussion->human_date_alt, 680, 340, function ($font) {
                $font->file(resource_path('fonts') . '/FiraSans-Bold.ttf');
                $font->size(18);
                $font->color('#4a4a4a');
            })
            ->insert($avatar, 'bottom-left', 85, 70);

        foreach ($textLines as $line)
        {
            $image->text($line, $centerX, $y, function($font) use ($fontSize) {
                $font->file(resource_path('fonts') . '/FiraSans-Bold.ttf');
                $font->size($fontSize);
                $font->align('center');
                $font->valign('center');
            });

            $y += $fontHeight * 2;
        }

        $image->save(storage_path('app/public/') . $filePath);

        $discussion->social_preview = $filePath;
        $discussion->save();
    }
}
