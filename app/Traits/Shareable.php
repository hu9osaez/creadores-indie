<?php namespace CreadoresIndie\Traits;

trait Shareable
{
    public function getShareUrl($type = 'facebook')
    {
        $url = $this->{array_get($this->shareOptions, 'url')} ? $this->{array_get($this->shareOptions, 'url')} : url()->current();

        if ($type == 'facebook') {
            $query = urldecode(http_build_query([
                'app_id' => env('FACEBOOK_APP_ID'),
                'href' => $url,
                'display' => 'page',
                'title' => urlencode($this->{array_get($this->shareOptions, 'columns.title')})
            ]));

            return 'https://www.facebook.com/dialog/share?' . $query;
        }

        if ($type == 'twitter') {
            $query = urldecode(http_build_query([
                'url' => $url,
                'text' => urlencode(str_limit($this->{array_get($this->shareOptions, 'columns.title')}, 120))
            ]));

            return 'https://twitter.com/intent/tweet?' . $query;
        }

        if ($type == 'whatsapp') {
            $query = urldecode(http_build_query([
                'text' => urlencode($this->{array_get($this->shareOptions, 'columns.title')} . ' ' . $url)
            ]));

            return 'https://wa.me/?' . $query;
        }

        if ($type == 'linkedin') {
            $query = urldecode(http_build_query([
                'url' => $url,
                'summary' => urlencode($this->{array_get($this->shareOptions, 'columns.title')})
            ]));

            return 'https://www.linkedin.com/shareArticle?mini=true&' . $query;
        }

        if ($type == 'pinterest') {
            $query = urldecode(http_build_query([
                'url' => $url,
                'description' => urlencode($this->{array_get($this->shareOptions, 'columns.title')})
            ]));

            return 'https://pinterest.com/pin/create/button/?media=&' . $query;
        }

        if ($type == 'google') {
            $query = urldecode(http_build_query([
                'url' => $url,
            ]));

            return 'https://plus.google.com/share?' . $query;
        }
    }
}
