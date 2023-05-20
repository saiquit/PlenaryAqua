<?php

namespace App\Http\Controllers;

use App\Models\Variation;
use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\Drivers\Facebook\Extensions\ButtonTemplate;
use BotMan\Drivers\Facebook\Extensions\ElementButton;

class ChatController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        // DriverManager::loadDriver();
        $botman = app('botman');
        // $botman->setDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

        $botman->hears('{message}', function ($botman, $message) {
            if ($message == 'hi') {
                $this->askName($botman);
            } else if ($message == 'new') {
                $variations = Variation::orderBy('created_at', 'desc')->where('district_id', session('district'))->limit(5)->get();
                $text = '';
                foreach ($variations as $key => $variation) {
                    $text .= '<div class="latest-prdouct__slider__item"><a href="http://plenaryaqua.test/product/quam-voluptatum-enim" class="latest-product__item"><div class="latest-product__item__pic"><img src="/static/f/img/latest-product/lp-1.jpg" alt=""></div><div class="latest-product__item__text"><h6>' . $variation->name_en . '</h6><span>$' . $variation->price . '</span></div></a></div>';
                }
                $botman->reply($text);
            } else if ($message == 'button') {
                $botman->reply(
                    ButtonTemplate::create('Do you want to know more about BotMan?')
                        ->addButton(ElementButton::create('Tell me more')
                            ->type('postback')
                            ->payload('tellmemore'))
                );
            } else {
                $botman->reply("write 'hi' for testing...");
            }
        });

        $botman->listen();
    }

    /**
     * Place your BotMan logic here.
     */
    public function askName($botman)
    {
        $botman->ask('Hello! What is your Name?', function (Answer $answer) {

            $name = $answer->getText();

            $this->say('Nice to meet you ' . $name);
        });
    }
}
