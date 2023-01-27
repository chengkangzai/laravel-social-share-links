<?php

use Chengkangzai\LaravelSocialShareLinks\Enums\SocialMediaType;
use Chengkangzai\LaravelSocialShareLinks\SocialShareLinksBuilder;

it('can build social share link for facebook', function () {
    $url = 'https://www.google.com';
    $social = SocialMediaType::Facebook;

    $builder = new SocialShareLinksBuilder();
    $link = $builder->url($url)
        ->getSocialLink($social);

    expect($link)
        ->toBe('https://www.facebook.com/sharer/sharer.php?u=https://www.google.com');
});

it('can build social share link for twitter', function () {
    $url = 'https://www.google.com';
    $social = SocialMediaType::Twitter;
    $properties = [
        'text' => 'Hello World',
        'hashtags' => ['laravel', 'social', 'share', 'links'],
        'via' => 'laravel',
    ];

    $builder = new SocialShareLinksBuilder();
    $link = $builder->url($url)
        ->text($properties['text'])
        ->hashtags($properties['hashtags'])
        ->via($properties['via'])
        ->getSocialLink($social);

    $expected = 'https://twitter.com/intent/tweet?url=https://www.google.com&via=laravel&hashtags=laravel,social,share,links';
    expect($link)
        ->toBe($expected);
});

it('can build social share link for whatsapp', function () {
    $url = 'https://www.google.com';
    $social = SocialMediaType::Whatsapp;
    $properties = [
        'text' => 'Hello World',
    ];

    $builder = new SocialShareLinksBuilder();
    $link = $builder->url($url)
        ->text($properties['text'])
        ->getSocialLink($social);

    $expected = 'https://wa.me/?text=Hello World https://www.google.com';
    expect($link)
        ->toBe($expected);
});

it('can build social share link for telegram', function () {
    $url = 'https://www.google.com';
    $social = SocialMediaType::Telegram;
    $properties = [
        'text' => 'Hello World',
        'to' => '123456789',
    ];

    $builder = new SocialShareLinksBuilder();
    $link = $builder->url($url)
        ->text($properties['text'])
        ->phoneNumber($properties['to'])
        ->getSocialLink($social);

    $expected = 'https://t.me/share/url?url=https://www.google.com&text=Hello World&to=123456789';
    expect($link)
        ->toBe($expected);
});

it('can build social share link for linkedin', function () {
    $url = 'https://www.google.com';
    $social = SocialMediaType::Linkedin;

    $builder = new SocialShareLinksBuilder();
    $link = $builder->url($url)
        ->getSocialLink($social);

    expect($link)
        ->toBe('https://www.linkedin.com/sharing/share-offsite/?url=https://www.google.com');
});

it('can build social share link for sms', function () {
    $url = 'https://www.google.com';
    $social = SocialMediaType::Sms;
    $properties = [
        'body' => 'Hello World',
        'phone_number' => '123456789',
    ];

    $builder = new SocialShareLinksBuilder();
    $link = $builder->url($url)
        ->body($properties['body'])
        ->phoneNumber($properties['phone_number'])
        ->getSocialLink($social);

    $expected = 'sms:123456789?body=Hello World https://www.google.com';
    expect($link)
        ->toBe($expected);
});

it('can build social share link for email', function () {
    $url = 'https://www.google.com';
    $social = SocialMediaType::Email;
    $properties = [
        'title' => 'Hello World',
        'body' => 'Hello World',
        'email_recipient' => 'example@example.com',
    ];

    $builder = new SocialShareLinksBuilder();
    $link = $builder->url($url)
        ->title($properties['title'])
        ->body($properties['body'])
        ->emailRecipient($properties['email_recipient'])
        ->getSocialLink($social);

    $expected = 'mailto:example@example.com?subject=Hello World&body=Hello World https://www.google.com';
    expect($link)
        ->toBe($expected);
});

it('can build social media links for all by render method', function () {
    $url = 'https://www.google.com';
    $properties = [
        'title' => 'Hello World',
        'body' => 'Hello World',
        'text' => 'Hello World',
        'hashtags' => ['laravel', 'social', 'share', 'links'],
        'via' => 'laravel',
        'phone_number' => '123456789',
        'email_recipient' => 'sdf@example.com',
    ];

    $builder = new SocialShareLinksBuilder();
    $links = $builder->url($url)
        ->for([
            SocialMediaType::Facebook,
            SocialMediaType::Twitter,
            SocialMediaType::Whatsapp,
            SocialMediaType::Telegram,
            SocialMediaType::Linkedin,
            SocialMediaType::Sms,
            SocialMediaType::Email,
        ])
        ->title($properties['title'])
        ->body($properties['body'])
        ->text($properties['text'])
        ->hashtags($properties['hashtags'])
        ->emailRecipient($properties['email_recipient'])
        ->via($properties['via'])
        ->phoneNumber($properties['phone_number'])
        ->build();

    $expected = [
        SocialMediaType::Facebook->name => 'https://www.facebook.com/sharer/sharer.php?u=https://www.google.com',
        SocialMediaType::Twitter->name => 'https://twitter.com/intent/tweet?url=https://www.google.com&via=laravel&hashtags=laravel,social,share,links',
        SocialMediaType::Whatsapp->name => 'https://wa.me/?text=Hello World https://www.google.com',
        SocialMediaType::Telegram->name => 'https://t.me/share/url?url=https://www.google.com&text=Hello World&to=123456789',
        SocialMediaType::Linkedin->name => 'https://www.linkedin.com/sharing/share-offsite/?url=https://www.google.com',
        SocialMediaType::Sms->name => 'sms:123456789?body=Hello World https://www.google.com',
        SocialMediaType::Email->name => 'mailto:sdf@example.com?subject=Hello World&body=Hello World https://www.google.com',
    ];

    expect($links)
        ->toBe($expected);
});
