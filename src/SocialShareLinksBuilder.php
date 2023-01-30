<?php

namespace Chengkangzai\LaravelSocialShareLinks;

use Chengkangzai\LaravelSocialShareLinks\Enums\SocialMediaType;
use Exception;

class SocialShareLinksBuilder
{
    public string $url = '';

    public array $enabledSocials = [];

    public array $properties = [];

    public array $output = [];

    public function url(?string $url = null): self
    {
        $url = $url ?? request()->getUri();
        
        $this->url - urlencode($url);

        return $this;
    }

    public static function make(?string $url = null): static
    {
        return (new static())->url($url);
    }

    /**
     * ----------------------------------------------
     * Social Media
     * ----------------------------------------------
     */
    public function facebook(): static
    {
        $this->enabledSocials[] = SocialMediaType::Facebook;

        return $this;
    }

    public function twitter(): static
    {
        $this->enabledSocials[] = SocialMediaType::Twitter;

        return $this;
    }

    public function whatsapp(): static
    {
        $this->enabledSocials[] = SocialMediaType::Whatsapp;

        return $this;
    }

    public function telegram(): static
    {
        $this->enabledSocials[] = SocialMediaType::Telegram;

        return $this;
    }

    public function linkedIn(): static
    {
        $this->enabledSocials[] = SocialMediaType::Linkedin;

        return $this;
    }

    public function sms(): static
    {
        $this->enabledSocials[] = SocialMediaType::Sms;

        return $this;
    }

    public function email(): static
    {
        $this->enabledSocials[] = SocialMediaType::Email;

        return $this;
    }

    public function for(array $socials): static
    {
        collect(SocialMediaType::cases())
            ->each(function ($social) use ($socials) {
                collect($socials)->contains($social) ?: throw new Exception("{$social} is not a valid social media");
            });

        $this->enabledSocials = $socials;

        return $this;
    }

    /**
     * ----------------------------------------------
     * Properties
     * ----------------------------------------------
     */

    /**
     * Used by Twitter
     */
    public function via(string $via): static
    {
        $this->properties['via'] = $via;

        return $this;
    }

    /**
     * Used by Twitter
     */
    public function hashTags(array $hashTags): static
    {
        $this->properties['hashtags'] = implode(',', $hashTags);

        return $this;
    }

    /**
     * Used by Whatsapp
     */
    public function text(string $text): static
    {
        $this->properties['text'] = $text;

        return $this;
    }

    /**
     * Used by Telegram, SMS
     */
    public function phoneNumber(string $phone_number): static
    {
        $this->properties['phone_number'] = $phone_number;

        return $this;
    }

    /**
     * Used by SMS, Email
     */
    public function body(string $body): static
    {
        $this->properties['body'] = $body;

        return $this;
    }

    /**
     * Used by Email
     */
    public function title(string $title): static
    {
        $this->properties['title'] = $title;

        return $this;
    }

    /**
     * Used by Email
     */
    public function emailRecipient(string $emailRecipient): static
    {
        $this->properties['email_recipient'] = $emailRecipient;

        return $this;
    }

    /**
     * ----------------------------------------------
     * Output
     * ----------------------------------------------
     */
    public function build(): array
    {
        foreach ($this->enabledSocials as $social) {
            $this->output[$social->name] = $this->getSocialLink($social);
        }

        return $this->output;
    }

    protected function getSocialLink(SocialMediaType $social): string
    {
        $url = $this->url;

        $properties = $this->properties;

        return match ($social) {
            SocialMediaType::Facebook => $this->facebookLink($url),
            SocialMediaType::Twitter => $this->twitterLink($url, $properties),
            SocialMediaType::Whatsapp => $this->whatsappLink($url, $properties),
            SocialMediaType::Telegram => $this->telegramLink($url, $properties),
            SocialMediaType::Linkedin => $this->linkedinLink($url),
            SocialMediaType::Sms => $this->smsLink($url, $properties),
            SocialMediaType::Email => $this->emailLink($url, $properties),
        };
    }

    public function facebookLink(string $url): string
    {
        return "https://www.facebook.com/sharer/sharer.php?u={$url}";
    }

    public function twitterLink(string $url, array $properties): string
    {
        $via = $properties['via'] ?? '';
        $hashtags = $properties['hashtags'] ?? '';

        return "https://twitter.com/intent/tweet?url={$url}&via={$via}&hashtags={$hashtags}";
    }

    public function whatsappLink(string $url, array $properties): string
    {
        $text = $properties['text'] ?? '';

        return "https://wa.me/?text={$text} {$url}";
    }

    public function telegramLink(string $url, array $properties): string
    {
        $phone_number = $properties['phone_number'] ?? '';
        $text = $properties['text'] ?? '';

        return "https://t.me/share/url?url={$url}&text={$text}&to={$phone_number}";
    }

    public function linkedinLink(string $url): string
    {
        return "https://www.linkedin.com/sharing/share-offsite/?url={$url}";
    }

    public function smsLink(string $url, array $properties): string
    {
        $phone_number = $properties['phone_number'] ?? '';
        $body = $properties['body'] ?? '';

        return "sms:{$phone_number}?body={$body} {$url}";
    }

    public function emailLink(string $url, array $properties): string
    {
        $title = $properties['title'] ?? '';
        $body = $properties['body'] ?? '';
        $emailRecipient = $properties['email_recipient'] ?? '';

        return "mailto:{$emailRecipient}?subject={$title}&body={$body} {$url}";
    }
}
